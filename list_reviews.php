<?php
session_start();
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
       echo <<<_END
       <div id="miniheader">
       <button id='btn_miniheader' onclick="location.href='login.html';" type='button'>Login</button>
       <button id='btn_miniheader' onclick="location.href='signup.php';" type='button'>Sign up</button>
       <button id='btn_miniheader' onclick="location.href='admin_login.html';" type='button'>Admin</button>
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

      // Get the correct data to print the title and summary. 
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
	$total_grades = 0;
	$average_grades = 0;
	while ($row = mysqli_fetch_array($get_reviews)) {
		// Add to the total grade to be able to make an average
		$total_grade = $total_grade + 1;
    		$average_grades = $average_grades + $row['grading'];
    		$grade = $row['grading'];
       		$review = $row['comment'];         
         	echo
	 	"<tr id='entries'>
		<td>{$grade}</td>
		<td>{$review}</td>
		</tr>\n";
	}
	// Print the average grade
	$avg = round($average_grades / $total_grade, 2);
    	echo "
	<tr id='footer_column'>
	 <td>Average Grade</td>
	 <td></td>
	</tr>
   	<tr id='footer_column'>
	 <td>{$avg}</td>
	 <td></td>
	</tr>";
	?>

  </table>
  </div>
</div>        
</div>
</body>
</html>
