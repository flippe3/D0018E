<?php
$link = mysqli_connect("localhost", "root", "hackerman", "ecommerce");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Escape user inputs for security
$isbn = mysqli_real_escape_string($link, $_REQUEST['isbn']);
$author = mysqli_real_escape_string($link, $_REQUEST['author']);
$title = mysqli_real_escape_string($link, $_REQUEST['title']);
$price = mysqli_real_escape_string($link, $_REQUEST['price']);
$bookquantity = mysqli_real_escape_string($link, $_REQUEST['bookquantity']);
$releaseyear = mysqli_real_escape_string($link, $_REQUEST['releaseyear']);
$summary = mysqli_real_escape_string($link, $_REQUEST['summary']);

// Attempt insert query execution
$sql = "UPDATE Products SET author='$author', title='$title', price='$price', releaseyear='$releaseyear', summary='$summary' WHERE isbn='$isbn'";
if(mysqli_query($link, $sql)){
    echo "Records added successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 
// Close connection
mysqli_close($link);
?>
