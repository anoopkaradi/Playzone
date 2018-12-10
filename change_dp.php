<html>
  <script>
<?php
session_start();
if(isset($_POST['account_dp']))
{
$username=$_SESSION['username'];
$user_id=$_SESSION['user_id'];
$target_dir = "uploads/";
$target_file = $target_dir.$username.".jpeg";
$uploadOk = 1;
if(file_exists($target_file))
 unlink($target_file);
 
if (move_uploaded_file($_FILES['dp']['tmp_name'], $target_file))
    {
   echo " alert('Image Uploaded!'); window.location.href='home.php'; ";
        }
    else 
    {
       echo "alert('Error uploading image!'); window.location.href='home.php'; ";
       
}
}
?>
</script>

</html>
