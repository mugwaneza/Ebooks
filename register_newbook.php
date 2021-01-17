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

 $admin = $_POST['admin_id']; 
 $bookname = $_POST['book_name'];
 $bookcat =$_POST['book_category'];
 $bookprice = $_POST['book_price'];
 $bookquantity =$_POST['books_quantity'];

// save blob image to mysql

  $photo = addslashes(file_get_contents($_FILES['photo']['tmp_name']));
  $photo2 = addslashes(file_get_contents($_FILES['photo2']['tmp_name']));

  $photo2 = $_FILES['photo2'];


   $bookDesc = $_POST['book_description'];
   $author = $_POST['book_author'];

   $query ="INSERT INTO books_store
  (
 admin_id,
 book_name,
 book_category,
 book_price,
 books_quantity,
 book_front_image,
 book_back_image,
 book_description,
 book_author
)
 VALUES(
 '$admin',
 '$bookname',
 '$bookcat',
 '$bookprice',
 '$bookquantity',
 '$photo',
 '$photo2',
 '$bookDesc',
 '$author'
  )";
 $res = mysqli_query($conn, $query);
        
      if ($res) {
        $errTyp = "success";
        $errMSG = "Book successfully registered";
       unset($admin);
       unset($bookname);
       unset($bookcat);
       unset($bookprice);
       unset($bookquantity);   
       unset($photo);   
       unset($photo2);   
       unset($bookDesc);   
       unset($author);   
       } else {
        $errTyp = "danger";
        $errMSG = "Something went wrong, try again later...".mysqli_error(); 
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
           <a class="navbar-brand" href="register_newbook.php" style="color: #fff;">New book</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
   
            <li>
              <a href="user_visaccount_registration.php">New Visa account</a></li>
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
              
        <div class="page-header text-warning row mt-3">
                <h3 class="col-md-offset-5">Books registration</h3>
                </div>
                  
                  <div class="row">
                  <div class="col-lg-8 col-lg-offset-2 ">

            <div id="login-form" style="margin-bottom: 70%;">

   <form  method="POST" enctype="multipart/form-data"  action="<?php echo $_SERVER['PHP_SELF']; ?>" autocomplete="off">
   <?php if(isset($errMSG)) { ?>
             <div class="form-group">
              <div class="alert alert-<?php echo ($errTyp=="success") ? "success" : $errTyp; ?>">
              <span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
            </div>
              </div>
         <?php } ?>

      
      <div class="col-md-12" style="color: white;">
 
        <div class="form-group " hidden="true" >
              <div class="warning warning-  "warning>
        <span class="glyphicon glyphicon-info-sign"> 
                </div>
              </div>
   
            
            <div class="form-group"  hidden>
              <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon"></span> </span>
              <input type="text" name="admin_id" class="form-control" placeholder="id" maxlength="50" value="<?php echo $userRow['id'] ?>" id="id" required="true" />
                </div>
                <span class="text-danger"> </span>
            </div>

             <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-book"></span> </span>
              <input type="text" name="book_name" class="form-control" placeholder="Enter Book Name" maxlength="50" value="" id="name"  required="true"/>
                </div>
                <span class="text-danger">    </span>
            </div>
            
            
             
              <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">Rwf </span>
          <input type="number" name="book_price" class="form-control" placeholder="Enter price per book" maxlength="50" value="" id="price" required="true"/>
                </div>
                <span class="text-danger">    </span>
               </div>

              <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-folder-close"></span> </span>
              <select   name="book_category" 
              class="form-control" required="true">
     <option value="">--select book category--</option>
              <option>Politics</option>
              <option>Science</option>
              <option>Travel</option>
              <option>Children</option>
              <option>Computers</option>
             </select> 
                </div>
                <span class="text-danger">    </span>
               </div>

            
                <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-folder-open"></span> </span>
              <input type="number" name="books_quantity" class="form-control" placeholder="Enter books quantity" maxlength="50" value="" id="quantity" required="true"/>
                </div>
                <span class="text-danger">    </span>
               </div>    

           <div class="form-group">
              <div class="input-group " >
                <span class="input-group-addon"  >Book front image </span>
  <input class="form-control" id="jh" type="file" accept="image/*" aria-describedby="" name="photo" placeholder="Front image" required/>
                </div>              
                <span class="text-danger">    </span>
               </div> 


     <div class="form-group">
              <div class="input-group " >
        <span class="input-group-addon"  >Book back image </span>
      <input type="file" name="photo2" id="" class="form-control" placeholder="Back image" accept="image/*"  value="" required="true" />
                </div>
                <span class="text-danger">    </span>
               </div>

               <br>          
            

           <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span> </span>
              <input type="text" name="book_description" class="form-control" placeholder="Book description " maxlength="" value="" id="description"  required="true"/>
                </div>
                <span class="text-danger">    </span>
               </div>      

                <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span> </span>
          <input type="text" name="book_author" class="form-control" placeholder="Book author" maxlength="50" value=""  id="author" required="true" />
                </div>
                <span class="text-danger">    </span>
               </div>


            <div class="form-group">
              <button type="submit" class="col-md-4 col-md-offset-4 btn btn-warning" name="btn-signup">Submit</button>
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
