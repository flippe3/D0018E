<?php
session_start();
print_r($_SESSION);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
	<link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
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
      <div id="tablediv">
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
          $total_price = 0;
          $total_quantity = 0;

	 while ($row = mysqli_fetch_array($get_orderlist)) {
         $isbn = $row['isbn'];
         $get_book = mysqli_fetch_assoc(mysqli_query($dbconnect, "SELECT * FROM Products where isbn='$isbn'")) or die(mysqli_error($link));
         $get_quantity = mysqli_fetch_assoc(mysqli_query($dbconnect, "SELECT quantity FROM Orderlist where (isbn='$isbn' and orderid='$orderid')")) or die(mysqli_error($link));
         $book_price = $get_book['price'] * $get_quantity['quantity'];
         $total_price = $total_price + $book_price;
         $total_quantity = $total_quantity + $get_quantity['quantity'];
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
	<td>{$book_price} kr</td>
	<td>{$get_book['releaseyear']}</td>
	<td>{$get_quantity ['quantity']}</td>
    <form method='POST' action='server/remove_from_cart.php'>
	<td><button id='btn_remove' type='submit' value='$isbn' name='isbn'>Remove</button></td>
    </form>
    </tr>\n";}
    echo "
	<tr id='footer_column'>
	  <td></td>
	  <td></td>
	  <td></td>
	  <td></td>
	  <td>Sum</td>
	  <td></td>
	  <td>Total Quantity</td>
	  <td></td>
	</tr>
   <tr id='footer_column'>
	  <td></td>
	  <td></td>
	  <td></td>
	  <td></td>
	  <td>{$total_price}</td>
	  <td></td>
	  <td>{$total_quantity}</td>
	  <td></td>
	</tr>";
   ?>

  </table>
  </div>
  <div class="Orderform">
   <h1 class="header">Order Form</h1> 
  <form method="post" action="server/order.php">
   <div class="input-group">
     <label>Address</label>
     <input type="text" name="address">
   </div>
   <div class="input-group">
     <label>Zip</label>
     <input type="text" name="zip">
   </div>
   <div class="input-group">
     <button type="submit" class="btn" name="reg_user">Place Order</button>
   </div>
  </form>
</div>        
</div>
</body>
</html>
