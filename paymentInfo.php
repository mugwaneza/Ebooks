<?php 
  ob_start();
  session_start();

  include_once 'dbconnect.php';

  $bookId = $_GET['Bookid'];
  $quantity = $_GET['BookQty'];
  $visa = $_POST['visa_card_number'];
  $secretcode = $_POST['secret_code'];

  // Get current logged in user
  $usersession = $_SESSION['user'];


  // if session is not set this will redirect to login page
  if( !isset($_SESSION['user']) ) {
    header("Location: index.php");
    exit;
  }

  
// get a book to be purchased details
 $selectedRes=mysqli_query($conn, "SELECT id, book_name,book_price,books_quantity,book_front_image,book_back_image,book_description,book_author from books_store where id ='$bookId'"
     );
  $shopRow=mysqli_fetch_array($selectedRes);

  // Calculate amount accoding to selected books
  $purchased_book_number= $quantity;
  $totalprice = $purchased_book_number * $shopRow['book_price'];
  // echo  $paymentfee;

 if ( isset($_POST['btn-pay']) ){

      // check whether visa balance exist  
      // Transanction between user and syatem account  

   $res_visa=mysqli_query($conn, "SELECT * FROM client_visa_account WHERE visa_card_number='$visa'");
  $visaRow=mysqli_fetch_array($res_visa);

 if ($visaRow['visa_card_number'] != $visa) 
    {
   $errTyp = "warning";
   $errMSG = "Visa card does not exists";   
    }
  elseif($visaRow['secret_code'] != $secretcode){
    $errTyp = "warning";
   $errMSG = "Secret code does not match";   
    }
   elseif($shopRow['books_quantity'] < 1){
   $errTyp = "warning";
    $errMSG = "This book is no long available in our store";
    }
  elseif($shopRow['books_quantity'] < $quantity){
  $errTyp = "warning";
  $errMSG = "Only available book quantity are : ".$shopRow['books_quantity'];
     }
   elseif($quantity < 1){
  $errTyp = "warning";
  $errMSG = "Invalid input book quantity";
     }

    else
    {
   // compare visa and  user's balance before  transactions

   if($visaRow['amount'] < $totalprice){
   $errTyp = "warning";
   $errMSG = "Your balance is low";
     }
    else
     {
    // update visa left amount  
    // and create sold books history

     // remainder is the balence left after purchase a book , just is the previous visa amount minus price of  number of books bought
    
     $remainder = $visaRow['amount'] - $totalprice ;

     $updateRes = "update client_visa_account set amount ='$remainder' where visa_card_number='$visa'";

      $updatedb = mysqli_query($conn, $updateRes);
      
       if ($updatedb) {

         $reshistory = 
        "INSERT INTO sold_books
         (
          client_id,
          book_id,
          books_quantity,
          price
          )values
          (
          '$usersession',
          '$bookId',
          '$quantity',
          '$totalprice')" ; 
         $Storehistory = mysqli_query($conn, $reshistory); 

        if ($Storehistory) {
        // First find the letf books,which is existing books minus sold books

       $left_books = $shopRow['books_quantity']-$purchased_book_number ;

 // After payment history have been   saved,update the  left books in books entity store 

     $Resbookupda = "update books_store set books_quantity='$left_books' where id ='$bookId'";
    $updatedbook = mysqli_query($conn, $Resbookupda); 

    if ($updatedbook) {
          $errTyp = "success";
          $errMSGsuccess = "successfully paid"; 
          $errBalMSG 
        = "Your new balance is:  ". $remainder; 
          }
          else
          {
          echo "update payment".mysqli_error();        
           }



          }else{

            echo "history".mysqli_error();
          } 
           }
         else{
          $errTyp = "warning";
          $errMSG = "something went wrong";
          }  
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

   <div class="page-header text-danger">
<h3 class="col-md-offset-4">Payment Information</h3>
      </div>
        
 <!--    Row witch contains  a book which is going to be purchased -->
        <div class="row">
       <div class="col-md-6 " style="margin-left: 22%">
       <div class='thumbnail'>
    
        <table>
          <tr>
       <td>
    <p> <?php echo '<img src="data:photo/jpeg;base64,'.base64_encode($shopRow['book_front_image'] ).'" width="300" height="300"/><br/> <br/>' ; ?> 
      </p> 
       </td>
           <td>
    <div class='caption'>
     
  <p><span class="fa fa-book">&nbsp;<?php echo $shopRow['book_name'] ?></span><br><br> 
   By <span class="post-meta">&nbsp;<b><?php echo $shopRow['book_author'] ?></b></span><br>
  <span class="fa fa-bookmark "></span>  <?php echo $shopRow['book_price'] ?>Rwf/ piece <br><br>
  <span class="post-meta">&nbsp;<?php echo $shopRow['book_description'] ?></span><br> 
 <span class="fa fa-bar-chart"> Available quantity <span class="post-meta">&nbsp;<?php echo $shopRow['books_quantity'] ?></span>

 <form  method="GET" target=""    action="client_account.php?<?php echo $_GET['bookid']?><?php echo $_GET['bookqty']?>" autocomplete="off">

<lable class="col-sm-3" >Quantity:</lable>
<input  class="col-sm-4 col-sm-offset-2"  disabled name="bookqty" value="<?php echo $quantity?>" required><br>
     </p>
    </div>
      </td>
          </tr>
       
    </form>
        </table>
           </div>
          </div>
         </div>  
    <!-- end  -->

        <div class="row">
        <div class="col-lg-8 col-lg-offset-2">

  <div id="login-form" >

    <?php if ( isset($errMSG) )  { ?>
   <div class="form-group">
    <div class="alert alert-<?php echo ($errTyp=="success") ? "success" : $errTyp; ?>">
    <span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
            </div>
              </div>
         <?php } ?>

      <?php if ( isset($errMSGsuccess) )  { ?>
    <div class="form-group">
    <div class="alert alert-<?php echo ($errTyp=="success") ? "success" : $errTyp; ?>">
    <span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSGsuccess; ?><br>

    <span class="glyphicon glyphicon-envelope"></span> <?php echo $errBalMSG; ?><br>

    <a href="clientpage.php"><span class="glyphicon glyphicon-user"></span>My Orders >>> <a> 
            </div>
              </div>
         <?php } else{ ?>  

   <p>Payment method</p>
  <form method="post" action="" autocomplete="off" >
        <div class="form-group " hidden="true" >
              <div class="alert alert-  "success>
        <span class="glyphicon glyphicon-info-sign"> 
                </div>
              </div>
   
            
    <div class="form-group">
      <input type="number" name="visa_card_number" class="form-control" placeholder="Card number" maxlength="50" value="" required="true" />
    </div>
   
      <div class="form-group">
     <input type="password" name="secret_code" class="form-control" placeholder="Security code" maxlength="50" value="" required="true" />
      </div>
      

     <h6 for="">Card holder name</h6>
      <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
          <input class="form-control" id="" type="text" aria-describedby="" name="user_first_name" placeholder="First name" required="true">
              </div>
               <div class="col-md-6">
               <input class="form-control" id="" type="text" aria-describedby="" name="user_last_name" placeholder="Last name" required="true"><br>
              </div>
            </div>
          </div>

        <div class="form-grou mb-5" >
    <button type="submit" class="col-md-5 col-md-offset-4 btn btn-success" name="btn-pay" >Done</button>
            </div>
            
        </form>
        <?php }?>
         <div >
          <img src="assets/images/portfolio/visacards.jpg">
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
