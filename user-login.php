<?php
/* Template Name: User Login */
ob_start();
get_template_part('template-parts/login/header', 'login');

if (is_user_logged_in()) {
    wp_safe_redirect(home_url('/dashboard'));
    exit;
}

$error = '';
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['login'])) {
    if (!isset($_POST['_wpnonce']) || !wp_verify_nonce($_POST['_wpnonce'], 'user_login_action')) {
        $error = 'Security check failed. Please try again.';
    } else {
        $credentials = [
            'user_login'    => sanitize_text_field($_POST['username']),
            'user_password' => $_POST['password'],
            'remember'      => isset($_POST['remember']) && $_POST['remember'] === 'on'
        ];

        $user = wp_signon($credentials, false);

        if (is_wp_error($user)) {
            $error = $user->get_error_message();
        } else {
            wp_safe_redirect(home_url('/dashboard'));
            exit;
        }
    }
}
?>

<section class="page-section login-page">
    <div class="full-width-screen">
        <div class="container-fluid">
            <div class="content-detail">
                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger"><?php echo esc_html($error); ?></div>
                <?php endif; ?>

                <form class="login-form" method="post">
                    <?php wp_nonce_field('user_login_action'); ?>
                    
                    <div class="input-control">
                        <div class="row p-l-5 p-r-5">
                            <div class="col-md-12 p-l-10 p-r-10">
                                <input type="text" placeholder="Enter Username or Email" name="username" required>
                            </div>
                            <div class="col-md-12 p-l-10 p-r-10">
                                <input type="password" placeholder="Enter Password" name="password" required>
                            </div>
                        </div>
                        <label class="label-container">Remember me
                            <input type="checkbox" name="remember">
                            <span class="checkmark"></span>
                        </label>
                        <div class="login-btns">
                            <button type="submit" name="login">Login</button>
                        </div>
                        <p><a href="<?php echo esc_url(wp_lostpassword_url()); ?>">Forgot Password?</a></p>
                        <div class="login-with-btns">
                            <span class="already-acc">Not a member? <a href="<?php echo esc_url(get_permalink(get_page_by_path('User Registration'))); ?>" class="signup-btn">Sign up</a></span>
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</section>

<?php get_template_part('template-parts/login/footer', 'login'); ?>
