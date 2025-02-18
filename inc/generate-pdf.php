<?php
require_once dirname(__DIR__, 2) . '/wp-load.php';
require_once get_stylesheet_directory() . '/tcpdf/tcpdf.php';

if (!is_user_logged_in()) {
    wp_die('Unauthorized access');
}

$user_id = get_current_user_id();
$name = get_user_meta($user_id, 'multi_step_name', true);
$email = get_user_meta($user_id, 'multi_step_email', true);
$address = get_user_meta($user_id, 'multi_step_address', true);
$nid = get_user_meta($user_id, 'multi_step_nid', true);
$passport = get_user_meta($user_id, 'multi_step_passport', true);

$pdf = new TCPDF();
$pdf->AddPage();
$html = "<h2>User Information</h2>
<p><strong>Name:</strong> $name</p>
<p><strong>Email:</strong> $email</p>
<p><strong>Address:</strong> $address</p>
<p><strong>NID:</strong> $nid</p>
<p><strong>Passport:</strong> $passport</p>";

$pdf->writeHTML($html);
$pdf->Output('user-details.pdf', 'D');
exit;







error_reporting(E_ALL);
ini_set('display_errors', 1);


if (!is_user_logged_in()) {
    wp_die('Unauthorized access');
}

$user_id = get_current_user_id();
$name = get_user_meta($user_id, 'multi_step_name', true);
$email = get_user_meta($user_id, 'multi_step_email', true);
$address = get_user_meta($user_id, 'multi_step_address', true);
$nid = get_user_meta($user_id, 'multi_step_nid', true);
$passport = get_user_meta($user_id, 'multi_step_passport', true);

// Check if TCPDF class is loaded
if (!class_exists('TCPDF')) {
    die('TCPDF library not found.');
}

$pdf = new TCPDF();
$pdf->AddPage();
$html = "<h2>User Information</h2>
<p><strong>Name:</strong> $name</p>
<p><strong>Email:</strong> $email</p>
<p><strong>Address:</strong> $address</p>
<p><strong>NID:</strong> $nid</p>
<p><strong>Passport:</strong> $passport</p>";

$pdf->writeHTML($html);
$pdf->Output('user-details.pdf', 'D');
exit;
