<?php 
session_start();
if(isset($_SESSION['user_id']))
{
$age="";
$name="";
$loc="";
$servername = "localhost";
$username = "root";
$password = "";
$user_id=$_SESSION['user_id'];
$dbname="playzonedb";
$conn = new mysqli($servername, $username, $password,$dbname);
if ($conn->connect_error) {
    die("Connection failed:" . $conn->connect_error); }
    else
    {
   $result=$conn->query("select * from user_details where user_id=$user_id");
   if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
         $curimg=$row["dp"]; 
        $name=$row["first_name"]." ".$row["last_name"];
        $age= date('Y')-date('Y',strtotime($row["dob"]));
        $loc=$row['location'];  
      }
    }
    else
        $curimg="images/default.png";
    }         
$conn->close();
  }
  else
  header("location:MainPage.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>PlayZone</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script>
    function load()
    {
document.getElementById('meet_btn').click();
    }

    $(document).ready(function(){
    $('#meet_btn').click(function(){
 $('#tabFill').load('meet.php');
});
    });
    
    $(document).ready(function(){
    $('#account_btn').click(function(){
 $('#tabFill').load('account.php');
});
    }); 

    $(document).ready(function(){
    $('#host_btn').click(function(){
 $('#tabFill').load('host.php');
});
    });

     $(document).ready(function(){
    $('#manage_btn').click(function(){
 $('#tabFill').load('manage.php');
});
    }); 

    $(document).ready(function(){
    $('#calendar_btn').click(function(){
 $('#tabFill').load('my_calendar.php');
});

    }); 

    $(document).ready(function(){
    $('#logout_btn').click(function(){
      if(confirm("Are you sure?"))
      {
 $('#tabFill').load('logout.php');
}});
    }); 

    
  </script>
  <style>
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }
    /* Add a gray background color and some padding to the footer */
    footer {
      background-color: #1d2e16;
    }
    .carousel-inner img {
      width: 100%;
      /* Set width to 100% */
      margin: auto;
      min-height: 200px;
    }

    .navactive {
      color: #568b3f;
    }

    #dp_div {}

    #dp {}

    #close-modal {

      color: #568b3f;
    }

    body {
      background: #edf4f0;
    }

    #gametbl {
      font-size: 25px;
      border-collapse: collapse;
      width: 100%;

    }

    #gametbldiv {
      background: whitesmoke;
      height: 220px;
      width: 100%;
      border-radius: 4px;
      overflow-y: auto;
    }

    .active a {
      background-color: #568b3f;
    }

    #sec1 {
      background-color: #568b3f;
      height: 100%;
    }

    /* Hide the carousel text when the screen is less than 600 pixels wide */

    @media (max-width: 600px) {
      .carousel-caption {
        display: none;
      }
      
      }
    body{
      background-color:#edf4f0;
     

    }

    input[type=text],
    input[type=password],input[type=date] ,select{
      width: 100%;
      padding: 12px 20px;
      margin: 8px 0;
      display: inline-block;
      border: 1px solid #ccc;
      box-sizing: border-box;
    }

  
    button {
      background-color: #4CAF50;
      color: white;
      padding: 14px 20px;
      margin: 8px 0;
      border: none;
      cursor: pointer;
      width: 100%;
    }







    .footer {
   position: fixed;
   left: 0;
   bottom: 0;
   height:10%;
   width: 100%;
   background-color: black;
   color: white;
   
}

a#h>img:hover {
    opacity:0.5;
   
}


table {
    border-collapse: collapse;
    width: 100%;
	table-layout: fixed;
}

