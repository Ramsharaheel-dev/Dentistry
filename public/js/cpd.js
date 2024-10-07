$("#verifyButton").click(function () {
    var allChecked = !!$('form input[type="checkbox"]:not(:checked)').length;
    if (allChecked) {
        alert("Please complete all tasks and mark them as checked to submit.");
    } else {
        $("#submitButton").click();
    }
});
