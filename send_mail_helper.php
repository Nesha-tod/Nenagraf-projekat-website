<?php
// send_mail_helper.php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader for PHPMailer
require 'vendor/autoload.php';

// Include the secure credentials file, which is located one directory level up
// This path will need to be adjusted for the live server
require_once __DIR__ . '/config/email_credentials.php';

/**
 * Sends an email using PHPMailer with SMTP authentication.
 *
 * @param string $to_email The recipient's email address.
 * @param string $to_name The recipient's name.
 * @param string $subject The email subject.
 * @param string $body The email body in HTML format.
 * @param string $from_email The sender's email address.
 * @param string $from_name The sender's name.
 * @return bool True on success, false on failure.
 */
function send_email($to_email, $to_name, $subject, $body, $from_email = '', $from_name = '') {
    $mail = new PHPMailer(true); // Enable exceptions

    try {
        // Server settings
        $mail->isSMTP(); // Use SMTP
        $mail->Host       = SMTP_HOST;
        $mail->SMTPAuth   = true;
        $mail->Username   = SMTP_USERNAME;
        $mail->Password   = SMTP_PASSWORD;
        $mail->SMTPSecure = false;
        $mail->Port       =  SMTP_PORT;

        // Use the sender email specified in the function call, or fall back to the authenticated user
        $sender_email = !empty($from_email) ? $from_email : SMTP_USERNAME;
        $sender_name = !empty($from_name) ? $from_name : 'Contact Form';
        
        // Recipients
        $mail->setFrom($sender_email, $sender_name);
        $mail->addAddress($to_email, $to_name);
        
        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $body;
        $mail->AltBody = strip_tags($body); // Plain text for non-HTML clients

        $mail->send();
        return true;
    } catch (Exception $e) {
        error_log("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
        return false;
    }
}
