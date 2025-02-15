jQuery(window).on("elementor:init", () => {
  var e = window.elementor;
  e.on("preview:loaded", function () {
    var interval = setInterval(function () {
      var el = e.$previewContents.find(".elementor-add-template-button");
      if (el.length) {
        var content = jQuery(
          '<div class="rkit-add-template" ><img src="' +
            rkitLO.btnIcon +
            '"></div>'
        );
        el.after(content),
          e.$previewContents.on(
            "click",
            ".elementor-editor-section-settings .elementor-editor-element-add",
            function () {
              var el = jQuery(this)
                .parents(".elementor-top-section")
                .prev(".elementor-add-section")
                .find(".elementor-add-template-button");
              el.siblings(".rkit-add-template").length ||
                el.after(content.clone());
            }
          ),
          e.$previewContents.on(
            "click",
            ".elementor-editor-container-settings .elementor-editor-element-add",
            function () {
              var el = jQuery(this)
                .parents(".e-con")
                .prev(".elementor-add-section")
                .find(".elementor-add-template-button");
              el.siblings(".rkit-add-template").length ||
                el.after(content.clone());
            }
          );
        clearInterval(interval);
        e.$previewContents.on("click", ".rkit-add-template", showModal);
      }
    }, 100);
  });

  function showModal() {
    var ei = jQuery(this).parents(".elementor-add-section-inline"),
      t = ei.next(".elementor-top-section , .e-con").data("model-cid"),
      a = {};
    ei.length &&
      (ei.find(".elementor-add-section-close").trigger("click"),
      jQuery.each(window.elementor.elements.models, function (c, r) {
        r.cid === t && (a = { at: c });
      })),
      (window.rkitLO.modelOps = a);

    var modalOverlay = jQuery(
      '<div class="dialog-widget dialog-lightbox-widget dialog-type-buttons dialog-type-lightbox elementor-templates-modal"></div>'
    );
    // Add modal overlay
    jQuery("body").append(modalOverlay);

    // Add modal container
    var modalContainer = jQuery(
      '<div class="dialog-widget-content dialog-lightbox-widget-content rkit-modal-dialog"></div>'
    );
    modalOverlay.append(modalContainer);

    // Add modal content
    var modalContent = jQuery(
      '<div class="dialog-message dialog-lightbox-message"></div>'
    );

    var elmodalHeader = jQuery(
      '<div class="dialog-header dialog-lightbox-header"></div>'
    );
    var modalHeader = jQuery(
      '<div class="elementor-templates-modal__header rkit-modal-header"></div>'
    );
    modalHeader.append(
      '<div class="elementor-templates-modal__header__logo-area rkit-logo-container"><img src="' +
        rkit_libs.logo_url +
        '" height="25"></img></div>'
    );
    modalHeader.append(
      `<div class="elementor-templates-modal__header__items-area">
      <div class="elementor-templates-modal__header__close elementor-templates-modal__header__close--normal elementor-templates-modal__header__item">
      <button class="rkit-close-modal"><i class="eicon-close"></i></button>
      </div>
      <a href="https://rometheme.net/pricing/" target="_blank" class="btn btn-gradient-accent rounded-2 rkit-go-pro-btn">Go To Pro <i class="eicon-upgrade-crown"></i></a>
      </div>
      `
    );
    elmodalHeader.append(modalHeader);

    modalContainer.append(elmodalHeader);
    modalContainer.append(modalContent);

    var loading = jQuery(
      '<div id="rkit-loading" class="rkit-loading"><div class="spinner"></div></div>'
    );

    var modal_body = jQuery(
      '<div class="dialog-content dialog-lightbox-content"></div>'
    );
    var rkit_content = jQuery('<div class="rkit-template-library"></div>');
    var rkit_template_library = jQuery(
      '<div class="rkit-template-container"></div>'
    );

    var r_f = jQuery(
      '<div style="width:100%; padding:1rem ; padding-block: 6rem ; text-align:center ; font-size:medium;"></div>'
    );

    jQuery(".rkit-modal").css({ opacity: 0 }).show();
    jQuery(".rkit-modal").animate({ opacity: 1 }, 200);

    jQuery.ajax({
      url: rkit_libs.ajax_url,
      type: "GET",
      data: { action: "fetch_layout_lib", wpnonce: rkit_libs.template_nonce },
      dataType: "json",
      beforeSend: function () {
        modalContent.append(loading);
      },
      success: function (data) {
        var banner_img = jQuery(
          '<div class="rkit-template-library-banner"><img src="' +
            data.banner +
            '"></div>'
        );
        var tabs = rkitLO.default_tab;
        var type = data.type;

        var logo_area = jQuery(".elementor-templates-modal__header__logo-area");

        var div = jQuery(
          '<div class="elementor-templates-modal__header__menu-area"></div>'
        );
        var e = jQuery(
          '<div id="elementor-template-library-header-menu"></div>'
        );
        var template_tab = jQuery(
          '<div class="elementor-component-tab elementor-template-library-menu-item elementor-active" data-tab="template">TEMPLATES</div>'
        );

        template_tab.on("click", function (event) {
          if (!jQuery(event.currentTarget).hasClass("elementor-active")) {
            jQuery(
              "#elementor-template-library-header-menu .elementor-template-library-menu-item"
            )
              .not(event.currentTarget)
              .removeClass("elementor-active");
            jQuery(event.currentTarget).addClass("elementor-active");
          }
          rkit_template_library.empty();
          let param = {
            action: "fetch_lib",
            wpnonce: rkit_libs.template_nonce,
          };

          render_template_body(param);
        });

        const installed_template_tab = jQuery(
          '<div class="elementor-component-tab elementor-template-library-menu-item" data-tab="installed-template">INSTALLED TEMPLATES</div>'
        );

        installed_template_tab.on("click", function (event) {
          if (!jQuery(event.currentTarget).hasClass("elementor-active")) {
            jQuery(
              "#elementor-template-library-header-menu .elementor-template-library-menu-item"
            )
              .not(event.currentTarget)
              .removeClass("elementor-active");
            jQuery(event.currentTarget).addClass("elementor-active");
          }
          rkit_template_library.empty();
          let param = {
            action: "get_installed_templates",
            wpnonce: rkit_libs.template_nonce,
          };

          render_installed_template(param);
        });

        e.append(installed_template_tab);
        e.append(template_tab);

        for (let key in type) {
          let name = key == "block" ? "wireframes" : key + "s";
          var header_item = jQuery(
            '<div class="elementor-component-tab elementor-template-library-menu-item" data-tab="' +
              key +
              '">' +
              name.toUpperCase() +
              "</div>"
          );

          header_item.click((event) => {
            if (!jQuery(event.currentTarget).hasClass("elementor-active")) {
              jQuery(
                "#elementor-template-library-header-menu .elementor-template-library-menu-item"
              )
                .not(event.currentTarget)
                .removeClass("elementor-active");
              jQuery(event.currentTarget).addClass("elementor-active");
            }
            rkit_template_library.empty();
            render_body(data);
          });

          e.append(header_item);
        }
        div.append(e);
        logo_area.after(div);
        render_body(data);
        rkit_content.append(banner_img);
        rkit_content.append(rkit_template_library);
        rkit_content.append(r_f);
        modal_body.append(rkit_content);
        modalContent.append(modal_body);
      },
      error: function (xhr, status, error) {
        // menangani kesalahan
        console.log(status);
      },
      complete: function () {
        jQuery("#rkit-loading").remove();
      },
    });

    function render_body(data) {
      var tab_active = jQuery(
        "#elementor-template-library-header-menu .elementor-active"
      ).data("tab");
      let template = Object.values(data.template).filter(
        (template) => template.template_type == tab_active
      );
      var r_h = jQuery('<div class="r-header-' + tab_active + '"></div>');
      var r_t_l = jQuery('<div class="r-template-list"></div>');
      var list_cat =
        tab_active == "page" || tab_active == "block"
          ? data.type[tab_active].list_category
          : null;

      if (tab_active == "page") {
        var search = jQuery(
          '<input class="r-search" type="text" placeholder="Search">'
        );
        let slc = jQuery('<div class="r-select-container"></div>');
        let lcat = jQuery('<div class="r-list-page-category"></div>');
        let select = jQuery(
          '<input type="text" class="r-select-cat" data-value="all" value="All Categories" readonly>'
        );
        let all = jQuery(
          '<div class="r-page-category" data-value="all">All Categories</div>'
        );
        all.click((event) => {
          r_t_l.empty();
          render_list(template);
          select.val("All Categories");
          select.data("value", "all");
        });
        lcat.append(all);
        for (let key in list_cat) {
          var value = list_cat[key];
          var capitalize = value
            .split("-")
            .map((word) => word.charAt(0).toUpperCase() + word.slice(1))
            .join(" ");
          var rl = jQuery(
            '<div class="r-page-category" data-value="' +
              value +
              '">' +
              capitalize +
              "</div>"
          );
          rl.click((event) => {
            var value = jQuery(event.currentTarget).data("value");
            var capitalize = value
              .split("-")
              .map((word) => word.charAt(0).toUpperCase() + word.slice(1))
              .join(" ");
            let template = Object.values(data.template).filter(
              (template) =>
                template.template_type == tab_active &&
                template.template_category == value
            );
            r_t_l.empty();
            render_list(template);
            select.val(capitalize);
            select.data("value", value);
          });
          lcat.append(rl);
        }
        search.on("input", (event) => {
          var select = jQuery(".r-select-cat");
          var cat_value = select.data("value");
          var tab_active = jQuery(
            "#elementor-template-library-header-menu .elementor-active"
          ).data("tab");
          let template =
            cat_value == "all"
              ? Object.values(data.template).filter(
                  (template) =>
                    template.post_title
                      .toLowerCase()
                      .includes(
                        jQuery(event.currentTarget).val().toLowerCase()
                      ) && template.template_type == tab_active
                )
              : Object.values(data.template).filter(
                  (template) =>
                    template.post_title
                      .toLowerCase()
                      .includes(
                        jQuery(event.currentTarget).val().toLowerCase()
                      ) &&
                    template.template_type == tab_active &&
                    template.template_category == cat_value
                );
          r_t_l.empty();
          render_list(template);
        });
        slc.append(select);
        slc.append(lcat);
        r_h.append(slc);
        r_h.append(search);
        rkit_template_library.append(r_h);
        render_list(template);
        rkit_template_library.append(r_t_l);
      } else if (tab_active == "block") {
        list_cat.forEach((c) => {
          var cb = jQuery(
            '<button data-category="' +
              c +
              '" class="r-category-btn">' +
              c.replace("-", " ").toUpperCase() +
              "</button>"
          );
          cb.click((event) => {
            r_t_l.empty();
            var ct = jQuery(event.currentTarget).data("category");
            var search = jQuery(
              '<input class="r-search" type="text" placeholder="Search">'
            );
            search.on("input", (event) => {
              var tab_active = jQuery(
                "#elementor-template-library-header-menu .elementor-active"
              ).data("tab");
              let template = Object.values(data.template).filter(
                (template) =>
                  template.post_title
                    .toLowerCase()
                    .includes(
                      jQuery(event.currentTarget).val().toLowerCase()
                    ) &&
                  template.template_type == tab_active &&
                  template.template_category == ct
              );
              r_t_l.empty();
              render_list(template);
            });
            r_h.append(search);
            rkit_template_library.append(r_h);
            let template = Object.values(data.template).filter(
              (template) =>
                template.template_type == tab_active &&
                template.template_category == ct
            );
            render_list(template);
            rkit_template_library.append(r_t_l);
          });
          r_t_l.append(cb);
          // r_t_l.addClass('g-3');
          rkit_template_library.append(r_t_l);
        });
      } else {
        let param = {
          action: "fetch_lib",
          wpnonce: rkit_libs.template_nonce,
        };

        render_template_body(param);
      }

      function render_list(template) {
        for (let key in template) {
          var post_date = new Date(template[key].post_date);
          var now = new Date();
          var slsh = Math.round((now - post_date) / (1000 * 60 * 60 * 24));
          var t = jQuery(
            '<div class="rkit-template ' +
              (slsh < 30 ? "new-template-block" : "") +
              '"></div>'
          );
          var imgc = jQuery(
            '<div class="r-img-container-' + tab_active + '"></div>'
          );
          var img = jQuery(
            '<img class="' +
              tab_active +
              '-preview-img" src="' +
              template[key].preview_image +
              '">'
          );
          var t_f = jQuery('<div class="rkit-template-f"></div>');
          imgc.append(img);
          var title = jQuery("<div>" + template[key].post_title + "</div>");
          var i = jQuery(
            '<div style="display:flex; justify-content:center; gap:1rem ; "></div>'
          );
          var impor = jQuery(
            '<button class="rkit-import-btn btn btn-gradient-accent"  data-id-template="' +
              template[key].template_id +
              '"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16"><path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/><path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/></svg>Import</button>'
          );
          var preview = jQuery(
            `<button class="r-preview-btn btn" data-id-template="${template[key].template_id}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
  <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
  <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
</svg>Preview</button>`
          );
          preview.click((event) => {
            var id = jQuery(event.currentTarget).data("id-template");
            show_preview(
              template[key].preview_image,
              id,
              template[key].post_title
            );
          });
          i.append(impor);
          i.append(preview);
          t_f.append(title);
          t_f.append(i);
          t.append(imgc);
          t.append(t_f);
          impor.click((event) => {
            var id = jQuery(event.currentTarget).data("id-template");
            jQuery(event.currentTarget).html("Importing...");
            jQuery(event.currentTarget).prop("disabled", true);
            import_template(id);
          });
          r_t_l.append(t);
        }
      }
    }

    function render_template_body(params) {
      const templateHeader = jQuery(
        `<div id="template-header" class="r-header-page"></div>`
      );
      const searchInput = jQuery(
        `<input class="r-search" type="text" placeholder="Search All Template Kits...">`
      );
      const TemplateContainer = jQuery(
        `<div id="template-container" class="row-cols-3"></div>`
      );
      searchInput.on("change", function (e) {
        e.preventDefault();
        params.search = jQuery(this).val();
        // console.log(params);
        render_template_data(params);
      });

      let slc = jQuery('<div class="r-select-container"></div>');
      let lcat = jQuery('<div class="r-list-page-category"></div>');
      let select = jQuery(
        '<input type="text" class="r-select-cat" data-value="all" value="All Categories" readonly>'
      );
      let all = jQuery(
        '<div class="r-page-category" data-value="all">All Categories</div>'
      );

      all.on("click", function (e) {
        params.category = "";
        render_template_data(params);
        select.val("All Categories");
      });
      lcat.append(all);
      jQuery.ajax({
        type: "POST",
        data: {
          action: "template_category",
          wpnonce: rkit_libs.template_nonce,
        },
        url: rkit_libs.ajax_url,
        success: function (res) {
          if (res.success) {
            jQuery.each(res.data.rtm_templatekit_category, (i, v) => {
              let title = v
                .toLowerCase()
                .replace(/\b[a-z]/g, function (letter) {
                  return letter.toUpperCase();
                });
              let cat = jQuery(
                `<div class="r-page-category" data-value="${v}">${title.replace(
                  "-",
                  " "
                )}</div>`
              );
              cat.on("click", function (e) {
                params.category = v;
                render_template_data(params);
                select.val(title.replace("-", " "));
              });
              lcat.append(cat);
            });
          }
        },
      });
      slc.append(select);
      slc.append(lcat);
      templateHeader.append(slc);
      templateHeader.append(searchInput);
      rkit_template_library.append(templateHeader);
      // rkit_template_library.append(TemplateContainer);
      render_template_data(params);
    }

    function render_template_data(params) {
      const load = jQuery(
        '<div id="rkit-loading" class="rkit-loading"><div class="spinner"></div></div>'
      );

      let TemplateContainer = null;

      if (jQuery("#template-container").length) {
        TemplateContainer = jQuery("#template-container");
        TemplateContainer.empty();
        TemplateContainer.append(load);
      } else {
        TemplateContainer = jQuery(
          `<div id="template-container" class="row-cols-3"></div>`
        );
        TemplateContainer.empty();
        TemplateContainer.append(load);
        rkit_template_library.append(TemplateContainer);
      }
      jQuery.ajax({
        type: "POST",
        url: rkit_libs.ajax_url,
        data: params,
        success: function (res) {
          let dataTemplate = res.data.data_template;
          // console.log(dataTemplate);
          if (dataTemplate.length != 0) {
            TemplateContainer.empty();
            jQuery.each(dataTemplate, (i, v) => {
              let $col = jQuery('<div class="col"></div>');
              let $card = jQuery(
                '<div class="d-flex flex-column h-100 rounded-3 overflow-hidden glass-effect rtm-border"></div>'
              );
              let $previewImg = jQuery(
                `<img class="img-fluid" src=${v.image_preview}>`
              );
              let $cardBody = jQuery(
                `<div class="p-3 d-flex flex-column gap-3"></div>`
              );
              let $title = jQuery(
                `<div class="d-block"><h3 class="text-truncate text-white m-0">${v.name}</h3></div>`
              );

              let btnContainer = jQuery(
                '<div class="d-flex flex-row gap-2"></div>'
              );
              let btnInstall;
              if (v.type == "pro") {
                if (window.rtm.isPro) {
                  if (v.has_installed) {
                    btnInstall = jQuery(
                      `<button 
                      class="fw-light btn w-100 btn-gradient-accent rounded-2">
                      <i class="rtmicon rtmicon-plus me-2"></i>View Kit</button>`
                    );
                    btnInstall.on("click", function (e) {
                      e.preventDefault();
                      render_view_template(v.installed);
                    });
                  } else {
                    btnInstall = jQuery(
                      `<button class="fw-light btn w-100 btn-gradient-accent rounded-2 ">
                      <i class="rtmicon rtmicon-plus"></i>
                      Install</button>`
                    );

                    btnInstall.on("click", function (e) {
                      btnInstall.html("Installing...");
                      btnInstall.prop("disabled", true);
                      download_template(v.id, function (r) {
                        if (r) {
                          btnInstall.html("View Kit");
                          btnInstall.removeAttr("disabled");
                          btnInstall.off("click");
                          btnInstall.on("click", function (e) {
                            e.preventDefault();
                            render_view_template(r);
                          });
                        }
                      });
                    });
                  }
                } else {
                  btnInstall = jQuery(
                    `<a href="http://rometheme.net/pricing" target="_blank" class="fw-light btn w-100 btn-gradient-accent rounded-2"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lock" viewBox="0 0 16 16">
  <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2m3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2M5 8h6a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1"/>
</svg>Upgrade</a>`
                  );
                }
              } else {
                if (v.has_installed) {
                  btnInstall = jQuery(
                    `<button 
                        class="fw-light btn w-100 btn-gradient-accent rounded-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
                        </svg>
                        View Kit</button>`
                  );
                  btnInstall.on("click", function (e) {
                    e.preventDefault();
                    render_view_template(v.installed);
                  });
                } else {
                  btnInstall = jQuery(
                    `<button class="fw-light btn w-100 btn-gradient-accent rounded-2 "><i class="rtmicon rtmicon-plus"></i>
                    Install</button>`
                  );

                  btnInstall.on("click", function (e) {
                    btnInstall.html("Installing...");
                    btnInstall.prop("disabled", true);
                    download_template(v.id, function (r) {
                      if (r) {
                        btnInstall.html("View Kit");
                        btnInstall.removeAttr("disabled");
                        btnInstall.off("click");
                        btnInstall.on("click", function (e) {
                          e.preventDefault();
                          render_view_template(r);
                        });
                      }
                    });
                  });
                }
              }
              let btnPreview = jQuery(
                `<a target="_blank" href="${v.preview_url}" class="btn fw-light w-100 border-white text-white rounded-2" data-template="${v.id}">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
                        </svg>
                Preview</button>`
              );
              let totalDownloads = jQuery(
                `<button class="btn btn-outline-accent rounded-2" data-tooltips="Total Download"><i class="rtmicon rtmicon-download"></i>${v.downloads}</button>`
              );
              btnContainer.append(btnInstall);
              btnContainer.append(btnPreview);
              btnContainer.append(totalDownloads);

              $cardBody.append($title);
              // $cardBody.append(``);
              $cardBody.append(btnContainer);
              $card.append($previewImg);
              $card.append($cardBody);
              $col.append($card);
              TemplateContainer.append($col);
            });

            if (res.data.pagination.total_pages > 1) {
              const pagination = jQuery(
                ` <ul id="pagination" class="pagination justify-content-center my-3"></ul>`
              );
              pagination.empty();
              let p =
                res.data.pagination.current_page == 1
                  ? "#"
                  : res.data.pagination.current_page - 1;
              let n =
                res.data.pagination.current_page ==
                res.data.pagination.total_pages
                  ? "#"
                  : res.data.pagination.current_page + 1;

              const prev = jQuery(`<li class="page-item glass-effect"></li>`);
              const prevBtn = jQuery(
                `<button class="page-btn" aria-label="Previous" ${
                  p === "#" ? "disabled" : ""
                }><span aria-hidden="true">&laquo;</span></button>`
              );
              prevBtn.on("click", function (e) {
                rkit_template_library.empty();
                let param = {
                  action: "fetch_lib",
                  paged: p,
                  wpnonce: rkit_libs.template_nonce,
                };
                render_template_body(param);
              });
              prev.append(prevBtn);

              pagination.append(prev);

              for (let i = 1; i <= res.data.pagination.total_pages; i++) {
                const activeClass =
                  i === res.data.pagination.current_page
                    ? "elementor-active"
                    : "";

                pgNumber = jQuery(
                  `<li class="page-item glass-effect ${activeClass}"></li>`
                );
                pgBtn = jQuery(`<button class="page-btn">${i}</button>`);
                pgBtn.on("click", function (e) {
                  rkit_template_library.empty();
                  let param = {
                    action: "fetch_lib",
                    paged: i,
                    wpnonce: rkit_libs.template_nonce,
                  };
                  render_template_body(param);
                });

                pgNumber.append(pgBtn);
                pagination.append(pgNumber);
              }

              const next = jQuery(`<li class="page-item glass-effect"></li>`);
              const nextBtn =
                jQuery(`<button class="page-btn" aria-label="Next" ${
                  n === "#" ? "disabled" : ""
                }>
                <span aria-hidden="true">&raquo;</span>
              </button>`);

              nextBtn.on("click", function (e) {
                rkit_template_library.empty();
                let param = {
                  action: "fetch_lib",
                  paged: n,
                  wpnonce: rkit_libs.template_nonce,
                };
                render_template_body(param);
              });

              next.append(nextBtn);

              pagination.append(next);
              rkit_template_library.append(pagination);
            }
          } else {
            TemplateContainer.empty();
            TemplateContainer.append(
              `<div style="text-align:center ; width : 100%"><h1>Sorry, Template Not Found.<h1></div>`
            );
          }
        },
      });
    }

    function render_installed_template(params) {
      const TemplateContainer = jQuery(
        `<div id="template-container" class="row-cols-3"></div>`
      );
      const load = jQuery(
        '<div id="rkit-loading" class="rkit-loading"><div class="spinner"></div></div>'
      );

      jQuery.ajax({
        type: "POST",
        url: rkit_libs.ajax_url,
        data: params,
        beforeSend: function () {
          TemplateContainer.empty();
          TemplateContainer.append(load);
          rkit_template_library.append(TemplateContainer);
        },
        success: function (res) {
          if (res.success) {
            let data = res.data;
            if (data.length != 0) {
              jQuery.each(data, (i, v) => {
                let $col = jQuery('<div class="col"></div>');
                let $card = jQuery(
                  '<div class="d-flex flex-column h-100 rounded-3 overflow-hidden glass-effect rtm-border"></div>'
                );
                let $previewImg = jQuery(
                  `<img class="img-fluid" src=${v.image_preview_url}>`
                );
                let $cardBody = jQuery(
                  `<div class="p-3 d-flex flex-column gap-3"></div>`
                );
                let $title = jQuery(
                  `<div class="d-block"><h3 class="text-truncate text-white m-0">${v.name}</h3></div>`
                );
                let btnContainer = jQuery(
                  '<div class="d-flex flex-row gap-2"></div>'
                );
                btnInstall = jQuery(
                  `<button 
                  class="fw-light btn w-100 btn-gradient-accent rounded-2">
                  <i class="rtmicon rtmicon-plus me-2"></i>View Kit</button>`
                );
                btnInstall.on("click", function (e) {
                  e.preventDefault();
                  render_view_template(i);
                });

                let btnPreview = jQuery(
                  `<a target="_blank" href="${v.preview_url}" class="btn fw-light w-100 border-white text-white rounded-2" data-template="${v.id}">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                          <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
                          <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
                          </svg>
                  Preview</button>`
                );

                btnContainer.append(btnInstall);
                btnContainer.append(btnPreview);
                // btnContainer.append(totalDownloads);

                $cardBody.append($title);
                // $cardBody.append(``);
                $cardBody.append(btnContainer);
                $card.append($previewImg);
                $card.append($cardBody);
                $col.append($card);
                TemplateContainer.append($col);
              });
            }
          }
        },
        complete: function () {
          load.remove();
        },
      });
    }

    function render_view_template(template) {
      const templateHeader = jQuery(
        `<div id="template-header" class="r-header-page"></div>`
      );
      const TemplateContainer = jQuery("#template-container");
      const load = jQuery(
        '<div id="rkit-loading" class="rkit-loading"><div class="spinner"></div></div>'
      );
      let templateHashId = template;

      jQuery.ajax({
        type: "POST",
        url: rkit_libs.ajax_url,
        data: {
          action: "get_installed_template",
          template: template,
          wpnonce: rkit_libs.template_nonce,
        },
        beforeSend: function () {
          TemplateContainer.empty();
          rkit_template_library.empty();
          TemplateContainer.append(load);
          rkit_template_library.append(TemplateContainer);
        },
        success: function (res) {
          // console.log(res.data);

          if (res.success) {
            TemplateContainer.empty();
            let template = res.data.manifest.templates;
            let pathUrl = res.data.manifest.path_url;

            const title = jQuery(`<h1>${res.data.manifest.title}</h1>`);

            let $attentionBtn =
              jQuery(`<button class="fw-light btn btn-gradient-accent rounded-2 "><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-circle" viewBox="0 0 16 16">
              <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
              <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z"/>
            </svg>Attention</button>`);

            $attentionBtn.on("click", function (e) {
              show_template_description(res.data.description);
            });

            templateHeader.append(title);
            templateHeader.append($attentionBtn);
            jQuery.each(template, function (i, v) {
              if (v.metadata.template_type != "global-styles") {
                let $col = jQuery('<div class="col"></div>');
                let $card = jQuery(
                  '<div class="d-flex flex-column h-100 rounded-3 overflow-hidden glass-effect rtm-border"></div>'
                );
                let $previewImg = jQuery(
                  `<div style="aspect-ratio : 3/2 ; overflow:hidden;"><img class="img-fluid" src="${pathUrl}/${v.screenshot}"></div>`
                );
                let $cardBody = jQuery(
                  `<div class="p-3 d-flex flex-column gap-3"></div>`
                );
                let $title = jQuery(
                  `<div class="d-block"><h3 class="text-truncate text-white m-0">${v.name}</h3></div>`
                );

                let btnContainer = jQuery(
                  '<div class="d-flex flex-row gap-2"></div>'
                );

                let btnPreview = jQuery(
                  `<a target="_blank" href="${v.preview_url}" class="btn fw-light w-100 border-white text-white rounded-2" data-template="${v.id}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
  <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
  <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
</svg>Preview</button>`
                );

                btnInstall = jQuery(
                  `<button class="fw-light btn w-100 btn-gradient-accent rounded-2 "><i class="rtmicon rtmicon-plus"></i>Install</button>`
                );

                let keyName = v.name;
                if (keyName.replace(" ", "_") in res.data.imported) {
                  btnInstall.html(`<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
  <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5"/>
  <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708z"/>
</svg>Import`);
                  btnInstall.on("click", function (e) {
                    e.preventDefault();
                    jQuery(this).html("Importing...");
                    jQuery(this).prop("disabled", true);
                    let id = res.data.imported[keyName.replace(" ", "_")];
                    import_templatekit(id);
                  });
                } else {
                  btnInstall.on("click", function (e) {
                    e.preventDefault();
                    const $this = jQuery(this);
                    let path = v.source;
                    let template = templateHashId;
                    let template_name = keyName.replace(" ", "_");

                    $this.html("Importing 0%");
                    $this.prop("disabled", true);

                    // Fungsi untuk memeriksa progres
                    function checkProgress() {
                      jQuery.ajax({
                        type: "POST",
                        url: rkit_libs.ajax_url,
                        data: {
                          action: "get_import_progress",
                          template: template,
                          template_name: template_name,
                        },
                        success: function (res) {
                          if (res.success) {
                            $this.html(`Importing ${res.data.progress}%`);
                            if (res.data.progress < 100) {
                              setTimeout(checkProgress, 1000); // Cek progres setiap 1 detik
                            }
                          }
                        },
                      });
                    }

                    // Mulai proses impor
                    jQuery.ajax({
                      type: "POST",
                      url: rkit_libs.ajax_url,
                      data: {
                        action: "import_rtm_template",
                        template: template,
                        template_name: template_name,
                        path: path,
                        wpnonce: rkit_libs.template_nonce,
                      },
                      success: function (res) {
                        if (res.success) {
                          $this.html("Importing...");
                          // console.log(res.data.template_id);
                          import_templatekit(res.data.template_id);
                        } else {
                          $this.html("Import Failed");
                        }
                      },
                    });

                    // Mulai polling progres
                    checkProgress();
                  });
                }

                $cardBody.append($title);
                // $cardBody.append(``);
                btnContainer.append(btnInstall);
                btnContainer.append(btnPreview);
                $cardBody.append(btnContainer);
                $card.append($previewImg);
                $card.append($cardBody);
                $col.append($card);
                TemplateContainer.append($col);
              }
            });
          }
        },
        complete: () => {
          load.remove();
          rkit_template_library.append(templateHeader);
          rkit_template_library.append(TemplateContainer);
        },
      });
    }

    // Show modal when escape key is pressed
    jQuery(document).on("keydown", function (event) {
      if (event.keyCode == 27) {
        closeModal();
      }
    });

    // Close modal when close button is clicked
    jQuery(".rkit-close-modal").on("click", function () {
      closeModal();
    });
  }
});

