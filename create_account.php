<?php
$link = mysqli_connect("localhost", "root", "hackerman", "ecommerce");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Escape user inputs for
$email = mysqli_real_escape_string($link, $_REQUEST['email']);
$password1 = mysqli_real_escape_string($link, $_REQUEST['password_1']);
$password2 = mysqli_real_escape_string($link, $_REQUEST['password_2']);

if($password1 != $password2){
    echo '<script>alert("Passwords do not match");
          window.location.href="signup.php";
          </script>';
}
else{
    // Attempt insert query execution
    $sql = "INSERT INTO Customers (email, password) VALUES ('$email', '$password1')";
    if(mysqli_query($link, $sql)){
        echo '<script>alert("Account registered successfully.")
              window.location.href="login.php";          
              </script>';
    } else{
        echo '<script>alert("Email already registered.");
              window.location.href="signup.php";          
              </script>';
    }
}
 
// Close connection
mysqli_close($link);
?>
