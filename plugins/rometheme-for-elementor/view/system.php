<div class="spacer-2"></div>

<?php
$wp_info = [
    'WordPress_version' => get_bloginfo('version'),
    'WordPress_language' => get_bloginfo('language'),
    'WordPress_theme' => [
        'Name' => wp_get_theme()->Name,
        'Author' => wp_get_theme()->Author,
        'Version' => wp_get_theme()->Version,
    ],
    'Site_url' => get_site_url(), // Menambahkan URL situs
    'Max_upload_size' => wp_max_upload_size(), // Menambahkan ukuran maksimum unggahan
    'Permalink_structure' => get_option('permalink_structure'), // Menambahkan struktur permalink
    'Time_zone' => get_option('timezone_string'), // Menambahkan zona waktu
    'WP_multisite' => (is_multisite()) ? 'Yes' : 'No', // Menambahkan info apakah WordPress berjalan dalam mode multisite atau tidak
    'Active_plugins' => get_option('active_plugins'),
    // Informasi tambahan yang mungkin Anda perlukan
];

$php_info = [
    'PHP_version' => phpversion(),
    'PHP_OS' => PHP_OS,
    'PHP_memory_limit' => ini_get('memory_limit'),
    'PHP_max_execution_time' => ini_get('max_execution_time'),
    'server_software' => $_SERVER['SERVER_SOFTWARE'],
    'max_input_vars' => ini_get('max_input_vars'),
    'post_max_size' =>  ini_get('post_max_size')
];

global $wpdb;

$mysql_info_cached = wp_cache_get('mysql_info_cached');

if (false === $mysql_info_cached) {
    // Jika data tidak ada di cache, ambil dari database dan simpan ke cache
    $query = "SELECT version() as version, @@version_comment as comment";
    $mysql_info = $wpdb->get_results($query, ARRAY_A);

    // Simpan data ke cache
    wp_cache_set('mysql_info_cached', $mysql_info);

    // Gunakan data yang diambil dari database
    $mysql_info_cached = $mysql_info;
}

$mysql_version = $wpdb->db_version();

$mysql_comment_v = $mysql_info_cached[0]['comment'];

$uploads_dir = wp_upload_dir();
$upload_path = $uploads_dir['basedir'];
$is_writable = is_writable($upload_path) ? 'Writeable' : 'Not Writeable';

require_once(RomeTheme::plugin_dir() . 'view/header.php');


$active_theme = wp_get_theme();
$theme_name = $active_theme->get('Name');
$theme_version = $active_theme->get('Version');
$theme_author = $active_theme->get('Author');
$active_plugins = get_option('active_plugins');
?>

