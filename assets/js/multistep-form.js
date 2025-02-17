jQuery(document).ready(function ($) {
    let currentStep = 1;
    
    function showStep(step) {
        $(".step").hide();
        $(".step-" + step).show();
    }

    function saveStepData(step, moveNext = false) {
        let formData = {
            action: "save_step_data",
            step: step,
            multi_step_nonce: $("#multi_step_nonce").val(),
            name: $("#name").val(),
            email: $("#email").val(),
            address: $("#address").val(),
            nid: $("#nid").val(),
            passport: $("#passport").val()
        };

        $.post(ajax_object.ajax_url, formData, function (response) {
            console.log(response);
            if (moveNext) {
                currentStep++;
                showStep(currentStep);
            }
        });
    }

    $(".next-step").click(function () {
        let step = $(this).data("step");
        saveStepData(step, true);
    });

    $(".prev-step").click(function () {
        currentStep--;
        showStep(currentStep);
    });

    $(".save-progress").click(function () {
        let step = $(this).data("step");
        saveStepData(step, false);
        alert("Progress saved!");
    });

    $("#generatePdf").click(function () {
        window.location.href = ajax_object.ajax_url + "?action=generate_pdf";
    });

    showStep(currentStep);
});
