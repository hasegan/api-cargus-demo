$(document).ready(function () {
    if ($(".first").hasClass("d-block")) {
        $(".backBtn").addClass("d-none");
    }
});

function nextQuestion() {
    if ($(".d-block").find(":selected").val() != 0) {
        $(".backBtn").removeClass("d-none");
        var currentQuestion = $("div.d-block");
        var nextQuestion = $("div.d-block").next(".d-none");

        // show next question & hide previous one
        currentQuestion.removeClass("d-block").addClass("d-none");
        nextQuestion.removeClass("d-none").addClass("d-block");

        // progress bar
        var progressBarWidth = $(".progress").width();
        var progressPerQuestion = progressBarWidth / 3;
        var lastProgress = $(".progress-bar").width();
        var progress = lastProgress + progressPerQuestion;

        $(".progress-bar").css("width", progress);

        // hide next btn & show submit btn
        if (nextQuestion.hasClass("last")) {
            $(".nextBtn").addClass("d-none");
            $(".saveBtn").removeClass("d-none");
        }
    } else {
        if ($(".d-block").find("select").attr("id") == "deliveryStart") {
            $("#check-" + $(".d-block").find("select").attr("id")).text(
                "Localitatea de expediere este obligatorie."
            );
        } else if ($(".d-block").find("select").attr("id") == "deliveryEnd") {
            $("#check-" + $(".d-block").find("select").attr("id")).text(
                "Localitatea de destinatie este obligatorie."
            );
        }
    }
}

function backQuestion() {
    var currentQuestion = $("div.d-block");
    var backQuestion = $("div.d-block").prev(".d-none");

    currentQuestion.removeClass("d-block").addClass("d-none");
    backQuestion.removeClass("d-none").addClass("d-block");

    // hide back btn when you return to the first question
    if (backQuestion.hasClass("first")) {
        $(".backBtn").addClass("d-none");
    }

    // progress bar
    var progressBarWidth = $(".progress").width();
    var progressPerQuestion = progressBarWidth / 3;
    var lastProgress = $(".progress-bar").width();
    var progress = lastProgress - progressPerQuestion;

    $(".progress-bar").css("width", progress);

    // show next btn & hide submit btn
    if (currentQuestion.hasClass("last")) {
        $(".nextBtn").removeClass("d-none");
        $(".saveBtn").addClass("d-none");
    }
}

function removeWarning(id) {
    $("#check-" + id).text("");
}

function submitForm() {
    if ($("#weight").val() == "") {
        $("#check-weight").text("Greutatea este necesara.");
    } else if (!$.isNumeric($("#weight").val())) {
        $("#check-weight").text("Doar cifre sunt acceptate!");
    }

    if ($("#height").val() == "") {
        $("#check-height").text("Inaltimea este necesara.");
    } else if (!$.isNumeric($("#height").val())) {
        $("#check-height").text("Doar cifre sunt acceptate!");
    }

    if ($("#width").val() == "") {
        $("#check-width").text("Latimea este necesara.");
    } else if (!$.isNumeric($("#width").val())) {
        $("#check-width").text("Doar cifre sunt acceptate!");
    }

    if ($("#length").val() == "") {
        $("#check-length").text("Lungimea este necesara.");
    } else if (!$.isNumeric($("#length").val())) {
        $("#check-length").text("Doar cifre sunt acceptate!");
    }

    if (
        $("#check-weight").text().length == 0 &&
        $("#check-height").text().length == 0 &&
        $("#check-width").text().length == 0 &&
        $("#check-length").text().length == 0
    ) {
        $("form").submit();
    }
}
