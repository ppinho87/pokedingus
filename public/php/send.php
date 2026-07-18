<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/PHPMailer/Exception.php';
require __DIR__ . '/PHPMailer/PHPMailer.php';
require __DIR__ . '/PHPMailer/SMTP.php';

require_once __DIR__ . '/load_env.php';

$name = isset($_POST['name']) ? trim($_POST['name']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
$message = isset($_POST['message']) ? trim($_POST['message']) : '';
$company = isset($_POST['company']) ? trim($_POST['company']) : '';

if ($name === '' && $email === '' && $message === '') {
    http_response_code(400);
    echo "Missing required fields.";
    exit;
}

// Load SMTP config from environment variables (set these on your server) or edit below
$smtpHost = getenv('SMTP_HOST') ?: 'smtp.example.com';
$smtpUser = getenv('SMTP_USER') ?: 'your_smtp_username';
$smtpPass = getenv('SMTP_PASS') ?: 'your_smtp_password';
$smtpPort = getenv('SMTP_PORT') ?: 587;
$smtpSecure = getenv('SMTP_SECURE') ?: 'tls'; // 'ssl' or 'tls' or empty

$mail = new PHPMailer(true);
try {
    // Server settings
    $mail->isSMTP();
    $mail->Host = $smtpHost;
    $mail->SMTPAuth = true;
    $mail->Username = $smtpUser;
    $mail->Password = $smtpPass;
    if (strtolower($smtpSecure) === 'ssl') {
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    } elseif (strtolower($smtpSecure) === 'tls') {
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    }
    $mail->Port = (int)$smtpPort;

    // Recipients
    $fromEmail = filter_var($email, FILTER_VALIDATE_EMAIL) ? $email : ('noreply@' . ($_SERVER['HTTP_HOST'] ?? 'pokedingus.com'));
    $mail->setFrom($fromEmail, $name ?: 'Pokedingus Contact');
    $mail->addAddress('paulpinho87@gmail.com', 'Pokedingus Owner');
    if ($email && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $mail->addReplyTo($email, $name);
    }

    // Content
    $mail->isHTML(false);
    $mail->Subject = 'Contact Form Message from Pokedingus';

    $body = "From: " . $name . "\n";
    if ($phone) { $body .= "Phone: " . $phone . "\n"; }
    if ($company) { $body .= "Company: " . $company . "\n"; }
    if ($email) { $body .= "Sender Email: " . $email . "\n"; }
    $body .= "\nMessage:\n" . $message . "\n";

    $mail->Body = $body;

    $mail->send();
    echo "Thank you — your message has been sent.";
} catch (Exception $e) {
    http_response_code(500);
    echo "Message could not be sent. Mailer Error: " . htmlspecialchars($mail->ErrorInfo);
}
?>