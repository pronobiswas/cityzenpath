jQuery(document).ready(($) => {
    $('.rform-deserve-btn').click(() => {
        window.open('https://wordpress.org/support/plugin/romethemeform/reviews/' , '_blank');
        $.ajax({
            type: 'post',
            url: ajax_url.ajax_url,
            data: { 'action': 'remove_notice' },
            success: (data) => {
                console.log('Love Using RomethemeForm For Elementor')
                $('#rform-notices').remove();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error("The following error occured: " + textStatus, errorThrown);
            },
        });
    })
});