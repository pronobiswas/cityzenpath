<?php 
// Ensure user is logged in, otherwise redirect
if (!is_user_logged_in()) {
    wp_redirect(home_url());
    exit;
}
?>
        </div>
    </div>
</main>
<?php wp_footer(); ?> 
</body>
</html>