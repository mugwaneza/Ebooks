
<?php
  ob_start();
  session_start();

  if( isset($_SESSION['admin'])!="" ){
    header("Location:register_newbook.php");
   }
 include_once 'dbconnect.php';
  

   $error = false;
  
  if( isset($_POST['btn-login']) ) {  
    

    $username = trim($_POST['username']); 
    $password = trim($_POST['password']);
    
    if(empty($username)){
      $error = true;
      $emailError = "Please enter your user name address.";
    }

  if (!$error) {
      
    
   $res=mysqli_query($conn, "SELECT id, username, password FROM admin_account WHERE username='$username'");

    if($res === FALSE) { 
         die(mysqli_error()); 

             }

       $row=mysqli_fetch_array($res);
       $count = mysqli_num_rows($res); 

 if( $count == 1 && $row['password']==$password)  {
        $_SESSION['admin'] = $row['id'];
        header("Location: register_newbook.php");

      } 

      else {
            $errTyp = "warning";
        $errMSG = "Incorrect Credentials, Try again...";
      }
        
    }
    
  }
      
    
  
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Admin account</title>
 <!--  
    Stylesheets
    =============================================
    
    -->
    <!-- Default stylesheets-->
   <link href="assets/lib/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Template specific stylesheets--> 
    <link href="assets/lib/components-font-awesome/css/font-awesome.min.css" rel="stylesheet">
   </head>

<body class="">
  <div class="container">
    <div class="card card-register mx-auto  col-md-8">
      <br><br><br><br>
      <div class="well col-md-offset-5 ">  
    <p class="text-success col-md-offset-4 "><b>Admin login page</b></p>
     <br><br>
     
      <div class="card-body  ">

        <form  class="" method="POST"  action="<?php echo $_SERVER['PHP_SELF']; ?>" autocomplete="off">
              
              <?php
         if ( isset($errMSG) )  { ?>
             <div class="form-group">
              <div class="alert alert-<?php echo ($errTyp=="success") ? "success" : $errTyp; ?>">
              <span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
            </div>
              </div>
         <?php } ?>
             
       
          <div class="form-group">
            <input class="form-control" name="username" id="" type="text" aria-describedby="" placeholder="Enter username" required="true">
          </div>

           <div class="form-group">
            <input class="form-control" name="password" id="" type="password" aria-describedby="" placeholder="Enter Password" required="true">
          </div>
            
             <div class="form-group">
            <input class="btn btn-block btn-success col-md-4" type="submit" name="btn-login" value="Login" > 
             </div>

        </form>
        <br>
        <br>
        <br>
       
      </div>
    </div>
    </div>
  </div>
   <!--  
    JavaScripts
    =============================================
    -->
   <script src="assets/lib/jquery/dist/jquery.js"></script>
<script src="assets/lib/bootstrap/dist/js/bootstrap.min.js"></script>
 <script src="/jquery/jquery.min.js"></script>
</body>

</html>
<?php ob_end_flush(); ?>