<html>
  <script>
    <?php
session_start();

if(isset($_POST['account_pass']))
{
  

$uname=$_SESSION['username'];
$user_id=$_SESSION['user_id'];
$old_pass=$_POST['old_pass'];
$new_pass=$_POST['new_pass'];

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
   $result1=$conn->query("select * from login_details where user_id=$user_id and username='$uname' and password='$old_pass' ");   
   if ($result1->num_rows > 0) {
    $result2=$conn->query("update login_details SET password='$new_pass' where user_id=$user_id and username='$uname' and password='$old_pass'  ");  
   if($result2) {
    echo " alert('Password Changed'); window.location.href='home.php'; ";
    
  }
}
else
{
  echo " alert('Current password is incorrect!'); window.location.href='home.php'; ";
  
}
   }       
$conn->close();
}
?>
</script>

</html>
