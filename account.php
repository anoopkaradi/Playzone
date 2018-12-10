<?php 
session_start();
?>

<html>
    <head>

<script type='text/javascript' >
function show_pass(ele)
{
    if(document.getElementById('old_pass').type=='password')
    {
    document.getElementById('old_pass').type='text';
    document.getElementById('new_pass').type='text';
    ele.innerHTML='Hide Password';
    }
    else if(document.getElementById('old_pass').type=='text')
    {            document.getElementById('old_pass').type='password';
        document.getElementById('new_pass').type='password';
        ele.innerHTML='Show Password';
    }
}
    </script>
    <style>
    input[type=text],
    input[type=password],input[type=date],select{
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
<body>

<table>
<tr colspan="2">
<h1><b>Account Details </b></h1></tr>
<tr><td>
<h3>Select display picture:</h3> </td><td>
<form action="change_dp.php" method="post" enctype="multipart/form-data">

<input syle="align:left;" type="file" id="dp" name="dp" accept="image/jpeg" required> 
<button syle="align:left;" type='submit' name='account_dp'> Change display picture </button>    
</form>
</td></tr>
<tr><td><h3>Change Password:</h3> </td>
<td>
<form action="change_pass.php" method="post" enctype="multipart/form-data">
<h3>Old Password:</h3> <input syle="align:left;" id="old_pass" type="password"  name="old_pass" required>
<h3>New Password:</h3>  <input syle="align:left;" id="new_pass" type="password"  name="new_pass" required>
<button type="button" id="btn_pass" onclick="show_pass(this);" >Show password </button>
<button  type='submit' name='account_pass'> Reset Password </button>  </td></tr>  
</form>
</table>
<h1> <b>Add Games</b> </h1>
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
   
           
</body>
</html>