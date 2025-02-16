jQuery(window).on("elementor/frontend/init", function () {
  elementorFrontend.hooks.addAction(
    "frontend/element_ready/rtm-navmenu.default",
    function ($scope, $) {
      $.fn.isOutOfViewport = function () {
        var element = $(this)[0];
        var rect = element.getBoundingClientRect();

        return (
          rect.top < 0 ||
          rect.left < 0 ||
          rect.bottom > $(window).height() ||
          rect.right > $(window).width()
        );
      };

      function setPos() {
        $scope
          .find(".rkit-submenu-item .rkit-navmenu-dropdown")
          .each(function () {
            const $this = $(this);
            if ($this.isOutOfViewport()) {
              $this.css({
                left: "auto",
                right: "100%",
              });
            } else  {
              $this.css({
                right: "auto",
                left: "100%",
              });
            }
          });
      }

      setPos();

      const $container = $scope.find(".rkit-navmenu-container");
      let responsive = $container.data("responsive");
      let widthResponsive = responsive == "tablet" ? 1024 : 768;

      $screenWidth = jQuery(window).width();

      function setElHeight() {
        let d = 3;

        $scope.find(".rkit-navmenu-dropdown").each(function () {
          var scrollHeight = $(this).prop("scrollHeight"); // Dapatkan scrollHeight dari elemen ini
          $(this).css("--height", scrollHeight * d + "px"); // Set CSS custom property dengan nilai scrollHeight
        });

        $scope.find(".rkit-responsive-menu").each(function () {
          var scrollHeight = $(this).prop("scrollHeight"); // Dapatkan scrollHeight dari elemen ini
          $(this).css("--height", scrollHeight * d + "px"); // Set CSS custom property dengan nilai scrollHeight
        });
      }

      setElHeight();

      function fullwidth() {
        var nav_container = $scope.find(".rkit-navmenu-container");
        var elementorsection = $scope.closest(".elementor");
        var responsive_navmenu = nav_container.find(".rkit-responsive-menu");
        if (responsive_navmenu.hasClass("rkit-navmenu-fullwidth")) {
          var section_width = elementorsection.width();
          $(".rkit-navmenu-fullwidth").css("width", section_width + "px");
          var left = -1 * Math.round(nav_container.offset().left);
          $(".rkit-navmenu-fullwidth").css("left", left + "px");
        }
      }

      if ($screenWidth <= widthResponsive) {
        fullwidth();
        $scope
          .find(".rkit-dropdown-hover > a > .rkit-submenu-icon")
          .click(function (e) {
            e.preventDefault();
          });
      }

      jQuery(window).on("resize", function () {
        setElHeight();
        setPos();
        $screenWidth = jQuery(window).width();
        if ($screenWidth <= widthResponsive) {
          fullwidth();
          $scope
            .find(".rkit-dropdown-hover > a > .rkit-submenu-icon")
            .click(function (e) {
              e.preventDefault();
            });
        } else {
          var nav_container = $scope.find(".rkit-navmenu-container");
          var responsive_navmenu = nav_container.find(".rkit-responsive-menu");
          if (responsive_navmenu.hasClass("rkit-navmenu-fullwidth")) {
            $scope.find(".rkit-navmenu-fullwidth").removeAttr("style");
          }
        }
      });

      $scope.find(".rkit-btn-hamburger").click(function (e) {
        e.preventDefault();
        $siblings = $(this).parent().siblings();
        $siblings.toggleClass("rkit-menu-show");

        $(this).toggleClass("rkit-hamburger-show");
      });

      $scope
        .find(".rkit-menu-item.rkit-dropdown-click > a")
        .click(function (e) {
          e.preventDefault();

          // Toggle dropdown hanya untuk item yang diklik
          const parentMenuItem = $(this).parent();

          // Tutup dropdown lain yang sedang terbuka
          $scope
            .find(".rkit-menu-item.rkit-dropdown-show")
            .not(parentMenuItem)
            .removeClass("rkit-dropdown-show");

          if (
            parentMenuItem
              .find(".rkit-dropdown-click")
              .hasClass("rkit-dropdown-show")
          ) {
            parentMenuItem
              .find(".rkit-dropdown-click")
              .removeClass("rkit-dropdown-show");
          }

          // Toggle dropdown untuk menu yang diklik
          parentMenuItem.toggleClass("rkit-dropdown-show");
        });

      $scope
        .find(".rkit-submenu-item.rkit-dropdown-click > a")
        .click(function (e) {
          e.preventDefault();

          // Toggle dropdown hanya untuk item yang diklik
          const parentMenuItem = $(this).parent();
          parentMenuItem.toggleClass("rkit-dropdown-show");

          if (
            parentMenuItem
              .find(".rkit-dropdown-click")
              .hasClass("rkit-dropdown-show")
          ) {
            parentMenuItem
              .find(".rkit-dropdown-click")
              .removeClass("rkit-dropdown-show");
          }

          parentMenuItem.siblings().removeClass("rkit-dropdown-show");
        });

      jQuery(document).on("click", function (e) {
        if (!$scope.is(e.target) && $scope.has(e.target).length === 0) {
          if (
            $scope.find(".rkit-dropdown-click").hasClass("rkit-dropdown-show")
          ) {
            $scope
              .find(".rkit-dropdown-click")
              .removeClass("rkit-dropdown-show");
          }

          if ($scope.find(".rkit-responsive-menu").hasClass("rkit-menu-show")) {
            $scope.find(".rkit-responsive-menu").removeClass("rkit-menu-show");
            $scope
              .find(".rkit-btn-hamburger")
              .removeClass("rkit-hamburger-show");
          }
        }
      });
    }
  );
});
