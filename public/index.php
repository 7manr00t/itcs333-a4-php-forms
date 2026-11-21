<?php
declare(strict_types=1);
require_once __DIR__ . '/../src/validate.php';

// Array to collect the error messages
$errors = [];

// Run the validation only when the form is submitted (POST)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  
    $name    = trim($_POST['name'] ?? '');
    $email   = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');

    // Name: required, 2-60 characters
    if (!validate_required($name)) {
        $errors['name'] = "Name is required.";
    } elseif (!validate_length($name, 2, 60)) {
        $errors['name'] = "Name is too short or too long (2-60 characters).";
    }

    // Email: must be valid
    if (!validate_email($email)) {
        $errors['email'] = "Invalid email format. Please enter a valid email address.";
    }

    // Message: required, 10-1000 characters
    if (!validate_required($message)) {
        $errors['message'] = "Message is required.";
    } elseif (!validate_length($message, 10, 1000)) {
        $errors['message'] = "Message is too short or too long (10-1000 characters).";
    }

    // 
    if (empty($errors)) {
        header("Location: success.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Contact Us</title>
</head>
<body>
  <h1>Contact Us</h1>
  <!-- TODO: render the form, inline errors, and repopulated values -->
  <form method="post" action="index.php">
    <label>Name <input type="text" name="name"></label><br>
    <label>Email <input type="email" name="email"></label><br>
    <label>Message <textarea name="message"></textarea></label><br>
    <button type="submit">Send</button>
  </form>
</body>
</html>
