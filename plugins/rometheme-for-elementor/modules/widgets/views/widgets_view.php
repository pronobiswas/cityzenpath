<div class="spacer-2"></div>
<?php

require RomeTheme::plugin_dir() . 'view/header.php';

$options = get_option('rkit-widget-options');

$headeroptions = array_filter($options, function ($value) {
    return $value['category'] == 'header';
});
$rkitoptions = array_filter($options, function ($value) {
    if(class_exists('WooCommerce')) {
        return $value['category'] == 'rkit' || $value['category'] == 'woocommerce'  ;
    } else {
        return $value['category'] == 'rkit';
    }
});

$optionsPro = (\RomethemePlugin\Plugin::isProActive()) ? get_option('rkit-widget-pro-options') : \RomethemeKit\RkitWidgets::listWidgetPro();

?>

<div class="d-flex flex-column gap-3 me-3  mb-3 rtm-container rounded-2 rtm-bg-gradient-3" style="margin-top: -8rem;">
    <div class="px-5 rounded-3 mb-4">
        <div class="spacer"></div>
        <div class="row row-cols-xl-2 row-cols-1 rtm-text-font py-5">
            <div class="col col-xl-7">
                <div class="d-flex flex-column gap-4 px-4">
                    <span class="accent-color">RomethemeKit Widgets</span>
                    <h1 class="text-white m-0" style="max-width: 32rem">
                        For A Better Experience,
                        Turn Off And On The Widgets
                        That Will Go Online.
                    </h1>
                    <div class="rtm-divider rounded-pill" style="width: 80%;"></div>
                    <p class="text m-0 w-75">
                        Make the best experience when using RomethemeKit by learning and seeing how to use it, activating the necessary widgets, and turning off widgets for faster website performance.
                    </p>
                    <div class="d-flex flex-row align-items-center gap-4">
                        <a href="https://rometheme.net/widget-library/" target="_blank" class="btn btn-gradient-accent rounded-pill gap-3">About Widget <i class="rtmicon rtmicon-arrow-up-right "></i></a>
                        <a href="https://support.rometheme.net/" target="_blank" class="btn link-accent gap-3">Watch Documentation <i class="rtmicon rtmicon-arrow-up-right "></i></a>

                    </div>
                </div>
            </div>
            <div class="col col-xl-5">
                <img src="<?php echo esc_url(\RomeTheme::plugin_url() . 'view/images/widget-wp.png') ?>" alt="" class="img-fluid">
            </div>
        </div>
        <div class="rtm-text-font">
            <form id="widgets_option">
                <input type="text" name="action" value="save_options" hidden>
                <div class="d-flex flex-row justify-content-between mb-3">
                    <div class="d-flex gap-2">
                        <button class="btn btn-gradient-accent rounded-pill" id="enable-all">Enable All</button>
                        <button class="btn btn-outline-accent rounded-pill " id="disable-all">Disable All</button>
                        <button class="btn btn-outline-accent rounded-pill " id="reset-btn">Reset</button>
                    </div>
                    <div>
                        <button class="btn btn-gradient-accent rounded-pill" id="save-widget-options">Save Changes</button>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="d-flex w-100 py-3 text-white">
                        <h5>Header & Footer</h5>
                    </div>
                    <div class="row row-cols-xxl-4 row-cols-xl-3">
                        <?php foreach ($headeroptions as $h_opt => $value) : ?>
                            <div class="col m-0 p-2">
                                <div class="card bg-gradient-1 rounded-3 w-100 m-0 p-3 rtm-border">
                                    <div class="d-flex flex-row align-items-center justify-content-between">
                                        <div class="col-8">
                                            <div class="d-flex flex-row align-items-center gap-3 text-white">
                                                <i class="accent-color <?php echo esc_attr($value['icon']) ?>" style="font-size:40px;"></i>
                                                <span><?php echo esc_html($value['name']) ?></span>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="d-flex w-100 justify-content-end">
                                                <input name="<?php echo esc_attr($h_opt) ?>" value="false" hidden>
                                                <label class="switch">
                                                    <input name="<?php echo esc_attr($h_opt) ?>" class="switch-input" type="checkbox" value="true" <?php echo ($value['status']) ? 'checked' : ''  ?>>
                                                    <span class="slider round"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="d-flex w-100 text-white py-3">
                        <h5>General</h5>
                    </div>
                    <div class="row row-cols-xxl-4 row-cols-xl-3">
                        <?php foreach ($rkitoptions as $h_opt => $value) : ?>
                            <div class="col m-0 p-2">
                                <div class="card rounded-3 bg-gradient-1 w-100 m-0 p-3 rtm-border">
                                    <div class="d-flex flex-row align-items-center justify-content-between">
                                        <div class="col-8">
                                            <div class="d-flex flex-row align-items-center gap-3 text-white">
                                                <i class="accent-color <?php echo esc_attr($value['icon']) ?>" style="font-size:40px;"></i>
                                                <span><?php echo esc_html($value['name']) ?></span>
                                            </div>

                                        </div>
                                        <div class="col-4">
                                            <div class="d-flex w-100 justify-content-end">
                                                <input name="<?php echo esc_attr($h_opt) ?>" value="false" hidden>
                                                <label class="switch">
                                                    <input name="<?php echo esc_attr($h_opt) ?>" class="switch-input" type="checkbox" value="true" <?php echo ($value['status']) ? 'checked' : ''  ?>>
                                                    <span class="slider round"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

            </form>
            <form id="widgets_option_pro">
                <?php if (\RomethemePlugin\Plugin::isProActive()) : ?>
                    <input type="text" name="action" value="save_options_pro" hidden>
                <?php endif; ?>
                <div class="mt-4">
                    <div class="d-flex w-100 text-white py-3">
                        <h5>Pro</h5>
                    </div>
                    <div class="row row-cols-xxl-4 row-cols-xl-3">
                        <?php foreach ($optionsPro as $h_opt => $value) : ?>
                            <div class="col m-0 p-2">
                                <div class="card rounded-3 bg-gradient-1 w-100 m-0 p-3 rtm-border">
                                    <div class="d-flex flex-row align-items-center justify-content-between">
                                        <div class="col-8">
                                            <div class="d-flex flex-row align-items-center gap-3 text-white">
                                                <i class="accent-color <?php echo esc_attr($value['icon']) ?>" style="font-size:40px;"></i>
                                                <span><?php echo esc_html($value['name']) ?></span>
                                            </div>

                                        </div>
                                        <div class="col-4">
                                            <div class="d-flex w-100 justify-content-end">
                                                <?php if (\RomethemePlugin\Plugin::isProActive()) : ?>
                                                    <input name="<?php echo esc_attr($h_opt) ?>" value="false" hidden>
                                                    <label class="switch">
                                                        <input name="<?php echo esc_attr($h_opt) ?>" class="switch-input" type="checkbox" value="true" <?php echo ($value['status']) ? 'checked' : ''  ?>>
                                                        <span class="slider round"></span>
                                                    </label>
                                                <?php else: ?>
                                                    <i class="rtmicon rtmicon-lock" style="font-size: 1.3em ; color:#00cea6"></i>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>