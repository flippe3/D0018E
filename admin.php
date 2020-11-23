<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Page</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="header">
   <h2>Add Product</h2>
</div>
<form action="insert.php" method="post">
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
        <label for="bookquantity">Book Quanitty</label>
        <input type="text" name="bookquantity" id="bookquantity">
    </p>
    </div>
    <input type="submit" value="Submit" class='submit_btn'>
</form>

<div class="header">
   <h2>Remove Product</h2>
</div>
<form action="remove.php" method="post">
    <div class='input-group'>
    <p>
        <label for="isbn">ISBN</label>
        <input type="text" name="isbn" id="isbn">
    </p>
    </div>
    <input type="submit" value="Submit" class='submit_btn'>
</form>

<div class="header">
   <h2>Change Product</h2>
</div>
<form action="update.php" method="post">
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
    </div>
    <input type="submit" value="Submit" class='submit_btn'>
</form>

</body>
</html>