function show_template_description(description) {
  let modal = jQuery(
    `<div class="r-preview-modal-overlay elementor-templates-modal"></div>`
  );

  // Add modal container
  var modalContainer = jQuery(
    '<div class="dialog-widget-content dialog-lightbox-widget-content rkit-modal-dialog" style="width: 50% ; height: 80%"></div>'
  );
  // modalOverlay.append(modalContainer);

  // Add modal content
  var modalContent = jQuery(
    `<div class="dialog-message dialog-lightbox-message"></div>`
  );

  let $description = jQuery(`<div class="attention-description">${description}</div>`);

  modalContent.append($description);

  var elmodalHeader = jQuery(
    '<div class="dialog-header dialog-lightbox-header"></div>'
  );
  var modalHeader = jQuery(
    '<div class="elementor-templates-modal__header rkit-modal-header"></div>'
  );
  modalHeader.append(
    '<div class="elementor-templates-modal__header__logo-area rkit-logo-container"><h3>Attention</h3></div>'
  );

  let modalClose = jQuery(`<button class="rkit-close-modal" style="padding : 20px"><i class="eicon-close"></i></button>`);
  modalClose.on('click' , function(){
    close_preview();
  });
  
  modalHeader.append(modalClose);
  elmodalHeader.append(modalHeader);
  modalContainer.append(elmodalHeader);
  modalContainer.append(modalContent);

  modal.append(modalContainer);
  
  jQuery("body").append(modal);
  jQuery(".r-preview-modal-overlay").animate({ opacity: 1 }, 200, function () {
    jQuery(this).show();
  });
}

