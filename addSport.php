<?php 
if(isset($_POST['sport_submit']))
{
    session_start();
    
    $user_id=$_SESSION['user_id'];
    $sport_id=$_POST['sport_select'];
    $sld_id=$_POST['level_select'];
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname="playzonedb";
    $conn = new mysqli($servername, $username, $password,$dbname);
    if ($conn->connect_error) {
        die("Connection failed:" . $conn->connect_error); }
        else
        {
       $result0=$conn->query("select * from user_sport_details where sport_id=$sport_id");     
        if($result0->num_rows > 0)
        {
            echo "<html><script> alert('You have already selected this sport!');  window.location.href='home.php'; </script></html>";   
        }
        else{

       $result1=$conn->query("insert into user_sport_details(user_id,sport_id) values($user_id,$sport_id)");
       $result2=$conn->query("select usd_id from user_sport_details where user_id=$user_id and sport_id=$sport_id");
       if ($result2->num_rows > 0) {
       while($row2 = $result2->fetch_assoc()) {
           $usd_id=$row2['usd_id']; 
    }
       $result3=$conn->query("insert into rating_details(usd_id,sld_id) values($usd_id,$sld_id)");
       if ($result1 && $result3)
          {
            echo "<html><script> alert('Done!'); window.location.href='home.php';</script></html>";
            
          }
          else
           {
            echo "<html><script> alert('Error occured'); window.location.href='home.php';  </script></html>";
            
            
        } 
        }  
    }       
    $conn->close();


}
}
?>