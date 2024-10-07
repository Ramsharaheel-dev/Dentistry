$("#uploadLatestPic").click(function () {
    $("input[id='editProfilePic']").click();
});

$("#uploadLatestStatement").click(function () {
    $("input[id='editStatement']").click();
});

$("#uploadLatestStatementOne").click(function () {
    $("input[id='editStatementOne']").click();
});

$("#uploadLatestStatementTwo").click(function () {
    $("input[id='editStatementTwo']").click();
});

$("#uploadLatestStatementThree").click(function () {
    $("input[id='editStatementThree']").click();
});

document.getElementById("editStatement").onchange = function () {
    var src = this.files[0].name.slice(0, this.files[0].name.lastIndexOf("."));
    document.getElementById("updateFileName").value = src;
};

document.getElementById("editStatementOne").onchange = function () {
    var src = this.files[0].name.slice(0, this.files[0].name.lastIndexOf("."));
    document.getElementById("updateFileNameOne").value = src;
};

document.getElementById("editStatementTwo").onchange = function () {
    var src = this.files[0].name.slice(0, this.files[0].name.lastIndexOf("."));
    document.getElementById("updateFileNameTwo").value = src;
};

document.getElementById("editStatementThree").onchange = function () {
    var src = this.files[0].name.slice(0, this.files[0].name.lastIndexOf("."));
    document.getElementById("updateFileNameThree").value = src;
};
function alignModal() {
    var modalDialog = $(this).find(".modal-dialog");

    // Applying the top margin on modal to align it vertically center
    modalDialog.css(
        "margin-top",
        Math.max(0, ($(window).height() - modalDialog.height()) / 2)
    );
}
// Align modal when it is displayed
$(".modal").on("shown.bs.modal", alignModal);

// Align modal when user resize the window
$(window).on("resize", function () {
    $(".modal:visible").each(alignModal);
});

$("#verifyButton").click(function (event) {
    $("#submitButton").click();
});
