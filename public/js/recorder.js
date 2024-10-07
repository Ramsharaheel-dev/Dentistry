// Assuming you have a button with ID "startButton" and "stopButton"
const startButton = document.getElementById("startButton");
const stopButton = document.getElementById("stopButton");

let recordedChunks = [];

startButton.addEventListener("click", () => {
    navigator.mediaDevices
        .getUserMedia({ audio: true })
        .then((stream) => {
            const mediaRecorder = new MediaRecorder(stream);

            mediaRecorder.ondataavailable = (event) => {
                if (event.data.size > 0) {
                    recordedChunks.push(event.data);
                }
            };

            mediaRecorder.onstop = () => {
                const audioBlob = new Blob(recordedChunks, {
                    type: "audio/wav",
                });
                const formData = new FormData();
                formData.append("audio", audioBlob);

                fetch("/save-audio-test", {
                    method: "POST",
                    body: formData,
                })
                    .then((response) => response.json())
                    .then((data) => {
                        // Update the UI with the transcribed text
                        const transcribedText = data.transcribedText;
                        // Update the UI with transcribedText
                    })
                    .catch((error) => {
                        console.error("Transcription error:", error);
                    });
            };

            mediaRecorder.start();
            recordedChunks = [];
        })
        .catch((error) => {
            console.error("Error accessing microphone:", error);
        });
});

stopButton.addEventListener("click", () => {
    mediaRecorder.stop();
});
