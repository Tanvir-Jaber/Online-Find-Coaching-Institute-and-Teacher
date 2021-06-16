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
        <br>
        <?php
        if(isset($_SESSION['TostUpdate'])){
            echo $_SESSION['TostUpdate'];
            unset($_SESSION['TostUpdate']);
        }
        ?>
        <section class="content container-fluid">
            <div class="row ml-5">
                <div class="col-md-10 timeline">
                    <?php
                    $listOfValues = $dbmanipulate->viewPostByUserId($Meid);
                    if ($listOfValues){
                        foreach ($listOfValues as $listOfValues){
                            ?>

                            <div class="time-label">
                                <span class="bg-red"><?php $date = $listOfValues->date;  $date = date('F j, Y',strtotime($date)); echo $date?></span>
                            </div>
                            <div>
                                <i class="fas fa-envelope bg-gradient-green"></i>
                                <div class="timeline-item">
                                    <span class="time"><i class="fas fa-clock"></i> <?php echo $listOfValues->time?></span>
                                    <h3 class="timeline-header"><?php echo $listOfValues->name?></h3>

                                    <div  class="timeline-body">
                                        <?php echo nl2br($listOfValues->post) ?>
                                    </div>
                                    <div class="timeline-footer">
                                        <a data-id = "<?php echo $listOfValues->post_no ?>"class="btn btn-info btn-sm editPost" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-pencil-alt"></i> Edit</a>
                                        <a href="../process/all-process.php?managePostDelete=<?php echo $listOfValues->post_no; ?>" class="btn btn-danger btn-sm"><i class="fas fa-trash"> </i> Delete</a>
                                    </div>
                                </div>
                            </div>

                            <?php

                            if ($listOfValues->commentNo == NULL ){
                                $comment = $dbmanipulate->viewPostComment($listOfValues->post_no);
                                foreach ($comment as $comments){
                                    if($listOfValues->post_no == $comments->commentNo ) {
                                        ?>
                                        <div>
                                            <i class="fas fa-comments bg-gradient-danger"></i>
                                            <div class="timeline-item">
                                                <span class="time"><i class="fas fa-clock"></i> <?php echo $comments->date," ",$comments->time ; ?></span>
                                                <h3 class="timeline-header"><?php echo "<b>", $comments->name,"</b>"; ?></h3>
                                                <div class="timeline-body">
                                                    <?php echo $comments->post; ?>

                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }
                            }
                            ?>
                            <?php
                        }
                    }
                    else{
                        ?>
                        <div class="typewriter d-flex justify-content-center mt-5">
                            <h1>You Have No Post.</h1>
                        </div><?php
                    }
                    ?>
                </div>
                <form action="../process/all-process.php" method="post">
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit Post</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div style="min-height: 250px" class="modal-body">
                                    <textarea name="updatePostDataSection" class="updatePostDataSection form-control" style="resize: none; width: 100%;height: 240px"></textarea>
                                </div>
                                <div class="modal-footer">
                                    <input type="hidden" name="user_no_from" class="user_no_from">
                                    <button type="button" class="btn btn-info btn-sm" data-dismiss="modal"><i class="fas fa-times-circle"></i> Close</button>
                                    <button type="submit" name="btn-save-changes" class="btn btn-success btn-sm"><i class="fas fa-save"></i> Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
    <?php
    include_once "institue_foot.php";
    ?>
    <script>
        $(".editPost").click(function () {
            var value = $(this).attr('data-id');
            var postDataCollect = " ";
            $.ajax({
                type: "POST",
                url: "../process/all-process.php",
                data: {
                    value: value,
                    postDataCollect :postDataCollect
                },
                success: function(data)
                {
                    var data = JSON.parse(data);

                    $(".updatePostDataSection").val(data.post)
                    $(".user_no_from").val(data.post_no)

                }
            });
        })
    </script>
    <?php
}
else{
    header("Location: ../login-register/login.php");
}
?>
