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
$address = mysqli_real_escape_string($link, $_REQUEST['address']);
$zip = mysqli_real_escape_string($link, $_REQUEST['zip']);
$userid = $_SESSION['userID'];

$get_orderid = mysqli_fetch_assoc(mysqli_query($link, "SELECT orderid FROM Orders where (customerid='$userid' and active=1)")) or die(mysqli_error($link));
$orderid = $get_orderid['orderid'];

mysqli_query($link, "START TRANSACTION");

$get_orderlist = mysqli_query($link, "SELECT isbn,quantity FROM Orderlist where (orderid='$orderid')");
$can_order = true;

while($book = mysqli_fetch_array($get_orderlist)){
    $quantity = $book['quantity'];
    $isbn = $book['isbn'];
    
    $storage_quantity = mysqli_fetch_assoc(mysqli_query($link, "SELECT bookquantity FROM Products where isbn='$isbn'")) or die(mysqli_error($link));
    if ($quantity <= $storage_quantity['bookquantity']){
        mysqli_query($link, "UPDATE Products SET bookquantity=bookquantity-'$quantity'  WHERE (isbn='$isbn')") or die(mysqli_error($link));
    }
    else{
        $can_order = false;
        echo '<script>alert("Your order could not be placed, out of stock");window.location.href="../index.php"</script>';
    }
}

if($can_order)
{
    while($book = mysqli_fetch_array($get_orderlist)){
        $isbn = $book['isbn'];
        $get_price = mysqli_fetch_assoc(mysqli_query($link, "SELECT price FROM Products where isbn='$isbn'")) or die(mysqli_error($link));
        $get_total_price = $get_price['price'] * $book['quantity'];
        mysqli_query($link, "UPDATE Orderlist SET price='$get_total_price'  WHERE (orderid='$orderid' and isbn='$isbn')") or die(mysqli_error($link));
    }

    $currentdate = date('Y-m-d');
    mysqli_query($link, "UPDATE Orders SET transactiondate='$currentdate',address='$address',zip='$zip',active=0  WHERE (orderid='$orderid')") or die(mysqli_error($link));

    $create_order = "INSERT INTO Orders (customerid) VALUES ('$userid')";
    mysqli_query($link, $create_order);

    mysqli_query($link, "COMMIT");

    echo '<script>alert("Your order has been added");window.location.href="../index.php"</script>';
}
// Close connection
mysqli_close($link);
?>
