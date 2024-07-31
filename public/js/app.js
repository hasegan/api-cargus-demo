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

// ----------------------- D H L --------------------------
function nextQuestionDHL() {
    // Check if all the fields for the sender are completed:
    // if all the fields are completed => receiver details
    // else show error message
    if ($("#shipperDetalis").hasClass("d-block")) {
        if (
            $("#senderCountry").find(":selected").val() != 0 &&
            $("#senderCityName").find(":selected").val() != 0 &&
            $("#senderAddress").val() &&
            $("#senderPostalCode").val()
        ) {
            $(".backBtn").removeClass("d-none");
            var currentQuestion = $("div.d-block");
            var nextQuestion = $("div.d-block").next(".d-none");

            // show next question & hide previous one
            currentQuestion.removeClass("d-block").addClass("d-none");
            nextQuestion.removeClass("d-none").addClass("d-block");

            // hide next btn & show submit btn
            if (nextQuestion.hasClass("last")) {
                $(".nextBtn").addClass("d-none");
                $(".saveBtn").removeClass("d-none");
            }
        } else {
            if ($("#senderCountry").find(":selected").val() == 0) {
                $("#check-senderCountry").text("Country is required.");
            }
            if ($("#senderCityName").find(":selected").val() == 0) {
                $("#check-senderCityName").text("City is required.");
            }
            if ($("#senderAddress").val() == "") {
                $("#check-senderAddress").text("Address is required.");
            }
            if ($("#senderPostalCode").val() == "") {
                $("#check-senderPostalCode").text("Postal Code is required.");
            }
        }
    }
    // Check if all the fields for the receiver are completed:
    // if all the fields are completed => package details
    // else show error message
    else if ($("#receiverDetalis").hasClass("d-block")) {
        if (
            $("#receiverCountry").find(":selected").val() != 0 &&
            $("#receiverCityName").find(":selected").val() != 0 &&
            $("#receiverAddress").val() &&
            $("#receiverPostalCode").val()
        ) {
            $(".backBtn").removeClass("d-none");
            var currentQuestion = $("div.d-block");
            var nextQuestion = $("div.d-block").next(".d-none");

            // show next question & hide previous one
            currentQuestion.removeClass("d-block").addClass("d-none");
            nextQuestion.removeClass("d-none").addClass("d-block");

            // hide next btn & show submit btn
            if (nextQuestion.hasClass("last")) {
                $(".nextBtn").addClass("d-none");
                $(".saveBtn").removeClass("d-none");
            }
        } else {
        }
        if ($("#receiverCountry").find(":selected").val() == 0) {
            $("#check-receiverCountry").text("Country is required.");
        }
        if ($("#receiverCityName").find(":selected").val() == 0) {
            $("#check-receiverCityName").text("City is required.");
        }
        if ($("#receiverAddress").val() == "") {
            $("#check-receiverAddress").text("Address is required.");
        }
        if ($("#receiverPostalCode").val() == "") {
            $("#check-receiverPostalCode").text("Postal Code is required.");
        }
    }
}

function backQuestionDHL() {
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

function submitFormDHL() {
    if ($("#weight").val() == "" || $("#weight").val() == 0) {
        $("#check-weight").text("Weight is not specifie (0 not allowed)");
    } else if (!$.isNumeric($("#weight").val())) {
        $("#check-weight").text("Only digits are allowed.");
    }

    if ($("#height").val() == "" || $("#height").val() == 0) {
        $("#check-height").text("Height is not specified (0 not allowed)");
    } else if (!$.isNumeric($("#height").val())) {
        $("#check-height").text("Only digits are allowed.");
    }

    if ($("#width").val() == "" || $("#width").val() == 0) {
        $("#check-width").text("Width is not specified (0 not allowed)");
    } else if (!$.isNumeric($("#width").val())) {
        $("#check-width").text("Only digits are allowed.");
    }

    if ($("#length").val() == "" || $("#length").val() == 0) {
        $("#check-length").text("Length is not specified (0 not allowed)");
    } else if (!$.isNumeric($("#length").val())) {
        $("#check-length").text("Only digits are allowed.");
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

$(document).ready(function () {
    $("#senderCountry").on("change", function () {
        var countryCODE = $(this).val();
        if (countryCODE) {
            $.ajax({
                type: "POST",
                // url: "../php/getCities.php",
                url: "/get-cities",
                data: {
                    country_code: encodeURIComponent(countryCODE),
                    _token: $('meta[name="csrf-token"]').attr("content"),
                },
                success: function (html) {
                    $("#senderCityName").html(html);
                },
            });
        } else {
            $("#senderCityName").html(
                '<option value="">Select country first</option>'
            );
        }
    });

    $("#receiverCountry").on("change", function () {
        var countryCODE = $(this).val();
        if (countryCODE) {
            $.ajax({
                type: "POST",
                // url: "../php/getCities.php",
                url: "/get-cities",
                data: {
                    country_code: encodeURIComponent(countryCODE),
                    _token: $('meta[name="csrf-token"]').attr("content"),
                },
                success: function (html) {
                    $("#receiverCityName").html(html);
                },
            });
        } else {
            $("#receiverCityName").html(
                '<option value="">Select country first</option>'
            );
        }
    });
});
