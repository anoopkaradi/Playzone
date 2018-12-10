<?php 
 
 if(!empty($_REQUEST['host_id'])) 
 { 
   $host_id = $_REQUEST['host_id'];
 } 

?>



<!DOCTYPE html>
<html lang="en">
<head>
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
        $result1=$conn->query("delete from host_details where host_id=$host_id");
        if ($result1) 
       echo "<h3> Event cancelled!</h3>";
       else
       echo "<h3> Error canceling event!</h3>";
    }
     $conn->close();
    ?>
<button  class="btn btn-success " id="back_to_manage">Back</button>
</div>
</div>
</body>
</html>