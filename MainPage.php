
<!DOCTYPE html>
<html lang="en">
<head>
  <title>PlayZone</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500">
  <script type="text/javascript">


  function RegFun(){
            var TxtFname = document.getElementById("fname").value;
            var TxtLname = document.getElementById("lname").value;
            var TxtPhone = document.getElementById("phone").value;
            var TxtDate = document.getElementById("dob").value;    
            var TxtPat = /\w/;
            var NamePat = /^[a-zA-Z]*$/;
            var PhnPat = /^(\+91-|\+91|0)?[9|8|7]\d{9}$/;
            var date1 = new Date(TxtDate);
            var date2 = new Date();         
            if (!NamePat.test(TxtFname)||!NamePat.test(TxtLname)) {
                alert('Invalid Name');
                return;
            }
            if(document.getElementById('male').checked==false && document.getElementById('female').checked==false ){
                alert('Select Gender');
                return;
            }
            if (date1>date2){
            alert('Invalid Date!');
                return;
            }
            if (date2.getFullYear()-date1.getFullYear()<14){
            alert('You must be atleast 14 Years old to register!');
                return;
            }
            if (!PhnPat.test(TxtPhone)) {
                alert('Invalid Phone Number');
                return;
            }
            
            document.getElementById('RegBtn').click();
  }
    function initAutocomplete() {
      autocomplete = new google.maps.places.Autocomplete((document.getElementById('autocomplete')),{types:['geocode']});
      autocomplete.addListener('place_changed', fillInAddress);
    }
    function fillInAddress() {
      var place = autocomplete.getPlace();

    }
  </script>
  <style>
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }
    .pac-container {
      z-index: 100000;
    }
    footer {
            color: white;
            font-family: coalition;
            font-size: 17px;
            margin: 0;
            background-color: #568b3f;

            float: unset;
            left: 0;
            bottom: 0;
            right: 0;
        }
    .carousel-inner img {
      width: 100%;
      margin: auto;
      min-height: 200px;
    }
    .navactive {
      color: #568b3f;

    }
    #close-modal {

      color: #568b3f;
    }
    body {
      background: #1f1e1e
    }
    @media (max-width: 600px) {
      .carousel-caption {
        display: none;
      }

    }

    div.modal-content {
      position: relative;
      bottom: 0;
      right: 0;
      width: 500px;
      border: 3px solid #73AD21;
    }

#mainpage{

  color:white;
}
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
    #RegBtn{
      display:none; 
          }
    
    .s{
      background-color: #4CAF50;
      color: white;
      padding: 14px 20px;
      margin: 8px 0;
      border: none;
      cursor: pointer;
      width: 100%;
    }
    



    .footer {
   position: relative;
   left: 0;
   bottom: 0;
   height:10%;
   width: 100%;
   background-color: black;
   color: white;
   
}

a#h>img:hover {
    opacity:0.5;
   
}


  </style>
</head>
<body>
  <nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">
          <img src="images\logo.png" height="100%">
        </a>
      </div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav">
          <li class="active navactive">
            <a href="home.php">Home</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
    </ol>
    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
      <div class="item active">
        <img src="images\badminton.jpg" alt="Image">
        <div class="carousel-caption">
          <h3>Badminton</h3>
        </div>
      </div>
      <div class="item">
        <img src="images\football.jpg" alt="Image">
        <div class="carousel-caption">
          <h3>Football</h3>
        </div>
      </div>
    </div>
    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
  <br>
  <div>
      <div class="row">
        <div class="col-md-6">
<center>

        <input type="image" src="images\login.png" style="width:30%" data-toggle="modal" data-target="#LoginModal">
        <div class="modal fade" id="LoginModal" role="dialog">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Login</h4>
              </div>
              <div class="modal-body">
                <form action="login.php" method="POST">
                <table align="center">
                  <tr>
                    <td>
                      <label>
                        <b>Username: </b>
                      </label>
                    </td>
                    <td>
                      <input type="text" placeholder="Enter Username" name="LogUsrName" required>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <label>
                        <b>Password: </b>
                      </label>
                    </td>
                    <td>
                      <input type="password" placeholder="Enter Password" name="LogPswd" required>
                    </td>
                  </tr>
                  <tr>
                  <td id="txthint">  </td>
                   </tr>
                  <tr>
                    <td colspan="2" align="center">
                      <button name="SubmitLog" type="submit">Login</button>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="2" align="center">
                      <span class="psw">
                        <a href="forgot_pass.php" onclick="window.open('forgot_pass.php', 'Reset password', 'width=300, height=250'); return false;">Forgot password?</a>
                      </span>
                    </td>
                  </tr>
                </table>
              </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" id="close_modal" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
        <!-- Modal start-->
        <div id="ForgotModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
        <p>Some text in the modal.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<!-- Modal close-->
  </center>
      </div>
      <div class="col-md-6">
      <center>  
      <input type="image" src="images\register.png" style="width:30%" border="0" data-toggle="modal" data-target="#myModal">
        <div class="modal fade" id="myModal" role="dialog" align="center">
          <div class="modal-dialog modal-lg" id="regmodal">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Register</h4>
              </div>
              <div class="modal-body">
                  <form action="reg.php" method="POST" enctype="multipart/form-data" >
                <table align="center">

                  <tr>
                    <td>
                      <label>
                        <b>First Name: </b>
                      </label>
                    </td>
                    <td>
                      
                      <input type="text" placeholder="Enter Firstname" id="fname" name="fname" required>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <label>
                        <b>Last Name: </b>
                      </label>
                    </td>
                    <td>
                      <input type="text" placeholder="Enter Lastname" id="lname" name="lname" required>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <label>
                        <b>Gender: </b>
                      </label>
                    </td>
                    <td>
                   &nbsp&nbsp&nbsp&nbsp
                     <label>Male &nbsp<input type="radio" id="male" name="gen" value="m" required></label>
                     &nbsp&nbsp&nbsp&nbsp
                     <label>Female &nbsp<input type="radio" id="female" name="gen" value="f" required></label>
  
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <label>
                        <b>Date of Birth: </b>
                      </label>
                    </td>
                    <td>
                      <input type="date" placeholder="Select dob" id="dob" name="dob" required>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <label>
                        <b>Phone: </b>
                      </label>
                    </td>
                    <td>
                      <input type="text" placeholder="Enter phone number" id="phone" name="phone" required>
                    </td>
                  </tr>
                  
                
                  <tr>
                    <td>
                      <label>
                        <b>Your location: </b>
                      </label>
                    </td>
                    <td>
                      <input id="autocomplete" placeholder="Enter your locality"  name="loc" type="text" required></input>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <label>
                        <b>Display picture: &nbsp&nbsp</b>
                      </label>
                    </td>
                    <td>
                        <input type="file" id="dp" name="dp" accept="image/jpeg" required>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <label>                 
                        <b>Username: </b>
                      </label>
                    </td>
                    <td>
                      <input type="text" placeholder="Enter Username" id="usr" name="usr" required>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <label>
                        <b>Password: </b>
                      </label>
                    </td>
                    <td>
                      <input type="password" placeholder="Enter Password" id="psw" name="psw" required>
                    </td>
                  </tr>
                  <tr>
                      <td>
                        <label>
                           <b>Your first school name?</b> &nbsp&nbsp&nbsp&nbsp
                        </label>
                      </td>
                      <td>
                      <input type="text" placeholder="Enter your answer" id="secans" name="secans" required>
                      </td>
                    </tr>
                  <tr>
                    <td colspan="2" align="center" >
                      <button type="submit" id="RegBtn" name="SubmitReg" class="s"> Submit</button>
                    </td>
                  </tr>
                </table>
              </form>
                    <button  class="s" onclick="RegFun()"> Register </button>        
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" id="close_modal" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
  </center>  
