jQuery(window).on('elementor/frontend/init', function () {
    elementorFrontend.hooks.addAction('frontend/element_ready/rkit-imagecomparison.default', function ($scope, $) {
        let h, w , originalWidth, originalHeight;

        const imgElement = $scope.find('.img-comp-img img');
        // Fungsi untuk inisialisasi gambar
        function initializeImage() {
            
            imgElement.each(function () {
                
                $scope.originalWidth = $(this).width();
                $scope.originalHeight = $(this).height();

                if ($scope.originalWidth && $scope.originalHeight) {
                    updateImageDimensions();
                } else {
                    console.error('Original dimensions are not defined yet.');
                }
            });
        }

        imgElement.on('load', function () {
            setTimeout(initializeImage, 100); // Tambahkan delay 100ms untuk memastikan gambar sudah terload
        });

        if (imgElement[0].complete) {
            setTimeout(initializeImage, 100); // Inisialisasi jika gambar sudah terload sebelumnya
        }

        // Fungsi untuk memperbarui dimensi gambar
        function updateImageDimensions() {
            const conWrap = $scope.find('.con-wrap');
            const imgcomp = $scope.find('.img-comp-img');
            const imgCompImgs = $scope.find('.img-comp-img img');

            imgCompImgs.each(function () {
                $scope.originalWidth = $(this).width();
                $scope.originalHeight = $(this).height();
            });
  
            const screenWidth = $(window).width(); 
              // $scope akan merujuk pada container widget yang spesifik
              var container = $scope.find('.elementor-widget-container');
              var containerWidth = container.width(); 
            if ($scope.originalWidth && $scope.originalHeight) {
                const aspectRatio = $scope.originalWidth / $scope.originalHeight;
                  
                if (screenWidth <= 366) {
                    $scope.w = containerWidth;
                } else if (screenWidth > 366 && screenWidth <= 770) {
                    $scope.w = containerWidth;
                } else {
                    $scope.w = containerWidth;
                }
  
                $scope.h = $scope.w / aspectRatio;
  
                conWrap.css({ height: $scope.h + 'px', width: $scope.w + 'px' });
                imgcomp.css({ height: $scope.h + 'px', width: $scope.w + 'px' });
                imgCompImgs.css({ height: $scope.h + 'px', width: $scope.w + 'px' });
   
            }         //   else {
          //       console.error('Original dimensions are not defined yet sec.');
          //   }
        }
  

        // Fungsi untuk inisialisasi komparasi gambar
        function initComparisons() {
            const container = $scope.find('.img-comp-container');
            const sliderMode = container.data('slider-mode');
            const showIcon = container.data('show-icon');
            const overlays = $scope.find('.img-comp-overlay');

            overlays.each(function () {
                compareImages($(this));
            });

            // Fungsi untuk membandingkan gambar
            function compareImages($img) {
                let slider, clicked = 0;

                // Tentukan orientasi slider
                if (sliderMode === 'vertical') {
                    let existingSlider = $scope.find('.img-comp-slider.vertical');
                    $img.css('height', ($scope.h / 2) + "px");

                    if (existingSlider.length) {
                        existingSlider.remove();
                    }

                    slider = $('<div>', { class: 'img-comp-slider vertical' });

                    if (showIcon === 'yes') {
                        slider.append('<i class="eicon-caret-up"></i>');
                        slider.append('<i class="eicon-caret-down"></i>');
                    }

                    $img.before(slider);
                    slider.css({
                        top: ($scope.h / 2) - (slider.outerHeight() / 2) + "px",
                        left: ($scope.w / 2) - (slider.outerWidth() / 2) + "px"
                    });
                } else {
                    let existingSlider = $scope.find('.img-comp-slider');
                    $img.css('width', ($scope.w / 2) + "px");

                    if (existingSlider.length) {
                        existingSlider.remove();
                    }

                    slider = $('<div>', { class: 'img-comp-slider' });

                    if (showIcon === 'yes') {
                        slider.append('<i class="eicon-caret-left"></i>');
                        slider.append('<i class="eicon-caret-right"></i>');
                    }

                    $img.before(slider);
                    slider.css({
                        top: ($scope.h / 2) - (slider.outerHeight() / 2) + "px",
                        left: ($scope.w / 2) - (slider.outerWidth() / 2) + "px"
                    });
                }

                slider.on('mousedown touchstart', slideReady);
                $(window).on('mouseup touchend', slideFinish);

                function slideReady(e) {
                    e.preventDefault();
                    clicked = 1;
                    $(window).on('mousemove touchmove', slideMove);
                }

                function slideFinish() {
                    clicked = 0;
                    $(window).off('mousemove touchmove', slideMove);
                }

                function slideMove(e) {
                    if (clicked === 0) return false;

                    let pos = (sliderMode === 'vertical') ? getCursorPosVertical(e) : getCursorPosHorizontal(e);

                    pos = Math.max(0, Math.min(pos, (sliderMode === 'vertical' ? $scope.h : $scope.w)));

                    slide(pos);
                }

                function getCursorPosVertical(e) {
                    e = (e.changedTouches) ? e.changedTouches[0] : e;
                    const imgOffset = $img.offset();
                    return e.pageY - imgOffset.top;
                }

                function getCursorPosHorizontal(e) {
                    e = (e.changedTouches) ? e.changedTouches[0] : e;
                    const imgOffset = $img.offset();
                    return e.pageX - imgOffset.left;
                }

                function slide(pos) {
                    if (sliderMode === 'vertical') {
                        $img.css('height', pos + "px");
                        slider.css('top', pos - (slider.outerHeight() / 2) + "px");
                    } else {
                        $img.css('width', pos + "px");
                        slider.css('left', pos - (slider.outerWidth() / 2) + "px");
                    }
                }
            }
        }

        // Menggunakan ResizeObserver untuk menangani perubahan ukuran elemen
        new ResizeObserver(() => {
            updateImageDimensions();
            initComparisons();
            
        }).observe($scope[0]);

        setTimeout(initComparisons, 100);
    });
});
