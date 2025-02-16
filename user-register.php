<?php
/* Template Name: Registration */
ob_start();
get_template_part('template-parts/login/header', 'login');

if (is_user_logged_in()) {
    wp_safe_redirect(home_url('/dashboard'));
    exit;
}

// Handle form submission
$error = '';
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    if (!isset($_POST['_wpnonce']) || !wp_verify_nonce($_POST['_wpnonce'], 'user_registration')) {
        $error = "Invalid form submission.";
    } else {
        $username = sanitize_user($_POST['username']);
        $email = sanitize_email($_POST['email']);
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        if (username_exists($username) || email_exists($email)) {
            $error = "Username or email already exists.";
        } elseif ($password !== $confirm_password) {
            $error = "Passwords do not match.";
        } else {
            // Create the user
            $user_id = wp_create_user($username, $password, $email);
            
            if (!is_wp_error($user_id)) {
                
                wp_update_user(array('ID' => $user_id, 'role' => 'subscriber'));

                // Check the user role and set redirection URL
                $subscriber_login_page = home_url('/user-login');  
                $default_login_page = home_url('/login');  

                $redirect_url = (user_can($user_id, 'subscriber')) ? $subscriber_login_page : $default_login_page;

                wp_redirect($redirect_url);
                exit;
            } else {
                $error = $user_id->get_error_message();
            }
        }
    }
}
?>

<section class="page-section login-page">
    <div class="full-width-screen">
        <div class="container-fluid">
            <div class="content-detail">
                <!-- Display error messages -->
                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger"><?php echo esc_html($error); ?></div>
                <?php endif; ?>

                <!-- Signup form -->
                <form class="signup-form" method="post">
                    <?php wp_nonce_field('user_registration'); ?>
                    <div class="input-control">
                        <div class="row p-l-5 p-r-5">
                            <div class="col-md-6 p-l-10 p-r-10">
                                <input type="text" placeholder="Enter Username" name="username" required>
                            </div>
                            <div class="col-md-6 p-l-10 p-r-10">
                                <input type="email" placeholder="Enter Email" name="email" required>
                            </div>
                            <div class="col-md-6 p-l-10 p-r-10">
                                <input type="password" placeholder="Enter Password" name="password" class="input-checkmark" required>
                            </div>
                            <div class="col-md-6 p-l-10 p-r-10">
                                <span class="password-field-show">
                                    <input class="password-field input-checkmark" type="password" placeholder="Re-enter Password"
                                        name="confirm_password" required>
                                    <span data-toggle=".password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                </span>
                            </div>
                        </div>
                        <label class="label-container">I agree with <a href="#"> privacy policy</a>
                            <input type="checkbox" required>
                            <span class="checkmark"></span>
                        </label>
                        <div class="login-btns">
                            <button type="submit" name="submit">Sign up</button>
                        </div>
                        <div class="login-with-btns">
                          <span class="already-acc">Already you have an account? <a href="<?php echo esc_url(get_permalink(get_page_by_path('user-login'))); ?>" class="login-btn">Login</a></span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php get_template_part('template-parts/login/footer', 'login'); ?>