function show_preview(src, id, title) {
  var preview_modal = jQuery('<div class="r-preview-modal-overlay"></div>');
  var hpv = jQuery('<div class="r-preview-header"></div>');
  var backbtn = jQuery(
    '<button class="r-preview-back-btn"> <svg xmlns="http://www.w3.org/2000/svg" width=25" height="25" fill="currentColor" class="bi bi-arrow-bar-left" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M12.5 15a.5.5 0 0 1-.5-.5v-13a.5.5 0 0 1 1 0v13a.5.5 0 0 1-.5.5ZM10 8a.5.5 0 0 1-.5.5H3.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L3.707 7.5H9.5a.5.5 0 0 1 .5.5Z"/></svg> Back</button>'
  );
  var impor = jQuery(
    '<button class="r-preview-insert-btn"  data-id-template="' +
      id +
      '"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16"><path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/><path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/></svg>Import</button>'
  );
  var pb = jQuery('<div class="r-preview-body"></div>');
  var img = jQuery('<img class="r-preview-modal-img" src="' + src + '" >');
  var t = jQuery('<div class="r-preview-title"><h3>' + title + "</h3></div>");
  backbtn.click((event) => {
    close_preview();
  });
  impor.click((event) => {
    jQuery(event.currentTarget).html("Importing...");
    jQuery(event.currentTarget).prop("disabled", true);
    import_template(id);
  });
  hpv.append(backbtn);
  hpv.append(t);
  hpv.append(impor);
  pb.append(img);
  preview_modal.append(hpv);
  preview_modal.append(pb);
  jQuery("body").append(preview_modal);
  jQuery(".r-preview-modal-overlay").animate({ opacity: 1 }, 200, function () {
    jQuery(this).show();
  });
}

