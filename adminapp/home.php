<?php session_start();
$sessionid = session_id();
require_once 'config.php';
require_once 'auth.php';
$PageName = "Home";

$uid = $_REQUEST['uid'];    
//$_SESSION['Location'] = $city_id;
if($_REQUEST['uid'] == ''){
  $uid = $_SESSION['User']['id'];
}
else{
$uid = $_REQUEST['uid'];    
$sql11 = "SELECT * FROM tbl_users WHERE id='$uid'";
$row = getRecord($sql11);
$_SESSION['User'] = $row;
}

$sql11 = "SELECT * FROM tbl_users WHERE id='$uid'";
$rncnt11 = getRow($sql11);
$row = getRecord($sql11);
$mycity = $row['CityId'];

if($_REQUEST['city_id']==0){
    $city_id = $mycity;  
    
}
else if($_REQUEST['city_id']==''){
    $city_id = $mycity;  
    
}
else{
  $city_id = $_REQUEST['city_id'];
}
if($rncnt11 > 0){
    $_SESSION['User'] = $row;
    // $sql = "UPDATE tbl_users SET Location='$city_id' WHERE id='$uid'";
    // $conn->query($sql);
    
} 
?>
<!doctype html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="generator" content="">
    <title><?php echo $Proj_Title; ?></title>

    <!-- manifest meta -->
    <meta name="apple-mobile-web-app-capable" content="yes">

    <!-- Favicons -->
    <link rel="manifest" href="manifest.json" />

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js">
</script>

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet" id="style">
    <link rel="stylesheet" href="dist/css/styles.css" />
   
</head>

  

<body class="body-scroll d-flex flex-column h-100 menu-overlay" data-page="shop">
    
    
    
 <?php include_once 'sidebar.php'; ?>

    <!-- Begin page content -->
    <main class="flex-shrink-0 main has-footer">
        <!-- Fixed navbar -->
      <?php include_once 'top_header.php'; ?>

        <!-- page content start -->
<!-- page content start -->
   
<style>
   .project-card {
  text-decoration: none;
  transition: transform 0.2s ease, box-shadow 0.2s ease;
  display: block;
}

.project-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
}

.card-pump {
  background: #e3f2fd; /* Light blue */
  border-radius: 10px;
}

.card-rooftop {
  background: #fce4ec; /* Light pink */
  border-radius: 10px;
}

.project-title {
  font-size: 1.25rem; /* 20px */
  font-weight: 600;
  color: #083068;
  margin-top: 1rem;
  margin-bottom: 0;
}


</style>
        <div class="main-container  text-center" style="background-color:#fff;">

             <div class="container ">
                
                <div class="row text-center mt-4">
  <div class="col-6 col-md-3">
    <a href="pump-management.php" class="project-card">
      <div class="card card-pump border-0 shadow-sm mb-4">
        <div class="card-body">
          <h3 class="project-title">Pump Project</h3>
        </div>
      </div>
    </a>
  </div>

  <div class="col-6 col-md-3">
    <a href="#" class="project-card">
      <div class="card card-rooftop border-0 shadow-sm mb-4">
        <div class="card-body">
          <h3 class="project-title">Rooftop Project</h3>
        </div>
      </div>
    </a>
  </div>
  
  <div class="col-6 col-md-3">
    <a href="task-management.php" class="project-card">
      <div class="card card-rooftop border-0 shadow-sm mb-4">
        <div class="card-body">
          <h3 class="project-title">Task Management</h3>
        </div>
      </div>
    </a>
  </div>
</div>


            </div>

           
           
                               
            
    </main>

    <!-- footer-->
  <?php include_once 'footer.php'; ?>


<script src="dist/aos.js"></script>
    <script>
      AOS.init({
        easing: 'ease-in-out-sine'
      });
    </script>


    <!-- Required jquery and libraries -->
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

    <!-- PWA app service registration and works -->
    <script src="js/pwa-services.js"></script>

    <!-- page level custom script -->
    <script src="js/app.js"></script>

       <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
      <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
    <script>
        function logout(){
       Android.logout();
       window.location.href="logout.php";
  }
    </script>

</body>

</html>
