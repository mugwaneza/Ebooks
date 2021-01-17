<?php 
 include_once 'dbconnect.php';
 // select loggedin users detail

  $search = $_POST['search'];

  $res=mysqli_query($conn, "SELECT id, book_name,book_price,books_quantity,book_front_image,book_description,book_author from books_store where book_category ='Children'");

    $searchRes=mysqli_query($conn, "SELECT id, book_name,book_price,books_quantity,book_front_image,book_description,book_author from books_store where book_name like '%$search%' and book_category ='Children' ");

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
<!--       <div class="page-loader">
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
              <li class=""><a class="" href="politics.php" data-toggle="">Politics</a>
              </li>
              <li class="dropdown"><a class="" href="science.php" data-toggle="">Science</a>
               
              </li>
              <li class="dropdown"><a class="" href="travel.php" data-toggle="">Travel</a>
                
              </li>
              <li class="dropdown"><a class="" href="children.php" data-toggle="">Children</a></li>         

              <li class="dropdown"><a class="" href="computers.php" data-toggle="">computers</a></li>
            
        <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Logins</a>            
                     <ul class="dropdown-menu bg-white">
                      <li><a href="signinuser.php">client</a></li> 
                      <li><a href="register_newbook.php">Admin</a></li>
                       </ul>
                  </li>

            </ul>
          </div>
        </div>
      </nav>
   <section class="home-section bg-dark-60 portfolio-page-header parallax-bg" id="home" data-background="assets/images//portfolio/portfolio_header_bg.jpg">
        <div class="titan-caption">
          <div class="caption-content">
            <div class="font-alt mb-30 titan-title-size-4">Online books selling</div>
            <div class="font-alt mb-40 titan-title-size-4">Management system</div>
  <div class="col-sm-6 col-sm-offset-3 section-scroll " >
  
      <div class="">    
     <form method="post"  action="<?php echo $_SERVER['PHP_SELF']; ?>" autocomplete="off" >
          <div class="form-group">
          <input class="form-control" type="text" name="search" placeholder="Type keyword and Search for a book" required>
          </div>
          </form> 
          </div>
         </div>
          </div>
        </div>
      </section>
      <div class="main">
      
        <section class="module" id="news">
          <div class="container">
            <div class="row">
              <div class="col-sm-6 col-sm-offset-3">
                <h4 class="module-title font-alt text-alert">Purchase Children books today </h4>
                <div class="module-subtitle font-serif"> “A reader lives a thousand lives before he dies, said Jojen.”  <br> 

              The man who never reads lives only one.</div>
              </div>
            </div>
<!-- Check whether search is not empty -->
<?php if($search =="") { ?>

 <div class="row" >
   <?php while($ResultsRow=mysqli_fetch_array($res)) { ?> 

    <div class="col-md-2 offset-md-2">
       <div class='thumbnail'>

 <!-- <a href="shopping.php?id=<?php echo $_POST['book_id']?>" target="blank">   -->
  <?php echo '<img src="data:photo/jpeg;base64,'.base64_encode($ResultsRow['book_front_image'] ).'" width="300" height="300"/><br/>'; ?> 

     <div class='caption'>
  <p><span class="fa fa-book">&nbsp;<?php echo $ResultsRow['book_name'] ?></span><br><br> 
   By <span class="post-meta">&nbsp;<b><?php echo $ResultsRow['book_author'] ?></b></span><br>
  <span class="fa fa-bookmark "></span>  <?php echo $ResultsRow['book_price'] ?>Rwf/ piece <br><br>
 <span class="fa fa-bar-chart"> Available quantity <span class="post-meta">&nbsp;<?php echo $ResultsRow['books_quantity'] ?></span>
     </p>
  <form  method="GET" target="_blank"    action="shopping.php?<?php echo $_GET['book_id']?>" autocomplete="off">
 <input hidden   type="text" name="book_id" value="<?php echo $ResultsRow['id'] ?>">
   <input type="submit" name="" value="view" class="btn btn-inverse btn-block">
    </form>
    </div>
      </div>
          


  </div>
    <?php } ?>
   <?php } elseif($search!=""){ ?>

<div class="row">
   <?php while($searchedRow=mysqli_fetch_array($searchRes)) { ?> 
    <div class="col-md-2 offset-md-2">
       <div class='thumbnail'>
      
  <?php echo '<img src="data:photo/jpeg;base64,'.base64_encode($searchedRow['book_front_image'] ).'" width="300" height="300"/><br/>'  ; ?> 

     <div class='caption'>
  <p><span class="fa fa-book">&nbsp;<?php echo $searchedRow['book_name'] ?></span><br><br> 
   By <span class="post-meta">&nbsp;<b><?php echo $searchedRow['book_author'] ?></b></span><br>
  <span class="fa fa-bookmark "></span>  <?php echo $searchedRow['book_price'] ?>Rwf/ piece <br><br>
 <span class="fa fa-bar-chart"> Available quantity <span class="post-meta">&nbsp;<?php echo $searchedRow['books_quantity'] ?></span>
     </p>
 
  <form  method="GET" target="_blank"    action="shopping.php?<?php echo $_GET['book_id']?>" autocomplete="off">
 <input hidden   type="text" name="book_id" value="<?php echo $searchedRow['id'] ?>">
   <input type="submit" name="" value="view" class="btn btn-inverse btn-block">
    </form>

    </div>
      </div>
  </div>
    <?php } ?>

     <?php } ?>
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