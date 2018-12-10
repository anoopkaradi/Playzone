<?php 
session_start();
?>

<html>
<head>
<script type="text/javascript">
   function initAutocomplete() {
      autocomplete = new google.maps.places.Autocomplete((document.getElementById('autocomplete')),{types:['geocode']});
      autocomplete.addListener('place_changed', fillInAddress);
    }

    function fillInAddress() 
    {
      var place = autocomplete.getPlace();
    }

function validate()
{
            var TxtDate = document.getElementById("doh").value;
            var date1 = new Date(TxtDate);
            var date2 = new Date();   
            if (date1<date2){
            alert('Select future date');
                return;
            }
            document.getElementById('host_sub').click();
}
$(document).ready(function(){
    $('.delete_host').click(function(){
      if(confirm('Are you sure?')){
 $('#tabFill').load('delete_hosted_game.php',{'host_id':this.name});
}});
    });
</script>
<style>
#host_sub{
  display:none;
}


input[type=text],
    input[type=password],input[type=date],textarea,select {
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
	
	
	/* The container */
.container {
    display: block;
    position: relative;
    padding-left: 28px;
    margin-bottom: 10px;
    cursor: pointer;
    font-size: 18px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}

/* Hide the browser's default radio button */
.container input {
    position: absolute;
    opacity: 0;
}

/* Create a custom radio button */
.checkmark {
    position: absolute;
    top: 0;
    left: 0;
    height: 25px;
    width: 25px;
    background-color: #eee;
    border-radius: 50%;
}

/* On mouse-over, add a grey background color */
.container:hover input ~ .checkmark {
    background-color: green;
}

/* When the radio button is checked, add a blue background */
.container input:checked ~ .checkmark {
    background-color: green;
}

/* Create the indicator (the dot/circle - hidden when not checked) */
.checkmark:after {
    content: "";
    position: absolute;
    display: none;
}

/* Show the indicator (dot/circle) when checked */
.container input:checked ~ .checkmark:after {
    display: block;
}

/* Style the indicator (dot/circle) */
.container .checkmark:after {
 	top: 9px;
	left: 9px;
	width: 8px;
	height: 8px;
	border-radius: 50%;
	background: white;
	
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

.host{
    width: 320px;
    padding: 10px;
    border: 5px solid gray;
    margin: 0;
}
</style>
</head>
<body>
  <div>
  <form action="host_game.php" method="post" enctype="multipart/form-data">
  <div style="overflow-x:auto;">
  <table>
  <tr colspan="2">
  <div id="host">
  <h1><b>Host game</b></h1></div>
  </tr>
  <tr>
  <td>
  <h3> Select game :</h3>
  </td>
  <td>
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
                   $result1=$conn->query("select * from user_sport_details where user_id='$user_id'");
                   if ($result1->num_rows > 0) 
                   {
                  echo   "<select name='host_sport' required>";
                  echo "<option value=''></option>";
                  while($row1 = $result1->fetch_assoc()) {
                    $sport_id=$row1['sport_id'];
                      $result2=$conn->query("select * from sport_details where sport_id=$sport_id");
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
?>
</td>
</tr>
<!--<tr colspan="2">
  <h2><u>*rate yourself first in other games to host them*</u></h2>
  
</tr>-->
<tr>
<td>
<h3> Date :<h3></td><td> <input type='date'id="doh" name='host_date' required></td>

</tr>
<tr><td>
<h3>Select time zone :</h3></td><td>
<label class="container">Morning (5 AM to 10 AM) 
  <input type="radio" checked="checked" name="time_zone" value="Morning" required>
  <span class="checkmark"></span>
</label>
<label class="container">Day (10 AM to 4 PM) 
  <input type="radio" name="time_zone" value="Day" required>
  <span class="checkmark"></span>
</label>
<label class="container">Evening (4 PM to 8 PM)
  <input type="radio" name="time_zone" value="Evening" required>
  <span class="checkmark"></span>
</label>
<label class="container">Night (8 PM to 12 AM)
  <input type="radio" name="time_zone" value="Night" required>
  <span class="checkmark"></span>
</label></td></tr>
<tr>
<td>
<h3>Gender preference :</h3></td><td>
<label class="container">Male
  <input type="radio" checked="checked" name="gen_pref" value="m" required>
  <span class="checkmark"></span>
</label>
<label class="container">Female
  <input type="radio" name="gen_pref" value="f" required>
  <span class="checkmark"></span>
</label>
<label class="container">Don't care
  <input type="radio"  name="gen_pref" value="dc" required>
  <span class="checkmark"></span>
</label></td></tr>
<tr>
<td>     
<h3>Host location:</h3></td><td><input id="autocomplete" placeholder="Enter your locality"  name="host_location" type="text" required></input>
          </p></td></tr>
<tr><td>
<h3> Game info : </h3></td><td><textarea name="add_info" placeholder="Additional information (optional)" ></textarea></p></td></tr>

</table>
</div>
<button type="button" onclick="validate();">Host Game</button>
<button id="host_sub" type="submit" name="host_sub">Host game</button>


</form>
	</div>
  
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBOkVHW-16X6X4gIdoQ05CYFl76OpJOn9U&libraries=places&callback=initAutocomplete" async defer></script>
</body>

</html>



