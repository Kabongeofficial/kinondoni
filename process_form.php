<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['name'];
    $senderEmail = $_POST['email']; // Change variable name to avoid conflict
    $subject = $_POST['subject'];
    $messageContent = $_POST['message']; // Rename to avoid conflict with Swift_Message object

    // Require the Composer autoloader
    require 'mail/vendor/autoload.php';

    // Create the Transport
    $transport = new Swift_SmtpTransport('smtp.gmail.com', 587, 'tls');

    // Disable SSL certificate verification
    $transport->setStreamOptions([
        'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false,
        ],
    ]);

    // Set the username and password for your SMTP server
    $transport->setUsername('emmanueljeremiah008@gmail.com');
    $transport->setPassword('omaznypeukewzzez');

    // Create the Mailer using your created Transport
    $mailer = new Swift_Mailer($transport);

    // Create a message
    $swiftMessage = new Swift_Message($subject); // Rename variable to avoid conflict
    $swiftMessage->setFrom([$senderEmail => $name]); // Use correct variable for sender email
    $swiftMessage->setTo(['emmanueljeremiah008@gmail.com' => 'Emmanuel']);
    $swiftMessage->setBody($messageContent);

    // Send the message
    $result = $mailer->send($swiftMessage);

    // Check if the message has been sent successfully
    if ($result) {
        echo 'Email sent successfully.';
    } else {
        echo 'Failed to send email.';
    }
}
?>
