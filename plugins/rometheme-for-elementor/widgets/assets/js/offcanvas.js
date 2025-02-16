jQuery(window).on("elementor/frontend/init", function () {
  elementorFrontend.hooks.addAction(
    "frontend/element_ready/rtm-offcanvas.default",
    function ($scope, $) {
      const $btn = $scope.find(".menu-button-rometheme");
      const $closeBtn = $scope.find(".rkit-offcanvas-close");
      const $overlay = $scope.find(".overlay-rometheme");

      $btn.click(function (e) {
        e.preventDefault();
        $(this).closest(".rkit-offcanvas").addClass("offcanvas-show");
      });

      $closeBtn.click(function (e) {
        e.preventDefault();
        $(this).closest(".rkit-offcanvas").removeClass("offcanvas-show");
      });

      $overlay.click(function (e) {
        e.preventDefault();
        $(this).closest(".rkit-offcanvas").removeClass("offcanvas-show");
      });
    }
  );
});
