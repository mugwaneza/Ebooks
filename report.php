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

// Search by parking name
$findrepo=mysqli_query($conn ,"
  SELECT 
  -- books_store.id,
  Distinct
  books_store.book_category,
  books_store.book_name as bkName,
  books_store.books_quantity as availablebk,

  -- sold_books.id,
   sum(sold_books.books_quantity) as soldbk,
   sum(sold_books.price) as allAmountOfSoldbook

  -- client_account.id,
  -- client_account.client_fullname,
  -- client_account.address
 

  FROM
  books_store,
  sold_books
  -- client_account 
 WHERE 
 sold_books.book_id =books_store.id 
  GROUP BY bkName
 "
 );






 ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8"> 

 <link href="assets/lib/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"> 
 <link href="css/style.css" rel="stylesheet">

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
 
<div id="printBtn" class="col-md-6">   
<button class="btn btn-sm btn-primary " data-title="print" data-toggle="modal"  type="button"  id="print_button"><span class="glyphicon glyphicon-print">
      </span></button>
      </div>
  <div class="col-md-6"> <h3 class="">Books Report</h3> </div>
       
      </div>
    
     <div class="row">
           <div class=" ">

<table class="table table-borded"  > 
    <thead class="text-danger header">
    <div class ="">
      <tr>
        <th >No</th>
        <th>Book category</th>
        <th>Book Name</th>
        <th >Sold books</th>
        <th>Available books</th>
        <!-- <th>Client names</th> -->
        <!-- <th>Shipping address</th> -->
        <th>Earned amount</th>
      </tr>
      </div>
    </thead>
    <tbody>

       
        
         <!-- Results of all report -->

       <?php 
      //set counter variable
       $counter = 1;
    while($resultRow=mysqli_fetch_assoc($findrepo)){ ?>

        <tr class="" >
        <td><?php echo $counter  ?></td>
<td><?php echo $resultRow['book_category'];?></td>
<td><?php echo $resultRow['bkName'];?></td> 
<td><?php echo $resultRow['soldbk']; ?></td>
<td><?php echo $resultRow['availablebk'];?></td>     <!-- <td><?php echo $resultRow['client_fullname'];?></td> <td><?php echo $resultRow['address'];?></td> -->
<td><?php echo $resultRow['allAmountOfSoldbook'];?>
</td>            
          </tr> 
    
       <?php 
       $counter++;
       } ?>

    </tbody>
  </table>

        </div>
        </div>
    
    </div>
    
    </div>
<script src="assets/lib/jquery/dist/jquery.js"></script>
<script src="assets/lib/bootstrap/dist/js/bootstrap.min.js"></script>
 <script src="/jquery/jquery.min.js"></script>
    <script src="js/print.js"></script>

</body>
</html>
