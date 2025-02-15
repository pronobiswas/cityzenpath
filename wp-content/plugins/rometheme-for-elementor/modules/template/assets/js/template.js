jQuery(document).ready(function ($) {
  // console.log(window.rtm);

  const params = new URLSearchParams(window.location.search);
  if (!params.has("template_id")) {
    // Buat objek data
    const data = {
      action: "fetch_lib",
      wpnonce: rometheme_ajax.nonce,
    };

    // Tambahkan parameter hanya jika ada
    if (params.has("search")) {
      data.search = params.get("search");
      $("#template-search").val(params.get("search"));
    }

    if (params.has("category")) {
      data.category = params.get("category");
    }

    if (params.has("paged")) {
      data.paged = params.get("paged");
    }
    $.ajax({
      type: "POST",
      url: rometheme_ajax.ajax_url,
      data: data,
      success: function (res) {
        if (res.success) {
          let dataTemplate = res.data.data_template;
          console.log(dataTemplate);

          const TemplateContainer = $("#template-container");
          if (dataTemplate.length != 0) {
            TemplateContainer.empty();
            $.each(dataTemplate, (i, v) => {
              let $col = $('<div class="col mb-4"></div>');
              let $card = $(
                '<div class="d-flex flex-column h-100 rounded-3 overflow-hidden glass-effect rtm-border"></div>'
              );
              let $previewImg = $(
                `<img class="img-fluid" src=${v.image_preview}>`
              );
              let $cardBody = $(
                `<div class="p-3 d-flex flex-column gap-3"></div>`
              );
              let $title = $(
                `<div class="d-block"><h5 class="text-truncate text-white m-0">${v.name}</h5></div>`
              );

              let btnContainer = $('<div class="d-flex flex-row gap-2"></div>');
              let btnInstall;
              if (v.type == "pro") {
                if (window.rtm.isPro) {
                  if (v.has_installed) {
                    btnInstall = $(
                      `<a href="${
                        res.data.template_url + "&template_id=" + v.installed
                      }" class="fw-light btn w-100 btn-gradient-accent rounded-2"><i class="fas fa-plus me-2"></i>View Kit</a>`
                    );
                  } else {
                    btnInstall = $(
                      `<button class="fw-light btn w-100 btn-gradient-accent rounded-2 "><i class="fas fa-plus me-2"></i>Install</button>`
                    );

                    btnInstall.on("click", function (e) {
                      $(this).html("Installing...");
                      $(this).prop("disabled", true);
                      download_template(v.id);
                    });
                  }
                } else {
                  btnInstall = $(
                    `<a href="http://rometheme.net/pricing" target="_blank" class="fw-light btn w-100 btn-gradient-accent rounded-2"><i class="fas fa-plus me-2"></i>Upgrade</a>`
                  );
                }
              } else {
                if (v.has_installed) {
                  btnInstall = $(
                    `<a href="${
                      res.data.template_url + "&template_id=" + v.installed
                    }" class="fw-light btn w-100 btn-gradient-accent rounded-2"><i class="fas fa-plus me-2"></i>View Kit</a>`
                  );
                } else {
                  btnInstall = $(
                    `<button class="fw-light btn w-100 btn-gradient-accent rounded-2 "><i class="fas fa-plus me-2"></i>Install</button>`
                  );

                  btnInstall.on("click", function (e) {
                    $(this).html("Installing...");
                    $(this).prop("disabled", true);
                    download_template(v.id);
                  });
                }
              }
              let btnPreview = $(
                `<a target="_blank" href="${v.preview_url}" class="btn fw-light w-100 border-white text-white rounded-2" data-template="${v.id}"><i class="far fa-eye me-2"></i>Preview</button>`
              );

              let totalDownloads = $(`<button class="btn btn-outline-accent" data-tooltips="Total Download"><i class="fas fa-download"></i>${v.downloads}</button>`);

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
              const pagination = $("#pagination");
              pagination.empty();
              let p =
                res.data.pagination.current_page == 1
                  ? "#"
                  : res.data.pagination.current_page - 1;
              let prevLink =
                p === "#"
                  ? ""
                  : `href="${res.data.template_url + "&paged=" + p}"`;
              const prev = $(`<li class="page-item glass-effect">
              <a class="page-btn" ${prevLink} aria-label="Previous" ${
                p === "#" ? "disabled" : ""
              }>
                <span aria-hidden="true">&laquo;</span>
              </a>
            </li>`);

              let n =
                res.data.pagination.current_page ==
                res.data.pagination.total_pages
                  ? "#"
                  : res.data.pagination.current_page + 1;
              let nextLink =
                n === "#"
                  ? ""
                  : `href="${res.data.template_url + "&paged=" + n}"`;
              const next = $(`<li class="page-item glass-effect">
              <a class="page-btn" ${nextLink} aria-label="Next" ${
                n === "#" ? "disabled" : ""
              }>
                <span aria-hidden="true">&raquo;</span>
              </a>
            </li>`);

              pagination.append(prev);
              for (let i = 1; i <= res.data.pagination.total_pages; i++) {
                const activeClass =
                  i === res.data.pagination.current_page ? "active" : "";
                pagination.append(
                  `<li class="page-item glass-effect ${activeClass}"><a href="${
                    res.data.template_url + "&paged=" + i
                  }" class="page-btn" data-page="${i}">${i}</a></li>`
                );
              }

              pagination.append(next);
            }
          } else {
            $("#loader").empty();
            $("#loader").append(
              `<h4 class="text-light">Sorry, Result Not Found</h4>`
            );
          }
        } else {
          console.log(res);
        }
      },
    });
  }
  function download_template(id) {
    $.ajax({
      type: "POST",
      url: rometheme_ajax.ajax_url,
      // timeout: 20000,
      data: {
        action: "download_template",
        template: id,
        wpnonce: rometheme_ajax.nonce,
      },
      success: function (res) {
        console.log(res);
        
        if (res.success) {
          window.location.reload();
        }
      },
    });
  }

  $(".import-template").on("click", function (e) {
    e.preventDefault();
    const $this = $(this);
    let path = $this.data("path");
    let template = $this.data("template");
    let template_name = $this.data("template-name");

    $this.html("Importing 0%");
    $(".import-template").prop("disabled", true);

    // Fungsi untuk memeriksa progres
    function checkProgress() {
      $.ajax({
        type: "POST",
        url: rometheme_ajax.ajax_url,
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
    $.ajax({
      type: "POST",
      url: rometheme_ajax.ajax_url,
      data: {
        action: "import_rtm_template",
        template: template,
        template_name: template_name,
        path: path,
        wpnonce: rometheme_ajax.nonce,
      },
      success: function (res) {
        if (res.success) {
          console.log(res.data);
          
          $this.html("Import Complete!");
          let $link = $(
            `<a href="${res.data.edit_url}" class="fw-light btn w-100 btn-gradient-accent rounded-2 text-nowrap"><i class="far fa-eye me-2"></i>View Template</a>`
          );
          let $deleteButton = $(`
                    <button 
                        class="btn w-100 btn-outline-danger text-nowrap delete-installed-template" 
                        data-template="${template}" 
                        data-item-template="${res.data.template_id}">
                        <i class="far fa-trash-can me-2"></i>
                        Delete
                    </button>
                `);

          $deleteButton.on("click", function () {
            $deleteButton.html("Deleting...");
            $deleteButton.prop("disabled", true);
            $.ajax({
              type: "POST",
              url: rometheme_ajax.ajax_url,
              data: {
                action: "delete_installed_template",
                template: template,
                template_id: res.data.template_id,
                wpnonce: rometheme_ajax.nonce,
              },
              success: function (deleteRes) {
                if (deleteRes.success) {
                  alert("Template deleted successfully!");
                  window.location.reload();
                }
              },
            });
          });

          window.location.reload();
        } else {
          $this.html("Import Failed");
        }
      },
    });

    // Mulai polling progres
    checkProgress();
  });

  $(".delete-template").on("click", function (e) {
    e.preventDefault();
    let template = $(this).data("template");
    $(this).html("Deleting...");
    $.ajax({
      type: "POST",
      url: rometheme_ajax.ajax_url,
      data: {
        action: "delete_template",
        template: template,
        wpnonce: rometheme_ajax.nonce,
      },
      success: function (res) {
        if (res.success) {
          window.location.reload();
        }
      },
    });
  });

  $(".delete-installed-template").on("click", function (e) {
    e.preventDefault();
    $this = $(this);
    $this.prop("disabled", true);
    $this.html("Deleting...");
    let template = $this.data("template");
    let id = $this.data("item-template");

    $.ajax({
      type: "POST",
      url: rometheme_ajax.ajax_url,
      data: {
        action: "delete_installed_template",
        template: template,
        template_id: id,
        wpnonce: rometheme_ajax.nonce,
      },
      success: function (res) {
        if (res.success) {
          alert("Template deleted successfully!");
          window.location.reload();
        }
      },
    });
  });

  $(".btn-install-requirements").on("click", function (e) {
    e.preventDefault();
    $this = $(this);
    let datamiss = $(this).data("missing"); // Ambil data plugin yang hilang
    let total = datamiss.length; // Total plugin yang harus diinstall

    if (!Array.isArray(datamiss) || total === 0) {
      alert("No plugins to install.");
      return;
    }

    $(this).prop("disabled", true); // Disable tombol untuk mencegah klik ganda

    function installPlugin(index) {
      if (index < total) {
        // Update teks untuk plugin yang sedang diproses
        let percen = (index / datamiss.length) * 100;
        $this.html(`Installing...`);

        // Kirim AJAX untuk menginstall plugin
        $.post(rometheme_ajax.ajax_url, {
          action: "install_requirements",
          plugin: datamiss[index].file,
        })
          .done(function (res) {
          })
          .fail(function () {})
          .always(function () {
            // Setelah selesai, lanjutkan ke plugin berikutnya
            installPlugin(index + 1);
          });
      } else {
        // Semua plugin sudah diinstall
        window.location.reload();
      }
    }

    // Mulai proses dari plugin pertama
    installPlugin(0);
  });
});
