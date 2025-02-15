jQuery(window).on('elementor/frontend/init', function () {
    elementorFrontend.hooks.addAction('frontend/element_ready/rkit-logocaraosel.default', function ($scope, $) {
  
      const slider = $scope.find('.rkit-logocaraosel-slider');
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
        grabCursor : true,
        initialSlide : (config.initial_slide == null) ? 0 : config.initial_slide,
      }
  
      var pagination = {
        pagination: {
          enabled: config.dots,
          el: '.rkit-clientcaraosel-pagination',
          type: 'bullets',
          clickable: true,
          bulletClass: 'rkit-clientcaraosel-bullet',
          bulletActiveClass: 'rkit-clientcaraosel-bullet-active',
          clickableClass: 'rkit-clientcaraosel-bullet-clickable'
        }
      }
  
      var navigation = {
        navigation: {
          enabled: config.arrows,
          nextEl: '.rkit-swiper-cl-button-next',
          prevEl: '.rkit-swiper-cl-button-prev',
        }
      }
  
      var dataConfig = { ...conf, ...pagination, ...navigation }
  
      let container = $scope.find('.rkit-swiper-cl');
      const swiper = new Swiper(container[0], dataConfig);
    });
  });
  