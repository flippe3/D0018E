<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<body>
<?php

$hostname = "localhost";
$username = "root";
$password = "hackerman";
$db = "TESTDATABASE";

$dbconnect=mysqli_connect($hostname,$username,$password,$db);

if ($dbconnect->connect_error) {
  die("Database connection failed: " . $dbconnect->connect_error);
}

?>

<table border="1" align="center">
<tr>
  <td>Title</td>
  <td>Price</td>
  <td>Author</td>
</tr>

<?php

$query = mysqli_query($dbconnect, "SELECT * FROM Products")
   or die (mysqli_error($dbconnect));

while ($row = mysqli_fetch_array($query)) {
  echo
   "<tr>
    <td>{$row['Title']}</td>
    <td>{$row['Price']}</td>
    <td>{$row['Author']}</td>
   </tr>\n";

}

?>
</table>
</body>
</html>
