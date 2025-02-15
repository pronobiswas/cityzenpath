jQuery(window).on("elementor/frontend/init", function () {
  elementorFrontend.hooks.addAction(
    "frontend/element_ready/rkit-running_text.default",
    function ($scope, $) {
        const cont = $scope.find('.rkit-marquee-container');
        const content = cont.find('.rkit-marquee-content');
        const clone = content.clone();
        const clone2 = clone.clone();
        cont.append(clone);
        cont.append(clone2);
        
        $scope.find('.rkit-marquee-content').addClass('rkit-marquee');
    }
  );
});
