<!DOCTYPE html>
<html>
<head>
<title>Login</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
   <h2>Login</h2>
  </div>
  
  <form method="post" action="login_account.php">
   <?php include('errors.php'); ?>
   <div class="input-group">
    <label>Email</label>
    <input type="email" name="email" >
   </div>
   <div class="input-group">
    <label>Password</label>
    <input type="password" name="password">
   </div>
   <div class="input-group">
    <button type="submit" class="btn" name="login_user">Login</button>
   </div>
   <p>
    Not yet a member? <a href="signup.php">Sign up</a>
   </p>
  </form>
</body>
</html>
