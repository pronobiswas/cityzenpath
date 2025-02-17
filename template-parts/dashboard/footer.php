<?php 
// Ensure user is logged in, otherwise redirect
if (!is_user_logged_in()) {
    wp_redirect(home_url());
    exit;
}
get_footer('dashboard');

?>
<script>
        $(document).ready(function() {
            $(".droplink > a").click(function(e) {
                e.preventDefault(); // Prevent default link behavior
                $(this).siblings(".sub-menu").slideToggle();
            });
        });
    </script>