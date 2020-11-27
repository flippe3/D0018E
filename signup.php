<!DOCTYPE html>
<html>
<head>
  <title>Sign Up</title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
  <div class="header">
   <h2>Sign Up</h2>
  </div>
 
  <form method="post" action="create_account.php">
   <?php include('errors.php'); ?>
   <div class="input-group">
     <label>Email</label>
     <input type="email" name="email" value="<?php echo $email; ?>">
   </div>
   <div class="input-group">
     <label>Password</label>
     <input type="password" name="password_1">
   </div>
   <div class="input-group">
     <label>Confirm password</label>
     <input type="password" name="password_2">
   </div>
   <div class="input-group">
     <button type="submit" class="btn" name="reg_user">Sign Up</button>
   </div>
   <p>
    Already a member? <a href="login.php">Login</a>
   </p>
  </form>
</body>
</html>
