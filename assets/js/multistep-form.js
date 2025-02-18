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
            form_id: $('#form_id').val(),
            form_title: $('#form_title').val(),
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
        let formID = $("#form_id").val();
        window.location.href = ajax_object.ajax_url + "?action=generate_pdf&form_id=" + formID;
    });

    showStep(currentStep);
});

jQuery(document).ready(function($) {
    $(".delete-form").click(function(e) {
        e.preventDefault();
        
        if (!confirm("Are you sure you want to delete this form?")) {
            return;
        }

        var formID = $(this).data("form-id");
        var button = $(this);

        $.ajax({
            url: ajax_object.ajax_url,
            type: "POST",
            data: {
                action: "delete_user_form",
                form_id: formID,
            },
            success: function(response) {
                if (response.success) {
                    alert("Form deleted successfully!");
                    button.closest("tr").remove();
                } else {
                    alert("Failed to delete form. Try again!");
                }
            }
        });
    });
});