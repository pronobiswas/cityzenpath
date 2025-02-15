jQuery(window).on("elementor/frontend/init", function () {
  elementorFrontend.hooks.addAction(
    "frontend/element_ready/rkit-animated-heading.default",
    function ($scope, $) {
      $scope.find(".rkit-animated-heading").each(function () {
        var duration = $(this).data("duration");

        $scope.find(".text-writing").each(function () {
          const $el = $(this);
          var toRotate = JSON.parse($el.attr("data-type"));
          var period = $el.attr("data-period");

          const maxWordLength = Math.max(
            ...toRotate.map((word) => word.length)
          );

          let currentWordIndex = 0;
          let currentWord = toRotate[currentWordIndex];
          let index = 0;

          function typeText() {
            $el.text(currentWord.slice(0, index++));

            if (index <= currentWord.length) {
              setTimeout(typeText, duration /10 );
            } else {
              setTimeout(eraseText, duration );
            }
          }

          function eraseText() {
            $el.text(currentWord.slice(0, index));

            if (index > 0) {
              index--;
              setTimeout(eraseText, duration /10 );
            } else {
              currentWordIndex = (currentWordIndex + 1) % toRotate.length;
              currentWord = toRotate[currentWordIndex];
              setTimeout(typeText, maxWordLength * 50);
            }
          }

          typeText();
        });

        $scope.find(".text-flipping").each(function () {
          var textElement = $(this);
          var data = JSON.parse(textElement.attr("data-type"));
          textElement.text(data[0]);
          var index = 1;

          function flipText() {
            textElement.addClass("flip-out");

            setTimeout(function () {
              textElement.text(data[index]);
              textElement.removeClass("flip-out");
              textElement.addClass("flip-in");
            }, 500);

            setTimeout(function () {
              textElement.removeClass("flip-in");
              index = (index + 1) % data.length;
            }, 1000);
          }

          setInterval(flipText, duration);
        });

        $scope.find(".text-sliding_down").each(function () {
          var textElement = $(this);
          var data = JSON.parse(textElement.attr("data-type"));
          textElement.text(data[0]);
          var index = 1;

          function slideUpText() {
            textElement.addClass("slide-down_out");

            setTimeout(function () {
              textElement.text(data[index]);
              textElement.removeClass("slide-down_out");
              textElement.addClass("slide-down_in");
            }, 500);

            setTimeout(function () {
              textElement.removeClass("slide-down_in");
              index = (index + 1) % data.length;
            }, 1000);
          }

          setInterval(slideUpText, duration);
        });

        $scope.find(".text-sliding_up").each(function () {
          var textElement = $(this);
          var data = JSON.parse(textElement.attr("data-type"));
          textElement.text(data[0]);
          var index = 1;

          function slideUpText() {
            textElement.addClass("slide-up_out");

            setTimeout(function () {
              textElement.text(data[index]);
              textElement.removeClass("slide-up_out");
              textElement.addClass("slide-up_in");
            }, 500);

            setTimeout(function () {
              textElement.removeClass("slide-up_in");
              index = (index + 1) % data.length;
            }, 1000);
          }

          setInterval(slideUpText, duration);
        });

        $scope.find(".rkit-highlighted").each(function () {
          var textElement = $(this);
          var data = JSON.parse(textElement.attr("data-type"));
          var txt = $("<p>" + data[0] + "</p>");
          textElement.append(txt);
          textElement.addClass("highlighted_in");
          var index = 0;

          function animation() {
            setTimeout(function () {
              textElement.removeClass("highlighted_in");
              textElement.addClass("highlighted_out");
            }, 1000);

            setTimeout(function () {
              textElement.find("p").remove();
              var text = $("<p>" + data[index] + "</p>");
              textElement.append(text);
              textElement.removeClass("highlighted_out");
              textElement.addClass("highlighted_in");
            }, 1500);

            setTimeout(function () {
              index = (index + 1) % data.length;
            }, 2000);
          }

          setInterval(animation, duration);
        });

        $scope.find(".text-drop-in").each(function () {
          var textElement = $(this);
          var data = JSON.parse(textElement.attr("data-type"));
          textElement.text(data[0]);
          var index = 1;

          function dropInText() {
            textElement.addClass("drop-in_out");

            setTimeout(function () {
              textElement.text(data[index]);
              textElement.removeClass("drop-in_out");
              textElement.addClass("drop-in_in");
            }, 500);

            setTimeout(function () {
              textElement.removeClass("drop-in_in");
              index = (index + 1) % data.length;
            }, 1000);
          }

          setInterval(dropInText, duration);
        });

        $scope.find(".text-drop-out").each(function () {
          var textElement = $(this);
          var data = JSON.parse(textElement.attr("data-type"));
          textElement.text(data[0]);
          var index = 1;

          function dropOutText() {
            textElement.addClass("drop-out_out");

            setTimeout(function () {
              textElement.text(data[index]);
              textElement.removeClass("drop-out_out");
              textElement.addClass("drop-out_in");
            }, 500);

            setTimeout(function () {
              textElement.removeClass("drop-out_in");
              index = (index + 1) % data.length;
            }, 1000);
          }

          setInterval(dropOutText, duration);
        });
      });
    }
  );
});
