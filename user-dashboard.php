<?php
/* Template Name: User Dashboard */

if (!is_user_logged_in()) {
    wp_redirect(esc_url(home_url()));
    exit;
}

get_template_part('template-parts/dashboard/header');
get_template_part( 'template-parts/dashboard/redirection' ); 
$current_user = wp_get_current_user();
?>
<style>
    form select.form-select, form .form-control {
    background-color: transparent !important;
}
</style>
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
        <div class="col-md-12">
            <div class="panel panel-white">
                <div class="panel-heading clearfix">
                    <h4 class="panel-title">Form Elements</h4>
                </div>
                <div class="panel-body">
                    <!-- <form class="form-horizontal">
                        <div class="form-group">
                            <label for="input-help-block" class="col-sm-2 control-label">Help Block</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="input-help-block">
                                <p class="help-block">Example block-level help text here.</p>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="input-help-block" class="col-sm-2 control-label">Help Block</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="input-help-block">
                                <p class="help-block">Example block-level help text here.</p>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="input-help-block" class="col-sm-2 control-label">Help Block</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="input-help-block">
                                <p class="help-block">Example block-level help text here.</p>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="input-help-block" class="col-sm-2 control-label">Help Block</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="input-help-block">
                                <p class="help-block">Example block-level help text here.</p>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="input-help-block" class="col-sm-2 control-label">Help Block</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="input-help-block">
                                <p class="help-block">Example block-level help text here.</p>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="input-help-block" class="col-sm-2 control-label">Help Block</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="input-help-block">
                                <p class="help-block">Example block-level help text here.</p>
                            </div>
                        </div>
                        
                                                
                        
                                             
                        
                        
                    </form> -->
                    <?php 
                        function display_user_form_status() {
                            if (!is_user_logged_in()) {
                                return '<p>You must be logged in.</p>';
                            }
                        
                            $user_id = get_current_user_id();
                            $form_status = get_user_meta($user_id, 'multi_step_form_status', true);
                        
                            if (!$form_status) {
                                echo '<button id="startNewForm">Start a New Form</button>';
                            } elseif ($form_status == 'incomplete') {
                                echo '<p style="color: red;">Incomplete Form</p>';
                            } elseif ($form_status == 'completed') {
                                echo '<p style="color: green;">Form Completed</p>';
                            }
                        
                            echo '<script>
                                document.getElementById("startNewForm")?.addEventListener("click", function() {
                                    window.location.href = "/form-page-url";
                                });
                            </script>';
                        }
                        
                        add_shortcode('user_form_status', 'display_user_form_status');
                        
                    ?>
                    <?php echo do_shortcode( '[multistep_form]' ); ?>
                    <div class="mt-2">
                    <?php echo do_shortcode( '[form_status]' ); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_template_part('template-parts/login/footer', 'login'); ?>
