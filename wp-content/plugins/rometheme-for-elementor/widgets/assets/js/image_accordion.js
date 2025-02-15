jQuery(window).on('elementor/frontend/init', function () {
    elementorFrontend.hooks.addAction('frontend/element_ready/rkit_image_accordion.default', function ($scope, $) {

        const accl = $scope.find('.item-ia-click');

        accl.on('click', function() { 
            accl.removeClass('active'); 
            $(this).addClass('active');
        }); 

        const acc = $scope.find('.item-ia-hover');
        const dfa =  $scope.find('.item-ia-hover.active'); 
        

        acc.on('mouseenter', function() {
            $(this).addClass('active');
            $scope.find('.item-ia-hover').not($(this)).removeClass('active');
        });
        acc.on('mouseleave', function() {
            $(this).removeClass('active');
            dfa.addClass('active');
        });


        const anm = $scope.find('.text-description');
        const dlanm = $scope.find('.text-description.hs-animation-text')
        anm.on('mouseenter', function(){
            $(this).addClass('hs-animation-text');
            $scope.find('.text-description').not($(this)).removeClass('hs-animation-text');
        });

        anm.on('mouseleave', function() {
            $(this).removeClass('active');
            dlanm.addClass('hs-animation-text');
        });       


   
          

    });
});
