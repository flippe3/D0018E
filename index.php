<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
    <link rel="stylesheet" href="main.css">
  </head>
  <header>Amazon V2</header>
  <div id="miniheader">
    <button id='btn_miniheader' onclick="location.href='login.php';" type='button'>Login</button>
    <button id='btn_miniheader' onclick="location.href='signup.php';" type='button'>Sign up</button>
    <button id='btn_miniheader' onclick="location.href='admin.php';" type='button'>Go to cart</button>
  </div>
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
	  <td>Add to cart</td>
	</tr>

	<?php

	 $query = mysqli_query($dbconnect, "SELECT * FROM Products")
	 or die (mysqli_error($dbconnect));

	 while ($row = mysqli_fetch_array($query)) {
	 echo
	 "<tr id='entries'>
	<td><img id='table_image' src='images/asimov.jpg'></td>
	<td>{$row['title']}</td>
	<td>{$row['price']} kr</td>
	<td>{$row['author']}</td>
	<td>{$row['isbn']}</td>
	<td>{$row['bookquantity']}</td>
	<td><button id='btn_add_cart' type='button'>Add to cart</button></td>
        </tr>\n";}?>
      </table>
    </div>
  </body>
</html>
