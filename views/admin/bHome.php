<?php
if(!isset($_SESSION)){
    session_start();
}
include_once ("../../vendor/autoload.php");
use App\DataManipulation\DataManipulation;
$Adid = $_SESSION ['Aid'];
$Adname = $_SESSION ['Aname'];
$Ademail = $_SESSION ['Aemail'];
$dbmanipulate = new DataManipulation();
if (isset($_SESSION ['Aid']) && isset($_SESSION ['Aname']) && isset($_SESSION ['Aemail']) ){
    include_once "adminHead.php";
    ?>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Home</h1>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-info elevation-1 wow swing" data-wow-duration= "2s"><i class="fas fa-cog"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Total Admin</span>
                                <span class="info-box-number"><?php
                                    $count_admin = $dbmanipulate->Admin();
                                    echo count($count_admin)
                                    ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-danger elevation-1 wow wobble" data-wow-duration= "2s"><i class="fas fa-thumbs-up"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Total Teacher</span>
                                <span class="info-box-number">
                                    <?php
                                    $count_admin = $dbmanipulate->TotalTeacheListSearch();
                                    echo count($count_admin)
                                    ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix hidden-md-up"></div>

                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3 ">
                            <span class="info-box-icon bg-success elevation-1 wow swing" data-wow-duration= "2s"><i class="fas fa-shopping-cart "></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Total Institute</span>
                                <span class="info-box-number">
                                     <?php
                                     $count_admin = $dbmanipulate->TotalInstituteSearch();
                                     echo count($count_admin)
                                     ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-warning elevation-1 wow wobble" data-wow-duration= "2s"><i class="fas fa-users"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Total Members</span>
                                <span class="info-box-number"> <?php
                                    $count_admin = $dbmanipulate->TotalMembersSearch();
                                    echo count($count_admin)
                                    ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="carouselExampleControls" class="carousel slide wow swing" data-wow-duration= "2s" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item d-flex justify-content-center active">
                        <img style="width: 85%; height: 400px;" class="d-block " src="https://storage.googleapis.com/ibw-blog/media/72/9a7e6fc7ef32f3cd56ad901410bb27.png" alt="First slide">
                    </div>
                    <div class="carousel-item d-flex justify-content-center">
                        <img style="width: 85%; height: 400px;" class="d-block " src="https://mentoria.azureedge.net/e84dd445-4bd2-4026-850f-3474080de6be_feed_web.jpg" alt="Second slide">
                    </div>
                    <div class="carousel-item d-flex justify-content-center">
                        <img style="width: 85%; height: 400px;" class="d-block " src="https://publictechnology.net/sites/www.publictechnology.net/files/styles/original_-_local_copy/entityshare/22392%3Fitok%3D0-vwWgES" alt="Third slide">
                    </div>
                    <div class="carousel-item d-flex justify-content-center">
                        <img style="width: 85%; height: 400px;" class="d-block " src="https://www.nea.org/sites/default/files/styles/1920wide/public/legacy/2018/05/FINAL_STRESS-copy-1-e1526014798962.jpg?itok=ffO945ZB" alt="Forth slide">
                    </div>
                    <div class="carousel-item d-flex justify-content-center">
                        <img style="width: 85%; height: 400px;" class="d-block " src="https://www.thoughtco.com/thmb/oBZHBIQNZN1OGGCiaIs4n5acmfo=/735x0/ways-to-keep-your-class-interesting-4061719_final-296fc6e82fc248659c9bc049dd8018a5.png" alt="Third slide">
                    </div>
                </div>
            </div>
        </section>
    </div>


    <?php
    include_once "adminFoot.php";
    ?>
    <script>
        $('.carousel').carousel({
            interval: 2000
        })
    </script>
    <?php
}
else{
    header("Location: ../login-register/login.php");
}
?>

