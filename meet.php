
<!DOCTYPE html>
<html lang="en">
<head>
<script>

 $(document).ready(function(){
    $('.host_det_btn').click(function(){
 $('#tabFill').load('host_details.php',{'host_id':this.name});
});
    });

  
</script>
<style>
 
</style>
</head>
<body >
  

  
  <table class="table">
    <thead>
      <tr>
        <th>Hosted By</th>
        <th>Game</th>
        <th>Level</th>
        <th>Area</th>
        <th>Date</th>
        <th>Time-Zone</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
    <?php 
session_start();
$user_id=$_SESSION['user_id'];
  $gender=$_SESSION['gender'];
$servername = "localhost";
     $username = "root";
     $password = "";
     $dbname="playzonedb";
     $conn = new mysqli($servername, $username, $password,$dbname);
     if ($conn->connect_error) {
         die("Connection failed:" . $conn->connect_error); }
         else
         {
        $result1=$conn->query("select * from host_details where (gen_pref='$gender' or gen_pref='dc') and game_end='no'");
        if ($result1->num_rows > 0) {
          while($row1 = $result1->fetch_assoc()) {
            $host_id=$row1['host_id'];
        $usr_id = $row1['user_id'];
        $sport_id = $row1['sport_id']; 
$host_date = $row1['host_date'];	
$time_zone = $row1['time_zone'];
$host_location = $row1['host_location'];
$sld_id=$row1['sld_id'];
$result2=$conn->query("select first_name,last_name,dp from user_details where user_id=$usr_id");
if ($result2->num_rows > 0) 
  while($row2 = $result2->fetch_assoc()) 
  {
    $name=$row2['first_name']." ".$row2['last_name'];
    $dp_loc=$row2['dp'];
  }

  $result3=$conn->query("select sport_name from sport_details where sport_id=$sport_id");
  if ($result3->num_rows > 0) 
    while($row3 = $result3->fetch_assoc()) 
   $sport_name=$row3['sport_name'];

   
  $result4=$conn->query("select level_name from sports_levels_details where sld_id=$sld_id");
  if ($result4->num_rows > 0) 
    while($row4 = $result4->fetch_assoc()) 
   $level_name=$row4['level_name'];
      if($user_id!=$usr_id)
      {
    echo '<tr>'; 
      echo "<form action='host_details.php' >";    
      echo "<td style='vertical-align:middle;'><center> <img src='$dp_loc' width='30%' class='img-circle img-responsive'></center> <figcaption>$name</figcaption>  </figure> </td>";
      echo "<td style='vertical-align:middle;'>$sport_name</td>";
      echo "<td style='vertical-align:middle;'> $level_name</td>";
      echo "<td style='vertical-align:middle;'>$host_location</td>";
      echo "<td style='vertical-align:middle;'>$host_date</td>";
      echo "<td style='vertical-align:middle;'>$time_zone</td>";
      echo "<td style='vertical-align:middle;'> <button class='btn btn-success btn-sm host_det_btn' name='$host_id'>More details</button></td>";
          echo '</tr>'; 
      }
        }
    
      
    }
        }
     $conn->close();
    
    
    ?>

    </tbody>
  </table>
</body>
</html>



