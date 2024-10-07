const videoElement = document.getElementById("video");
const startRecordButton = document.getElementById("startRecord");
const stopRecordButton = document.getElementById("stopRecord");
// const saveVideoButton = document.getElementById("saveVideo");
let mediaRecorder;
let chunks = [];

// Start recording when the "Start Recording" button is clicked
startRecordButton.addEventListener("click", startRecording);

// Stop recording when the "Stop Recording" button is clicked
stopRecordButton.addEventListener("click", stopRecording);

// Save the recorded video when the "Save Video" button is clicked
// saveVideoButton.addEventListener("click", saveVideo);

// Function to start recording
async function startRecording() {
    const stream = await navigator.mediaDevices.getUserMedia({
        audio: true,
        video: true,
    });
    videoElement.srcObject = stream;
    mediaRecorder = new MediaRecorder(stream);

    mediaRecorder.ondataavailable = (event) => {
        if (event.data.size > 0) {
            chunks.push(event.data);
        }
    };

    mediaRecorder.onstop = () => {
        const blob = new Blob(chunks, { type: "video/webm" });
        // console.log(blob);
        // console.log(chunks);
        // saveVideoButton.disabled = false;

        stopRecording(chunks);
    };

    mediaRecorder.start();
    startRecordButton.disabled = true;
    stopRecordButton.disabled = false;
}

function stopRecording(chunks) {
    mediaRecorder.stop();
    startRecordButton.disabled = false;
    stopRecordButton.disabled = true;

    if (chunks.length > 0) {
        const blob = new Blob(chunks, { type: "video/webm" });

        // Create a FormData object and append the blob to it
        const formData = new FormData();
        formData.append("video", blob);

        // console.log(blob);
        saveVideo(blob);
    }
}

// Function to save the recorded video on the server
// async function saveVideo(blob) {
//     const formData = new FormData();

//     formData.append("video", blob, "recorded-video.webm");
//     console.log(blob);

//     // const response = await fetch("/lara/dev/dian/public/save-video", {
//     //     method: "POST",
//     //     body: formData,
//     // });

//     try {
//         const response = await fetch("/save-video", {
//             method: "POST",
//             body: formData,
//         });

//         if (response.ok) {
//             const replayRecord = document.getElementById("replayRecord");
//             replayRecord.style.display = "block";
//             replayRecord.style.cursor = "pointer";
//             const data = await response.json();
//             console.log(data.videoLink);
//             replayRecord.href = data.videoLink;
//             alert("Video saved successfully.");
//         } else {
//             const errorMessage = await response.text();
//             alert("Error saving the video: " + errorMessage);
//         }
//     } catch (error) {
//         console.error("An error occurred:", error);
//         alert("An error occurred while saving the video.");
//     }
// }

async function saveVideo(blob) {
    const formData = new FormData();
    formData.append("video", blob, "recorded-video.webm");

    try {
        const response = await fetch("/save-video", {
            method: "POST",
            body: formData,
        });
        // console.log("formData", formData);

        if (response.ok) {
            const replayRecord = document.getElementById("replayRecord");
            replayRecord.style.display = "block";
            replayRecord.style.cursor = "pointer";
            const data = await response.json();
            console.log(data.videoLink);
            replayRecord.href = data.videoLink;
            alert("Video saved successfully.");
        } else {
            const errorMessage = await response.text();
            console.error("Server responded with an error:", errorMessage);
            alert("Error saving the video: " + errorMessage);
        }
    } catch (error) {
        console.error("An error occurred while saving the video:", error);
        alert("An error occurred while saving the video.");
    }
}

