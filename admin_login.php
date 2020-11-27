<!DOCTYPE html>
<html>
<head>
<title>Login</title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
  <div class="header">
   <h2>Admin Login</h2>
  </div>  
  <form method="post" action="server/admin_account.php">
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
    <button type="submit" class="btn" name="login_admin">Login</button>
   </div>
  </form>
</body>
</html>
