<?php 
 include_once 'dbconnect.php';
 // select loggedin users detail
 
  $bookId = $_GET['book_id'];
  $search = $_POST['search'];

  $res=mysqli_query($conn, "SELECT id, book_name,book_price,books_quantity,book_front_image,book_back_image,book_description,book_author from books_store order by id Desc limit 12");

 $selectedRes=mysqli_query($conn, "SELECT id, book_name,book_price,books_quantity,book_front_image,book_back_image,book_description,book_author from books_store where id ='$bookId'"
     );

     $shopRow=mysqli_fetch_array($selectedRes);

?>
<!DOCTYPE html>
<html lang="en-US" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style type="text/css">
    
    
    .stackem div {
    width: 100%;
}

    </style>
    <!--  
    Document Title
    =============================================
    -->
    <title>E-book | Ms</title>

    <!--  
    Favicons
    =============================================
    -->
     <link rel="icon" type="image/png" sizes="192x192" href="assets/images/favicons/android-icon-192x192.png">
    <link rel="manifest" href="/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="assets/images/favicons/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <!--  
    Stylesheets
    =============================================
    
    -->
  
    <!-- Default stylesheets-->
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
  <body data-spy="scroll" data-target=".onpage-navigation" data-offset="60">
    <main>
   <!--  <div class="page-loader">
        <div class="loader">Loading...</div>
      </div> -->

      <nav class="navbar navbar-custom navbar-fixed-top navbar-transparent" role="navigation">
        <div class="container">
          <div class="navbar-header">
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#custom-collapse"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
            <!-- <a class="navbar-brand" href="index.php">Tourism M.S</a> -->
          </div>
          <div class="collapse navbar-collapse" id="custom-collapse">
            <ul class="nav navbar-nav navbar-right">
              <li class="dropdown"><a class="dropdown-toggle" href="index.php" data-toggle="">Home</a>           
              </li>
              <li class=""><a class="" href="lakes.php" data-toggle="">Politics</a>
              </li>
              <li class="dropdown"><a class="" href="forestry.php" data-toggle="">Science</a>
               
              </li>
              <li class="dropdown"><a class="" href="miseums.php" data-toggle="">Travel</a>
                
              </li>
              <li class="dropdown"><a class="" href="parks.php" data-toggle="">Children</a></li>         

              <li class="dropdown"><a class="" href="parks.php" data-toggle="">computers</a></li>
            
        <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">More</a>            
                     <ul class="dropdown-menu bg-white">
                      <li><a href="signinuser.php">client</a></li> 
                      <li><a href="register_newbook.php">Admin</a></li>
                       </ul>
                  </li>

            </ul>
          </div>
        </div>
      </nav>
   <section class="home-section bg-dark-60 portfolio-page-header parallax-bg" id="home" data-background="assets/images//portfolio/ebookselling.jpg">
        <div class="titan-caption">
          <div class="caption-content">
            <div class="font-alt mb-30 titan-title-size-1">Online books selling</div>
            <div class="font-alt mb-40 titan-title-size-3">Management system</div>

          </div>
        </div>
      </section>
      <div class="main">
      
        <section class="module" id="">
        <div class="container">
<!--    Row witch contains  a book which is going to be purchased -->
        <div class="row">
       <div class="col-md-6 " style="margin-left: 22%">
       <div class='thumbnail'>
    
        <table>
          <tr>
       <td>
    <p> <?php echo '<img src="data:photo/jpeg;base64,'.base64_encode($shopRow['book_front_image'] ).'" width="300" height="300"/><br/> <br/>' ; ?> 
      <?php echo '<img src="data:photo/jpeg;base64,'.base64_encode($shopRow['book_back_image'] ).'" width="300" height="300"/><br/>' ; ?></p> 
       </td>
           <td>
    <div class='caption'>
     
  <p><span class="fa fa-book">&nbsp;<?php echo $shopRow['book_name'] ?></span><br><br> 
   By <span class="post-meta">&nbsp;<b><?php echo $shopRow['book_author'] ?></b></span><br>
  <span class="fa fa-bookmark "></span>  <?php echo $shopRow['book_price'] ?>Rwf/ piece <br><br>
  <span class="post-meta">&nbsp;<?php echo $shopRow['book_description'] ?></span><br> 
 <span class="fa fa-bar-chart"> Available quantity <span class="post-meta">&nbsp;<?php echo $shopRow['books_quantity'] ?></span>

 <form  method="GET" target=""    action="client_account.php?<?php echo $_GET['bookid']?><?php echo $_GET['bookqty'] ;echo $_GET['cart'] ?>" autocomplete="off">

