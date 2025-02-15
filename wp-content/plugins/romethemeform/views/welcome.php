<style>
    #section1>img {
        width: 100%;
        max-width: 1024px;
    }

    body {
        background-color: white;
    }

    #section3>div {
        aspect-ratio: 1/1;
        background-color: #f8f8f8;
    }

    #section3 {
        max-width: 1024px;
        width: 100%;
        aspect-ratio: 11/4;
    }


    .rkit-container {
        max-width: 1024px;
        width: 100%;
        aspect-ratio: 11/4;
        background-color: #f8f8f8;
    }

    .rkit-container-50 {
        aspect-ratio: 1/1;
        background-color: #f8f8f8;
    }

    .fit-contain {
        object-fit: contain;
    }

    .rkit-s2-btn {
        background-color: #ffb901;
        padding-inline: 2rem;
        border-radius: 25px;
    }

    .rkit-s2-btn:hover {
        background-color: #ffb901;
        filter: brightness(95%);
    }

    .rkit-social-btn {
        background-color: #ffb901;
        border-radius: 50%;
        align-items: center;
        aspect-ratio: 1/1;
        padding: .5rem;
    }

    .rkit-social-btn:hover {
        background-color: #ffb901;
        filter: brightness(95%);
    }

    .rform {
        font-family: "Space Grotesk", Sans-serif;

    }

    .h6-color {
        color: #4b4b4b;
    }

    .rkit-logo {
        width: 16rem;
    }

    .rkit-welcome-footer {
        width: 100%;
        max-width: 1024px;
        aspect-ratio: 11/2;
        background-color: #f8f8f8
    }
</style>

