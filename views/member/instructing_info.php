<?php
if(!isset($_SESSION)){
    session_start();
}
include_once ("../../vendor/autoload.php");
include_once "config.php";
use App\DataManipulation\DataManipulation;
$Meid = $_SESSION ['Mid'];
$Mename = $_SESSION ['Mname'];
$Meemail = $_SESSION ['Memail'];
$dbmanipulate = new DataManipulation();
$userdetails = $dbmanipulate->showUserProfile($Meemail);
if (isset($_SESSION ['Mid']) && isset($_SESSION ['Mname']) && isset($_SESSION ['Memail']) ){
    include_once "institue_head.php";
    $trueStatus = $dbmanipulate->singleUsers($Meid);
    ?>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Add Instructing Institute Details </h1>
                    </div>
                </div>
            </div>
        </div>
        <?php
        if(isset($_SESSION['CreateSuccessMessageForNewAdmin'])){
            echo $_SESSION['CreateSuccessMessageForNewAdmin'];
            unset($_SESSION['CreateSuccessMessageForNewAdmin']);
        }
        ?>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-warning card-outline">
                            <div class="card-body box-profile">
                                <div class="card card-danger">
                                    <div class="card-header">
                                        <h3 class="card-title">Institute Details</h3>
                                    </div>
                                    <form action="../process/data-process.php" method="post">
                                        <div class="card-body">
                                            <strong><i class="fas fa-book mr-1"></i>Full Name</strong>
                                            <input type="text" name="name" class="form-control" placeholder="Full Name" required>
                                            <hr>
                                            <strong><i class="fas fa-mail-bulk mr-1"></i> Email Address</strong>
                                            <input type="email" name="email" class="form-control" placeholder="Email Address" required>
                                            <hr>
                                            <strong><i class="fas fa-map-marker-alt mr-1"></i> Address</strong>
                                            <input type="text" name="address" class="form-control" placeholder="Address" required>
                                            <hr>
                                            <strong><i class="fas fa-phone-square-alt mr-1"></i>Phone Number</strong>
                                            <input type="text" name="phone" class="form-control" placeholder="Phone Number" required>
                                            <hr>
                                            <strong><i class="fas fa-user-lock mr-1"></i>Password</strong>
                                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                                            <hr
                                            <div class="row">
                                                <div class="col-12">
                                                    <button type="submit" name="newAdmin" style="background: #00adc2;border: #00adc2;color: #ffffff;font-weight: bold" class="btn btn-block"><i class="fa fa-sign-language mr-2" aria-hidden="true"></i>Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
    </div>
    <?php
    include_once "institue_foot.php";
    ?>
    <?php
}
else{
    header("Location: ../login-register/login.php");
}
?>
