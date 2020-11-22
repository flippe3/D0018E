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
        <label for="ISBN">ISBN</label>
        <input type="text" name="ISBN" id="ISBN">
    </p>
    <p>
        <label for="ProductNr">ProductNr</label>
        <input type="text" name="ProductNr" id="ProductNr">
    </p>
    <p>
        <label for="Author">Author</label>
        <input type="text" name="Author" id="Author">
    </p>
    <p>
        <label for="Title">Title</label>
        <input type="text" name="Title" id="Title">
    </p>
    <p>
        <label for="Price">Price</label>
        <input type="text" name="Price" id="Price">
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
        <label for="ISBN">ISBN</label>
        <input type="text" name="ISBN" id="ISBN">
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
        <label for="ISBN">ISBN</label>
        <input type="text" name="ISBN" id="ISBN">
    </p>
    <p>
        <label for="ProductNr">ProductNr</label>
        <input type="text" name="ProductNr" id="ProductNr">
    </p>
    <p>
        <label for="Author">Author</label>
        <input type="text" name="Author" id="Author">
    </p>
    <p>
        <label for="Title">Title</label>
        <input type="text" name="Title" id="Title">
    </p>
    <p>
        <label for="Price">Price</label>
        <input type="text" name="Price" id="Price">
    </p>
    </div>
    <input type="submit" value="Submit" class='submit_btn'>
</form>

</body>
</html>
