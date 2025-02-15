jQuery(window).on('elementor/frontend/init', function () {
    elementorFrontend.hooks.addAction('frontend/element_ready/rform_phone.default', function ($scope, $) {
        $('.rform-input-tel').each(function() {
            var iti = window.intlTelInput(this, {
              initialCountry: $(this).data('default-countries'),
              separateDialCode: true,
              utilsScript: intl_tel_input_script.url,
              placeholderNumberType: 'FIXED_LINE_OR_MOBILE',
            });

            $(this).on('blur' , function () {
              var formattedNumber =  iti.getNumber(intlTelInputUtils.numberFormat.E164);
              $(this).val(formattedNumber);
            });
        
            // Menyimpan instance variabel sehingga bisa diakses dalam console, misalnya window.iti.getNumber()
            // $(this).data('iti', iti);
          });
    });
});