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
if (isset($_SESSION ['Mid']) && isset($_SESSION ['Mname']) && isset($_SESSION ['Memail']) ){
    include_once "institue_head.php";
    $trueStatus = $dbmanipulate->singleUsers($Meid);
    ?>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Instructing Institute Offer</h1>
                    </div>
                </div>
            </div>
        </div>
        <?php

        if(isset($_SESSION['SuccessMessageForNewNotice'])){
            echo $_SESSION['SuccessMessageForNewNotice'];
            unset($_SESSION['SuccessMessageForNewNotice']);
        }
        if(isset($_SESSION['SuccessMsg'])){
            echo $_SESSION['SuccessMsg'];
            unset($_SESSION['SuccessMsg']);
        }
        ?>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="">
                            <div class="">
                                <div class="">
                                    <form action="../process/all-process.php" method="post">
                                        <input type="hidden" name="name" value="<?php echo $Meemail?>">
                                        <div class="card-body">
                                            <strong><i class="fas fa-book mr-1"></i>Institute Offer</strong>
                                            <input type="text" name="notice_title" class="form-control mb-1" placeholder="Please write your offer title" required>
                                            <textarea style="resize: none; height: 150px" name="notice" class="main-search form-control" required></textarea>
                                            <div class="row mt-1">
                                                <div class="col-12">
                                                    <button type="submit" name="addNotice" style="background: #02c27f;border: #00adc2;color: #ffffff;font-weight: bold" class="btn btn-block btn-outline-success"><i class="fa fa-sign-language mr-2" aria-hidden="true"></i>Submit</button>
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

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="callout callout-info" >
                            <?php

                            if(isset($_SESSION['inserMsg'])){
                                echo $_SESSION['inserMsg'];
                                unset($_SESSION['inserMsg']);
                            }
                            if(isset($_SESSION['updateMsg'])){
                                echo $_SESSION['updateMsg'];
                                unset($_SESSION['updateMsg']);
                            }
                            if(isset($_SESSION['deleteMsg'])){
                                echo $_SESSION['deleteMsg'];
                                unset($_SESSION['deleteMsg']);
                            }
                            ?>
                            <h5><i class="fas fa-info"></i> Offer View:</h5>
                            <?php
                            $list = $dbmanipulate->viewNoticeInfo();

                            if($list){
                                foreach ($list as $lists){
                                    ?>
                                    <div class="row">
                                        <div class="col-8"><b><?php $date = $lists->date; echo  date(' m/d/Y', strtotime($date));?></b></div>

                                        <div class=""> </div>
                                        <div class="col-4 btn-group" style="padding-left: 190px">
                                            <a style="text-decoration: none" href="manage_offer.php?notice_id=<?php echo $lists->institute_offer_no?>" class="btn btn-primary btn-outline-secondary btn-round"> <i class="fas fa-edit"></i></a>
                                            <a style="text-decoration: none" href="../process/all-process.php?delete_notice=<?php echo $lists->institute_offer_no?>" class="btn btn-danger btn-outline-success btn-round"><i class="far fa-trash-alt"></i></a>
                                        </div>

                                    </div>
                                    <!--<div class="mb-5 mr-5 d-flex justify-content-end">9/5/2020</div>-->
                                    <div style="text-transform:capitalize;font-weight:bold;white-space:pre-wrap;font-size: 30px; padding-left: 13px"><?php echo $lists->Title?></div>
                                    <div style="white-space:pre-wrap;font-size: 17px; padding-left: 13px"><?php echo $lists->offer_details?></div><hr>
                                    <?php
                                }}

                            ?>

                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div>
    <?php
    include_once "institue_foot.php";
}
else{
    header("Location: ../login-register/login.php");
}
?>
