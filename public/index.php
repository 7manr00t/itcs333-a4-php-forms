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
  <style>
    .error { color: red; font-weight: bold; }
  </style>
</head>
<body>
  <h1>Contact Us</h1>

  <form method="post" action="index.php">
    <p>
      <label>Name
        <input type="text" name="name"
               value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>">
      </label>
      <?php if (isset($errors['name'])) echo "<span class='error'>" . htmlspecialchars($errors['name']) . "</span>"; ?>
    </p>

    <p>
      <label>Email
        <input type="email" name="email"
               value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
      </label>
      <?php if (isset($errors['email'])) echo "<span class='error'>" . htmlspecialchars($errors['email']) . "</span>"; ?>
    </p>

    <p>
      <label>Message
        <textarea name="message"><?php echo isset($_POST['message']) ? htmlspecialchars($_POST['message']) : ''; ?></textarea>
      </label>
      <?php if (isset($errors['message'])) echo "<span class='error'>" . htmlspecialchars($errors['message']) . "</span>"; ?>
    </p>

    <button type="submit">Send</button>
  </form>
</body>
</html>