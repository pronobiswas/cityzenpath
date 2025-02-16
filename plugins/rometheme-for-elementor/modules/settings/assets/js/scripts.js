jQuery(document).ready(($) => {
    const form = $('#set-global-style');

    form.on('submit' , function(e) {
        e.preventDefault();
        let thisForm = $(this);
        let dataSerialize = thisForm.serialize();
        let data = dataSerialize + '&nonce=' + rtm_settings.nonce;
        let selectHtml = thisForm.find('select');
        let button = thisForm.find('button');

        let spinner = '<span class="spinner-border spinner-border-sm me-3" aria-hidden="true"></span><span role="status">Saving...</span>';

        selectHtml.attr('disabled' , 'disabled');
        button.attr('disabled' , 'true');

        button.empty();
        button.html(spinner);
        
        $.ajax({
            type : 'POST' ,
            url : rtm_settings.ajax_url,
            data : data ,
            success : function(res) {
                selectHtml.removeAttr('disabled');
                button.empty();
                button.text('Save Changes');
                button.removeAttr('disabled');
            }
        });
        
    });
});