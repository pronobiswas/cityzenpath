<?php 
// Ensure user is logged in, otherwise redirect
if (!is_user_logged_in()) {
    wp_redirect(home_url());
    exit;
}

get_header('dashboard');

$current_user = wp_get_current_user();
$logout_url = wp_logout_url(home_url()); // Logout and redirect to homepage
?>

<div class="page-title">
    <div class="page-breadcrumb">
        <a href="<?php echo get_the_permalink();?>" class="text-decoration-none">
            <i class="icon-user"></i>
            <?php echo esc_html($current_user->display_name); ?>
        </a>
    </div>
</div>