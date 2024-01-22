<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Include PHPMailer library

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Common fields
    $fullName = $_POST["fullName"];
    $email = $_POST["email"];

    // Form 1 fields
    $name = isset($_POST["name"]) ? $_POST["name"] : "";
    $subject = isset($_POST["subject"]) ? $_POST["subject"] : "";
    $message = isset($_POST["message"]) ? $_POST["message"] : "";

    // Form 2 fields
    $company = isset($_POST["company"]) ? $_POST["company"] : "";
    $phoneCode = isset($_POST["phoneCode"]) ? $_POST["phoneCode"] : "";
    $phone = isset($_POST["phone"]) ? $_POST["phone"] : "";
    $budget = isset($_POST["budget"]) ? $_POST["budget"] : "";
    $projectDescription = isset($_POST["projectDescription"]) ? $_POST["projectDescription"] : "";

    // Set your Gmail email address where you want to receive emails
    $to = "kdcsleads@gmail.com";

    // Include PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->SMTPDebug = 0; // Set to 2 for debugging
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'kdcsleads@gmail.com'; // Your Gmail email
        $mail->Password = 'Alpharock@654321'; // Your Gmail app password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Recipients
        $mail->setFrom($email, $fullName);
        $mail->addAddress($to);

        // Content
        $mail->isHTML(true);

        // Form 1 content
        if (!empty($name)) {
            $mail->Subject = $subject;
            $mail->Body = "Name: $name<br>Email: $email<br>Message: $message";
        }

        // Form 2 content
        if (!empty($company)) {
            $mail->Subject = "New Quote Request";
            $mail->Body = "Full Name: $fullName<br>Email: $email<br>Company: $company<br>Phone: +$phoneCode $phone<br>Budget: $$budget<br>Project Description: $projectDescription";
        }

        $mail->send();
        echo "success";
    } catch (Exception $e) {
        echo "error";
    }
} else {
    echo "error";
}
?>
