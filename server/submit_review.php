<?php
$link = mysqli_connect("localhost", "root", "hackerman", "ecommerce");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Escape user inputs for
$isbn = $_REQUEST['isbn'];
$grade = $_REQUEST['grade'];
$review = mysqli_real_escape_string($link, $_REQUEST['review']);

if($grade == ''){
    echo '<script>alert("You need to submit a grade.");
      window.location.href="../order_history.php";          
      </script>';    
}
else{
    // Attempt insert query execution
    $submit = "INSERT INTO Reviews (isbn, grading, comment) VALUES ('$isbn', '$grade', '$review')";
    mysqli_query($link, $submit) or die(mysqli_error($link));
    echo '<script>alert("Submitted review.");
      window.location.href="../order_history.php";          
      </script>';

}

 
// Close connection
mysqli_close($link);
?>