th, td {
    padding: 8px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

  </style>
</head>

<body onload='load();'>

  <nav class="navbar navbar-default navbar-inverse">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="home.php">
          <img src="images\logo.png" height="100%">
        </a>
      </div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav navbar-right">
      <li id="logout_btn"><a><span  class="glyphicon glyphicon-log-out"></span> Logout</a></li>
    </ul>
      </div>
  </nav>
  </div>
  <div class="modal fade" id="ChooseGameModal" role="dialog" align="center">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><b>Select sports you play</b></h4>
              </div>
              <div class="modal-body">
                <form action="addSport.php" method="POST">
             <p>
                <?php 
                $servername = "localhost";
                $username = "root";
                $password = "";
                $user_id=$_SESSION['user_id'];
                $dbname="playzonedb";
                $conn = new mysqli($servername, $username, $password,$dbname);
                if ($conn->connect_error) {
                    die("Connection failed:" . $conn->connect_error); }
                    else
                    {
                   $result1=$conn->query("select * from sport_type_details");
                   if ($result1->num_rows > 0) {
                  echo   "<select name='sport_select' required>";
                  echo "<option value=''>Select sport you play</option>";
                      
                  while($row1 = $result1->fetch_assoc()) {
                    $type_id=$row1['type_id'];
                    $type_name=$row1['type_name'];
                    echo "<optgroup label='$type_name'>";
                      $result2=$conn->query("select * from sport_details where type_id=$type_id");
                      if ($result2->num_rows > 0) {
                        
                       while($row2 = $result2->fetch_assoc()) {
                        $sport_id=$row2['sport_id'];
                        $sport_name=$row2['sport_name'];
                        echo "<option value='$sport_id'>$sport_name</option>";
                           }
                        }
                         echo "</optgroup>";
                      }
                      echo "</select>";
                    }
                  }         
                $conn->close();
                ?></p><p>
                <select name="level_select" required>
                <option value="">Rate yourself</option>
                <option value="1">Beginner</option>
                <option value="2">Amateur</option>
                <option value="3">Intermediate</option>
                <option value="4">Advanced</option>
                <option value="5">Professional</option>
                </select>
                </p>
    <button type="submit" name="sport_submit">Submit</button>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" id="close_modal" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
  

  <div class="container-fluid text-center">
    <div class="row content">

      <div class="col-md-3 sidenav" style="bottom:0;" id="sec1">

        <b>
          <label name="LblFrstNme" style="font-size:25px;"> <?php echo $name ?></label>
        </b>
        <div id="dp_div">
          <center>
          <img id='dp' class='img-thumbnail img-responsive img-rounded' src='<?php echo $curimg?>'/>  
		      </center>
        </div>
        <br>
        <div style="font-size:25px;" class="text-left">
            <p>
            <label>Location :</label>
            <span id="loc"> <?php echo $loc ?> </span>
            </p>
            <p>
            <label>Age :</label>
            <span id="loc"> <?php echo $age ?> </span>
            </p>
            <div id="gametbldiv">
                <?php 
                $servername = "localhost";
                $username = "root";
                $password = "";
                $user_id=$_SESSION['user_id'];
                $dbname="playzonedb";
                $conn = new mysqli($servername, $username, $password,$dbname);
                if ($conn->connect_error) {
                    die("Connection failed:" . $conn->connect_error); }
                    else
                    {
                  $result=$conn->query("select * from user_sport_details where user_id=$user_id");
                  if ($result->num_rows > 0) {
                    echo '<table class="table" id="gametbl"><thead><tr><th>Game</th><th>Rating</th></tr></thead><tbody>';
                    while($row = $result->fetch_assoc()) {
                      $usd_id=$row["usd_id"];
                      $sport_id=$row["sport_id"];
                      $result2=$conn->query("select s2.sport_name,avg(s.points) as points from user_sport_details u,rating_details r,sports_levels_details s,sport_details s2 where u.usd_id=r.usd_id and r.sld_id= s.sld_id and u.sport_id=s2.sport_id and u.usd_id=$usd_id");
                      if ($result2->num_rows > 0) {
                        while($row2 = $result2->fetch_assoc()) {
                          $sport_name=$row2['sport_name'];
                          $points=(int)$row2['points'];
                        {  $result3=$conn->query("select level_name from sports_levels_details where points=$points");
                          if ($result3->num_rows > 0) {
                            while($row3 = $result3->fetch_assoc()) {
                              $level_name=$row3['level_name'];
                            }
                          }
                        }
                          echo "<tr><td>$sport_name</td><td>$level_name</td></tr>";
                        }
                      }
                    }
                    echo '</tbody></table>';
                      }
                      else
                      echo '<button data-toggle="modal" data-target="#ChooseGameModal" style="border-radius: 12px;background-color: red;"> Select games you play</button>';
                    }         
                $conn->close();
                ?>
          
            </div>
            <br>
            <br>
        </div>

      </div>
      <div class="col-md-6" >

        <div class="container-fluid">
          <br>
          <ul class="nav nav-tabs">
            <li> <button class="btn btn-success" onclick="loadMeet();" id="meet_btn">Meet</button>
            </li>
            &nbsp;
            <li>
              <button class="btn btn-success" onclick="loadHost();" id="host_btn">Host</button>
            </li>
            &nbsp;
            <li>
              <button class="btn btn-success" onclick="loadManage();" id="manage_btn">Manage</button>
            </li>
            &nbsp;
            <li>
              <button class="btn btn-success" onclick="loadCalendar();" id="calendar_btn">My Calendar</button>
            </li>
            <li>
              <button class="btn btn-success" onclick="loadAccount();" id="account_btn">Account</button>
            </li>
          </ul>
          <br>
          <div id="tabFill" style="height:700px;overflow-y:auto; ">
          </div>
        </div>
      </div>
      
      <div class="col-md-3 sidenav">
   
        <br>
        <h3>Notifcations</h3>
        <?php 
          $servername = "localhost";
          $username = "root";
          $password = "";
          $user_id=$_SESSION['user_id'];
          $dbname="playzonedb";
          $conn = new mysqli($servername, $username, $password,$dbname);
          if ($conn->connect_error) {
              die("Connection failed:" . $conn->connect_error); }
              else
              { 
                $flag=false;
                $result1=$conn->query("select * from host_details where user_id=$user_id and game_end='no'");
                if ($result1->num_rows > 0) {
                  while($row1 = $result1->fetch_assoc())
                  { 
                    $host_id=$row1['host_id'];
                $result4=$conn->query("select * from host_details h,participant_details p where h.host_id=$host_id and h.host_id=p.host_id and confirmed='no';");
                if($result4->num_rows>0)
                {
                  $flag=true;
                echo "
                <div class='well'> 
                <h4>You have pending requests!</h4> 
                </div>
                ";
                break;
                }
                }
              }


                $result5=$conn->query("select r.*,s.sport_name,u.first_name,u.dp from rate_player_flag r,host_details h,sport_details s,user_details u where r.rated_by=$user_id and r.rate_flag='no' and r.host_id=h.host_id and h.sport_id=s.sport_id and r.rate_to=u.user_id ");
                if($result5->num_rows>0)
                {  $flag=true;
                  echo "
                  <hr>
                  <div class='well' style='height:715px;overflow-y:auto;'> 
                  <h4>Pending rating</h4> 
                  <table >
                  <thead>
                  <th>PLAYER</th>
                  <th>GAME</th>
                  </thead>
                  <tbody>
                  ";
                  while($row5=$result5->fetch_assoc())
                {
                  $rate_sport_name=$row5['sport_name'];
                  $rate_name=$row5['first_name'];
                  $rate_dp=$row5['dp'];
                  $rpf_id=$row5['rpf_id'];
                  echo "
                  <tr>
                  <td>
                  <center><img width='30%' src='$rate_dp' class='img img-responsive img-circle'></center><br>
                  <center>$rate_name</center>
                  </td>
                  <td style='vertical-align:middle'>
                  <form action='rate_player.php' method='POST'>
                  <center><p>$rate_sport_name</p> 
                        <center><p><select name='sld_id'  required>
                        <option value=''>Rate player</option>
                  <option value='1'>Beginner</option>
                  <option value='2'>Amateur</option>
                  <option value='3'>Intermediate</option>
                  <option value='4'>Advanced</option>
                  <option value='5'>Professional</option>
                  </select></p></center>
                  <input type='hidden' value='$rpf_id' name='rpf_id'>
                  <button name='rate_level_select' type='submit' class='btn btn-sm btn-success'>  <span class='glyphicon glyphicon-ok'></span> </button>
                  </form>
                  </td></tr>
                  ";


                }

                echo "</tbody>
                <table>

                </div>
                ";
              
                }


            }

            if(!$flag)
            echo "
            <div class='well'> 
            <h4>All caught up!</h4> 
            </div>
            ";
              $conn->close();
        ?>
        </div>
        
      </div>
      
    </div>
    
  </div>
</div>

 
</body>


</html>