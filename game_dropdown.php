
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
                  echo   "<select name='sport_select'>";
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
                ?>