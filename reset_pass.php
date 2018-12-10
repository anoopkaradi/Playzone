<html>
<head>
<title> Reset your password </title>
<style>

input[type=text],
    input[type=password],input[type=date] {
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

</style>

<script>


 </script>
<?php
if(count($_COOKIE) > 0) {
$user_id=$_COOKIE['user_id'];
$sec_ans=$_POST['sec_ans'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname="playzonedb";

$conn = new mysqli($servername, $username, $password,$dbname);
if ($conn->connect_error) {
    die("Connection failed:" . $conn->connect_error); 
  
  }
   
    else
    {  
   $result1=$conn->query("select * from user_details where user_id=$user_id and sec_ans='$sec_ans'");   
   if ($result1->num_rows > 0) {
    while($row1=$result1->fetch_assoc())
    {
       
    }

  }
  else{
echo "<script> alert('Invalid school name!'); window.close();</script>";

  }
}
       
$conn->close();
}
?>
</head>
<form method='post' action='reset_pass2.php'>
<input type="password" name='pass1' id='pass1' placeholder="New password">
<button type="submit" id="resetp" >Reset</button>
</form>
</html>
