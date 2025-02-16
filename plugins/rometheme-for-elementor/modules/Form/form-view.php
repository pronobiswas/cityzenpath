<?php
if (file_exists(WP_PLUGIN_DIR . '/romethemeform/rometheme-form.php')) {
    $btn['text'] = 'Activate Now';
    $btn['url'] = wp_nonce_url('plugins.php?action=activate&plugin=romethemeform/rometheme-form.php&plugin_status=all&paged=1', 'activate-plugin_romethemeform/rometheme-form.php');
} else {
    $btn['text'] = 'Install Now';
    $btn['url'] = wp_nonce_url(self_admin_url('update.php?action=install-plugin&plugin=romethemeform'), 'install-plugin_romethemeform');
}

?>

<div class="text-center container d-flex flex-column align-items-center justify-content-center rtm-text-font">
    <div class="w-50 px-5">
        <img src="<?php echo esc_url(\RomeTheme::plugin_url() . 'view/formbuilder.png') ?>" alt="" class="img-fluid">
    </div>
    <div style="margin-top: -3rem;">
        <div class="mb-4">
            <h5 class="text-white lh-1 mb-4">Please install and activate RomeThemeForm for Elementor first.</h5>
            <?php if (class_exists('RomethemePro')) : ?>
                <a href="<?php echo esc_url($btn['url']) ?>" class="btn btn-gradient-accent mb-4 rounded-pill" >
                    <?php echo esc_html($btn['text']) ?>
                </a>
                <?php else : ?>>
            <?php endif; ?>
            <div class="rtm-divider w-75 mx-auto"></div>
        </div>
        <p class="text">Unlock all feature and join 1000+ Pro User worldwide</p>
    </div>
</div>