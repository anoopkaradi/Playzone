<?php 
 
 if(!empty($_REQUEST['host_id'])) 
 { 
   $host_id = $_REQUEST['host_id'];
 } 


?>


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
        $result1=$conn->query("select * from host_details where host_id=$host_id");
        if ($result1->num_rows > 0) {
          while($row1 = $result1->fetch_assoc()) {
        $usr_id = $row1['user_id'];
        $sport_id = $row1['sport_id']; 
$host_date = $row1['host_date'];	
$time_zone = $row1['time_zone'];
$host_location = $row1['host_location'];
$sld_id=$row1['sld_id'];
$add_info=$row1['add_info'];

$result2=$conn->query("select first_name,last_name,dp,phone from user_details where user_id=$usr_id");
if ($result2->num_rows > 0) 
  while($row2 = $result2->fetch_assoc()) 
  {
    $name=$row2['first_name']." ".$row2['last_name'];
    $dp_loc=$row2['dp'];
    $phone=$row2['phone'];
  }

  $result3=$conn->query("select sport_name from sport_details where sport_id=$sport_id");
  if ($result3->num_rows > 0) 
    while($row3 = $result3->fetch_assoc()) 
   $sport_name=$row3['sport_name'];   
  $result4=$conn->query("select level_name from sports_levels_details where sld_id=$sld_id");
  if ($result4->num_rows > 0) 
    while($row4 = $result4->fetch_assoc()) 
   $level_name=$row4['level_name'];
}
    }
        }
     $conn->close();
       
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
<script>

</script>
</head>
<body>
<div class="container-fluid">
<div class="well">
<div class="row">
<div class="col-md-4">
<figure align="left"> <center> <img src='<?php echo $dp_loc?>' width='70%' class='img-circle img-responsive'></center> <figcaption><?php echo $name?></figcaption>  </figure> 
    
</div>
<div class="col-md-8">
<h2 align="left"><?php echo $sport_name ?><h2>
<h3 class="text-success" align="left"><?php echo $level_name ?></h3>
<h4  align="left"><span class="glyphicon glyphicon-map-marker"></span> Playing at <?php echo $host_location ?></h4>
<h4  align="left"><span class="glyphicon glyphicon-calendar"></span> <?php echo $host_date ?></h4>
<h4  align="left"><span class="glyphicon glyphicon-time"></span> <?php echo $time_zone ?></h4>
<h5  align="left"><?php echo $add_info ?> </h5>
</div>
</div>
<form action="join_game.php" method="POST">
<input type="hidden" name="host_id" value="<?php echo $host_id ?>">
<input type="hidden" name="sport_id" value="<?php echo $sport_id ?>">
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
$result10=$conn->query("select * from participant_details where host_id=$host_id and confirmed='yes'");
if($result10->num_rows > 0)
{
  echo "
  <hr>
  <div class='row'>
  <div class='col-md-12' style='overflow-x:auto;'>
  <h4 align='left'>Playing: </h4>";
  
 echo " <table class='parti' align='left'>
 <tr>";
while($row10=$result10->fetch_assoc())
{
   $parti_id=$row10['user_id'];
   $result11=$conn->query("select * from user_details where user_id=$parti_id ");
   if($result11->num_rows > 0)
   {
   while($row11 = $result11->fetch_assoc())
   {
    $name_parti=$row11['first_name']." ".$row11['last_name']; 
    $dp_parti=$row11['dp'];
   }
  }
 echo "<td><center><img src='$dp_parti' width='50px' class='img-circle img-responsive'></center><br>
 <center>$name_parti</center></td>";

}
echo "
</tr>
</table>
</div>
</div>";
}
    }
    
    $conn->close();

?>
<hr>
<?php 
       
session_start();
$user_id=$_SESSION['user_id'];
$servername = "localhost";
     $username = "root";
     $password = "";
     $dbname="playzonedb";
     $conn = new mysqli($servername, $username, $password,$dbname);
     if ($conn->connect_error) {
         die("Connection failed:" . $conn->connect_error); }
         else
         { 
           $result5=$conn->query("select * from user_sport_details where sport_id=$sport_id and user_id=$user_id");
           if ($result5->num_rows > 0);
           else
           {
                   
        echo "
        <p>Rate your self in $sport_name to join : 
        <select name='parti_level_select' required>
        <option value='1'>Beginner</option>
        <option value='2'>Amateur</option>
        <option value='3'>Intermediate</option>
        <option value='4'>Advanced</option>
        <option value='5'>Professional</option>
        </select>
        </p>";

          }
          }
        $conn->close();
        
?>
<button  class="btn btn-success " name="join_game_btn" type="submit" >Join game</button>
</form>
</div>

</body>
</html>