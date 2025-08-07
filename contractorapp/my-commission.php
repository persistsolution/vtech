<?php session_start();
require_once 'config.php';
$id = $_GET['id'];
$PageName = "My Commission";
$UserId = $_SESSION['User']['id']; 
?>
<!DOCTYPE html>
<html lang="en" class="default-style layout-fixed layout-navbar-fixed">
<head>
<title><?php echo $Proj_Title; ?> | View Customer Account List</title>
 <!-- manifest meta -->
    <meta name="apple-mobile-web-app-capable" content="yes">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="img/favicon180.png" sizes="180x180">
    <link rel="icon" href="img/favicon32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="img/favicon16.png" sizes="16x16" type="image/png">

    <!-- Material icons-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&amp;display=swap" rel="stylesheet">

    <!-- swiper CSS -->
    <link href="vendor/swiper/css/swiper.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet" id="style">
    <link href="css/toastr.min.css" rel="stylesheet">
    <script src="js/jquery.min3.5.1.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/toastr.min.js"></script>
    <link rel="stylesheet" href="example/css/slim.min.css">
    <?php include_once 'header_script.php'; ?>
</head>

<body class="body-scroll d-flex flex-column h-100 menu-overlay">
   


    <!-- Begin page content -->
    <main class="flex-shrink-0 main">
        <!-- Fixed navbar -->
        <?php include_once 'back-header.php'; ?> 

        <!-- page content start -->

       
            <div class="container mb-4" style="padding-right: 1px;
padding-left: 1px;">

                   
                <div class="card">
                   
              <?php 
              $sql2 = "SELECT SUM(tc.Amount) AS TotAmt FROM tbl_made_contractor_commision tc INNER JOIN tbl_users tu On tu.id=tc.CustId WHERE tc.ContractorId='$UserId' ORDER BY tc.id DESC";
              $row2 = getRecord($sql2);
              ?>
                    <div class="card-body px-0 pt-0">
                        <span style="text-align: center;font-weight: 500;font-size: 20px;">
    <div class='alert alert-warning'>Total Commission Amount : &#8377;<?php echo number_format($row2['TotAmt'],2);?></div></span>
                        <ul class="list-group list-group-flush" id="show_prod">
                             <?php 
                                $sql2 = "SELECT tc.*,tu.Fname,tu.BeneficiaryId FROM tbl_made_contractor_commision tc INNER JOIN tbl_users tu On tu.id=tc.CustId WHERE tc.ContractorId='$UserId' ORDER BY tc.id DESC"; 
                                $res2 = $conn->query($sql2);
                                $row_cnt = mysqli_num_rows($res2);
                                    if($row_cnt > 0){
                                    while($row = $res2->fetch_assoc()){
                                      
                                     ?>
                            <li class="list-group-item">
                               <div class="row align-items-center">
                                   
                                    <div class="col align-self-center pr-0">
                                        <h6 style="margin-bottom: 1px;">&#8377;<?php echo number_format($row['Amount'],2);?></h6>
                                        <h7 class="font-weight-normal mb-1" style="color: #212529"><?php echo $row['Fname']." (".$row['BeneficiaryId'].")"; ?><br><strong>Scope Of Work : </strong><?php echo $row['ScopeOfWork'];?></h7>
                                       
                                        <p class="small text-secondary"><?php echo date("d/m/Y", strtotime(str_replace('-', '/',$row['CreatedDate'])))?></p>
                                    </div>
                                    <div class="col-auto">
                                        <?php echo $Status; ?>
                                    </div>
                                </div>
                            </li>
                        <?php }} else{ ?><br>
                          <!--  <div class="col-auto">
                                        <h6 class="text-danger">Sorry! No Customer Found..</h6>
                                    </div> -->
                           <?php } ?>
                        </ul>
                    </div>
                </div>
             
                
            
        </div>
    </main><br><br><br>
 <?php include_once 'footer.php';?>

     <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- cookie js -->
    <script src="js/jquery.cookie.js"></script>

    <!-- Swiper slider  js-->
    <script src="vendor/swiper/js/swiper.min.js"></script>

    <!-- Customized jquery file  -->
    <script src="js/main.js"></script>
    <script src="js/color-scheme-demo.js"></script>


    <!-- page level custom script -->
    <script src="js/app.js"></script>
       <?php include_once 'footer_script.php'; ?>

    </body>

</html>
