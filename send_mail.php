<?php
// send_mail.php

session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader for PHPMailer
require 'vendor/autoload.php';

// Include the secure credentials file
require_once __DIR__ . '/config/email_credentials.php';

// Check if the form was submitted via POST
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: contact.php");
    exit;
}

$errors = [];

// --- 1. Sanitize and Validate Input ---
$name = trim($_POST["name"] ?? '');
$email = trim($_POST["email"] ?? '');
$message = trim($_POST["message"] ?? '');

if (empty($name)) {
    $errors[] = "Ime i prezime je obavezno.";
}

if (empty($email)) {
    $errors[] = "Email adresa je obavezna.";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Email adresa nije validna.";
}

if (empty($message)) {
    $errors[] = "Poruka je obavezna.";
}

// --- 2. Process form if no errors ---
if (empty($errors)) {
    $mail = new PHPMailer(true); // Enable exceptions

    try {
        // Server settings from your credentials file
        $mail->isSMTP();
        $mail->Host       = SMTP_HOST;
        $mail->SMTPAuth   = true;
        $mail->Username   = SMTP_USERNAME;
        $mail->Password   = SMTP_PASSWORD;
        $mail->SMTPSecure = false;
        $mail->Port       = SMTP_PORT;
        $mail->CharSet    = 'UTF-8';  

        // Recipients
        $mail->setFrom(SMTP_USERNAME, 'TIMBOX Kontakt Forma'); // Use your authenticated SMTP email
        $mail->addAddress(SMTP_USERNAME, 'TIMBOX - Nenad'); // The site owner's email
        $mail->addReplyTo($email, $name); // Set the sender's email as the reply-to address

        // Content
        $mail->isHTML(true);
        $mail->Subject = "Nova poruka sa kontakt forme od: " . $name;
        $mail->Body    = "
            <p>Primili ste novu poruku sa veb-sajta:</p>
            <ul>
                <li><strong>Ime i prezime:</strong> " . htmlspecialchars($name) . "</li>
                <li><strong>Email adresa:</strong> " . htmlspecialchars($email) . "</li>
                <li><strong>Poruka:</strong> " . nl2br(htmlspecialchars($message)) . "</li>
            </ul>
        ";
        $mail->AltBody = "Primili ste novu poruku sa veb-sajta:\n\n" .
                         "Ime i prezime: " . htmlspecialchars($name) . "\n" .
                         "Email adresa: " . htmlspecialchars($email) . "\n" .
                         "Poruka: " . htmlspecialchars($message);

        $mail->send();
        
        // Success: Redirect back to contact page with a success message
        $_SESSION['success_message'] = "Vaša poruka je uspešno poslata!";
        header("Location: contact.php");
        exit;

    } catch (Exception $e) {
        // Log the error for debugging
        error_log("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
        
        // Error: Redirect back to contact page with an error message
        $_SESSION['errors'] = ["Došlo je do greške prilikom slanja poruke. Molimo pokušajte ponovo."];
        header("Location: contact.php");
        exit;
    }
} else {
    // Validation errors: Redirect back to contact page with errors
    $_SESSION['errors'] = $errors;
    header("Location: contact.php");
    exit;
}




