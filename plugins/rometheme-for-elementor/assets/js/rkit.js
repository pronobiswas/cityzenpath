typeof globalThis.rtm;

rtm = {
  isPro: false,
};

jQuery(window).ready(function ($) {
  // console.log(rtm);

  function remove_notice(url) {
    notice = document.getElementById("rkit-notices");
    notice.remove();
    window.open(
      "https://wordpress.org/support/plugin/rometheme-for-elementor/reviews/",
      "_blank"
    );
    jQuery(($) => {
      $.ajax({
        type: "post",
        url: ajax_url.ajax_url,
        data: { action: "rkitRemoveNotice" },
        success: (data) => {
          console.log("Love Using RomethemeKit For Elementor");
        },
        error: function (jqXHR, textStatus, errorThrown) {
          console.error(
            "The following error occured: " + textStatus,
            errorThrown
          );
        },
      });
    });
  }
});
