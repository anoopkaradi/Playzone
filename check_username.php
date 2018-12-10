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
<?php
$uname=$_POST['username'];
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
   $result1=$conn->query("select * from login_details where username='$uname'");   
   if ($result1->num_rows > 0) {
    while($row1=$result1->fetch_assoc())
    {
        setcookie("user_id", $row1['user_id']);
    }

  }
  else{
echo "<script> alert('Invalid useraname!'); window.location.href='MainPage.php';</script>";

  }
}
       
$conn->close();

?>
</head>
<form method='post' action='reset_pass.php'>
<h3>Your first school name?</h3>
<input type="text" name='sec_ans' placeholder="Your answer">
<button type="submit">Submit</button>
</form>
</html>
