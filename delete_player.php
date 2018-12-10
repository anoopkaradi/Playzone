<?php 
 
 if(!empty($_REQUEST['pd_id'])) 
 { 
   $pd_id = $_REQUEST['pd_id'];
 } 

?>



<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script>
$(document).ready(function(){
    $('#back_to_manage').click(function(){
 $('#tabFill').load('manage.php');
});
    });
</script>
</head>
<body>
<div class="container-fluid">
<div class="jumbotron">
<?php 
$servername = "localhost";
     $username = "root";
     $password = "";
     $dbname="playzonedb";
     $conn = new mysqli($servername, $username, $password,$dbname);
     if ($conn->connect_error) {
         die("Connection failed:" . $conn->connect_error); }
         else
         {
        $result1=$conn->query("update participant_details set confirmed='NA' where pd_id=$pd_id");
        if ($result1) 
       echo "<h3> Player rejected!</h3>";
       else
       echo "<h3> Error rejecting player!</h3>";
    }
     $conn->close();
    ?>
<button  class="btn btn-success " id="back_to_manage">Back</button>
</div>
</div>
</body>
</html>