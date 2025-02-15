<div class="spacer-2"></div>
<?php
if (file_exists(WP_PLUGIN_DIR . '/romethemeform/rometheme-form.php')) {
    $btn['text'] = 'Activate Now';
    $btn['url'] = wp_nonce_url('plugins.php?action=activate&plugin=romethemeform/rometheme-form.php&plugin_status=all&paged=1', 'activate-plugin_romethemeform/rometheme-form.php');
} else {
    $btn['text'] = 'Install Now';
    $btn['url'] = wp_nonce_url(self_admin_url('update.php?action=install-plugin&plugin=romethemeform'), 'install-plugin_romethemeform');
}

require RomeTheme::plugin_dir() . 'view/header.php';

?>

<div class="d-flex flex-column gap-3 me-3  mb-3 rtm-container rounded-2 rtm-bg-gradient-1 rtm-text-font" style="margin-top: -8rem;">
    <div class="px-5 rounded-3 pb-5">
        <div class="spacer"></div>
        <div class="row row-cols-xl-2 row-cols-1 rtm-text-font px-4 py-5">
            <div class="col col-xl-7">
                <div class="d-flex flex-column gap-4 px-4 h-100 justify-content-center">
                    <span class="accent-color">Build the Future</span>
                    <h1 class="text-white m-0">
                        Hello , <span class="fw-bold"><?php echo ucwords(get_userdata(get_current_user_id())->user_login) ?></span> <br>
                        Welcome To Form Builder
                    </h1>
                    <div class="rtm-divider rounded-pill" style="width: 80%;"></div>
                    <p class="text">
                        Please make sure RomethemeForm for Elementor is installed and active before attempting to use this feature.
                    </p>
                    <div class="d-flex flex-row align-items-center gap-4">
                        <a href="<?php echo esc_url($btn['url']) ?>" class="btn btn-gradient-accent rounded-pill text-nowrap"><?php echo esc_html($btn['text']) ?></a>
                    </div>
                </div>
            </div>
            <div class="col col-xl-5">
                <img src="<?php echo esc_url(\RomeTheme::plugin_url() . 'view/formbuilder.png') ?>" alt="" class="img-fluid">
            </div>
        </div>
    </div>
</div>