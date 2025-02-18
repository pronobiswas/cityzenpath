<?php
$page_type = isset($_GET['bd']) && $_GET['bd'] != "" ? $_GET['bd'] : "user-dashboard";

if ($page_type == "forms") {
    get_template_part('template-parts/dashboard/layouts/forms');
} elseif ($page_type == "user-dashboard") {
    get_template_part('template-parts/dashboard/layouts/dashboard');
} elseif ($page_type == "resumeform") {
    get_template_part('template-parts/dashboard/layouts/resumeform');
} elseif ($page_type == "newform") {
    get_template_part('template-parts/dashboard/layouts/newform');
} else {
    get_template_part('template-parts/dashboard/layouts/dashboard');
}
?>





