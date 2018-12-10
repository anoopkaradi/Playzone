<?php 
session_start();
?>


<!DOCTYPE html>
<html lang='en'>
<head>

<script>

$(document).ready(function(){
    $('.confirm_player_btn').click(function(){
      if(confirm('Are you sure?')){
 $('#tabFill').load('confirm_player.php',{'pd_id':this.name});
}});
    });

    $(document).ready(function(){
    $('.delete_player_btn').click(function(){
      if(confirm('Are you sure?')){
 $('#tabFill').load('delete_player.php',{'pd_id':this.name});
}});
    });


    $(document).ready(function(){
    $('.delete_host').click(function(){
      if(confirm('Are you sure?')){
 $('#tabFill').load('delete_hosted_game.php',{'host_id':this.name});
}});
    });

    $(document).ready(function(){
    $('.end_game_btn').click(function(){
      if(confirm('Are you sure?')){
 $('#tabFill').load('end_game.php',{'host_id':this.name});
}});
    });

</script>
<style>

.parti
{
  table-layout:fixed;
  margin:2px;
  }
.tdparti{width:1px;white-space:nowrap;}
</style>
</head>
<body>

<div class='container-fluid' style='overflow-y: auto; height:600px;'>
<h2>Manage your games</h2>

<?php 
    $user_id=$_SESSION['user_id'];
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname='playzonedb';
    $conn = new mysqli($servername, $username, $password,$dbname);
     if ($conn->connect_error) {      die('Connection failed:' . $conn->connect_error); 
        }
         else
         {
            $result1=$conn->query("select * from host_details where user_id=$user_id and game_end='no'");
            if ($result1->num_rows > 0) {
              while($row1 = $result1->fetch_assoc()) {
                echo "<div class='well'>
                <div class='row'>";
                $host_id=$row1['host_id'];
                $usr_id = $row1['user_id'];
                $sport_id = $row1['sport_id']; 
                $host_date = $row1['host_date'];	
                $time_zone = $row1['time_zone'];
                $host_location = $row1['host_location'];
                $sld_id=$row1['sld_id'];
                $add_info=$row1['add_info'];
                $result2=$conn->query("select first_name,last_name,dp from user_details where user_id=$usr_id");
                    if($result2->num_rows > 0) 
                      while($row2 = $result2->fetch_assoc()) 
                      {
                        $name=$row2['first_name'].' '.$row2['last_name'];
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
                      echo "
                      <div class='col-md-6'>
                      <h1 align='left'>$sport_name<h1><h3 class='text-success' align='left'>$level_name</h3>
                      <h4 align='left'><span class='glyphicon glyphicon-map-marker'></span> Playing at $host_location </h4>
                      <h4 align='left'><span class='glyphicon glyphicon-calendar'></span> $host_date </h4>
                      <h4 align='left'><span class='glyphicon glyphicon-time'></span>  $time_zone </h4>
                      <h5  align='left'> $add_info </h5>
                      <button align='left' class='btn btn-danger delete_host' name='$host_id'>Cancel event</button>
                      </form>
                      <button align='left' class='btn btn-warning end_game_btn' name='$host_id'>End the game</button>
                      </div>";
$result5=$conn->query("select * from participant_details where host_id=$host_id and confirmed='no'");
if($result5->num_rows > 0)
{
  echo " 
   <div class='col-md-6' style='overflow-y:auto; height:auto;'>
   <h3 align='left'>Pending Requests</h3>
   <table class='table'>
   <thead>
   <th>Player</p>
   <th>Level</p>
   <th> </th>
   </thead>
   <tbody>
   ";
while($row5=$result5->fetch_assoc())
{   
    $pd_id=$row5['pd_id'];
   $parti_id=$row5['user_id'];
   $result6=$conn->query("select * from user_details where user_id=$parti_id ");
   if($result6->num_rows > 0)
   {
   while($row6 = $result6->fetch_assoc())
   {
    $name_parti=$row6['first_name']." ".$row6['last_name']; 
    $dp_parti=$row6['dp'];
   }
   $result7 = $conn -> query("select * from user_sport_details where user_id=$parti_id and sport_id=$sport_id"); 
   if ($result7 -> num_rows > 0) {
    while ($row7 = $result7 -> fetch_assoc()) {
      $parti_usd_id = $row7["usd_id"]; 
   $result8 = $conn -> query("select avg(s.points) as points from user_sport_details u,rating_details r,sports_levels_details s,sport_details s2 where u.usd_id=r.usd_id and r.sld_id= s.sld_id and u.sport_id=s2.sport_id and u.usd_id=$parti_usd_id"); 
   if ($result8 -> num_rows > 0) {
     while ($row8 = $result8 -> fetch_assoc()) {
       $points = (int)$row8['points'];  {
         $result9 = $conn -> query("select level_name from sports_levels_details where points=$points"); 
       if ($result9 -> num_rows > 0) {
         while ($row9 = $result9 -> fetch_assoc()) {
           $parti_sport_level = $row9['level_name']; 
         }
       }
     }
   }
 }
}

  echo "<tr>
   <td><figure><center><img src='$dp_parti' width='30%' class='img-circle img-responsive'></center><figcaption>$name_parti</figcaption></figure></td>
   <td style='vertical-align:middle;'>$parti_sport_level</td>
   <td> 
   <button name='$pd_id' class='btn btn-sm btn-success confirm_player_btn'>  <span class='glyphicon glyphicon-ok'></span> </button> &nbsp&nbsp <button name='$pd_id' class='btn btn-sm btn-danger delete_player_btn'>  <span class='glyphicon glyphicon-remove'></span> </button> </td>
   </tr>";
  }
}
}
   echo "
   </tbody>
   </table>
   </div>
   <hr>
   ";
}
else
{
echo "<h3>No pending participant requests</h3>";

}

   echo "
  
   
   </div>
   <hr>
   ";

echo "
<div class='row'>
<div class='col-md-12'>
<h4 align='left'>Playing: </h4>";
echo " <table class='parti' align='left' style='overflow:auto;'>
 <tr>";
$result10=$conn->query("select * from participant_details where host_id=$host_id and confirmed='yes'");
if($result10->num_rows > 0)
{
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
 echo "
 <td class='tdparti'><center><img src='$dp_parti' width='50px' class='img-circle img-responsive'></center><br>
 <center>$name_parti</center></td>";
 }
}
echo "</tr>
 </table> ";

echo "
</div>
</div>
</div>";

  }
    }
    else
    {
      echo "<h2>You have not hosted any games!</h2>";
    }
        }
     $conn->close();
      ?>
</div>
</body>
</html>