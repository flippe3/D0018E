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
  <a href='index.php'><header style="color: green;">Reviews</header></a>
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
      $isbn = $_REQUEST['isbn'];
$get_book = mysqli_fetch_assoc(mysqli_query($dbconnect, "SELECT title,summary FROM Products WHERE isbn='$isbn'"));
      $title = $get_book['title'];
      $summary = $get_book['summary'];
      echo "<h3>$title</h3>";
      echo "<div id='summarybox'>$summary</div>";
      ?>
      <div id="tablediv">
	  <table border="1" align="left">
	<tr id="head_column">
	  <td>Grades</td>
	  <td>Reviews</td>
	</tr>
    <?php
          $get_reviews = mysqli_query($dbconnect, "SELECT * FROM Reviews where isbn='$isbn'");
  	 while ($row = mysqli_fetch_array($get_reviews)) {
         $grade = $row['grading'];
         $review = $row['comment'];         
         echo
	 "<tr id='entries'>
	<td>{$grade}</td>
	<td>{$review}</td>
    </tr>\n";}
?>

  </table>
  </div>
</div>        
</div>
</body>
</html>
