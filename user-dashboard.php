<?php
/* Template Name: User Dashboard */

if (!is_user_logged_in()) {
    wp_redirect(esc_url(home_url()));
    exit;
}

get_template_part('template-parts/dashboard/header');

$current_user = wp_get_current_user();
?>

<div id="main-wrapper">
    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-white">
                <div class="panel-heading">
                    <div class="panel-title">User Profile</div>
                </div>
                <div class="panel-body">
                    <h4 class="m-t-lg"><?php echo esc_html($current_user->display_name); ?></h4>
                    <ul class="list-unstyled m-0">
                        <li><p><i class="icon-envelope-open m-r-xs"></i><a href="#"><?php echo esc_html($current_user->user_email); ?></a></p></li>
                    </ul>
                </div>
                
            </div>
        </div>
        <div class="col-md-3">
            <form method="post" action="">
                <?php wp_nonce_field('user_dashboard_action'); ?>
                <input type="text" name="user_name" placeholder="Enter Your Name" required>
                <input type="email" name="user_email" placeholder="Enter Your Email" required>
                <input type="hidden" name="user_dashboard_form" value="1">
                <button type="submit">Update Profile</button>
            </form>
            <?php if (isset($_GET['updated']) && $_GET['updated'] == 'true') : ?>
                <p style="color: green;">Profile updated successfully!</p>
            <?php endif; ?>

        </div>
    </div>
</div>

<?php get_template_part('template-parts/login/footer', 'login'); ?>
