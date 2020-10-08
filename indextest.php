<?php
// Message Vars
$msg = '';
$msgClass = '';

// Check Submit
if (filter_has_var(INPUT_POST, 'submit')) {
  // Get Data
  $name = htmlspecialchars($_POST['name']);
  $email = htmlspecialchars($_POST['email']);
  $message = htmlspecialchars($_POST['message']);

  // Check required fields
  if (!empty($email) && !empty($name) && !empty($message)) {
    //Passed
    //check email
    if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
      //failed
      $msg = 'Please use a valid Email';
      $msgClass = 'alert-danger';
    } else {
      //passed
      //Recipient Email
      $toEmail = 'mediacodenow@gmail.com';
      $subject = 'Contact Request From ' . $name;
      $body = '<h2>Contact Request</h2>
              <h4>Name</h4><p>' . $name . '</p>
              <h4>Email</h4><p>' . $email . '</p>
              <h4>Message</h4><p>' . $message . '</p>
              ';

      //Email Header
      $headers = "MIME-Version: 1.0" . "\r\n";
      $headers .= "Content-Type:text/html;charset=UTF-8" . "\r\n";

      //Additional headers
      $headers .= "From: " . $name . "<" . $email . ">" . "r\n";

      if (mail($toEmail, $subject, $body, $headers)) {
        // Email Sent
        $msg = 'Your email has been sent';
        $msgClass = 'alert-success';
      } else {
        //Failed
        $msg = 'Your email was not sent';
        $msgClass = 'alert-danger';
      }
    }
  } else {
    // Failed
    $msg = 'Please fill in all the fields';
    $msgClass = 'alert-danger';
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Us</title>
  <link rel="stylesheet" href="https://bootswatch.com/4/cosmo/bootstrap.min.css">

</head>

<body>
  <nav class="navbar bg-dark navbar-default">
    <div class="container">
      <div class="navbar-header">
        <a class="navbar-brand" href="index.php">Website</a>
      </div>
    </div>
  </nav>
  <div class="container">
    <?php if ($msg != '') : ?>
      <div class="alert <?php echo $msgClass; ?>"><?php echo $msg ?></div>
    <?php endif; ?>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <div class="form-group">
        <label>Name</label>
        <input name="name" class="form-control" value="<?php echo isset($_POST['name']) ? $name : ''; ?>">
      </div>
      <div class="form-group">
        <label>Email</label>
        <input name="email" class="form-control" value="<?php echo isset($_POST['email']) ? $email : ''; ?>">
      </div>
      <div class="form-group">
        <label>Message</label>
        <textarea name="message" class="form-control"><?php echo isset($_POST['message']) ? $message : ''; ?></textarea>
        <br>
        <button class="btn btn-primary btn-lg" name="submit">Submit</button>
      </div>
    </form>
  </div>
</body>

</html>