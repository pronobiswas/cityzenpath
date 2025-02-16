jQuery(window).on('elementor/frontend/init', function () {
  elementorFrontend.hooks.addAction('frontend/element_ready/rkit-home-slider.default', function ($scope, $) {

    const slider = $scope.find('.rkit-homeslider-slider');
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
      // effect: 'fade',  
      // fadeEffect: {
      //   crossFade: true  
      // },
    }
    if (config.slideStyle === 'fade') {
      conf.effect = 'fade';
      conf.cardsEffect = {
          crossFade: true,
      };
    }

    var pagination = {
      pagination: {
        enabled: config.dots,
        el: '.rkit-homeslider-pagination',
        type: 'bullets',
        clickable: true,
        bulletClass: 'rkit-homeslider-bullet',
        bulletActiveClass: 'rkit-homeslider-bullet-active',
        clickableClass: 'rkit-homeslider-bullet-clickable'
      }
    }

    var navigation = {
      navigation: {
        enabled: config.arrows,
        nextEl: '.rkit-swiper-hs-button-next',
        prevEl: '.rkit-swiper-hs-button-prev',
      }
    }

    var dataConfig = { ...conf, ...pagination, ...navigation }

    let container = $scope.find('.rkit-swiper-hs');
      const swiper = new Swiper(container[0], dataConfig);

    swiper.on('slideChangeTransitionStart', function () { 
      $('.image-cover-hsl').removeClass('animate-zoom-out');
       
      $('.swiper-slide-active .image-cover-hsl').addClass('animate-zoom-out');

      //text animation  
        // Seleksi elemen judul di slide aktif

        // subtitle
      // Pilih elemen subtitle section
      const activeSlideSubTitleSection = document.querySelector('.swiper-slide-active .hs-subtitle-section');

      if (activeSlideSubTitleSection) {
        const activeSlideSubTitle = activeSlideSubTitleSection.querySelector('.hs-sub-title');
        const iconElement = activeSlideSubTitleSection.querySelector('.icon-subtitle-hs');
      
        if (activeSlideSubTitle) {
          const textContent = activeSlideSubTitle.textContent.trim(); // Ambil teks tanpa spasi berlebih
          activeSlideSubTitle.textContent = ''; // Kosongkan teks untuk diisi ulang dengan elemen <span>
      
          // Bagi teks menjadi kata-kata dan tambahkan animasi
          const words = textContent.split(' ');
          words.forEach((word, index) => {
            const span = document.createElement('span');
            span.textContent = word;
            span.style.animationDelay = `${0.2 * (index + 1)}s`;
            activeSlideSubTitle.appendChild(span);
            activeSlideSubTitle.appendChild(document.createTextNode(' ')); // Tambahkan spasi antar kata
          });
      
          // Pastikan ikon tetap di tempatnya, baik di depan atau di belakang
        
        }
      }
      
      

        // title
        const activeSlideTitle = document.querySelector('.swiper-slide-active .hs-animation-1-title');
        
        if (activeSlideTitle) {
          // Ambil teks di dalam elemen
          const words = activeSlideTitle.textContent.split(' ');
          // Kosongkan teks asli
          activeSlideTitle.textContent = '';
          // Tambahkan setiap kata ke dalam elemen span
          words.forEach(word => {
            const span = document.createElement('span');
            span.textContent = word;
            activeSlideTitle.appendChild(span);
            activeSlideTitle.appendChild(document.createTextNode(' '));  
          });
      
          // Setelah elemen span dibuat, tambahkan animation-delay
          activeSlideTitle.querySelectorAll('span').forEach((span, index) => {
            const delay = 0.2 * (index + 1); 
            span.style.animationDelay = `${delay}s`;
          });
        }

        // desc
        const activeSlideDesc = document.querySelector('.swiper-slide-active .hs-animation-1-desc');
        
        if (activeSlideDesc) { 
          const words = activeSlideDesc.textContent.split(' '); 
          activeSlideDesc.textContent = ''; 
          words.forEach(word => {
            const span = document.createElement('span');
            span.textContent = word;
            activeSlideDesc.appendChild(span);
            activeSlideDesc.appendChild(document.createTextNode(' '));  
          }); 
          activeSlideDesc.querySelectorAll('span').forEach((span, index) => {
            const delay = 0.2 * (index + 1); 
            span.style.animationDelay = `${delay}s`;
          });
        }












        // typewriter 
        const activeSlideTextSubtitle = document.querySelector('.swiper-slide-active .hs-animation-2-subtitle');

        if (activeSlideTextSubtitle) { 
          activeSlideTextSubtitle.style.animation = 'none';
          void activeSlideTextSubtitle.offsetWidth; // Trigger reflow
          activeSlideTextSubtitle.style.animation = 'typewritersubtitle 4s steps(30) 1s forwards, blink 0.7s step-end infinite';
        }

        const activeSlideTextTitle = document.querySelector('.swiper-slide-active .hs-animation-2-title');

        if (activeSlideTextTitle) { 
          activeSlideTextTitle.style.animation = 'none';
          void activeSlideTextTitle.offsetWidth; // Trigger reflow
          activeSlideTextTitle.style.animation = 'typewritertitle 4s steps(30) 1s forwards, blink 0.7s step-end infinite';
        }

        const activeSlideTextDesc = document.querySelector('.swiper-slide-active .hs-animation-2-desc');

        if (activeSlideTextDesc) { 
          activeSlideTextDesc.style.animation = 'none';
          void activeSlideTextDesc.offsetWidth; // Trigger reflow
          activeSlideTextDesc.style.animation = 'typewriterdesc 4s steps(30) 1s forwards, blink 0.7s step-end infinite';
        }


        
      });
      

      
  


 

  });
});
