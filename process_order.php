<?php
session_start();

// Include the PHPMailer classes from Composer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Path to Composer's autoload file

require_once __DIR__ . '/config/email_credentials.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: cenovnik.php");
    exit;
}

$cart = $_SESSION['cart'] ?? [];

if (empty($cart)) {
    echo "<p>Korpa je prazna. <a href='cenovnik.php'>Nazad</a></p>";
    exit;
}

$name = htmlspecialchars(trim($_POST['name']));
$email = htmlspecialchars(trim($_POST['email']));
$phone = htmlspecialchars(trim($_POST['phone']));
$address = htmlspecialchars(trim($_POST['address']));

// Sastavi tekst porudžbine
$total = 0;
$message = "Nova porudžbina sa sajta Nenagraf\n\n";
$message .= "Ime: $name\nEmail: $email\nTelefon: $phone\nAdresa: $address\n\n";
$message .= "Stavke:\n";

foreach ($cart as $item) {
    $lineTotal = $item['price'] * $item['quantity'];
    $total += $lineTotal;
    $message .= "- {$item['name']} ({$item['variant']}) x {$item['quantity']} kom @ " . number_format($item['price'],2,',','') . " RSD = " . number_format($lineTotal,2,',','') . " RSD\n";
}

$message .= "\nUkupno: " . number_format($total,2,',','') . " RSD\n";
$mail = new PHPMailer(true);
// POSALJI MEJL
try {
    // SMTP server configuration
    $mail->isSMTP();                                    // Send using SMTP
    $mail->Host       = SMTP_HOST;             // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                           // Enable SMTP authentication
    $mail->Username   = SMTP_USERNAME;       // SMTP username
    $mail->Password   = SMTP_PASSWORD;   // SMTP password
    $mail->SMTPSecure = false; // Enable explicit TLS encryption
    $mail->Port       = SMTP_PORT;                            // TCP port to connect to; use 465 for SMTPS

    // Sender and recipient settings
    $mail->setFrom('noreply@nenagraf.local', 'Nenagraf'); // From address
    $mail->addAddress('nenadtimbox@gmail.com');          // Recipient address
    $mail->addReplyTo($email, $name);                   // Set reply-to address

    // Email content
    $mail->isHTML(false);                               // Set email format to plain text
    $mail->Subject = "Porudžbina - Nenagraf";
    $mail->Body    = $message;

    $mail->send();
    $sent = true;
} catch (Exception $e) {
    $sent = false;
}
// Očisti korpu
$_SESSION['cart'] = [];

// Prikaz poruke korisniku
if ($sent) {
    echo "<h2>Hvala! Porudžbina je poslata.</h2>";
    echo "<p>Poslaćemo vam potvrdu na: " . htmlspecialchars($email) . "</p>";
} else {
    // Ako lokalno ne može da pošalje mail, prikaži porudžbinu i savet
    echo "<h2>Porudžbina je zabeležena, ali mejl nije mogao da se pošalje lokalno.</h2>";
    echo "<pre>" . nl2br(htmlspecialchars($message)) . "</pre>";
    echo "<p>Na produkciji (hosting) mejl će biti poslat automatski. Ako želiš test slanje lokalno, koristi Mailpit ili podesi SMTP sa PHPMailer-om.</p>";
}

echo "<p><a href='cenovnik.php'>Nazad na cenovnik</a></p>";
?>
