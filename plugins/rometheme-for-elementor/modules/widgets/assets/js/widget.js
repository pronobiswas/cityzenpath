jQuery(document).ready(function ($) {
  disableBtn = $("#disable-all");
  enableBtn = $("#enable-all");
  saveBtn = $("#save-widget-options");
  resetBtn = $("#reset-btn");

  disableBtn.click(function (e) {
    e.preventDefault();
    form = $(this).closest("#widgets_option");
    form.find("input").prop("checked", false);
  });

  enableBtn.click(function (e) {
    e.preventDefault();
    form = $(this).closest("#widgets_option");
    form.find("input").prop("checked", true);
  });

  saveBtn.click(function (e) {
    e.preventDefault();
    btn = $(this);
    btn.html("Saving...");
    btn.prop("disabled", true);
    form = $(this).closest("#widgets_option");
    formPro = $("#widgets_option_pro");
    const formData = form.serialize();
    const formDataPro = formPro.serialize();
    var nonce = rometheme_ajax_url.nonce;

    const data = formData + "&nonce=" + nonce;
    const dataPro = formDataPro + "&nonce=" + nonce;

    $.ajax({
      method: "POST",
      url: rometheme_ajax_url.ajax_url,
      data: data,
      success: function (res) {
        // btn.html('Save Changes');
        // btn.prop('disabled', false);
        if (rometheme_ajax_url.isProActive) {
            $.ajax({
                method: "POST",
                url: rometheme_ajax_url.ajax_url,
                data: dataPro,
                success: function (res) {
                  // btn.html('Save Changes');
                  // btn.prop('disabled', false);
                  window.location.reload();
                // console.log(res);
                
                },
              });
        } else {
            window.location.reload();
        }
      },
    });
  });

  resetBtn.click(function (e) {
    e.preventDefault();
    resetBtn.html("Resetting");
    resetBtn.prop("disabled", false);
    var nonce = rometheme_ajax_url.nonce;
    $.ajax({
      method: "POST",
      url: rometheme_ajax_url.ajax_url,
      data: {
        action: "reset_widgets",
        nonce : nonce
      },
      success: function (res) {
        window.location.reload();
      },
    });
  });
});
