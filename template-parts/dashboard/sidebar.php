<?php 
// Ensure user is logged in, otherwise redirect
if (!is_user_logged_in()) {
    wp_redirect(home_url());
    exit;
}

    $logout_url = wp_logout_url(home_url()); // Logout and redirect to homepage
?>
<div class="page-sidebar sidebar">
    <div class="page-sidebar-inner slimscroll">
        <ul class="menu accordion-menu">
            <li class="<?php echo (is_page('user-dashboard') && !isset($_GET['bd'])) ? 'active' : ''; ?>">
                <a href="<?php echo get_the_permalink();?>" class="waves-effect waves-button"><span class="menu-icon icon-user"></span><p>Profile</p><span class="active-page"></span></a>
            </li>
            <li class="<?php echo (isset($_GET['bd']) && $_GET['bd'] == 'forms') ? 'active' : ''; ?>">
                <a href="<?php echo esc_url(get_the_permalink());?>?bd=forms" class="waves-effect waves-button"><span class="menu-icon icon-pencil"></span><p>Forms</p><span class="active-page"></span></a>
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