<?php
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
  http_response_code(403);
  exit("Forbidden");
}

$name = trim($_POST["name"] ?? "");
$email = trim($_POST["email"] ?? "");
$subject = trim($_POST["subject"] ?? "");
$message = trim($_POST["message"] ?? "");

if ($name === "" || $email === "" || $subject === "" || $message === "" || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
  exit("Please complete all fields correctly.");
}

$to = "info@wellmorecare.co.uk";
$body = "Name: $name\nEmail: $email\nSubject: $subject\n\nMessage:\n$message";
$headers = "From: $name <$email>\r\nReply-To: $email\r\n";

if (mail($to, $subject, $body, $headers)) {
  header("Location: contact.html?sent=1");
  exit;
}

exit("Message could not be sent.");
?>
