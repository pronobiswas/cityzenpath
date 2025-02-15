<?php

$hashId = $_GET['template_id'];

$upload_dir = wp_upload_dir();
$rtmTemplateDir = $upload_dir['basedir'] . '/rometheme_template';
$imported = get_option('rtm_import_template_' . $hashId, []);
$manifest = json_decode(file_get_contents($rtmTemplateDir . '/' . $hashId . '/manifest.json'));
$id = \RomethemeKit\Template::get_installed_template_id($hashId);
$missing_plugin = \RomethemeKit\Template::missing_plugins($manifest->required_plugins);

?>


<div class="d-flex flex-column gap-3 me-3  mb-3 rtm-container rounded-2 rtm-bg-gradient-1 rtm-text-font" style="margin-top: -8rem;">
    <div class="px-5 rounded-3 pb-5">
        <div class="spacer"></div>
        <div class="row row-cols-lg-2 row-cols-1 p-4">
            <div class="col col-lg-8">
                <div class="d-flex flex-column gap-3">
                    <span class="accent-color">Build the Future</span>
                    <h1 class="text-white text-wrap m-0">
                        <?php echo esc_html($manifest->title) ?>
                    </h1>
                </div>

            </div>
            <div class="col col-lg-4 d-flex align-items-center justify-content-end">
                <button type="button" class="btn btn-gradient-accent" data-bs-toggle="modal" data-bs-target="#description_modal">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                        <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z" />
                    </svg>
                    Attention
                </button>
            </div>
        </div>
        <?php if (count($missing_plugin) > 0) : ?>
            <div class="alert alert-warning" role="alert">
                <div class="d-flex flex-row justify-content-between align-items-center">
                    <span>
                        <span class="fw-bold">Attention!</span> There are <?php echo esc_html(count($missing_plugin)) ?> requirements that need installing for this Template Kit to work correctly.
                    </span>
                    <button type="button" class="btn btn-warning btn-install-requirements" data-missing="<?php echo esc_attr(json_encode($missing_plugin)) ?>"><i class="fas fa-circle-info"></i> Install Requirements</button>
                </div>
            </div>
        <?php endif ?>
    </div>
</div>
<div class="rtm-container rtm-bg-gradient-1 rounded-3 me-3 p-4">
    <div class="row row-cols-3" id="template-container">
        <?php foreach ($manifest->templates as $t) :
            $imgurl = $upload_dir['baseurl'] . '/rometheme_template/' . $hashId . '/' . $t->screenshot;
        // echo $imported['Header_–_Block'];
        ?>
            <div class="col mb-3">
                <div class="d-flex flex-column h-100 rounded-3 overflow-hidden glass-effect rtm-border">
                    <div class="overflow-hidden" style="aspect-ratio:3/2;">
                        <img class="img-fluid" src="<?php echo esc_url($imgurl) ?>">
                    </div>
                    <div class="p-3 d-flex flex-column gap-3">
                        <div class="d-block">
                            <h5 class="text-truncate text-white m-0"><?php echo esc_html($t->name) ?></h5>
                        </div>
                        <div class="d-flex flex-row gap-2">
                            <?php if (isset($imported[str_replace(' ', '_', $t->name)])) : ?>
                                <a href="<?php echo esc_url(admin_url('post.php?post=' . $imported[str_replace(' ', '_', $t->name)] . '&action=elementor')) ?>" class="fw-light btn w-100 btn-gradient-accent rounded-2 text-nowrap">
                                    <i class="far fa-eye me-2"></i>
                                    View Template</a>
                                <button class="btn btn-outline-danger fw-light w-100 rounded-2 text-nowrap delete-installed-template" data-template="<?php echo esc_attr($hashId) ?>" data-item-template="<?php echo esc_attr($imported[str_replace(' ', '_', $t->name)]) ?>">
                                    <i class="far fa-trash-can me-2"></i>
                                    Delete</button>
                            <?php else : ?>
                                <button class="fw-light btn w-100 btn-gradient-accent rounded-2 import-template text-nowrap" data-template-name="<?php echo esc_attr(str_replace(' ', '_', $t->name)) ?>" data-template="<?php echo esc_attr($hashId) ?>" data-path="<?php echo esc_attr($t->source) ?>"><i class="fas fa-plus me-2"></i>Import</button>
                                <a id="preview_template" target="_blank" href="<?php echo esc_url($t->preview_url) ?>" class="btn fw-light w-100 border-white text-white rounded-2"><i class="far fa-eye me-2"></i>Preview</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Description Modal -->
<div class="modal fade" id="description_modal" tabindex="-1" style="z-index: 99999;">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content rtm-bg-gradient-1">
            <div class="modal-header">
                <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">ATTENTION</h1>
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fas fa-xmark"></i>
                </button>
            </div>
            <div class="modal-body px-4">
                <?php
                $description = \RomethemeKit\Template::get_template_description($id);
                echo wp_kses_post($description);
                ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-gradient-accent" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>