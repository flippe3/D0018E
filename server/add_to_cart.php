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
$get_orderid = mysqli_fetch_assoc(mysqli_query($link, "SELECT orderid FROM Orders where (customerid='$userid' and active=1)")) or die(mysqli_error($link));
$orderid = $get_orderid['orderid'];

$get_id_isbn = mysqli_fetch_assoc(mysqli_query($link, "SELECT isbn, orderid FROM Orderlist where (orderid='$orderid' and isbn='$isbn')"));
echo "wiwu\n";

if($get_id_isbn == ''){    
    echo "I am now inserting my book into Orderlist mr hope that makes u sufficiently happy\n";
    mysqli_query($link, "INSERT INTO Orderlist (isbn, orderid) VALUES ('$isbn', '$orderid')");
}
else{
    echo "get_id_isbn is null or empty or smth\n";
    mysqli_query($link, "UPDATE Orderlist SET quantity=quantity + 1 WHERE (orderid='$orderid' and isbn='$isbn')") or die(mysqli_error($link));
}

echo '<script>window.location.href="../cart.php"</script>';

// Close connection
mysqli_close($link);
?>
