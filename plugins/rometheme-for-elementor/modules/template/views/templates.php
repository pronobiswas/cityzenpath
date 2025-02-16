<div class="spacer-2"></div>
<?php
require RomeTheme::plugin_dir() . 'view/header.php';
?>

<?php
if (isset($_GET['template_id'])) {
    require_once RomeTheme::module_dir() . 'template/views/installed_template.php';
} else {
    require_once RomeTheme::module_dir() . 'template/views/template_list.php';
}
?>