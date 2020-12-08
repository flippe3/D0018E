<?php
session_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
	<link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
  </head>
  <a href='index.php'><header style="color: green;">Order History</header></a>
 <?php
   if($_SESSION["login_status"] === true){
       echo <<<_END
       <div id="miniheader">
       <button id='btn_miniheader' onclick="location.href='server/logout_account.php';" type='button'>Logout</button>
       <button id='btn_miniheader' onclick="location.href='index.php';" type='button'>Shop</button>
       <button id='btn_miniheader' onclick="location.href='order_history.php';" type='button'>Order History</button>
       </div>
       _END;
       }
   else{
       echo '<script>alert("Login bro");window.location.href="../login.php"</script>';
}
 ?>
 <body>
	<div id="wrapper">
	  <?php
	   $hostname = "localhost";
	   $username = "root";
	   $password = "hackerman";
	   $db = "ecommerce";

	   $dbconnect=mysqli_connect($hostname,$username,$password,$db);
	   if ($dbconnect->connect_error) {
	  die("Database connection failed: " . $dbconnect->connect_error);
	  }

	  ?>
      <div id="tablediv">
	  <table border="1" align="left">
	<tr id="head_column">
	  <td>Orderid</td>
	  <td>Date</td>
	  <td>ISBN</td>
	  <td>Title</td>
	  <td>Price</td>
	  <td>Quantity</td>
	  <td>Leave Review</td>
	</tr>
    <?php

          $userid = $_SESSION['userID'];
$fetch_order = mysqli_query($dbconnect, "SELECT orderid FROM Orders where (customerid='$userid' and active=0)") or die(mysqli_error($dbconnect));

while($get_orderid = mysqli_fetch_array($fetch_order)){
    $orderid = $get_orderid['orderid'];
          $get_orderlist = mysqli_query($dbconnect, "SELECT * FROM Orderlist where orderid='$orderid'") or die(mysqli_error($dbconnect));
          
  	 while ($row = mysqli_fetch_array($get_orderlist)) {
         $date = mysqli_fetch_assoc(mysqli_query($dbconnect, "SELECT transactiondate FROM Orders where orderid='$orderid'")) or die(mysqli_error($dbconnect));
         $printdate = $date['transactiondate'];

         $isbn = $row['isbn'];
         $get_book = mysqli_fetch_assoc(mysqli_query($dbconnect, "SELECT * FROM Products where isbn='$isbn'")) or die(mysqli_error($dbconnect));

         $imageurl = "images/{$get_book['imgurl']}";         
		 if ($imageurl== "images/"){
			 $imageurl = "images/default.jpg";
		 }
         echo
	 "<tr id='entries'>
	<td>{$orderid}</td>
	<td>{$printdate}</td>
	<td>{$row['isbn']}</td>
	<td>{$get_book['title']}</td>
	<td>{$row['price']} kr</td>
	<td>{$row ['quantity']}</td>
    <form method='POST' action='review.php'>
	<td><button id='btn_grade' type='submit' value='$isbn' name='isbn'>Grade</button></td>
    </form>
    </tr>\n";}}?>

  </table>
  </div>
</div>        
</div>
</body>
</html>
