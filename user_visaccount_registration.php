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

  $firstname = $_POST['user_first_name']; 
  $lastname = $_POST['user_last_name'];
  $visa = $_POST['visa_card_number'];
  $amount =$_POST['amount'];
  $code = $_POST['secret_code'];
 
  // check whever visa card already exists

 $result="SELECT * FROM client_visa_account where visa_card_number='$visa'";
  $userVisa=mysqli_fetch_array($result);

 if ($userVisa) {
    $errTyp = "warning";
     $errMSG = "Sorry visa card number: already registered"; 
    }
    else{
 $query ="INSERT INTO client_visa_account
 (
 user_first_name,
 user_last_name,
 visa_card_number,
 amount,
 secret_code)
 VALUES(
 '$firstname',
 '$lastname',
 '$visa',
 '$amount',
 '$code'
  )";
 $res = mysqli_query($conn, $query);
        
      if ($res) {
        $errTyp = "success";
        $errMSG = "Successfully registered";
       unset($firstname);
       unset($lastname);   
       } else {
        $errTyp = "danger";
        $errMSG = "Something went wrong, try again later...".mysqli_error(); 
      }      
        }
    }

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8"> 
<!-- Default stylesheets-->
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
        </div>  <!--/.nav-collapse -->
      </div>
    </nav> 




  <div id="wrapper">

  <div class="container ">
    
      <div class="page-header text-success row mt-3">
    <h3 class="col-md-offset-4 ">Visa registration</h3>
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
 
        <div class="form-group " hidden="true" >
              <div class="alert alert-  "success>
        <span class="glyphicon glyphicon-info-sign"> 
                </div>
              </div>
   
            
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span> </span>
              <input type="text" name="user_first_name" class="form-control" placeholder="Enter First Name" maxlength="50" value="" required="true"/>
                </div>
                <span class="text-danger">    </span>
            </div>
            
            
             
              <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span> </span>
              <input type="text" name="user_last_name" class="form-control" placeholder="Enter Last Name" maxlength="50" value=""  required="true"/>
                </div>
                <span class="text-danger">    </span>
               </div>

             
            
                <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span> </span>
              <input type="number" name="visa_card_number" class="form-control" placeholder="Enter Visa number" maxlength="50" value="" required="true" />
                </div>
                <span class="text-danger">    </span>
               </div>


           <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span> </span>
       <input type="password" pattern="[0-9]*" name="secret_code" class="form-control" placeholder="Enter Visa secret code" maxlength="50" value=""  required="true"  /> 
        </div>
        </div>


       <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-credit-card"></span> </span>
       <input type="number" name="amount" class="form-control" placeholder="Enter visa amount" maxlength="50" value=""  required="true"  />
                </div>
                <span class="text-danger">    </span>
               </div> <br>          
            


            <div class="form-group">
              <button type="submit" class="col-md-4 col-md-offset-4 btn btn-success" name="btn-signup">Create account</button>
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
