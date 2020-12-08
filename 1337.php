<?php
session_start();
if(isset($_SESSION["admin"]) === false){
    echo '<script>alert("You aint no admin boy");window.location.href="../admin_login.php"</script>';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Page</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<div class="header">
   <h2>Add Product</h2>
</div>
<form action="server/insert.php" method="post">
    <div class='input-group'>
    <p>
        <label for="isbn">ISBN</label>
        <input type="text" name="isbn" id="isbn">
    </p>
    <p>
        <label for="author">Author</label>
        <input type="text" name="author" id="author">
    </p>
    <p>
        <label for="title">Title</label>
        <input type="text" name="title" id="title">
    </p>
    <p>
        <label for="price">Price</label>
        <input type="text" name="price" id="price">
    </p>
    <p>
        <label for="bookquantity">Book Quantity</label>
        <input type="text" name="bookquantity" id="bookquantity">
    </p>
    <p>
        <label for="releaseyear">Release Year</label>
        <input type="text" name="releaseyear" id="releaseyear">
    </p>
    <p>
        <label for="summary">Summary</label>
        <input type="text" name="summary" id="summary">
    </p>
    <p>
        <label for="imgurl">Image Url</label>
        <input type="text" name="imgurl" id="imgurl">
    </p>
    </div>
    <input type="submit" value="Submit" class='submit_btn'>
</form>

<div class="header">
   <h2>Remove Product</h2>
</div>
<form action="server/remove.php" method="post">
    <div class='input-group'>
    <p>
        <label for="isbn">ISBN</label>
<?php
$link = mysqli_connect("localhost", "root", "hackerman", "ecommerce");

if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$sql = "SELECT isbn from Products";
$query = mysqli_query($link, $sql) or die(mysqli_error($link));

echo '<select name="isbn">';

while ($row = mysqli_fetch_array($query)) {
    echo "<option name='isbn' id='isbn' value=".$row['isbn'].">" . $row['isbn'] . "</option>";
}

echo '</select>';
?>
    </p>
    </div>
    <input type="submit" value="Submit" class='submit_btn'>
</form>

<div class="header">
   <h2>Change Product</h2>
</div>
<form action="server/update.php" method="post">
    <div class='input-group'>
    <p>
        <label for="isbn">ISBN</label>
<?php

$get_books = "SELECT * from Products";
$query2 = mysqli_query($link, $get_books) or die(mysqli_error($link));

echo '<select name="isbn">';

while ($row = mysqli_fetch_array($query2)) {
    echo "<option name='isbn' id='isbn' value=".$row['isbn'].">" . $row['isbn'] . "</option>";
}

echo '</select>';
?>              
    </p>
    <p>
        <label for="author">Author</label>
        <input type="text" name="author" id="author">
    </p>
    <p>
        <label for="title">Title</label>
        <input type="text" name="title" id="title">
    </p>
    <p>
        <label for="price">Price</label>
        <input type="text" name="price" id="price">
    </p>
    <p>
        <label for="bookquantity">Book Quantity</label>
        <input type="text" name="bookquantity" id="bookquantity">
    </p>
    <p>
        <label for="releaseyear">Release Year</label>
        <input type="text" name="releaseyear" id="releaseyear">
    </p>
    <p>
        <label for="summary">Summary</label>
        <input type="text" name="summary" id="summary">
    </p>
    <p>
        <label for="imgurl">Image Url</label>
        <input type="text" name="imgurl" id="imgurl">
    </p>

     </div>
    <input type="submit" value="Submit" class='submit_btn'>
</form>

</body>
</html>
