<?php
$link = mysqli_connect("localhost", "root", "hackerman", "ecommerce");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Escape user inputs for
$email = mysqli_real_escape_string($link, $_REQUEST['email']);
$password = mysqli_real_escape_string($link, $_REQUEST['password']);

// Attempt insert query execution
$sql = "SELECT password FROM Customers WHERE email='$email'"; 
$get_id = "SELECT customerid FROM Customers WHERE email='$email'"; 
$query = mysqli_query($link, $sql) or die(mysqli_error($link));
$getting_id = mysqli_query($link, $get_id) or die(mysqli_error($link));

$pass = mysqli_fetch_assoc($query); 
session_start();

if($pass['password'] == $password && $password != ''){
    $get = mysqli_fetch_assoc($getting_id); 
    $_SESSION["login_status"] = true;
    $_SESSION["userID"] = $get["customerid"];
    
    echo '<script>alert("Login Successful");window.location.href="../index.php"</script>';
}
else{
    echo '<script>alert("Wrong password or email");window.location.href="../login.php"</script>';
}
if(!$query){
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

// Close connection
mysqli_close($link);
?>
