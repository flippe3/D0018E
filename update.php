<?php
$link = mysqli_connect("localhost", "root", "hackerman", "TESTDATABASE");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Escape user inputs for security
$isbn = mysqli_real_escape_string($link, $_REQUEST['ISBN']);
$productnr = mysqli_real_escape_string($link, $_REQUEST['ProductNr']);
$author = mysqli_real_escape_string($link, $_REQUEST['Author']);
$title = mysqli_real_escape_string($link, $_REQUEST['Title']);
$price = mysqli_real_escape_string($link, $_REQUEST['Price']);

// Attempt insert query execution
$sql = "UPDATE Products set ProductNr='$productnr', Author='$author', Title='$title', Price='$price' WHERE ISBN='$isbn'";
if(mysqli_query($link, $sql)){
    echo "Records added successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 
// Close connection
mysqli_close($link);
?>
