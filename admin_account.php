<?php  

  ob_start();
  session_start();
  include_once 'dbconnect.php';
 
 // select loggedin users detail
  $res=mysqli_query($conn, "SELECT * FROM admin_account WHERE id=".$_SESSION['admin']);
  $userRow=mysqli_fetch_array($res);

  if( !isset($_SESSION['admin']) ) {
    header("Location: login_admin.php");
    exit;
  }

  if ( isset($_POST['btn-signup']) ){

  $fullname = $_POST['admin_fullname']; 
  $username = $_POST['username'];
  $password = $_POST['password'];
  $phone =$_POST['phone_number'];
  $address = $_POST['address'];
 
  // check whever visa card already exists

 $result="SELECT * FROM admin_account where username='$username'";
  $user =mysqli_fetch_array($result);

 if ($user) {
    $errTyp = "warning";
     $errMSG = "Sorry the username : already taken , try another one"; 
    }
    else{
 $query ="INSERT INTO admin_account
 (
 admin_fullname,
 username,
 password,
 phone_number,
 address)
 VALUES(
 '$fullname',
 '$username',
 '$password',
 '$phone',
 '$address'
  )";
 $res = mysqli_query($conn, $query);
        
      if ($res) {
        $errTyp = "success";
        $errMSG = "Successfully registered";
       unset($address);
       unset($fullname);   
       } else {
        $errTyp = "danger";
        $errMSG = "Something went wrong, try again later...".mysql_error(); 
      }      
        }
    }

?>


<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8"> 
 <link href="assets/lib/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
  <nav class="navbar  navbar-fixed-top " style="background-color: #A4C639;">
      <div class="container">
        <div class="navbar-header ">
          <button type="button" class="navbar-toggle collapsed " data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="register_newbook.php" style="color: #fff;">Home</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
           
            <li><a href="user_visaccount_registration.php">New Visa account</a></li>
            <li><a href="admin_account.php">New admin account</a></li>
            <li><a href="report.php">Report</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
        <span class="glyphicon glyphicon-user"></span>&nbsp; 
         &nbsp;<span class="caret"></span></a>
               <ul class="dropdown-menu"> 
                 <li><a href=" "><span class=""></span>&nbsp;
              <?php echo $userRow['admin_fullname']; ?>
                 </a></li> 

                 <li><a href="signout_admin.php?logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Sign Out</a></li> 
              </ul>
            </li>
          </ul>
        </div>  <!--/.nav-collapse -->
      </div>
    </nav> 




  <div id="wrapper">

  <div class="container ">
    
      <div class="page-header text-primary row mt-3">
      <h3 class="col-md-offset-4">Admins account registration</h3>
      </div>
        
        <div class="row">
        <div class="col-lg-8 col-lg-offset-2">

  <div id="login-form">

 <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" autocomplete="off">
  
  <?php if(isset($errMSG))  { ?>
             <div class="form-group">
              <div class="alert alert-<?php echo ($errTyp=="success") ? "success" : $errTyp; ?>">
              <span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
            </div>
              </div>
         <?php } ?>
      <div class="col-md-12" style="color: white;">
  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" autocomplete="off">
  

        <div class="form-group " hidden="true" >
              <div class="alert alert-  "primary>
        <span class="glyphicon glyphicon-info-sign"> 
                </div>
              </div>
   
            
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span> </span>
              <input type="text" name="admin_fullname" class="form-control" placeholder="Enter full name" maxlength="50" value="" required="true"/>
                </div>
                <span class="text-primary">    </span>
            </div>
            
            
             
              <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span> </span>
              <input type="text" name="username" id="usern" class="form-control" placeholder="Enter admin user name" maxlength="50" value="" required="true"/>
                </div>
                <span class="text-primary">    </span>
               </div>

             
            
                <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span> </span>
              <input type="password" name="password" class="form-control" id="pass" placeholder="Enter admin password" maxlength="50" value="" required="true" />
                </div>
                <span class="text-primary">    </span>
               </div>


           <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-briefcase"></span> </span>
      <input type="text" name="address" class="form-control" id="addr" placeholder="Enter admin address" maxlength="50" value="" required="true" />
                </div>
                <span class="text-primary">    </span>
               </div> 



           <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-phone"></span> </span>
         <input type="number" name="phone_number" class="form-control" id="phon" placeholder="Enter admin phone number" maxlength="50" value="" required="true" />
                </div>
                <span class="text-primary">    </span>
               </div> 
               <br>          
            
            <div class="form-group">
              <button type="submit" class="col-md-4 col-md-offset-4 btn" style="background: black;color: white;" name="btn-signup">Register</button>
            </div>
            
          
        
        
        </div>
   
    </form>
</div>

        </div>
        </div>
    
    </div>
    
    </div>
    
<script src="assets/lib/jquery/dist/jquery.js"></script>
<script src="assets/lib/bootstrap/dist/js/bootstrap.min.js"></script>
 <script src="/jquery/jquery.min.js"></script>
    
</body>
</html>