<div class="mt-3 me-3 container m-0 d-flex flex-column gap-3 font-montserrat p-0">
    <div class="d-flex flex-row p-5" style="background-color: #1f2227;">
        <div class="col mx-0">
            <div class="d-flex flex-column justify-content-center h-100">
                <img src="<?php echo esc_attr(RomeThemeForm::plugin_url() . 'assets/images/rform_icon.png')  ?>" alt="" class="img-fluid p-3" width="300">
                <div class="d-flex flex-column text-white font-montserrat p-3">
                    <h4 class="text-white fw-semibold lh-base">CREATE & CUSTOMIZE FORM OF YOUR SITE WITH EASE</h4>
                    <ul class="list my-3">
                        <li class="d-flex flex-row align-items-center gap-2">
                            - Create New Form in Elementor Builder
                        </li>
                        <li class="d-flex flex-row align-items-center gap-2">
                            - Send Email Notification and Email Confirmation
                        </li>
                        <li class="d-flex flex-row align-items-center gap-2">
                            - Entries View
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col p-3">
            <img src="<?php echo esc_attr(RomeThemeForm::plugin_url() . 'assets/images/romethemeform1a.png')  ?>" alt="" class="img-fluid">
        </div>
    </div>
    <div class="d-flex flex-wrap w-100 m-0 p-0 flex-wrap gap-3">
        <div class="col py-4 px-5" style="background-color: #1f2227;">
            <div class="d-flex flex-column gap-4 text-white">
                <div class="d-flex flex-row gap-4 align-items-center">
                    <i class="rtmicon rtmicon-notes" style="font-size: xx-large;"></i>
                    What's New
                </div>
                <span class="text-gray">What’s new in RomethemeForm v.<?php echo esc_html(RomeThemeForm::rform_version()) ?></span>
                <div class="d-flex flex-column gap-3 text-gray">
                    <span>We’re trilled to announce RomethemeForm :</span>
                    <ul class="list list-group-numbered">
                        <li class="list-group-item">Introduced a revamped visual interface for the plugin.</li>
                        <li class="list-group-item">Restructured user interface for improved usability and navigation.</li>
                        <li class="list-group-item">Fixed for special character on sending email confirmation and email notification.</li>
                    </ul>
                </div>
                <span class="text-gray">Check out the changes & features we have added with our new updates</span>
                <div>
                    <a href="https://wordpress.org/plugins/romethemeform/#developers" class="btn btn-outline-accent rounded-0 px-5 py-3" target="_blank">View Changelog</a>
                </div>
            </div>
        </div>
        <div class="col text-white">
            <div class="d-flex flex-column gap-3">
                <div class="d-flex flex-column gap-3 py-4 px-5" style="background-color: #1f2227;">
                    <div class="d-flex flex-row gap-4 align-items-center">
                        <i class="rtmicon rtmicon-notes" style="font-size: xx-large;"></i>
                        View Documentation
                    </div>
                    <span class="text-gray">Detailed RomethemeForm user guide</span>
                    <div>
                        <a href="https://rometheme.net/docs" class="link accent-color" target="_blank">View More</a>
                    </div>
                </div>
                <div class="d-flex flex-column gap-3 py-4 px-5" style="background-color: #1f2227;">
                    <div class="d-flex flex-row gap-4 align-items-center">
                        <i class="rtmicon rtmicon-site-logo" style="font-size: xx-large;"></i>
                        Show Your Love
                    </div>
                    <span class="text-gray">Let us know about your experience</span>
                    <div>
                        <a href="https://wordpress.org/support/plugin/romethemeform/reviews/" class="link accent-color" target="_blank">Rate Us</a>
                    </div>
                </div>
                <div class="d-flex flex-column gap-3 py-4 px-5" style="background-color: #1f2227;">
                    <div class="d-flex flex-row gap-4 align-items-center">
                        <i class="rtmicon rtmicon-help" style="font-size: xx-large;"></i>
                        Need Help?
                    </div>
                    <span class="text-gray">Reach out to our support.</span>
                    <div>
                        <a href="https://rometheme.net/contact-us/" class="link accent-color" target="_blank">Submit Ticket</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="d-flex flex-column gap-3">
                <div class="position-relative">
                    <img src="<?php echo esc_attr(RomeThemeForm::plugin_url() . 'assets/images/img-hero-1.jpg') ?>" alt="" class="img-fluid">
                    <div class="position-absolute start-0 top-0 w-100 h-100 d-flex flex-column justify-content-center align-items-center text-center p-5" style="background-color:#33e4c0cc;">
                        <h4 class="font-montserrat fw-semibold">Looking Template Kit ?</h4>
                        <p class="fw-semibold">Over 350 fully customizable, responsive Templates for every part of your Elementor website.</p>
                        <div>
                            <a href="https://rometheme.net/elementor-kits/" class="btn btn-dark rounded-0 px-5 py-3" target="_blank">Buy Now</a>
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-column gap-3 py-4 px-5 text-white" style="background-color: #1f2227;">
                    <div class="d-flex flex-row gap-4 align-items-center">
                        <i class="rtmicon rtmicon-working-hours" style="font-size: xx-large;"></i>
                        Join Commuunity
                    </div>
                    <span class="text-gray">Join Facebook Community</span>
                    <div>
                        <a href="https://www.facebook.com/rometheme" class="link accent-color" target="_blank">Join Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div style="max-width:1024px">
        <div>
            <h1>Create Your Website be Better</h1>
            <h6>We have some plugins you can install to get most from Wordpress.</h6>
        </div>
        <a href="<?php echo esc_url(admin_url('/plugin-install.php?tab=plugin-information&plugin=rometheme-for-elementor&TB_iframe=true&width=600&height=550')) ?>" class="col-4 other-plugin card border-0 pb-4 px-5">
            <div class="d-flex flex-row align-items-center gap-2 mt-3 mb-3">
                <img src="<?php echo esc_attr(\RomeThemeForm::plugin_url() . 'assets/images/RomethemeKit_Pirus.png') ?>" alt="" srcset="" class="rkit-logo">
            </div>
            <span style="font-family:system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;">Addons for Elementor Page Builder. It included Header Footer Builder, and Widget Ready to use.</span>
        </a>
    </div>
</div>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap');

    .font-montserrat {
        font-family: "Montserrat", sans-serif;
        font-style: normal;
    }

    .text-gray {
        color: #b3b3b3;
    }

    .link {
        text-decoration: none;
    }


    .other-plugin {
        background-color: #1f2227;
        text-decoration: none;
        color: #b3b3b3;
        transition: all 0.5s;
        border-radius: 0px;
    }

    .other-plugin:hover {
        color: #b3b3b3;
        transform: translateY(-5px);
        box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
    }

    .btn-outline-accent {
        background-color: transparent;
        border: 1px solid #33e4c0;
        color: #33e4c0;
    }

    .btn-outline-accent:hover {
        background-color: #33e4c0;
        color: black;
    }
</style>