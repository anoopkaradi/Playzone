<html>  <script>  <?php
session_start(); 
if (isset($_POST['host_sub'])) {
$uname = $_SESSION['username']; 
$user_id = $_SESSION['user_id']; 
$sport_id = $_POST['host_sport']; 
$host_date = $_POST['host_date']; 	
$time_zone = $_POST['time_zone']; 
$host_location = $_POST['host_location']; 
$gen_pref = $_POST['gen_pref']; 
$add_info = $_POST['add_info']; 

$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "playzonedb"; 

$conn = new mysqli($servername, $username, $password, $dbname); 
if ($conn -> connect_error) {
    die("Connection failed:" . $conn -> connect_error); 
  
  }
    else {
      $result = $conn -> query("select * from user_sport_details where user_id=$user_id and sport_id=$sport_id"); 
      if ($result -> num_rows > 0) {
       while ($row = $result -> fetch_assoc()) {
         $usd_id = $row["usd_id"]; 
      $result2 = $conn -> query("select s2.sport_name,avg(s.points) as points from user_sport_details u,rating_details r,sports_levels_details s,sport_details s2 where u.usd_id=r.usd_id and r.sld_id= s.sld_id and u.sport_id=s2.sport_id and u.usd_id=$usd_id"); 
      if ($result2 -> num_rows > 0) {
        while ($row2 = $result2 -> fetch_assoc()) {
          $points =(int) $row2['points'];  {$result3 = $conn -> query("select sld_id from sports_levels_details where points=$points"); 
          if ($result3 -> num_rows > 0) {
            while ($row3 = $result3 -> fetch_assoc()) {
              $sld_id = $row3['sld_id']; 
            }
          }
        }
      
      }
    }
}

$result4 = $conn -> query("insert into host_details(user_id,sport_id,host_date,time_zone,host_location,gen_pref,add_info,sld_id,game_end) values($user_id,$sport_id,'$host_date','$time_zone','$host_location','$gen_pref','$add_info',$sld_id,'no')"); 
if ($result4) {
  $result6=$conn->query("select max(host_id) as host_id from host_details"); 
  if ($result6 -> num_rows > 0) {
   while ($row6 = $result6 -> fetch_assoc()) {
$host_id=$row6['host_id'];
  $result5 = $conn -> query("insert into participant_details(host_id,user_id,confirmed) values($host_id,$user_id,'yes')"); 
 if($result5)
  echo "alert('Game hosted successfully!'); window.location.href='home.php';"; 
}
  }
}
else
echo " alert('Error hosting game!'); window.location.href='home.php'; "; 
      }
      else {
  echo " alert('Error hosting game!'); window.location.href='home.php'; "; 
  
}
  
  }
$conn -> close(); 
}?>  </script>  </html> 
