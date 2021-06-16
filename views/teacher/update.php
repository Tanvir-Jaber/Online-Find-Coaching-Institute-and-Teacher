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
$teacherDetails = $dbmanipulate->detailsOfTeacher($Meemail);
if (isset($_SESSION ['Mid']) && isset($_SESSION ['Mname']) && isset($_SESSION ['Memail']) ){
    include_once "institue_head.php";
    $trueStatus = $dbmanipulate->singleUsers($Meid);
    if ($teacherDetails){
        $name = $teacherDetails->name;$gender = $teacherDetails->gender;$study = $teacherDetails->study;$medium = $teacherDetails->medium;$address = $teacherDetails->address;$address2 = $teacherDetails->address2;
        $ssc_institute = $teacherDetails->ssc_institute;$ssc_yearpassing = $teacherDetails->ssc_yearpassing;
        $ssc_group = $teacherDetails->ssc_group;
        $ssc_gpa = $teacherDetails->ssc_gpa;$hsc_institute = $teacherDetails->hsc_institute;$hsc_yearpassing = $teacherDetails->hsc_yearpassing;
        $hsc_group = $teacherDetails->hsc_group;$hsc_gpa = $teacherDetails->hsc_gpa;
        $honours_institute = $teacherDetails->honours_institute ;$honours_yearadmission = $teacherDetails->honours_yearadmission;
        $dept = $teacherDetails->dept;$honours_cgpa = $teacherDetails->honours_cgpa;

        $tuition_area = $teacherDetails->tuition_area;$tuition_medium = $teacherDetails->tuition_medium;
        $tuition_subject = $teacherDetails->tuition_subject;
        $tuition_class = $teacherDetails->tuition_class;$tuition_week = $teacherDetails->tuition_week;
        $tuition_shift = $teacherDetails->tuition_shift;$tuition_salary = $teacherDetails->tuition_salary;$tuition_style = $teacherDetails->tuition_style;
        $nid = $teacherDetails->nid;$std_card = $teacherDetails->std_card;
    }
    else{
        $name = " ";$gender = " ";$study = " ";$medium = " ";$address = " ";$address2 = " ";
        $ssc_institute = " ";$ssc_yearpassing = " ";$ssc_group = " ";$ssc_gpa = " ";$hsc_institute = " ";$hsc_yearpassing = " ";
            $hsc_group = " ";$hsc_gpa = " ";$honours_institute = " ";$honours_yearadmission = " ";$dept = " ";$honours_cgpa = " ";
        $tuition_area = " ";$tuition_medium = " ";$tuition_subject = " "; $tuition_class = " ";$tuition_week = " ";
        $tuition_shift = " ";$tuition_salary = " ";$tuition_style = " ";
        $nid = '../../assets/img/t.jpg';$std_card = '../../assets/img/t.jpg';
    }
    ?>
    <?php
    if(isset($_SESSION['SuccessMsg'])){
        echo $_SESSION['SuccessMsg'];
        unset($_SESSION['SuccessMsg']);
    }
    ?>
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="text-danger wow flash" data-wow-duration= "2s" data-wow-offset="60"  data-wow-iteration="60">Update Profile</h1>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <!-- Custom Tabs -->
                        <div class="card">
                            <div class="card-header d-flex p-0">
                                <h3 class="card-title p-3 wow swing" data-wow-duration= "2s" data-wow-offset="60"  data-wow-iteration="60">Information</h3>
                                <ul class="nav nav-pills ml-auto p-2 " id="myTab">
                                    <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">Personal Information</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">Educational Information</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#tab_3" data-toggle="tab">Tuition Information</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#tab_4" data-toggle="tab">Account Verification</a></li>
                                </ul>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_1">
                                        <form action="../process/all-process.php" method="post">
                                            <div class="row">
                                                <!--<div class="col-4"></div>-->
                                                <div class="col-12 row">
                                                    <div class="col-4 mb-3">
                                                        <label>Name</label>
                                                        <input class="form-control" type="text" name="name" value="<?php echo $userdetails->name?>" required>
                                                    </div>
                                                    <div class="col-4">
                                                        <label>Email</label>
                                                        <input disabled class="form-control" type="text" value="<?php echo $Meemail?>" name="email">
                                                        <input  class="form-control" type="hidden" value="<?php echo $Meemail?>" name="email">
                                                    </div>
                                                    <div class="col-4">
                                                        <label>Gender</label>
                                                        <input type="text" class="form-control" value="<?php echo $gender?>"  name="gender" required>
                                                    </div>
                                                    <div class="col-6 mb-3">
                                                        <label>Name of The Subject You are studing on</label>
                                                        <input class="form-control" type="text" name="study" value="<?php echo $study?>">
                                                    </div>

                                                    <div class="col-6">
                                                        <label>Background Medium</label>
                                                        <input type="text" class="form-control"  name="medium" value="<?php echo $medium?>" required>
                                                    </div>
                                                    <div class="col-6">
                                                        <label>Present Address</label>
                                                        <input class="form-control" type="text" name="address" value="<?php echo $userdetails->address?>" required>
                                                    </div>
                                                    <div class="col-6 mb-3">
                                                        <label>Permanent Address</label>
                                                        <input class="form-control" type="text" name="address2" value="<?php echo $address2?>"  required>
                                                    </div>
                                                    <input class="form-control btn btn-info" name="Personal_Information" type="submit" value="Update Profile">
                                                </div>
                                            </div>

                                        </form>

                                    </div>
                                    <div class="tab-pane" id="tab_2">
                                        <form action="../process/all-process.php" method="post">
                                            <div class="row">
                                                <div class="col-12 d-flex justify-content-center"><h1>SSC Information</h1></div>
                                                <div class="col-6 mb-2">
                                                    <label>Institute</label>
                                                    <input class="form-control" type="text" name="ssc_institute" required value="<?php echo $ssc_institute?>">
                                                </div>
                                                <div class="col-6">
                                                    <label>Year of Passing</label>
                                                    <input class="form-control" type="text" name="ssc_yearpassing" required value="<?php echo $ssc_yearpassing?>">
                                                </div>
                                                <div class="col-6 mb-2">
                                                    <label>Group</label>
                                                    <input class="form-control" type="text" name="ssc_group" required value="<?php echo $ssc_group?>">
                                                </div>
                                                <div class="col-6">
                                                    <label>GPA</label>
                                                    <input class="form-control" type="text" name="ssc_gpa" required value="<?php echo $ssc_gpa?>">
                                                </div>
                                                <div class="col-12 d-flex justify-content-center"><h1>HSC Information</h1></div>
                                                <div class="col-6 mb-2">
                                                    <label>Institute</label>
                                                    <input class="form-control" type="text" name="hsc_institute" required value="<?php echo $hsc_institute?>">
                                                </div>
                                                <div class="col-6">
                                                    <label>Year of Passing</label>
                                                    <input class="form-control" type="text" name="hsc_yearpassing" required value="<?php echo $hsc_yearpassing?>">
                                                </div>
                                                <div class="col-6 mb-2">
                                                    <label>Group</label>
                                                    <input class="form-control" type="text" name="hsc_group" required value="<?php echo $hsc_group?>">
                                                </div>
                                                <div class="col-6">
                                                    <label>GPA</label>
                                                    <input class="form-control" type="text" name="hsc_gpa" required value="<?php echo $hsc_gpa?>">
                                                </div>
                                                <div class="col-12 d-flex justify-content-center"><h1>Honours Information</h1></div>
                                                <div class="col-6 mb-2">
                                                    <label>Institute</label>
                                                    <input class="form-control" type="text" name="honours_institute" required value="<?php echo $honours_institute?>">
                                                </div>
                                                <div class="col-6">
                                                    <label>Year of Admission</label>
                                                    <input class="form-control" type="text" name="honours_yearadmission" required value="<?php echo $honours_yearadmission?>">
                                                </div>
                                                <div class="col-6 mb-2">
                                                    <label>Group</label>
                                                    <input class="form-control" type="text" name="dept" required value="<?php echo $dept?>" >
                                                </div>
                                                <div class="col-6">
                                                    <label>CGPA</label>
                                                    <input class="form-control" type="text" name="honours_cgpa" value="<?php echo $honours_cgpa?>" required>
                                                    <input type="hidden" name="email" value="<?php echo $Meemail?>">
                                                </div>
                                                <input class="form-control btn btn-info" type="submit" name="Educational_Information" value="Update Profile">
                                            </div>
                                        </form>
                                    </div>
                                    <!-- /.tab-pane -->
                                    <div class="tab-pane" id="tab_3">
                                        <form action="../process/all-process.php" method="post">
                                            <input type="hidden" name="email" value="<?php echo $Meemail?>">
                                            <div class="row">
                                                <div class="col-12 d-flex justify-content-center"><h1>Tuition Information</h1></div>
                                                <div class="col-6 mb-2">
                                                    <label>Preferred Area for tuition</label>
                                                    <input class="form-control" type="text" name="tuition_area" required value="<?php echo $tuition_area?>">
                                                </div>
                                                <div class="col-6">
                                                    <label>Preferred Medium</label>
                                                    <input class="form-control" type="text" name="tuition_medium" required value="<?php echo $tuition_medium?>">
                                                </div>
                                                <div class="col-6 mb-2">
                                                    <label>Preferred Subject</label>
                                                    <input class="form-control" type="text" name="tuition_subject" required value="<?php echo $tuition_subject?>">
                                                </div>
                                                <div class="col-6">
                                                    <label>Preferred Classes</label>
                                                    <input class="form-control" type="text" name="tuition_class" value="<?php echo $tuition_class?>">
                                                </div>
                                                <div class="col-6 mb-2">
                                                    <label>Days Per Week</label>
                                                    <input class="form-control" type="text" name="tuition_week" required value="<?php echo $tuition_week?>">
                                                </div>
                                                <div class="col-6">
                                                    <label>Timing Shift</label>
                                                    <input class="form-control" type="text" name="tuition_shift" required value="<?php echo $tuition_shift?>">
                                                </div>
                                                <div class="col-6 mb-2">
                                                    <label>Expected Salary</label>
                                                    <input class="form-control" type="text" name="tuition_salary" required value="<?php echo $tuition_salary?>">
                                                </div>
                                                <div class="col-6">
                                                    <label>Preffered Tuition Style</label>
                                                    <input type="text" class="form-control"  name="tuition_style" placeholder="e.g Private,Group" required value="<?php echo $tuition_style?>">
                                                </div>
                                                <input class="form-control btn btn-info" name="Tuition_Information" type="submit" value="Update Profile">
                                            </div>
                                        </form>
                                    </div>
                                    <!-- /.tab-pane -->
                                    <div class="tab-pane" id="tab_4">
                                        <form action="../process/all-process.php" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="email" value="<?php echo $Meemail?>">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h3 class="card-title">
                                                                <i class="fas fa-text-width"></i>
                                                                NID CARD
                                                            </h3>
                                                        </div>
                                                        <div class="card-body">
                                                            <blockquote>
                                                                <img style="width: 400px; height: 200px" src="<?php echo $nid?>">
                                                            </blockquote>
                                                            <div class="custom-file">
                                                                <input type="file" name="file" class="custom-file-input" id="customFile" ACCEPT="image/*" required>
                                                                <label class="custom-file-label" for="customFile">Choose file</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h3 class="card-title">
                                                                <i class="fas fa-text-width"></i>
                                                                STUDENT ID CARD
                                                            </h3>
                                                        </div>
                                                        <!-- /.card-header -->
                                                        <div class="card-body clearfix">
                                                            <blockquote class="quote-secondary">
                                                                <img style="width: 400px; height: 200px" src="<?php echo $std_card?>">
                                                            </blockquote>
                                                            <div class="custom-file">
                                                                <input type="file" name="files" class="custom-file-input" id="customFile" ACCEPT="image/*" required>
                                                                <label class="custom-file-label" for="customFile">Choose file</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <input class="form-control btn btn-info" name="acccount_verification_info" type="submit" value="Update Profile">
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <?php
    include_once "institue_foot.php";
    ?>
    <script>
        $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
            localStorage.setItem('activeTab', $(e.target).attr('href'));
        });
        var activeTab = localStorage.getItem('activeTab');
        if(activeTab){
            $('#myTab a[href="' + activeTab + '"]').tab('show');
        }
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>
    <?php
}
else{
    header("Location: ../login-register/login.php");
}
?>
