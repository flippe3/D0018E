<?php
session_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
	<link rel="stylesheet" href="css/main.css">
  </head>
  <a href='index.php'><header>Amazon V2</header></a>
 <?php

   // Print the right menu depending on login status 

   if($_SESSION["login_status"] === true){
       echo <<<_END
       <div id="miniheader">
       <button id='btn_miniheader' onclick="location.href='server/logout_account.php';" type='button'>Logout</button>
       <button id='btn_miniheader' onclick="location.href='cart.php';" type='button'>Cart</button>
       <button id='btn_miniheader' onclick="location.href='order_history.php';" type='button'>Order History</button>
       </div>
       _END;
       }
   else{
       echo <<<_END
       <div id="miniheader">
       <button id='btn_miniheader' onclick="location.href='login.php';" type='button'>Login</button>
       <button id='btn_miniheader' onclick="location.href='signup.php';" type='button'>Sign up</button>
       <button id='btn_miniheader' onclick="location.href='admin_login.php';" type='button'>Admin</button>
       </div>
       _END;

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
	  <td>Title</td>
	  <td>Price</td>
	  <td>Author</td>
	  <td>ISBN</td>
	  <td>Book Quantity</td>
	  <td>Year</td>
	  <td>Summary</td>
	  <td>Add to cart</td>
	</tr>

	<?php

	 $query = mysqli_query($dbconnect, "SELECT * FROM Products")
	 or die (mysqli_error($dbconnect));

	 while ($row = mysqli_fetch_array($query)) {
		 $imageurl = "images/{$row['imgurl']}";
		 if ($imageurl== "images/"){
			 $imageurl = "images/default.jpg";
		 }

         $isbn = "{$row['isbn']}";
         echo
	 "
    <tr id='entries'>
    <td><img id='table_image' src=$imageurl></td>
	<td>{$row['title']}</td>
	<td>{$row['price']} kr</td>
	<td>{$row['author']}</td>
	<td>{$row['isbn']}</td>
	<td>{$row['bookquantity']}</td>
	<td>{$row['releaseyear']}</td>
    <form method='POST' action='list_reviews.php'>
	<td><button id='btn_add_cart' type='submit' value=$isbn name='isbn'>Review</button></td>
    </form>
    <form method='POST' action='server/add_to_cart.php'>
	<td><button id='btn_add_cart' type='submit' value=$isbn name='isbn'>Add to cart</button></td>
    </form>
	</tr>\n";}
	  ?>
	  </table>
	</div>
  </body>
</html>
