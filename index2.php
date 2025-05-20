<?php

$error_messages = [
    'emptyfields' => 'Please fill in all fields!',
    'invalidemail' => 'Invalid email format!',
    'shortpassword' => 'Password must be at least 6 characters!',
    'emailtaken' => 'Email already registered!',
    'invalidcredentials' => 'Invalid email or password!',
    'dberror' => 'Database error occurred!',
    'unknown' => 'An unknown error occurred!'
];


$error_message = "";
if (isset($_GET['error']) && isset($error_messages[$_GET['error']])) {
    $error_message = $error_messages[$_GET['error']];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Error</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <div class="container" id="signup" style="display:none;">
    <h1 class="form-title">Register</h1>
    <?php if (!empty($error_message)): ?>
    <div class="error-message">
      <i class="fas fa-exclamation-circle"></i>
      <p><?php echo htmlspecialchars($error_message); ?></p>
    </div>
    <?php endif; ?>
    <form method="post" action="register.php">
      <div class="input-group">
        <i class="fas fa-user"></i>
        <input type="text" name="fName" id="fName" placeholder="First Name" required>
        <label for="fName">First Name</label>
      </div>
      <div class="input-group">
        <i class="fas fa-user"></i>
        <input type="text" name="lName" id="lName" placeholder="Last Name" required>
        <label for="lName">Last Name</label>
      </div>
      <div class="input-group">
        <i class="fas fa-envelope"></i>
        <input type="email" name="email" id="email" placeholder="Email" required>
        <label for="email">Email</label>
      </div>
      <div class="input-group">
        <i class="fas fa-lock"></i>
        <input type="password" name="password" id="password" placeholder="Password" required>
        <label for="password">Password</label>
      </div>
      <input type="submit" class="btn" value="Sign Up" name="signUp">
    </form>
    <div class="links">
      <p>Already Have Account?</p>
      <button id="signInButton">Sign In</button>
    </div>
  </div>

  <div class="container" id="signIn">
    <h1 class="form-title">Sign In</h1>
    <?php if (!empty($error_message)): ?>
    <div class="error-message">
      <i class="fas fa-exclamation-circle"></i>
      <p><?php echo htmlspecialchars($error_message); ?></p>
    </div>
    <?php endif; ?>
    <form method="post" action="register.php">
      <div class="input-group">
        <i class="fas fa-envelope"></i>
        <input type="email" name="email" id="emailSignIn" placeholder="Email" required>
        <label for="emailSignIn">Email</label>
      </div>
      <div class="input-group">
        <i class="fas fa-lock"></i>
        <input type="password" name="password" id="passwordSignIn" placeholder="Password" required>
        <label for="passwordSignIn">Password</label>
      </div>
      <p class="recover">
        <a href="#">Recover Password</a>
      </p> 
      <input type="submit" class="btn" value="Sign In" name="signIn">
    </form>
    <div class="links">
      <p>Don't have account yet?</p>
      <button id="signUpButton">Sign Up</button>
    </div>
  </div>

  <script src="script.js"></script>
</body>
</html>