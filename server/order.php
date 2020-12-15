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
$get_orderlist2 = mysqli_query($link, "SELECT isbn,quantity FROM Orderlist where (orderid='$orderid')");
$can_order = true;

// Check if there is an address and a zip
if($address == '' and $zip == ''){
    $can_order = false;
    echo '<script>alert("You need an adress and a zip");window.location.href="../cart.php"</script>';
}
// Check if the cart is empty
if(mysqli_num_rows($get_orderlist) == 0){
    $can_order = false;
    echo '<script>alert("Your cart is empty");window.location.href="../cart.php"</script>';    
}

// Get every book in the cart where active=1
while($book = mysqli_fetch_array($get_orderlist)){
    // This is the quantity in the cart	
    $quantity = $book['quantity'];
    $isbn = $book['isbn'];

    // This is the amount of books in the actual storage
    $storage_quantity = mysqli_fetch_assoc(mysqli_query($link, "SELECT bookquantity FROM Products where isbn='$isbn'")) or die(mysqli_error($link));

    // If the quantity is less than storagequantity you can make the purchase
    if ($quantity <= $storage_quantity['bookquantity']){
	//Remove the quanity from the storage
        mysqli_query($link, "UPDATE Products SET bookquantity=bookquantity-'$quantity'  WHERE (isbn='$isbn')") or die(mysqli_error($link));
    }
    else{
        $can_order = false;
        echo '<script>alert("Your order could not be placed, out of stock");window.location.href="../index.php"</script>';
    }
}

// If all of the above requirements are met we can pursue the order
if($can_order)
{
    // Go through every book in the cart and update the price in orderlist
    while($book = mysqli_fetch_array($get_orderlist2)){
        $isbn = $book['isbn'];
        $get_price = mysqli_fetch_assoc(mysqli_query($link, "SELECT price FROM Products where isbn='$isbn'")) or die(mysqli_error($link));
	$get_total_price = $get_price['price'] * $book['quantity'];
	//Update the orderlist to the total price which is the price of a book multiplied by the quantity
        mysqli_query($link, "UPDATE Orderlist SET price='$get_total_price'  WHERE (orderid='$orderid' and isbn='$isbn')") or die(mysqli_error($link));
    }
    // Update the order table with the current date and the entered address and zip and set active of that order to 0.
    $currentdate = date('Y-m-d');
    mysqli_query($link, "UPDATE Orders SET transactiondate='$currentdate',address='$address',zip='$zip',active=0  WHERE (orderid='$orderid')") or die(mysqli_error($link));

    // Create a new order
    $create_order = "INSERT INTO Orders (customerid) VALUES ('$userid')";
    mysqli_query($link, $create_order);

    echo '<script>alert("Your order has been added");window.location.href="../index.php"</script>';
}
mysqli_query($link, "COMMIT");
// Close connection
mysqli_close($link);
?>
