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

<main class="page-content content-wrap">
    <div class="page-sidebar sidebar">
        <div class="page-sidebar-inner slimscroll">
            <ul class="menu accordion-menu">
                <li class="<?php echo (is_page('user-dashboard') ? 'active' : ''); ?>">
                    <a href="<?php echo home_url('/user-dashboard'); ?>" class="waves-effect waves-button">
                        <span class="menu-icon icon-user"></span>
                        <p>Profile</p>
                        <span class="active-page"></span>
                    </a>
                </li>
                <li class="droplink">
                    
                    <a href="#" class="waves-effect waves-button">
                        <span class="menu-icon icon-pencil"></span>
                        <p>Forms</p><span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li><a href="<?php echo home_url('/form-elements'); ?>">Form Elements</a></li>
                        <li><a href="<?php echo home_url('/form-wizard'); ?>">Form Wizard</a></li>
                    </ul>
                </li>
                <li>
                    <a href="<?php echo esc_url($logout_url); ?>" class="waves-effect waves-button">
                        <span class="menu-icon icon-logout"></span>
                        <p>Logout</p>
                    </a>
                </li>
            </ul> 
        </div><!-- Page Sidebar Inner -->
    </div><!-- Page Sidebar -->
    <div class="page-inner">
        <div class="page-title">
            <div class="page-breadcrumb">
                <ol class="breadcrumb">
                    <li><a href="<?php echo home_url('/user-dashboard'); ?>">Home</a></li>
                    <li class="active">Profile</li>
                </ol>
            </div>
        </div>
        <div id="main-wrapper">