</div>
  </div>
  <div class="row">
        <div class="col-md-6">
		<center>
		<h4 id="mainpage">Login</h4>
		</center>
  </div>
        <div class="col-md-6">
		<center>
		<h4 id="mainpage">Register</h4>
		</center>
		</div>
  </div>
  </div>
   <!-- <footer class="container-fluid">
   <span> PlayZone &copy;</span> 
  </footer> -->
 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBOkVHW-16X6X4gIdoQ05CYFl76OpJOn9U&libraries=places&callback=initAutocomplete" async defer></script>
 <div class="footer">

 <span>&copy; COPYRIGHT  &nbsp&nbsp &nbsp&nbsp &nbsp&nbsp &nbsp&nbsp&nbsp&nbsp &nbsp&nbsp &nbsp&nbsp &nbsp&nbsp&nbsp&nbsp &nbsp&nbsp &nbsp&nbsp &nbsp&nbsp&nbsp&nbsp &nbsp&nbsp &nbsp&nbsp &nbsp&nbsp&nbsp&nbsp &nbsp&nbsp &nbsp&nbsp &nbsp&nbsp&nbsp&nbsp &nbsp&nbsp &nbsp&nbsp &nbsp&nbsp&nbsp&nbsp &nbsp&nbsp &nbsp&nbsp &nbsp&nbsp&nbsp&nbsp &nbsp&nbsp &nbsp&nbsp &nbsp&nbsp&nbsp&nbsp &nbsp&nbsp &nbsp&nbsp &nbsp&nbsp&nbsp&nbsp &nbsp&nbsp &nbsp&nbsp &nbsp&nbsp&nbsp&nbsp &nbsp&nbsp &nbsp&nbsp &nbsp&nbsp&nbsp&nbsp &nbsp&nbsp &nbsp&nbsp &nbsp&nbsp 
 <a href="facebook.com" class="facebook" id="h"><img src="f.png" height="20" width="20" ></a>&nbsp&nbsp
<a href="twitter.com" class="twitter"  id="h"><img src="t.png" height="20" width="20"></a>&nbsp&nbsp
<a href="" class="in"  id="h"><img src="in.png" height="20" width="20"></a></span>
<a href="youtube.com" class="youtube"  id="h"><img src="y3.png" height="35" width="50"></a>&nbsp&nbsp &nbsp&nbsp&nbsp&nbsp &nbsp&nbsp &nbsp&nbsp &nbsp&nbsp&nbsp&nbsp &nbsp&nbsp &nbsp&nbsp &nbsp&nbsp&nbsp&nbsp &nbsp&nbsp &nbsp&nbsp &nbsp&nbsp&nbsp&nbsp &nbsp&nbsp &nbsp&nbsp &nbsp&nbsp&nbsp&nbsp &nbsp&nbsp &nbsp&nbsp &nbsp&nbsp&nbsp&nbsp &nbsp&nbsp &nbsp&nbsp &nbsp&nbsp&nbsp&nbsp &nbsp&nbsp &nbsp&nbsp &nbsp&nbsp&nbsp&nbsp &nbsp&nbsp &nbsp&nbsp &nbsp&nbsp&nbsp&nbsp &nbsp&nbsp &nbsp&nbsp &nbsp&nbsp 
<a href="" style="color:white;">Privacy Policy</a>&nbsp&nbsp &nbsp&nbsp    <a href="" style="color:white;">Sitemap</a>&nbsp&nbsp &nbsp&nbsp    <a href="" style="color:white;">Support</a>
</span>
</div>
</body>
</html>