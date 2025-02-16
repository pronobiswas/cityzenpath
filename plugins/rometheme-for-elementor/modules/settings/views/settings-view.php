<div class="spacer-2"></div>
<?php
require_once(RomeTheme::plugin_dir() . 'view/header.php');

if (class_exists('RomethemePro')) {
    if (class_exists('\RomethemePro\RproLicense')) {
        $license = \RomethemePro\RproLicense::get_license_key();
    }
}

$args = array(
    'post_type' => 'elementor_library', // Post type
    'posts_per_page' => -1, // Get all posts
    'meta_query' => array(
        array(
            'key' => '_elementor_template_type',
            'value' => 'kit',
            'compare' => '='
        )
    )
);

$globalSettings = new WP_Query($args);

?>

<div class="d-flex flex-column gap-3 me-3  mb-3 rtm-container rounded-2 rtm-bg-gradient-3 rtm-text-font" style="margin-top: -8rem;">
    <div class="px-5 rounded-3 pb-5">
        <div class="spacer"></div>
        <div class="d-flex flex-column gap-4">
            <div class="row row-cols-lg-2 row-cols-1">
                <div class="col col-lg-7">
                    <div class="d-flex flex-column gap-3">
                        <span class="accent-color">Settings</span>
                        <h1 class="text-white fw-light">Adjust your website settings to achieve the best performance.</h1>
                        <div class="rtm-divider rounded-pill"></div>
                        <p class="text m-0">Adjust your website settings to achieve the best performance. Customizing these settings will enhance your site's efficiency and provide an improved user experience.</p>
                        <div class="d-flex flex-row align-items-center gap-4">
                            <a href="https://rometheme.net/docs/" target="_blank" class="btn btn-gradient-accent rounded-pill">Watch Documentation <i class="rtmicon rtmicon-arrow-up-right mt-2"></i></a>
                            <p class="text m-0">Enjoy your #selflearningwithrometheme</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="rounded rtm-border bg-gradient-1">
                <div class="rtm-border-bottom p-3">
                    <h5 class="text-white m-0 fw-light">Global Style</h5>
                </div>
                <div class="p-3">
                    <form action="" id="set-global-style">
                        <input type="text" name="action" value="set_global_site" hidden>
                        <label for="select-global" class="form-label text-white">Select Global Style</label>
                        <div class="input-group mb-3">
                            <select class="form-select py-2 px-3" name="idKit" id="select-global">
                                <?php while ($globalSettings->have_posts()) : $globalSettings->the_post(); ?>
                                    <option value="<?php echo esc_attr(get_the_ID()) ?>" <?php echo (get_option('elementor_active_kit') == get_the_ID()) ? esc_attr('selected') : '' ?>><?php echo esc_html(the_title()) ?></option>
                                <?php endwhile; ?>
                            </select>
                            <button class="btn btn-gradient-accent rtm-border">Save Changes</button>
                        </div>
                        <div class="d-flex flex-row gap-2 align-items-center">
                            <i class="fa-solid fa-triangle-exclamation"></i>
                            <p class="text m-0" style="font-size:11px; max-width:75%;">When used, the "Global Site Settings" that some Template Kits contain can affect your entire website. The Elementor Hamburger Menu » Site Settings is where you can change the Site Settings. The global site settings that are applied to your website can be altered below.</p>
                        </div>
                    </form>
                </div>
            </div>
            <?php if (class_exists('RomethemePro')) : ?>
                <div class="rounded rtm-border bg-gradient-1">
                    <div class="rtm-border-bottom p-3">
                        <h5 class="text-white m-0 fw-light">License Settings</h5>
                    </div>
                    <div class="p-4 d-flex flex-column gap-3">
                        <?php if (!empty($license)) : ?>
                            <div class="pb-3 d-flex flex-row align-items-center gap-3 text-white">
                                <h5 class="m-0 text-nowrap"> Status : </h5>
                                <span class="rounded-pill <?php echo esc_attr(\RomethemePro\RproLicense::get_subs_status()) ?>"><?php echo esc_html(ucwords(\RomethemePro\RproLicense::get_subs_status())) ?></span>
                                <div class="rtm-divider rounded-pill"></div>
                                <div>
                                    <a href="https://rometheme.net/my-account/" target="_blank" class="btn btn-gradient-accent rounded-pill text-nowrap">My Account</a>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div>
                            <?php if (empty($license)) : ?>
                                <form action="" id="activate-form" class="d-flex flex-column">
                                    <input type="text" name="action" value="update_license_key" hidden>
                                    <label for="license-input" class="form-label text-white">License Key</label>
                                    <div class="input-group mb-3">
                                        <input type="text" id="license-input" name="license_key" class="form-control py-2" placeholder="rtm-xxxx-xxxxx-xxxxx-xxxx" required>
                                        <button type="submit" class="btn btn-gradient-accent rtm-border">Connect & Active</button>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <p class="text">Needing a license key at this time? Check out our interesting offering at <a href="" class="link accent-color">Rometheme.net</a></p>
                                    </div>
                                </form>
                            <?php else : ?>

                                <table class="rtm-table">
                                    <tbody>
                                        <tr>
                                            <td>License Key</td>
                                            <td><?php echo esc_html($license) ?></td>
                                        </tr>
                                        <tr>
                                            <td>Connected Account</td>
                                            <td><?php echo esc_html(\RomethemePro\RproLicense::get_user_email()) ?></td>
                                        </tr>
                                        <tr>
                                            <td>Product</td>
                                            <td><?php echo esc_html(\RomethemePro\RproLicense::get_product_name()) ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="d-flex align-items-center py-2 justify-content-between">
                                    <p class="text m-0">
                                        Have a few issues? Connect with the <a href="" class="accent-color link">Help Center</a>. For what reason would you like the license to be revoked?
                                    </p>
                                    <form id="deactivate-license">
                                        <input type="text" name="action" value="deactivate_license" hidden>
                                        <button class="btn btn-gradient-accent rounded-pill">Disconnect</button>
                                    </form>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>