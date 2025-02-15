jQuery(document).on('click', '.rform-select-div', function (event) {
    jQuery(this).closest('.rform-select-container').find('.rform-options-container').toggle();
    jQuery(this).closest('.rform-select-container').find('.rform-select-div').toggleClass('rotate');
    jQuery(this).closest('.rform-select-container').find('.rform-option').click(function (event) {
        jQuery(this).closest('.rform-select-container').find('.rform-select').focus();
        var val = jQuery(this).data('value');
        var text = jQuery(this).text();
        if (!jQuery(this).is('[disabled]')) {
            jQuery(this).closest('.rform-select-container').find('.rform-select').val(text);
            jQuery(this).closest('.rform-select-container').find('.rform-select-input').val(val);
            jQuery(this).closest('.rform-select-container').find('.rform-options-container').hide();
            jQuery(this).closest('.rform-select-container').find('.rform-select-div').removeClass('rotate');
            if (val === "") {
                jQuery(this).closest('.rform-select-container').find('.rform-select').attr('aria-invalid', 'true');
            } else {
                jQuery(this).closest('.rform-select-container').find('.rform-select').attr('aria-invalid', 'false');
            }
        }
    });
});
