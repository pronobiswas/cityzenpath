jQuery(document).ready(($) => {
    $('.rform-button-submit').click(function (event) {
        event.preventDefault();
        var form = $(this).closest("form");
        var form_id = form.attr('data-form');
        if (form.hasClass('rform-dsb')) {
            var m = form.find('.require-login');
            m.css('display', 'block');
        } else {
            form.find('.rform-select').each(function () {
                if ($(this).is('[required]')) {
                    var value = $(this).closest('.rform-select-container').find('.rform-select-input').val();
                    if (value === "") {
                        $(this).attr("aria-invalid", "true");
                    } else {
                        $(this).attr("aria-invalid", "false");
                    }
                }

            });
            if (form.get(0).checkValidity()) {
                if (form.find("[aria-invalid= true]").length == 0) {
                    // console.log('Form Valid'); 

                    var loading = form.find('.loading');
                    loading.css('display', 'flex');
                    $(this).prop('disabled', true);
                    var data = form.serializeArray();
                    var serializedInputs = {};
                    var nonce = romethemeform_ajax_url.nonce;
                    $(data).each(function (index, obj) {
                        if (serializedInputs[obj.name] !== undefined) {
                            if (!Array.isArray(serializedInputs[obj.name])) {
                                serializedInputs[obj.name] = [serializedInputs[obj.name]];
                            }
                            serializedInputs[obj.name].push(obj.value);
                        } else {
                            serializedInputs[obj.name] = obj.value;
                        }
                    });

                    var jsonString = JSON.stringify(serializedInputs);
                    var data_sending = { action: "rformsendform", id: form_id, data: jsonString, email: form.find('input[type="email"]').val() , nonce : nonce , page :  window.location.href };
                    // console.log(data_sending);
                    sending_form(data_sending, $(this), loading);
                } else {
                    form.find(":invalid").each(function () {
                        $(this).attr("aria-invalid", "true");
                    });
                }
            } else {
                form.find(":invalid").each(function () {
                    $(this).attr("aria-invalid", "true");
                });
            }
        }
    });
    $('.close-msg').click(function (event) {
        event.preventDefault();
        var msg = $(this).closest('.msg');
        msg.css('display', 'none');
    });
});


function sending_form(data, btn, loading) {
    console.log(data);
    jQuery(document).ready(($) => {
        $.ajax({
            type: 'post',
            url: romethemeform_ajax_url.ajax_url,
            data: data,
            success: (e) => {
                btn.prop('disabled', false);
                btn.closest('form').find('.success-submit').css('display', 'block');
                loading.css('display', 'none');
                btn.closest('form')[0].reset();
                console.log(e);
            },
            error : (jqXHR, textStatus, errorThrown) => {
                console.log(textStatus, errorThrown);
            }
        });

    });
}