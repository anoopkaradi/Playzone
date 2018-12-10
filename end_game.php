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
       $result0=$conn->query("select host_date from host_details where host_id=$host_id");
       if ($result0->num_rows > 0)
       {
        $row0=$result0->fetch_assoc();
         $host_date=$row0['host_date'];
        $today = date("Y-m-d");
        $today = new DateTime($today);
        $end_date = new DateTime($host_date);
        if ($today < $end_date)    
            echo "<h3>You can end the game after $host_date !</h3>";
        else
            {
                $result1=$conn->query("update host_details set game_end='yes' where host_id=$host_id");
                if($result1)
                {
                    $result2=$conn->query("select user_id from participant_details where host_id=$host_id and confirmed='yes'");
                    if ($result2->num_rows > 0)
                    {   $pd_id=array();
                        $n=0;
                        while($row2=$result2->fetch_assoc())
                        {   
                            $pd_id[$n]=$row2['user_id'];
                            $n++;
                        }
                        $flag;
                        for($i=0;$i<$n;$i++)
                        {
                            for($j=0;$j<$n;$j++)
                            {
                                $rate_flag="no";
                                $rate_to=$pd_id[$i];
                                $rated_by=$pd_id[$j];
                                if($rate_to!=$rated_by)
                                {
                                    
                                    $result3=$conn->query("insert into rate_player_flag(host_id,rate_to,rated_by,rate_flag) values($host_id,$rate_to,$rated_by,'$rate_flag');");        
                                    if($result3)
                                    {
                                        $test=true;
                                    }
                                    else
                                    { 
                                        $test=false;
                                    }
                                }
                            }
                        }
                        if($test)
                            echo "<h3> You have closed the hosted game!</h3>";
                        else
                        {
                        echo "<h3>Error ending game! $rate_flag, $rate_to, $rated_by </h3>";
                        $result1=$conn->query("update host_details set game_end='no' where host_id=$host_id");
                        }
                                    
                    }                           
                }
            }
       }
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
