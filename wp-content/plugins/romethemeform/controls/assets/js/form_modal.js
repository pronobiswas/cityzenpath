jQuery(document).ready(($) => {
    $(document).on('click', '.rform-editform-btn', function () {
        $(this).closest('.rform-editform').find('.rform-editform-modal').toggle();
        var selectedContent = $(this).closest('.rform-editform').find('.rform-editform-modal').find('.rform-radio-btn:checked').data('content');
        $(selectedContent).show();
    });

    $(document).on('click', '.rform-radio-btn', function () {
        var selectedContent = $(this).data('content');
        $(this).closest('.rform-modal-tabs').find('.rform-tab-content').not(selectedContent).hide();
        $(selectedContent).show();
    });

    $(document).on('click', '.rform-close-btn', function () {
        $(this).closest('.rform-editform-modal').toggle();
    });

    $(document).on('click', '#rform-editform-button', function () {
        $(this).html('SAVING...');
        $(this).attr('disabled' , true);
        let $this = $(this);
        var uid = $(this).data('control-uid');
        var modal = $("#myModal" + uid);
        var iframe = window.parent.document.getElementById("ifr-" + uid);
        var elementorEditor = iframe.contentWindow.elementor;

        var panel = elementor.getPanelView();
        // Get the current selected widget
        var currentSelectedWidget = panel.getCurrentPageView().getOption('editedElementView');

        elementorEditor.saver.saveEditor({
            status: elementorEditor.settings.page.model.get('post_status'),
            onSuccess: function () {
                modal.hide();
                currentSelectedWidget.renderOnChange();
                iframe.src = '';
                $this.html('SAVE & CLOSE');
                $this.removeAttr('disabled');
            },
            onError: function () {
                alert("Error saving Form");
            }
        });
    });

    $(document).on('click', '.tab-item', function () {
        $('.tab-item').removeClass('active');
        // Menambahkan class active pada tab yang diklik
        $(this).addClass('active');

        // Mengambil data-tab dari tab yang diklik
        var tabId = $(this).attr('data-tab');

        // Menampilkan konten tab yang sesuai dengan data-tab
        $('.tab-pane').removeClass('active');
        $('#' + tabId).addClass('active');
    });

    $(document).on('click', '#switch_confirmation', function () {
        var checked = jQuery('#switch_confirmation').prop('checked');
        if (checked) {
            jQuery('#confirmation_form').show();
        } else {
            jQuery('#confirmation_form').hide();
        }
    });
    $(document).on('click', '#switch_notification', function () {
        var checked = jQuery('#switch_notification').prop('checked');
        if (checked) {
            jQuery('#notification_form').show();
        } else {
            jQuery('#notification_form').hide();
        }
    });
});
