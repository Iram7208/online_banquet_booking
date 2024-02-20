<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['odmsaid']==0)) {
  header('location:logout.php');
  } else{
    if(isset($_POST['submit']))
  {
$uid=$_GET['updid'];
$sername=$_POST['sername'];
$serdes=$_POST['serdes'];
$serprice=$_POST['serprice'];

$sql="update tblservice set ServiceName=:sername,SerDes=:serdes, ServicePrice=:serprice where ID=:uid";
$query=$dbh->prepare($sql);
$query->bindParam(':sername',$sername,PDO::PARAM_STR);
$query->bindParam(':serdes',$serdes,PDO::PARAM_STR);
$query->bindParam(':serprice',$serprice,PDO::PARAM_STR);
$query->bindParam(':uid',$uid,PDO::PARAM_STR);


 $query->execute();

    echo '<script>alert("Services has been updated.")</script>';
echo "<script>window.location.href ='manage-services.php'</script>";

  
}

?>
<!doctype html>
 <html lang="en" class="no-focus"> <!--<![endif]-->
    <head>
 <title>Online Banquet Booking System - Update Services</title>
<link rel="stylesheet" id="css-main" href="assets/css/codebase.min.css">

</head>
    <body>
        <div id="page-container" class="sidebar-o sidebar-inverse side-scroll page-header-fixed main-content-narrow">
     

             <?php include_once('includes/sidebar.php');?>

          <?php include_once('includes/header.php');?>

            <!-- Main Container -->
            <main id="main-container">
                <!-- Page Content -->
                <div class="content">
                
                    <!-- Register Forms -->
                    <h2 class="content-heading">Edit Services</h2>
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Bootstrap Register -->
                            <div class="block block-themed">
                                <div class="block-header bg-gd-emerald">
                                    <h3 class="block-title">Edit Services</h3>
                                    <div class="block-options">
                                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                            <i class="si si-refresh"></i>
                                        </button>
                                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
                                    </div>
                                </div>
                                <div class="block-content">
                                   
                                    <form method="post">
                                     

<?php
$uid=$_GET['updid'];
$sql="SELECT * from  tblservice where ID=:uid";
$query = $dbh -> prepare($sql);
$query->bindParam(':uid',$uid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
                                        <div class="form-group row">
                                                <label class="col-form-label col-md-4">Service Name:</label>
                                    <div class="col-md-12">
                                        <input type="text" value="<?php  echo htmlentities($row->ServiceName);?>" name="sername" required="true" class="form-control" >
                                    </div></div>
                                    <div class="form-group row">
                                                <label class="col-form-label col-md-4">Service Description:</label>
                                    <div class="col-md-12">
                                        <input type="text" value="<?php  echo htmlentities($row->SerDes);?>" name="serdes" required="true" class="form-control" >
                                    </div></div>
                                                <div class="form-group row">
                                    <label class="col-form-label col-md-4">Service Price(Rs.)</label>
                                    <div class="col-md-12">
                                        <input type="text" name="serprice" class="form-control" required="true" value="<?php  echo htmlentities($row->ServicePrice);?>">
                                    </div>
                                </div>
                                                 <div class="form-group row">
                                    <label class="col-form-label col-md-4">Service Date</label>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" value="<?php  echo htmlentities($row->CreationDate);?>" name="CreationDate" required="true" readonly title="date can't be edit">
                                    </div>
                                </div>
                                </div><?php $cnt=$cnt+1;}} ?>
                                              <br>
                                                <div class="tp"> 
                                                     <button type="submit" class="btn btn-primary" name="submit">Update</button>
                                                </div>
                                    </form>
                                </div>
                            </div>
                            <!-- END Bootstrap Register -->
                        </div>
                        
                       </div>
                </div>
                <!-- END Page Content -->
            </main>
            <!-- END Main Container -->

          <?php include_once('includes/footer.php');?>
        </div>
        <!-- END Page Container -->

        <!-- Codebase Core JS -->
        <script src="assets/js/core/jquery.min.js"></script>
        <script src="assets/js/core/popper.min.js"></script>
        <script src="assets/js/core/bootstrap.min.js"></script>
        <script src="assets/js/core/jquery.slimscroll.min.js"></script>
        <script src="assets/js/core/jquery.scrollLock.min.js"></script>
        <script src="assets/js/core/jquery.appear.min.js"></script>
        <script src="assets/js/core/jquery.countTo.min.js"></script>
        <script src="assets/js/core/js.cookie.min.js"></script>
        <script src="assets/js/codebase.js"></script>
    </body>
</html>
<?php }  ?>