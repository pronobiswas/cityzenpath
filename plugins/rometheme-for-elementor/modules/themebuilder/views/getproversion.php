<div class="text-center container d-flex flex-column align-items-center justify-content-center rtm-text-font">
    <div class="w-50">
        <img src="<?php echo esc_url(\RomeTheme::plugin_url() . 'view/dashboard_section_1.png') ?>" alt="" class="img-fluid">
    </div>
    <div style="margin-top: -3rem;">
        <div class="mb-4">
            <h1 class="text-white lh-1 m-0">You can’t use this feature yet</h1>
            <?php if (class_exists('RomethemePro')) : ?>
                <a href="https://rometheme.net/pricing/" target="_blank">
                    <h1 class="text-white fw-semibold lh-1 mb-4">Upgrade Pro Now!</h1>
                </a>
                <?php else : ?>>
            <?php endif; ?>
            <div class="rtm-divider w-75 mx-auto"></div>
        </div>
        <p class="text">Unlock all feature and join 1000+ Pro User worldwide</p>
    </div>
</div>