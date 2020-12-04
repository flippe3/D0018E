<!DOCTYPE html>
<html>
<head>
<title>Login</title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
  <div class="header">
   <h2>Review</h2>
  </div>
   <form method="post" action="server/submit_review.php">
   <div class="input-group">
    <label>Grade</label>
    <input type="number" name="grade" min="1" max="5" value="3">
   </div>
   <div class="input-group">
    <label>Summary</label>
    <textarea type="text" name="review" rows="10" cols="38">
    </textarea>
   </div>
   <div class="input-group">
<?php
$temp = $_REQUEST['isbn'];
echo "<button type='submit' class='btn' name='$temp'>Submit Review</button>";
?>
   </div>
  </form>
</body>
</html>
