<?php
if (is_user_logged_in()) {
    $current_user = wp_get_current_user();
    ?>
    <div class="container">
        <div class="row">
            <div class="col-xl-8 col-lg-12 col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Profile Details</h4>            
                        <form id="employer_form">
                            <div class="form-row">
                                <!-- Username Field -->
                                <div class="form-group col-md-6">
                                    <label>Username</label>
                                    <input type="text" class="form-control" name="name" value="<?php echo esc_attr($current_user->user_login); ?>" required>
                                    <p> Be careful while changing your username.</p>
                                </div>

                                <!-- Email Address Field -->
                                <div class="form-group col-md-6">
                                    <label>Email Address</label>
                                    <input type="email" class="form-control" name="email" disabled value="<?php echo esc_attr($current_user->user_email); ?>">
                                    <p> You cannot change your email address.</p>
                                </div>      
                            </div>
           
                        </form>
                    </div>        
                </div>
            </div>
        </div>
    </div>
    <?php
} else {
    echo '<p>You need to log in to edit your profile.</p>';
}
?>
