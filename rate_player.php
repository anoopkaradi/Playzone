<?php 
 if(isset($_POST['rate_level_select']))
 {
session_start();
$sld_id=$_POST['sld_id'];
$rpf_id=$_POST['rpf_id'];
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
$result0=$conn->query("select u1.usd_id from user_sport_details u1,host_details h,rate_player_flag r where r.rpf_id=$rpf_id and  r.host_id=h.host_id and u1.sport_id=h.sport_id and u1.user_id=r.rate_to");
if($result0->num_rows>0)
{     
    $row0=$result0->fetch_assoc();
    $usd_id=$row0['usd_id'];
    $result1=$conn->query("insert into rating_details(usd_id,sld_id) values($usd_id,$sld_id);");
    if($result1)
    $result3=$conn->query("update rate_player_flag set rate_flag='yes' where rpf_id=$rpf_id");
    if($result3)
    echo "<html><script>window.location.href='home.php';</script></html>";
   else die($conn->error);
    
}
 }
 $conn->close();

 }

?>