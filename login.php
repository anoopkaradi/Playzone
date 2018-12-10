<?php
if(isset($_POST['SubmitLog']))
{
    $uname=$_POST['LogUsrName'];
    $psw=$_POST['LogPswd'];
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname="playzonedb";
    $errmsg="";
    $conn = new mysqli($servername, $username, $password,$dbname);
    if ($conn->connect_error) {
        die("Connection failed:" . $conn->connect_error); }
       $result=$conn->query("select user_id,username from login_details where username='$uname' and password='$psw'");
       if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) 
        {
        session_start();
        $_SESSION['user_id']=$row["user_id"];
        $user_id=$row["user_id"];
        $_SESSION['username']=$row["username"];
        $result1=$conn->query("select gender from user_details where user_id=$user_id");
        if ($result1->num_rows > 0) {
         while($row1 = $result1->fetch_assoc()) 
         $_SESSION['gender']=$row1['gender'];
        }
        echo "<html><script> window.location.href='home.php';  </script></html>";  
        }
    } 
    else {
        echo "<html><script> alert('Invalid Details'); window.location.href='MainPage.php';  </script></html>";
    }
    
    $conn->close();
}
?>
