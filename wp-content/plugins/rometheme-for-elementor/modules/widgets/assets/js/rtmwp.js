jQuery(window).on("elementor:init", () => {
  const e = window.elementor;
  e.on("preview:loaded", function () {
    if (rtmpro.is_pro === "false") {
      e.hooks.addFilter("panel/elements/regionViews", function (panel) {
        const intval = setInterval(function () {
          var el = e.panel.$el.find(
            "#elementor-panel-category-romethemekit_widgets_pro"
          );
          if (el.length) {
            var panelItems = el.find(".elementor-panel-category-items");
            el.show();
            jQuery.each(rtmpro.widgets, function (index, val) {
              if (val["status"] == true) {
                var elWrapper = jQuery(
                  '<div class="elementor-element-wrapper elementor-element--promotion"></div>'
                );
                var ele = jQuery('<div class="elementor-element"></div>');
                var lockIcon = jQuery('<i class="eicon-lock"></i>');
                var icon = jQuery(
                  '<div class="icon"><i class="rkit-widget-icon ' +
                    val["icon"] +
                    '" aria-hidden="true"></i></div>'
                );
                var title = jQuery(
                  '<div class="title-wrapper"><div class="title">' +
                    val["name"] +
                    "</div></div>"
                );
                ele.append(lockIcon);
                ele.append(icon);
                ele.append(title);
                elWrapper.append(ele);
                elWrapper.click(function () {
                  e.promotion.showDialog({
                    // translators: %s: Widget Title.
                    title: sprintf(
                      wp.i18n.__("%s Widget", "rometheme-for-elementor"),
                      val["name"]
                    ),
                    content: sprintf(
                      wp.i18n.__(
                        "%s simplifies the web design process with professional tools, enabling a smoother, faster, and more intuitive website creation experience."
                      ),
                      val["name"]
                    ),
                    position: {
                      blockStart: "-10",
                    },
                    targetElement: elWrapper,
                    actionButton: {
                      url: "https://rometheme.net/pricing",
                      text: "Upgrade Now",
                      classes: ["elementor-button", "go-pro"],
                    },
                  });
                });
                panelItems.append(elWrapper);
              }
            });
          }
          clearInterval(intval);
        }, 100);
        return panel;
      });
    }
  });
});
