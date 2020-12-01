<?php
session_start();
print_r($_SESSION);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
	<link rel="stylesheet" href="css/main.css">
  </head>
  <a href='index.php'><header style="color: magenta;">Shopping cart</header></a>
 <?php
   if($_SESSION["login_status"] === true){
       echo <<<_END
       <div id="miniheader">
       <button id='btn_miniheader' onclick="location.href='server/logout_account.php';" type='button'>Logout</button>
       <button id='btn_miniheader' onclick="location.href='index.php';" type='button'>Shop</button>
       <button id='btn_miniheader' onclick="location.href='orders.php';" type='button'>Order History</button>
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
	  
	  <table border="1" align="left">
	<tr id="head_column">
	  <td>Image</td>
	  <td>ISBN</td>
	  <td>Title</td>
	  <td>Author</td>
	  <td>Price</td>
	  <td>Year</td>
	  <td>Quantity</td>
	  <td>Remove from cart</td>
	</tr>

    <?php
          $userid = $_SESSION['userID'];
          $get_orderid = mysqli_fetch_assoc(mysqli_query($dbconnect, "SELECT orderid FROM Orders where (customerid='$userid' and active=1)")) or die(mysqli_error($link));
          $orderid = $get_orderid['orderid'];
          $get_orderlist = mysqli_query($dbconnect, "SELECT * FROM Orderlist where orderid='$orderid'") or die(mysqli_error($link));
          


	 while ($row = mysqli_fetch_array($get_orderlist)) {
         $isbn = $row['isbn'];
         $get_book = mysqli_fetch_assoc(mysqli_query($dbconnect, "SELECT * FROM Products where isbn='$isbn'")) or die(mysqli_error($link));

         $imageurl = "images/{$get_book['imgurl']}";         
		 if ($imageurl== "images/"){
			 $imageurl = "images/default.jpg";
		 }
         echo
	 "<tr id='entries'>
	<td><img id='table_image' src=$imageurl></td>
	<td>{$get_book['isbn']}</td>
	<td>{$get_book['title']}</td>
	<td>{$get_book['author']}</td>
	<td>{$get_book['price']} kr</td>
	<td>{$get_book['releaseyear']}</td>
	<td>{$get_book['quantity']}</td>
	<td><button id='btn_remove' type='button'>Remove</button></td>
		</tr>\n";}
	  ?>
	  </table>
	</div>
  </body>
</html>
