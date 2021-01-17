 <?php 
  ob_start();
  session_start();

   include_once 'dbconnect.php';
  // Get current logged in user

  // if session is not set this will redirect to login page
  if( !isset($_SESSION['user']) ) {
    header("Location: signinuser.php");
    exit;
  }

  // Get current logged in user
 $res=mysqli_query($conn, "SELECT * from client_account where id=".$_SESSION['user']);
  $row=mysqli_fetch_array($res);

// Get client history

 $resord=mysqli_query($conn, "SELECT
  shopping_cart.books_quantity,
  books_store.id,
  books_store.book_price,
  books_store.book_price,
  books_store.book_author,
  books_store.book_front_image,
  books_store.book_name
   FROM
 shopping_cart,books_store
  WHERE 
books_store.id = shopping_cart.book_id 
AND client_id =".$_SESSION['user']);
  

  ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>eBook</title>

         <!-- Bootstrap CSS CDN -->
       <link href="assets/lib/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Our Custom CSS -->
    <link href="assets/css/style_clientpage.css" rel="stylesheet">
    </head>
    <body>



        <div class="wrapper">
            <!-- Sidebar Holder -->
            <nav id="sidebar">
                <div class="sidebar-header">
                    <h3>Online Books selling M.S</h3>
                </div>

                <ul class="list-unstyled components">
                    <p>Client dashboard</p>
                    <li class="active">
                        <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false">My orders</a>
                        <ul class="collapse list-unstyled" id="homeSubmenu">
                           <li><a href="clientpage.php">View orders</a></li>        
                        </ul>
                    </li>
                    <li>
                        <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false">My shopping cart</a>
                        <ul class="collapse list-unstyled" id="pageSubmenu">
                        <li><a href="shoppingcart.php">Shopping cart</a></li>
                        </ul>
                    </li>
                    
                </ul>

             <!--    <ul class="list-unstyled CTAs">
         <li><a href="" 
                class="article">Bank services</a></li>
                </ul> -->
            </nav>

            <!-- Page Content Holder -->
            <div id="content">

                <nav class="navbar navbar-default">
                    <div class="container-fluid ">

                        <div class="navbar-header">
            <button type="button" id="sidebarCollapse" class="btn btn-success navbar-btn">
                <i class="glyphicon glyphicon-user"></i>
         <span><?php echo $row['client_fullname']?></span>
                            </button>
                        </div>

                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav navbar-right">
                                <li><a href="signout_client.php?logout">Signout</a></li>
                                
                            </ul>
                        </div>
                    </div>
                </nav>

                <h2>Shopping cart</h2>

                <div class="line"></div>

        
          <div class="container ">
           <div class="row">
   <?php while($mycartRow=mysqli_fetch_array($resord)) { ?> 
    <div class="col-md-2 offset-md-2 ">
       <div class='thumbnail '>
      
  <?php echo '<img src="data:photo/jpeg;base64,'.base64_encode($mycartRow['book_front_image'] ).'" width="300" height="300"/><br/>'  ; ?> 

     <div class='caption'>
  <p><span class="fa fa-book">&nbsp;<?php echo $mycartRow['book_name'] ?></span><br><br> 
   By <span class="post-meta">&nbsp;<b><?php echo $mycartRow['book_author'] ?></b></span><br>
  <span class="fa fa-bookmark "></span>Price/piece: <?php echo $mycartRow['book_price'] ?>Rwf<br><br>
 <span class="fa fa-bar-chart">Quantity: <span class="post-meta">&nbsp;<?php echo $mycartRow['books_quantity'] ?></span>
     </p>
 <form  method="GET" target="_blank"    action="shopping.php?<?php echo $_GET['book_id']?>" autocomplete="off">
 <input hidden type="text" name="book_id" value="<?php echo $mycartRow['id'] ?>">
   <input type="submit" name="" value="view" class="btn btn-inverse btn-block">
    </form>
    </div>
      </div>
   </div>
    <?php } ?>
     </div>
    </div>

   <div class="line"></div>

                
            </div>
        </div>





        <!-- jQuery CDN -->
         <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
         <!-- Bootstrap Js CDN -->
         <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

         <script type="text/javascript">
             $(document).ready(function () {
                 $('#sidebarCollapse').on('click', function () {
                     $('#sidebar').toggleClass('active');
                 });
             });
         </script>
    </body>
</html>
