jQuery(window).on("elementor/frontend/init", function () {
  elementorFrontend.hooks.addAction(
    "frontend/element_ready/rkit-testimonial-carousel.default",
    function ($scope, $) {

      const slider = $scope.find('.rkit-testimonial-carousel');
      var config = slider.data('config');
  
      var conf = {
        rtl: config.rtl,
        arrows: config.arrows,
        dots: config.dots,
        autoplay: config.autoplay,
        loop: config.loop,
        speed: config.speed,
        slidesPerView: config.slidesPerView,
        slidesPerGroup: config.slidesPerGroup,
        breakpoints: config.breakpoints,
        grabCursor : true
      }
  
      var pagination = {
        pagination: {
          enabled: config.dots,
          el: '.rkit-testimonial-pagination',
          type: 'bullets',
          clickable: true,
          bulletClass: 'rkit-pagination-bullet',
          bulletActiveClass: 'rkit-pagination-bullet-active',
          clickableClass: 'rkit-pagination-bullet-clickable'
        }
      }
  
      var navigation = {
        navigation: {
          enabled: config.arrows,
          nextEl: '.rkit-testimonial-button-next',
          prevEl: '.rkit-testimonial-button-prev'
        }
      }
  
      var dataConfig = { ...conf, ...pagination, ...navigation }
  
      let container = $scope.find('.testimonial-container');
      const swiper = new Swiper(container[0], dataConfig);
    }
  );
});