<lable class="col-sm-3" >Quantity: </lable>
<input  class="col-sm-4 col-sm-offset-2"  type="number" name="bookqty" value="" required><br>
     </p>
    </div>
      </td>
          </tr>
          <tr>
       <td>

 <input  hidden type="text" name="bookid" value="<?php echo $shopRow['id'] ?>">

  <button type="submit" name="cart" class="btn btn-warning col-md-offset-1 "> Buy this book</button><br><br>
        </td>
       <td><button class="btn btn-success col-md-offset-2" name="cart" value="cart" type="submit">Add to cart</button><br><br>
      </form>
       </td>
          </tr>
        </table>
           </div>
          </div>
         </div>  
<!-- end  -->

    <div class="row">
    <div class="col-sm-6 col-sm-offset-3">
  <div class="module-subtitle font-serif text-success"> 
    <h4>“Top twelve of most popular books ever known allover the world.”</h4>
      </div>
       </div>
      </div>


        <!-- Defaul current books -->


 <div class="row">

   <?php while($ResultsRow=mysqli_fetch_array($res)) { ?> 

    <div class="col-md-2 offset-md-2">
       <div class='thumbnail'>
  <?php echo '<img src="data:photo/jpeg;base64,'.base64_encode($ResultsRow['book_front_image'] ).'" width="300" height="300"/><br/>'; ?> 

     <div class='caption'>
  <p><span class="fa fa-book">&nbsp;<?php echo $ResultsRow['book_name'] ?></span><br><br> 
   By <span class="post-meta">&nbsp;<b><?php echo $ResultsRow['book_author'] ?></b></span><br>
  <span class="fa fa-bookmark "></span>  <?php echo $ResultsRow['book_price'] ?>Rwf/ piece <br><br>
 <span class="fa fa-bar-chart"> Available quantity <span class="post-meta">&nbsp;<?php echo $ResultsRow['books_quantity'] ?></span><br>
    
   </p>
  <form  method="GET" target="_blank" action="shopping.php?<?php echo $_GET['book_id']?>" autocomplete="off">
 <input hidden   type="text" name="book_id" value="<?php echo $ResultsRow['id'] ?>">
   <input type="submit" name="" value="view" class="btn btn-inverse btn-block">
    </form>
    </div>

      </div> 
  </div>
      <?php } ?>
        </div>
      </div>
        </section> 

        <hr class="divider-d">
        <footer class="footer bg-dark">
          <div class="container">
            <div class="row">
              <div class="col-sm-6">
                <p class="copyright font-alt">&copy; 2017&nbsp;<a href="index.php">Rwanda e-book</a>, All Rights Reserved</p>
              </div>
              <div class="col-sm-6">
                <div class="footer-social-links"><a href="#"><i class="fa fa-facebook"></i></a><a href="#"><i class="fa fa-twitter"></i></a><a href="#"><i class="fa fa-dribbble"></i></a><a href="#"><i class="fa fa-skype"></i></a>
                </div>
              </div>
            </div>
          </div>
        </footer>
        <div class="scroll-up"><a href="#totop"><i class="fa fa-angle-double-up"></i></a></div>
      </div>
    </main>
    <!--  
    JavaScripts
    =============================================
    -->

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