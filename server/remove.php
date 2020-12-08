<?php
$link = mysqli_connect("localhost", "root", "hackerman", "ecommerce");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Escape user inputs for security
$isbn = mysqli_real_escape_string($link, $_REQUEST['isbn']);

// Attempt insert query execution
$sql = "DELETE FROM Products WHERE ISBN='$isbn'";
$delete_reviews = "DELETE FROM Reviews where ISBN='$isbn'";

mysqli_query($link, "START TRANSACTION");

if(mysqli_query($link, $delete_reviews)){
    if(mysqli_query($link, $sql)){
        echo "Records removed successfully.";    
    }
    else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }
} else{
    echo "ERROR: Could not able to execute $delete_reviews. " . mysqli_error($link);
}
 
mysqli_query($link, "COMMIT");
// Close connection
mysqli_close($link);
?>
