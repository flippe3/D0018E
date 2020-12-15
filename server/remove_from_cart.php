<?php
$link = mysqli_connect("localhost", "root", "hackerman", "ecommerce");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
session_start();

if(!isset($_SESSION["userID"])){
    echo '<script>alert("You are not loggin in buddy");window.location.href="../index.php"</script>';
}


// Escape user inputs for
$isbn = mysqli_real_escape_string($link, $_REQUEST['isbn']);
$userid = $_SESSION['userID'];

mysqli_query($link, "START TRANSACTION");

$get_orderid = mysqli_fetch_assoc(mysqli_query($link, "SELECT orderid FROM Orders where (customerid='$userid' and active=1)")) or die(mysqli_error($link));
$orderid = $get_orderid['orderid'];

$get_quantity = mysqli_fetch_assoc(mysqli_query($link, "SELECT quantity FROM Orderlist where (orderid='$orderid' and isbn='$isbn')"));           

if($get_quantity['quantity'] == 1){
    mysqli_query($link, "DELETE FROM Orderlist WHERE (orderid='$orderid' and isbn='$isbn')") or die(mysqli_error($link));
}
else{
    mysqli_query($link, "UPDATE Orderlist SET quantity=quantity - 1 WHERE (orderid='$orderid' and isbn='$isbn')") or die(mysqli_error($link));
}
echo '<script>window.location.href="../cart.php"</script>';

mysqli_query($link, "COMMIT");

// Close connection
mysqli_close($link);
?>
