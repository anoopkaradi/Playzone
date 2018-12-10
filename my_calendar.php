
<!DOCTYPE html>
<html lang='en'>
<head>
<script>

</script>
</head>
<body>
<div class='container-fluid'>
<?php
session_start(); 
$user_id=$_SESSION['user_id'];
$servername = 'localhost';
     $username = 'root';
     $password = '';
     $dbname='playzonedb';
     $conn = new mysqli($servername, $username, $password,$dbname);
     if ($conn->connect_error) {
         die('Connection failed:' . $conn->connect_error); }
         else
         {
            $result1=$conn->query("select h.host_id,h.user_id as host_guy_id,s.sport_name,h.time_zone,s2.level_name,h.add_info,h.host_location,h.host_date,u.phone,u.first_name,u.last_name,u.dp 
            from host_details h,participant_details p,user_details u,sport_details s,sports_levels_details s2 
            where p.user_id=$user_id and p.host_id=h.host_id and h.user_id=u.user_id and h.sport_id=s.sport_id and s2.sld_id=h.sld_id and h.game_end='no' and p.confirmed='yes';");
            if ($result1->num_rows > 0) 
            {
                while($row1 = $result1->fetch_assoc()) 
                {
                        $host_id = $row1['host_id'];
                        $host_date = $row1['host_date'];	
                        $time_zone = $row1['time_zone'];
                        $host_location = $row1['host_location'];
                        $add_info=$row1['add_info'];
                        $name=$row1['first_name'].' '.$row1['last_name'];
                        $dp_loc=$row1['dp'];
                        $phone=$row1['phone'];
                        $level_name=$row1['level_name'];
                        $sport_name=$row1['sport_name'];
                        echo "<div class='well'>
                        <div class='row'>
                        <div class='col-md-4'>
                        <figure align='left'> <center> <img src='$dp_loc' width='70%' class='img-circle img-responsive'></center> <figcaption>$name</figcaption>  </figure> 
                        </div>
                        <div class='col-md-8'>
                        <h2 align='left'>$sport_name<h2>
                        <h3 class='text-success' align='left'>$level_name</h3>
                        <h4  align='left'><span class='glyphicon glyphicon-map-marker'></span> Playing at $host_location</h4>
                        <h4  align='left'><span class='glyphicon glyphicon-calendar'></span> $host_date</h4>
                        <h4  align='left'><span class='glyphicon glyphicon-time'></span> $time_zone </h4>
                        <h4  align='left'><span class='glyphicon glyphicon-phone'></span> Contact me at <span class='text-info'>$phone</span> to know the exact venue</h4>
                        <h5  align='left'>$add_info</h5>
                        </div>
                        </div>
                        
                        ";
                        
                        $result10=$conn->query("select * from participant_details where host_id=$host_id and confirmed='yes'");
                        if($result10->num_rows > 0)
                        {
                        echo "
                        <hr>
                        <div class='row'>
                        <div class='col-md-12'>
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
                      
                      echo"  <td class='tdparti'><center><img src='$dp_parti' width='50px' class='img-circle img-responsive'></center>                        
                        <br><center>$name_parti</center></td>";
                        
                        }
                        echo "</tr>
                        </table> ";
                        echo "
                        </div>
                        </div>
                        </div>"      ;
                        }
                            }
                            

                }
            
            else
            {
                echo "<div class='well'>
                <h3>You have not joined any hosted games!</h3>
                </div>
                ";
                
            }
        }

     $conn->close();
       
    ?>
</body>
</html>