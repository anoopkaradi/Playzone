<html>
    <?php
$user_id=$_COOKIE['user_id'];
$new_pass=$_POST['pass1'];
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
    $result2=$conn->query("update login_details SET password='$new_pass' where user_id=$user_id ");  
   if($result2) {
    echo "<script> alert('Password reset successfully!'); window.close();</script>";
  }

else
{
    echo "<script> alert('Password not reset!'); window.close();</script>"; 
}
   }       
$conn->close();

?>

</html>
