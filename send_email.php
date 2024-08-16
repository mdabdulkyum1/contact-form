<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

function sendEmail($name, $email, $subject, $message)
{
    $to = "kyummdabdul@gmail.com";
    $emailSubject = "New Form Submission: $subject";
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";

    $mailBody = "Name: $name\n";
    $mailBody .= "Email: $email\n";
    $mailBody .= "Subject: $subject\n";
    $mailBody .= "Message: \n$message\n";

    return mail($to, $emailSubject, $mailBody, $headers);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST["name"] ?? "";
    $email = $_POST["email"] ?? "";
    $subject = $_POST["subject"] ?? "";
    $message = $_POST["message"] ?? "";

    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        http_response_code(400);
        echo json_encode(["error" => "Incomplete data"]);
        exit;
    }

    $emailSent = sendEmail($name, $email, $subject, $message);

    if ($emailSent) {
        echo json_encode(["success" => "Email sent successfully"]);
    } else {
        http_response_code(500);
        echo json_encode(["error" => "Failed to send email"]);
    }
} else {
    http_response_code(405);
    echo json_encode(["error" => "Method Not Allowed"]);
}
?>
