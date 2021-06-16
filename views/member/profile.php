<?php
if(!isset($_SESSION)){
    session_start();
}
include_once ("../../vendor/autoload.php");
use App\DataManipulation\DataManipulation;
$Meid = $_SESSION ['Mid'];
$Mename = $_SESSION ['Mname'];
$Meemail = $_SESSION ['Memail'];
$dbmanipulate = new DataManipulation();
$userdetails = $dbmanipulate->showUserProfile($Meemail);
$userPayment = $dbmanipulate->userPaymentQuery($Meemail);
if ($userPayment){
    $monthyear = $userPayment->date;
    $mont = $userPayment->subscription;
    $cur = date("Y-m-d");
    $dates = date('Y-m-d', strtotime(" +$mont months", strtotime($monthyear)));
    if($dates <= $cur){
        $dbmanipulate->updateCheckActiveTimeOver($Meemail);
    }
}
if (isset($_SESSION ['Mid']) && isset($_SESSION ['Mname']) && isset($_SESSION ['Memail']) ){
    include_once "institue_head.php";
    $trueStatus = $dbmanipulate->singleUsers($Meid);
    ?>
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Profile</h1>
                    </div>
                </div>
            </div>
        </section>
        <?php
        if(isset($_SESSION['UpdateSuccessMessageForPassword'])){
            echo $_SESSION['UpdateSuccessMessageForPassword'];
            unset($_SESSION['UpdateSuccessMessageForPassword']);
        }
        ?>
        <section class="content">
            <div class="container-fluid">
                <?php
                 if ($trueStatus){
                     ?>
                     <div class="row">
                         <div class="col-md-6">
                             <div class="card card-primary card-outline">
                                 <div class="card-body box-profile">
                                     <div class="text-center">
                                         <img style="width: 110px;height: 110px" class="profile-user-img img-fluid img-circle"
                                              src="../../assets/img/c.jpg" >
                                     </div>
                                     <?php
                                     if ($userPayment){
                                         $monthyear = $userPayment->date;
                                         $mont = $userPayment->subscription;
                                         $cur = date("Y-m-d");
                                         $dates = date('Y-m-d', strtotime(" +$mont months", strtotime($monthyear)));
                                         if($dates <= $cur){
                                             $dbmanipulate->updateCheckActiveTimeOver($Meemail);
                                             }
                                     }
                                     $list = $dbmanipulate->showUserProfile($Meemail) ?>
                                     <h3 class="profile-username text-center"><?php echo $userdetails->name ?></h3>
                                     <p class="text-muted text-center"><?php echo "Instructing Institute of <br>Find Instructing Institute and Teacher" ?></p>
                                     <form action="../process/data-process.php" method="post">
                                         <div class="card card-primary">
                                             <div class="card-header">
                                                 <h3 class="card-title">About Me</h3>
                                             </div>
                                             <div class="card-body">
                                                 <strong><i class="fas fa-book mr-1"></i> Name</strong>
                                                 <p class="text-muted">
                                                     <input type="text" name="name" class="form-control" placeholder="Name" value="<?php echo $userdetails->name?>">
                                                 </p>
                                                 <hr>
                                                 <strong><i class="fas fa-mail-bulk mr-1"></i> Email Address</strong>
                                                 <p class="text-muted">
                                                     <input disabled type="text" class="form-control"value="<?php echo $userdetails->email?>">
                                                 </p>
                                                 <hr>
                                                 <strong><i class="fas fa-map-marker-alt mr-1"></i> Address</strong>
                                                 <p class="text-muted">
                                                     <input type="text" name="address" class="form-control" placeholder="Address" value="<?php echo $userdetails->address?>">
                                                 </p>
                                                 <hr>
                                                 <strong><i class="fas fa-theater-masks"></i> Instructing Institute Name</strong>
                                                 <p class="text-muted">
                                                     <input disabled type="text"  class="form-control"  value="<?php echo $userdetails->cname?>">
                                                 </p>
                                                 <hr>
                                                 <strong><i class="fas fa-phone-square-alt mr-1"></i>Phone Number</strong>
                                                 <p class="text-muted">
                                                     <input disabled type="text" class="form-control"  value="<?php echo $userdetails->pnumber?>">
                                                     <input type="hidden" name="user_no"  value="<?php echo $userdetails->no?>">
                                                 </p>
                                                 <input type="submit" name="edit-information" class="form-control btn btn-info" value="Edit Information">
                                             </div>
                                         </div>
                                     </form>

                                 </div>
                             </div>
                         </div>
                         <div class="col-md-6">
                             <div class="card">
                                 <div class="card-header p-2">
                                     <ul class="nav nav-pills">
                                         <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Change Password</a></li>
                                     </ul>
                                 </div>
                                 <div class="card-body">
                                     <div class="tab-content">
                                         <div class="active tab-pane" id="activity">
                                             <form id="UpdatePass" action="../process/data-process.php" method="post" class="form-horizontal">
                                                 <div class="form-group row">
                                                     <div class="col-sm-12 mb-2">
                                                         <input type="hidden" value="<?php echo $Meid?>" name="user_no">
                                                         <input type="password" class="form-control" name="password" id="password" placeholder="Create password">
                                                     </div>
                                                     <div class="col-sm-12">
                                                         <input type="password" class="form-control" name="repass" placeholder="Confirm password">
                                                     </div>
                                                 </div>
                                                 <div class="form-group row">
                                                     <div class="col-sm-12">
                                                         <button type="submit" name="change-pass" class="btn w-100 btn-danger">Submit</button>
                                                     </div>
                                                 </div>
                                             </form>
                                         </div>
                                     </div>
                                     <!-- /.tab-content -->
                                 </div><!-- /.card-body -->
                             </div>
                             <!-- /.card -->
                         </div>
                         <!-- /.col -->
                     </div>
                     <?php
                 }
                 else{
                     echo "<div class=\"typewriter d-flex justify-content-center mt-5\">
                  <h1>Opps!Your account is not activated.</h1>
                </div>";
                 }
                ?>

                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
 <?php
 include_once "institue_foot.php";
}
else{
    header("Location: ../login-register/login.php");
}
?>
