<?php
require_once "recaptchalib.php";

// your secret key
$secret = "SECRETKEY";
 
// empty response
$response = null;
 
// check secret key
$reCaptcha = new ReCaptcha($secret);

// if submitted check response
if ($_POST["g-recaptcha-response"])
{
    $to      = 'akustes@gmail.com';
    $subject = 'Web App Inquiry';
    $message = 'Name: ' . $_POST['name'] . "\r\n" . 'Phone: ' . $_POST['phone'] . "\r\n" . 'Email: ' . $_POST['email'] . "\r\n" . $_POST['message'];
    $headers = 'From:' . $_POST['email'] . "\r\n" .
    'Reply-To:' .  $_POST['email'] . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

    mail($to, $subject, $message, $headers);

    if ($response != null && $response->success) 
    {
       
    }
    else
    {

    }

    header('Content-Type: application/json');
    echo json_encode(array('success' => true));
    exit;
}
else
{
    header('Content-Type: application/json');
    echo json_encode(array('success' => false));
    exit;
}