
<?php
  ob_start();
  session_start();


 if( isset($_SESSION['user'])!="" ){
    header("Location:signinuser.php");
     }

 include_once 'dbconnect.php';

 if (isset($_POST['btn-save'])){ 

  $clientname = $_POST['client_fullname'];
  $username =$_POST['user_name'];
  $password = $_POST['password'];
  $telephone =$_POST['tel'];
  $email = $_POST['email'];
  $address = $_POST['address'];

  // select logged in users detail
 $res=mysqli_query($conn, "SELECT * FROM client_account WHERE user_name ='$username'");
  $userRow=mysqli_fetch_array($res);

  if ($userRow) {
    $errTyp = "warning";
   $errMSG = "Sorry Username : ".$username." already taken,login / register new";  
    }
    else{
 
   $query ="INSERT INTO client_account(client_fullname,user_name,password,tel,email,address)VALUES('$clientname','$username','$password','$telephone','$email','$password')";
      $res = mysqli_query($conn, $query);    
      if($res) {
     
      $errTyp = "warning";
      $errMSG = "User successfully registered     ".'<a href="signinuser.php">login here</a>';
      // header("Location:signinuser.php"); 

        }
        }   
     }
  ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8"> 

<link rel="stylesheet" href="/css/style.css">

<!-- <link rel="stylesheet" href="/fonts/glyphicons-halflings-regular.wolf">
<link rel="stylesheet" href="/fonts/glyphicons-halflings-regular.eot"> -->

<link href="assets/lib/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Template specific stylesheets-->
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Volkhov:400i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <link href="assets/lib/animate.css/animate.css" rel="stylesheet">
    <link href="assets/lib/components-font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="assets/lib/et-line-font/et-line-font.css" rel="stylesheet">
    <link href="assets/lib/flexslider/flexslider.css" rel="stylesheet">
    <link href="assets/lib/owl.carousel/dist/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="assets/lib/owl.carousel/dist/assets/owl.theme.default.min.css" rel="stylesheet">
    <link href="assets/lib/magnific-popup/dist/magnific-popup.css" rel="stylesheet">
    <link href="assets/lib/simple-text-rotator/simpletextrotator.css" rel="stylesheet">
    <!-- Main stylesheet and color file-->
    <link href="assets/css/style.css" rel="stylesheet">
    <link id="color-scheme" href="assets/css/colors/default.css" rel="stylesheet">


</head>
<body>


  <div id="wrapper">

  <div class="container ">
    
      <div class="page-header text-success">
      <h3 class="col-md-offset-2">Create your own books shoping account</h3>
      </div>
        
        <div class="row">
        <div class="col-lg-8 col-lg-offset-2">

  <div id="login-form">


  <?php if ( isset($errMSG) ) { ?>
   <div class="form-group">
    <div class="alert alert-<?php echo ($errTyp=="success") ? "success" : $errTyp; ?>">
    <span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
            </div>
              </div>
         <?php } ?>

<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" autocomplete="off">
<div class="col-md-12" style="color: white;">
  <div class="form-group " hidden="true" >
    <div class="alert alert-  "success>
        <span class="glyphicon glyphicon-info-sign"> 
                </div>
              </div>
   
            
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span> </span>
              <input type="text" name="client_fullname" class="form-control" placeholder="Enter your full name" maxlength="50" value="" required="true" />
                </div>
                <span class="text-danger"> </span>
            </div>
            
            
             
              <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-eye"></span> </span>
              <input type="text" name="user_name" class="form-control" placeholder="Enter your username" maxlength="50" value="" required="true" />
                </div>
                <span class="text-danger">    </span>
               </div>
                <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span> </span>
              <input type="password" name="password" class="form-control" placeholder="Enter your password" maxlength="50" value=""  required="true"/>
                </div>
                <span class="text-danger">    </span>
               </div>


           <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-signal"></span> </span>
       <input type="number"  name="tel" class="form-control" placeholder="Enter your telephone number" maxlength="50" value=""  required="true" /> 
        </div>
        </div>


       <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-login"></span> </span>
       <input type="email" name="email" class="form-control" placeholder="Enter your email" maxlength="50" value="" required="true"  />
                </div>
                <span class="text-danger">    </span>
               </div> 


               <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-save"></span> </span>
       
        <input type="text" name="address" class="form-control" placeholder="Enter your address" maxlength="50" value=""  required="true" />
                </div>
                <span class="text-danger">    </span>
               </div> <br>  
   <div class="form-group">
<button type="submit" class="col-md-5 col-md-offset-4 btn btn-success" name="btn-save">Register</button>
    </div>

          
           
    </form>

</div>

        </div>
        </div>
    
    </div>
    
    </div>
   
     <script src="assets/lib/jquery/dist/jquery.js"></script>
    <script src="assets/lib/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/lib/wow/dist/wow.js"></script>
    <script src="assets/lib/jquery.mb.ytplayer/dist/jquery.mb.YTPlayer.js"></script>
    <script src="assets/lib/isotope/dist/isotope.pkgd.js"></script>
    <script src="assets/lib/imagesloaded/imagesloaded.pkgd.js"></script>
    <script src="assets/lib/flexslider/jquery.flexslider.js"></script>
    <script src="assets/lib/owl.carousel/dist/owl.carousel.min.js"></script>
    <script src="assets/lib/smoothscroll.js"></script>
    <script src="assets/lib/magnific-popup/dist/jquery.magnific-popup.js"></script>
    <script src="assets/lib/simple-text-rotator/jquery.simple-text-rotator.min.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/main.js"></script>

   <script src="assets/js/custom.js"></script>
    
</body>
</html>
<?php ob_end_flush(); ?>