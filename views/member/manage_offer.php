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
                        <h1 class="m-0 text-dark">Notice</h1>
                    </div>
                </div>
            </div>
        </div>
        <?php
        if(isset($_SESSION['SuccessMessageForNewNotice'])){
            echo $_SESSION['SuccessMessageForNewNotice'];
            unset($_SESSION['SuccessMessageForNewNotice']);
        }
        ?>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-success card-outline">
                            <div class="card-body box-profile">
                                <div class="card card-success">
                                    <div class="card-header">
                                    </div>
                                    <?php
                                    if(isset($_GET['notice_id'])){
                                        $noticeId=$_GET['notice_id'];
                                        $noticeData=$dbmanipulate->viewNoticeByid($_GET['notice_id']);


                                    }
                                    ?>
                                    <form action="../process/all-process.php" method="post">
                                        <input type="hidden" name="name" value="<?php echo $Meemail?>">
                                        <div class="card-body">
                                            <strong><i class="fas fa-book mr-1"></i>??????????????? ????????????</strong>
                                            <textarea style="resize: none; height: 150px" name="notice" class="main-search form-control"><?php echo $noticeData->offer_details?></textarea>
                                            <input type="hidden" name="notice_id" value="<?php echo $noticeId?>">

                                            <hr>
                                            <div class="row">
                                                <div class="col-12">
                                                    <button type="submit" name="editNotice" style="background: #02c27f;border: #00adc2;color: #ffffff;font-weight: bold" class="btn btn-block btn-outline-success"><i class="fa fa-sign-language mr-2" aria-hidden="true"></i>Edit</button>
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
}
else{
    header("Location: ../login-register/login.php");
}
?>