function close_preview() {
  jQuery(".r-preview-modal-overlay").animate({ opacity: 0 }, 200, function () {
    jQuery(this).remove();
  });
}

function closeModal() {
  jQuery(".elementor-templates-modal").animate(
    { opacity: 0 },
    200,
    function () {
      jQuery(this).remove();
    }
  );
  jQuery(".rkit-modal").animate({ opacity: 0 }, 200, function () {
    jQuery(this).remove();
  });
  jQuery(document).off("keydown");
}

function import_template(id) {
  jQuery(document).ready(($) => {
    $.ajax({
      url: rkit_libs.ajax_url,
      type: "GET",
      data: {
        action: "fetch_layout_lib",
        id: id,
        wpnonce: rkit_libs.template_nonce,
      },
      dataType: "json",
      success: (response) => {
        data = JSON.parse(JSON.stringify(response));
        data.content.forEach((el) => {
          el.id = elementorCommon.helpers.getUniqueId();
          if (el.elements) {
            el.elements.forEach((els) => {
              els.id = elementorCommon.helpers.getUniqueId();
              if (els.elements) {
                els.elements.forEach((eell) => {
                  eell.id = elementorCommon.helpers.getUniqueId();
                });
              }
            });
          }
        });
        var a = $e.run("document/elements/import", {
          model: window.elementor.elementsModel,
          data: data,
          options: window.rkitLO.modelOps,
        });
        if (a[0].view.isRendered) {
          closeModal();
          close_preview();
        }
      },
    });
  });
}

