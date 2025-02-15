<?php
$page = $_GET['page'];
?>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

    .divider {
        position: relative;
        background-color: #00cea6;
        height: 35px;
        width: 2px;
    }

    body {
        background-color: #f0f0f1;
    }

    .spacer {
        width: 100%;
        height: 8rem;
    }

    p.text {
        color: #aeaeae;
    }

    ul.list {
        margin: 0;
        padding: 0;
    }
</style>

<div id="header-dashboard" class="rtm-container header-sticky px-5 me-3">
    <div class="d-flex flex-row gap-5 align-items-center rtm-text-font my-3 m-0 glass-effect px-4 py-3 rounded-3">
        <div class="d-flex flex-row align-items-center gap-2">
            <img src="<?php echo esc_attr(\RomeTheme::plugin_url() . 'view/images/rtmkit-logo-white.png') ?>" alt="rtm-logo" width="200">
            <span class="rtm-version">v.<?php echo esc_html(\RomeTheme::rt_version()) ?></span>
        </div>
        <ul class="nav nav-underline">
            <li class="nav-item m-0">
                <a href="<?php echo esc_url(admin_url('admin.php?page=romethemekit')) ?>" class="nav-link <?php echo ($page == 'romethemekit') ? esc_attr('active') : '' ?>">Welcome</a>
            </li>
            <li class="nav-item m-0">
                <a href="<?php echo esc_url(admin_url('admin.php?page=rkit-widgets')) ?>" class="nav-link <?php echo ($page == 'rkit-widgets') ? esc_attr('active') : '' ?>">Widgets</a>
            </li>
            <li class="nav-item m-0">
                <a href="<?php echo esc_url(admin_url('admin.php?page=themebuilder')) ?>" class="nav-link <?php echo ($page == 'themebuilder') ? esc_attr('active') : '' ?>">Theme Builder</a>
            </li>
            <li class="nav-item m-0">
                <a href="<?php echo esc_url(admin_url('admin.php?page=rtmkit-templates')) ?>" class="nav-link <?php echo ($page == 'rtmkit-templates') ? esc_attr('active') : '' ?>">Templates</a>
            </li>
            <li class="nav-item m-0">
                <a href="<?php echo esc_url(admin_url('admin.php?page=rkit-system-status')) ?>" class="nav-link <?php echo ($page == 'rkit-system-status') ? esc_attr('active') : '' ?>">System Status</a>
            </li>
            <li class="nav-item m-0">
                <a href="<?php echo esc_url(admin_url('admin.php?page=rtm-settings')) ?>" class="nav-link <?php echo ($page == 'rtm-settings') ? esc_attr('active') : '' ?>">Settings</a>
            </li>
            <!-- <li class="nav-item m-0">
            <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Go Pro</button>
        </li> -->
        </ul>
    </div>
</div>