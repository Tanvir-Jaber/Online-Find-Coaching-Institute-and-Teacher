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
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Contact Us</h1>
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
        <div  class="content wow swing" data-wow-duration= "2s">
            <?php
            if (isset($_SESSION["SendMessage"])){
                echo $_SESSION["SendMessage"];
                unset($_SESSION["SendMessage"]);
            }
            ?>
            <div class="row m-2">
                <div class="col-4 card ml-4">
                    <div class="p-4">
                        <i class="fas fa-phone fa-2x"></i><span style="color: #344e86; font-size: 25px"> Phone:</span>
                        <p style="padding-left: 30px">+8801865-232773</p>
                        <br>
                        <i class="far fa-envelope fa-2x"></i><span style="color: #344e86; font-size: 25px"> Mail:</span>
                        <p style="padding-left: 30px">OnlineInstructingInstituteTeacher@gmail.com</p>
                        <br>
                        <i class="fas fa-map-marker-alt fa-2x"></i>
                        <span style="color: #344e86; font-size: 25px"> Address:</span>
                        <p style="padding-left: 30px"> Khulshi, Chittagong</p>
                    </div>

                </div>
                <div class="col-7 card ml-3">
                    <div  class="tab-pane ">
                        <form class="form-horizontal" action="../process/all-process.php" method="post">
                            <input class="user_id" name="user_id" type="hidden" value="<?php echo $Meid?>" >

                            <div style="padding: 10px" class="form-group row">
                                <div class="col-6 mb-1">
                                    <label ><strong  >Your Name:</strong></label>
                                    <div>
                                        <input type="text" disabled class="form-control" name="name" value="<?php echo $userdetails->name?>">
                                    </div>
                                </div>
                                <div class="col-6 mb-1">
                                    <label  ><strong  >Your Email:</strong></label>
                                    <div >
                                        <input type="email" disabled  class="form-control"  value="<?php echo $Meemail?>">
                                        <input type="hidden"  name="email" value="<?php echo $Meemail?>">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div>
                                        <label >Subject</label>
                                        <input required placeholder="Subject" class="form-control" name="subject" value="">
                                    </div>
                                </div>
                                <div class="col-12 mb-2">
                                    <div>

                                        <label >Message</label>
                                        <textarea required placeholder="Message" class="form-control " rows="10" name="mesaage" value=""></textarea>
                                    </div>
                                </div>
                                <button style="color: white" type="submit" class="form-control btn btn-info  btn-outline-primary btn-round" name="send_message_to_adminBySeller" >Message</button>
                            </div>
                            <div class="form-group row">
                                <div class="offset-sm-2 col-12">

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <br>
            <br>


        </div>
        <!-- /.content -->
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
