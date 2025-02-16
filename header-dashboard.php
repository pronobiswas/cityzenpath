<?php 
// Ensure user is logged in, otherwise redirect
if (!is_user_logged_in()) {
    wp_redirect(home_url());
    exit;
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class('compact-menu'); ?>>
           