<div class="d-flex flex-column gap-3 me-3  mb-3 rtm-container rounded-2 rtm-bg-gradient-1" style="margin-top: -8rem;">
    <div class="px-5 rounded-3">
        <div class="spacer"></div>
        <div class="row row-cols-xl-2 row-cols-1 rtm-text-font px-4 py-5">
            <div class="col col-xl-8">
                <div class="d-flex flex-column gap-4 px-4">
                    <div>
                        <span class="accent-color">System Status Healthcheck</span>
                        <div class="d-flex flex-row gap-3 align-items-center ">
                            <h1 class="text-white text-nowrap m-0">
                                Hello , <span class="fw-bold"><?php echo ucwords(get_userdata(get_current_user_id())->user_login) ?></span>
                            </h1>
                            <div class="rtm-divider rounded-pill"></div>
                        </div>
                        <h1 class="text-white m-0">
                            Let's Check Your System Status Here
                        </h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="row row-cols-xl-2 row-cols-1 rtm-text-font px-4 mb-5">
            <div class="col col-xl-7">
                <div class="d-flex flex-column gap-3">
                    <div class="rounded rtm-border bg-gradient-1">
                        <div class="rtm-border-bottom p-3">
                            <h5 class="text-white m-0 fw-light">Server Status</h5>
                        </div>
                        <div class="p-3">
                            <table class="rtm-table table-system fw-light">
                                <tbody>
                                    <tr>
                                        <td scope="row">Operating System</td>
                                        <td class="description" colspan="2"><?php echo esc_html($php_info['PHP_OS']) ?></td>
                                    </tr>
                                    <tr>
                                        <td scope="row">Software</td>
                                        <td class="description" colspan="2"><?php echo esc_html($php_info['server_software']) ?></td>
                                    </tr>
                                    <tr>
                                        <td scope="row">Write Permissions</td>
                                        <td class="description" colspan="2"><?php echo esc_html($is_writable); ?></td>
                                    </tr>
                                    <tr>
                                        <td scope="row">MySQL Version</td>
                                        <td class="description"><?php echo esc_html($mysql_comment_v . ' v.' . $mysql_version) ?></td>
                                        <td class="icon-status"><i class="d-block <?php
                                                                                    if (strpos(strtolower($mysql_comment_v), 'mysql') !== false) {
                                                                                        echo (version_compare($mysql_version, '5.6.0') != -1) ? esc_attr('valid-color far fa-circle-check') : esc_attr('invalid-color far fa-circle-xmark');
                                                                                    } else if (strpos(strtolower($mysql_comment_v), 'mariadb') !== false) {
                                                                                        echo (version_compare($mysql_version, '10.0.0') != -1) ? esc_attr('valid-color far fa-circle-check') : esc_attr('invalid-color far fa-circle-xmark');
                                                                                    }

                                                                                    ?>"></i></td>
                                    </tr>
                                    <tr>
                                        <td scope="row">PHP Version</td>
                                        <td class="description"><?php echo esc_html($php_info['PHP_version']) ?></td>
                                        <td class="icon-status"><i class="d-block <?php echo (version_compare($php_info['PHP_version'], '7.3.0') != -1) ? esc_attr('valid-color far fa-circle-check') : esc_attr('invalid-color far fa-circle-xmark') ?>"></i></td>
                                    </tr>
                                    <tr>
                                        <td scope="row">PHP Memory Limit</td>
                                        <td class="description"><?php echo esc_html($php_info['PHP_memory_limit']) ?></td>
                                        <td class="icon-status"><i class="d-block <?php echo (intval($php_info['PHP_memory_limit']) >= 256) ?  esc_attr('valid-color far fa-circle-check') : esc_attr('invalid-color far fa-circle-xmark')  ?>"></i></td>
                                    </tr>
                                    <tr>
                                        <td scope="row">PHP Max Input Vars</td>
                                        <td class="description"><?php echo esc_html($php_info['max_input_vars']) ?></td>
                                        <td class="icon-status"><i class="d-block <?php echo (intval($php_info['max_input_vars']) >= 1000) ?  esc_attr('valid-color far fa-circle-check') : esc_attr('invalid-color far fa-circle-xmark')  ?>"></i></td>
                                    </tr>
                                    <tr>
                                        <td scope="row">PHP Max Post Size</td>
                                        <td class="description"><?php echo esc_html($php_info['post_max_size']) ?></td>
                                        <td class="icon-status"><i class="d-block <?php echo (intval($php_info['post_max_size']) >= 40) ?  esc_attr('valid-color far fa-circle-check') : esc_attr('invalid-color far fa-circle-xmark')  ?>"></i></td>
                                    </tr>
                                    <tr>
                                        <td scope="row">GD Installed</td>
                                        <td class="description"><?php echo extension_loaded('gd') ? esc_html('Yes') : esc_html('No') ?></td>
                                        <td class="icon-status"><i class="d-block <?php echo (extension_loaded('gd')) ?  esc_attr('valid-color far fa-circle-check') : esc_attr('invalid-color far fa-circle-xmark')  ?>"></i></td>
                                    </tr>
                                    <tr>
                                        <td scope="row">ZIP Installed</td>
                                        <td class="description"><?php echo extension_loaded('zip') ? esc_html('Yes') : esc_html('No') ?></td>
                                        <td class="icon-status"><i class="d-block <?php echo (extension_loaded('zip')) ?  esc_attr('valid-color far fa-circle-check') : esc_attr('invalid-color far fa-circle-xmark')  ?>"></i></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="rounded rtm-border bg-gradient-1">
                        <div class="rtm-border-bottom p-3">
                            <h5 class="text-white m-0 fw-light">WordPress Status</h5>
                        </div>
                        <div class="p-3">
                            <table class="rtm-table table-system fw-light">
                                <tbody>
                                    <tr>
                                        <td scope="row">Site URL</td>
                                        <td class="description" colspan="2"><?php echo esc_html($wp_info['Site_url']) ?></td>
                                    </tr>
                                    <tr>
                                        <td scope="row">Language</td>
                                        <td class="description" colspan="2"><?php echo esc_html($wp_info['WordPress_language']) ?></td>
                                    </tr>
                                    <tr>
                                        <td scope="row">Time Zone</td>
                                        <td class="description" colspan="2"><?php echo esc_html($wp_info['Time_zone']) ?></td>
                                    </tr>
                                    <tr>
                                        <td scope="row">WP Multisite</td>
                                        <td class="description" colspan="2"><?php echo esc_html($wp_info['WP_multisite']) ?></td>
                                    </tr>
                                    <tr>
                                        <td scope="row">WordPress Version</td>
                                        <td class="description"><?php echo esc_html($wp_info['WordPress_version']) ?></td>
                                        <td class="icon-status"><i class="d-block <?php echo (version_compare($wp_info['WordPress_version'], '6.0.0') != -1) ? esc_attr('valid-color far fa-circle-check') : esc_attr('invalid-color far fa-circle-xmark') ?>"></i></td>
                                    </tr>
                                    <tr>
                                        <td scope="row">Memory Limit</td>
                                        <td><?php echo esc_html(WP_MEMORY_LIMIT) ?></td>
                                        <td class="icon-status"><i class="d-block <?php echo ((intval(WP_MEMORY_LIMIT)) >= 256) ?  esc_attr('valid-color far fa-circle-check') : esc_attr('invalid-color far fa-circle-xmark')  ?>"></i></td>
                                    </tr>
                                    <tr>
                                        <td scope="row">Max Memory Limit</td>
                                        <td class="description"><?php echo esc_html($php_info['PHP_memory_limit']) ?></td>
                                        <td class="icon-status"><i class="d-block <?php echo (intval($php_info['PHP_memory_limit']) >= 256) ?  esc_attr('valid-color far fa-circle-check') : esc_attr('invalid-color far fa-circle-xmark')  ?>"></i></td>
                                    </tr>
                                    <tr>
                                        <td scope="row">Max Upload Size</td>
                                        <td><?php echo esc_html(size_format($wp_info['Max_upload_size'])) ?></td>
                                        <td class="icon-status"><i class="d-block <?php echo (($wp_info['Max_upload_size'] / (1024 * 1024)) >= 40) ?  esc_attr('valid-color far fa-circle-check') : esc_attr('invalid-color far fa-circle-xmark')  ?>"></i></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="rounded rtm-border bg-gradient-1">
                        <div class="rtm-border-bottom p-3">
                            <h5 class="text-white m-0 fw-light">Theme</h5>
                        </div>
                        <div class="p-3">
                            <table class="rtm-table table-system fw-light">
                                <tbody>
                                    <tr>
                                        <td scope="row">Name</td>
                                        <td class="description"><?php echo esc_html($theme_name) ?></td>
                                    </tr>
                                    <tr>
                                        <td scope="row">Version</td>
                                        <td class="description"><?php echo esc_html($theme_version) ?></td>
                                    </tr>
                                    <tr>
                                        <td scope="row">Author</td>
                                        <td class="description"><?php echo esc_html($theme_author) ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="rounded rtm-border bg-gradient-1">
                        <div class="rtm-border-bottom p-3">
                            <h5 class="text-white m-0 fw-light">Active Plugin</h5>
                        </div>
                        <div class="p-3">
                            <table class="rtm-table table-system fw-light">
                                <tbody>
                                    <?php foreach ($active_plugins as $plugin) :
                                        $plugin_data = get_plugin_data(WP_PLUGIN_DIR . '/' . $plugin);
                                        $plugin_name = $plugin_data['Name'];
                                        $plugin_version = $plugin_data['Version'];
                                        $plugin_author = $plugin_data['Author'];
                                    ?>
                                        <tr>
                                            <td scope="row"><?php echo esc_html($plugin_name) ?> - <?php echo esc_html($plugin_version) ?></td>
                                            <td class="description"> By <?php echo wp_kses_post($plugin_author) ?></td>

                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col col-xl-5">
                <div class="d-flex flex-column gap-3">
                    <div class="p-5 d-flex flex-column gap-3 rounded-3 text-white rtm-text-font rtm-bg-gradient-1">
                        <?php if (class_exists('RomethemePro\RproLicense')) : if(RomethemePro\RproLicense::get_subs_status() == 'active') : ?>
                            <h4>Now you are using license <?php echo esc_html(\RomethemePro\RproLicense::get_product_name()) ?></h4>
                            <div class="rtm-divider"></div>
                            <div class="spacer-2"></div>
                        <?php endif; endif; ?>
                            <h4>Upgrade Now !</h4>
                            <p class="text">Unlock more features and a longer usage period and can be used on unlimited websites.</p>
                            <div>
                                <a href="https://rometheme.net/pricing/" target="_blank" class="btn btn-gradient-accent rounded-pill">Upgrade Now</a>
                            </div>
                    </div>
                    <div class="p-5 d-flex flex-column gap-3 rounded-3 text-white rtm-text-font rtm-bg-gradient-1">
                        <h4>Let’s Connected with Us !</h4>
                        <p>Get information about updates, tips & tricks, New Offers, from our various social channels</p>
                        <div class="rtm-divider rounded-pill" style="width: 80%;"></div>
                        <div class="d-flex flex-column gap-2">
                            <h4>Social Media Channel</h4>
                            <ul class="rtm-social-container p-0 gap-2">
                                <li><a href="https://www.instagram.com/rometheme/" target="_blank" class="social-item rounded-2"><i class="fa-brands fa-instagram"></i></a></li>
                                <li><a href="https://twitter.com/rometheme" target="_blank" class="social-item rounded-2"><i class="fa-brands fa-x-twitter"></i></a></li>
                                <li><a href="https://www.youtube.com/channel/UCB1RCmPjzvFyWNN28rtwheQ" target="_blank" class="social-item rounded-2"><i class="fa-brands fa-youtube"></i></a></li>
                                <li><a href="https://dribbble.com/rometheme" target="_blank" class="social-item rounded-2"><i class="fa-brands fa-dribbble"></i></a></li>
                                <li><a href="https://www.behance.net/Rometheme" target="_blank" class="social-item rounded-2"><i class="fa-brands fa-behance"></i></a></li>
                            </ul>
                        </div>
                        <div class="d-flex flex-column gap-2">
                            <h4>Join the Community</h4>
                            <a href="https://www.facebook.com/groups/1039541754019284" target="_blank" class="d-flex flex-row align-items-center gap-3 social-link">
                                <div class="social-item rounded-2">
                                    <i class="fa-brands fa-facebook-f"></i>
                                </div>
                                <span>Rometheme Community</span>
                            </a>
                        </div>
                        <div class="d-flex flex-column gap-2">
                            <h4>Premium Support</h4>
                            <a href="mailto:cs.rometheme@gmail.com" class="d-flex flex-row align-items-center gap-3 social-link">
                                <div class="social-item rounded-2">
                                    <i class="fa-solid fa-envelope"></i>
                                </div>
                                <span>cs.rometheme@gmail.com</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>