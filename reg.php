<?php
$errmsg="";
if(isset($_POST['SubmitReg']))
{
$fname=$_POST['fname'];
$lname=$_POST['lname'];
$gen=$_POST['gen'];
$dob=$_POST['dob'];
$addr=$_POST['loc'];
$phone=$_POST['phone'];
$usr=$_POST['usr'];
$psw=$_POST['psw'];
$secans =$_POST['secans'];
$servername = "localhost";
$username = "root";
$password = "";
$dbname="playzonedb";
$errmsg="";

$target_dir = "uploads/";
$target_file = $target_dir.$usr.".jpeg";
$uploadOk = 1;
// Check if file already exists
if (file_exists($target_file)) {
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["dp"]["tmp_name"], $target_file)) {
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

$conn = new mysqli($servername, $username, $password,$dbname);
if ($conn->connect_error) {
    die("Connection failed:" . $conn->connect_error); }
    $dob=date($dob);
    $insert1=$conn->query("insert into user_details (first_name,last_name,location,phone,sec_ans,dob,gender,dp) values('$fname','$lname','$addr','$phone','$secans','$dob',
    '$gen','$target_file')");
   $result=$conn->query("select max(user_id) as user_id from user_details");
   if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
         $userid=$row["user_id"];
    }
   
} else {
    $errmsg="0 results";
}
$insert2=$conn->query("insert into login_details (user_id,username,password) values($userid,'$usr','$psw')");
if($insert1 && $insert2)
    $errmsg="Registered!";
    else
$errmsg="Invalid data entered!";
$conn->close();
$_POST['fname']="";
$_POST['lname']="";
$_POST['gen']="";
$_POST['dob']="";
$_POST['loc']="";
$_POST['phone']="";
$_POST['usr']="";
$_POST['psw']="";
$_POST['secans']="";
}

?>

<html>
<script type="text/javascript">
function load()
{
    alert("Registered");
    window.location.href='MainPage.php';
}
</script>
<body onload="load()"> </body>
</html>