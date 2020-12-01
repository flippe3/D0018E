<?php
$link = mysqli_connect("localhost", "root", "hackerman", "ecommerce");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

session_start();

// Escape user inputs for
$isbn = mysqli_real_escape_string($link, $_REQUEST['name']);

$userid = $_SESSION['userID'];
$get_orderid = mysqli_fetch_assoc(mysqli_query($link, "SELECT orderid FROM Orders where (customerid='$userid' and active=1)")) or die(mysqli_error($link));
$orderid = $get_orderid['orderid'];

$add_to_cart = mysqli_query($link, "INSERT INTO Orderlist (isbn, orderid) VALUES ('$isbn', '$orderid')") or die(mysqli_error($link));

 
// Close connection
mysqli_close($link);
?>
