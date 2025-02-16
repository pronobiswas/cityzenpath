 jQuery(document).ready(($) => {
    $('#formUpdate').on('show.bs.modal', (event) => {
        var edit_button = $(event.relatedTarget);
        var post_id = edit_button.data('form-id');
        var post_name = edit_button.data('form-name');
        var post_entry = edit_button.data('form-entry');
        var post_restricted = edit_button.data('form-restricted');
        var post_msg_succes = edit_button.data('form-msg-success');
        var modal = $('#formUpdate');

        fetch(romethemeform_ajax_url.rest_url + post_id)
            .then(response => response.json())
            .then(data => {
                if (data.meta.rtform_email_confirmation.length != 0) {
                    $('#update_switch_confirmation').prop('checked', true);
                    var data_confirmation = JSON.parse(data.meta.rtform_email_confirmation);
                    toogle_update_confirmation();
                    $('#update_email_subject').val(data_confirmation.email_subject);
                    $('#update_email_from').val(data_confirmation.email_from);
                    $('#update_email_replyto').val(data_confirmation.email_replyto);
                    $('#update_thks_msg').val(decodeURIComponent(data_confirmation.thankyou_msg));
                } else {
                    $('#update_switch_confirmation').prop('checked', false);
                    toogle_update_confirmation();
                }

                if (data.meta.rtform_email_notification.length != 0) {
                    $('#update_switch_notification').prop('checked', true);
                    toogle_update_notif();
                    var data_notification = JSON.parse(data.meta.rtform_email_notification);
                    $('#update_notif_subject').val(data_notification.notif_subject);
                    $('#update_notif_email_to').val(data_notification.notif_email_to);
                    $('#update_notif_email_from').val(data_notification.notif_email_from);
                    $('#update_adm_msg').val(decodeURIComponent(data_notification.admin_note));
                } else {
                    $('#update_switch_notification').prop('checked', false);
                    toogle_update_notif();
                }
            })
            .catch(error => {
                console.error(error);
                // Lakukan penanganan kesalahan sesuai kebutuhan Anda di sini
            });

        modal.find('#form-name').val(post_name);
        modal.find('#id').val(post_id);
        modal.find('#entry-name').val(post_entry);
        modal.find('#success-message').val(post_msg_succes);;
        if (post_restricted === true) {
            modal.find('#switch').prop("checked", true)
        } else {
            modal.find('#switch').prop("checked", false)
        }

        $('#update_switch_confirmation').click((event) => {
            toogle_update_confirmation();
        });
        $('#update_switch_notification').click((event) => {
            toogle_update_notif();
        });

    });

    $('#rform-save-editor-btn').click((event) => {
        var modal = $(event.currentTarget).closest('#rform-editor-modal');
        var iframe = modal.find('#rform-elementor-editor');
        var elementorEditor = iframe[0].contentWindow.elementor;
        elementorEditor.saver.saveEditor({
            status: elementorEditor.settings.page.model.get('post_status'),
            onSuccess: function () {
                location.href = romethemeform_url.form_url;
            },
            onError: function () {
                alert("Error saving Form");
            }
        });
    });

    $('#rform-save-button').click((event) => {
        $(event.currentTarget).html('Saving...');
        $(event.currentTarget).prop('disabled', true);
        $('#rtform-add-form').find('#close-btn').prop('disabled', true);
        $('#rtform-add-form').find('.btn-close').prop('disabled', true);
        var form_data = $('#rtform-add-form').serialize();
        var nonce = romethemeform_ajax_url.nonce;
        var data = form_data + '&nonce=' + nonce;
        // console.log(romethemeform_ajax_url.rest_url);
        $.ajax({
            type: 'post',
            url: romethemeform_ajax_url.ajax_url,
            data: data,
            success: (response) => {
                const modal = document.getElementById('rform-editor-modal');
                const iframe = document.getElementById('rform-elementor-editor');
                $('#formModal').modal('hide');
                iframe.src = response.data.url;
                modal.style.display = 'block';
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error("The following error occured: " + textStatus, errorThrown);
            },
        });
    });

    $('#rform-update-button').click((event) => {
        $(event.currentTarget).html('Saving...');
        $(event.currentTarget).prop('disabled', true);
        $('#rtform-update-form').find('#close-btn').prop('disabled', true);
        $('#rtform-update-form').find('.btn-close').prop('disabled', true);
        form_data = $('#rtform-update-form').serialize();
        var nonce = romethemeform_ajax_url.nonce;
        var data = form_data + '&nonce=' + nonce;
        // console.log(form_data);
        $.ajax({
            type: 'post',
            url: romethemeform_ajax_url.ajax_url,
            data: data,
            success: (data) => {
                location.href = romethemeform_url.form_url;
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error("The following error occured: " + textStatus, errorThrown);
            },
        });
    });
    $('#formModal').on('show.bs.modal', (event) => {
        toogle_form_confirmation();
        toogle_form_notif();
        $('#switch_confirmation').click((event) => {
            toogle_form_confirmation();
        });
        $('#switch_notification').click((event) => {
            toogle_form_notif();
        });
    });

});

function toogle_form_confirmation() {
    var checked = jQuery('#switch_confirmation').prop('checked');
    if (checked) {
        jQuery('#confirmation_form').show();
    } else {
        jQuery('#confirmation_form').hide();
    }
}

function toogle_update_confirmation() {
    var checked = jQuery('#update_switch_confirmation').prop('checked');
    if (checked) {
        jQuery('#update_confirmation_form').show();
    } else {
        jQuery('#update_confirmation_form').hide();
    }
}

function toogle_form_notif() {
    var checked = jQuery('#switch_notification').prop('checked');
    if (checked) {
        jQuery('#notification_form').show();
    } else {
        jQuery('#notification_form').hide();
    }
}

function toogle_update_notif() {
    var checked = jQuery('#update_switch_notification').prop('checked');
    if (checked) {
        jQuery('#update_notification_form').show();
    } else {
        jQuery('#update_notification_form').hide();
    }
}


function export_entries(form_id, form_name) {
    jQuery(document).ready(($) => {
        var nonce = romethemeform_ajax_url.nonce;
        window.location.href = `${romethemeform_ajax_url.ajax_url}?action=export_entries&form_id=${form_id}&form_name=${form_name}&nonce=${nonce}`;
    });
}