function import_templatekit(id) {
  jQuery.ajax({
    type: "POST",
    url: rkit_libs.ajax_url,
    data: {
      action: "get_template_content",
      template: id,
      wpnonce: rkit_libs.template_nonce,
    },
    success: function (res) {
      if (res.success) {
        data = res.data;

        data.content.forEach((el) => {
          el.id = elementorCommon.helpers.getUniqueId();
          if (el.elements) {
            el.elements.forEach((els) => {
              els.id = elementorCommon.helpers.getUniqueId();
              if (els.elements) {
                els.elements.forEach((eell) => {
                  eell.id = elementorCommon.helpers.getUniqueId();
                });
              }
            });
          }
        });
        var a = $e.run("document/elements/import", {
          model: window.elementor.elementsModel,
          data: data,
          options: window.rkitLO.modelOps,
        });
        if (a[0].view.isRendered) {
          closeModal();
          close_preview();
        }
      }
    },
  });
}

function download_template(id, callback) {
  jQuery.ajax({
    type: "POST",
    url: rkit_libs.ajax_url,
    data: {
      action: "download_template",
      template: id,
      wpnonce: rkit_libs.template_nonce,
    },
    success: function (res) {
      console.log(res.template);

      if (res.success) {
        callback(res.data.template);
      } else {
        callback(false);
      }
    },
  });
}
