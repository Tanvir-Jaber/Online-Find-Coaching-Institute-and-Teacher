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
    $teacherDetails = $dbmanipulate->detailsOfTeacher($Meemail);
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
                                 </div>
                             </div>
                         </div>
                         <div class="col-md-6">
                             <div class="card">
                                 <div class="card-header">
                                     <h3 class="card-title">
                                         <i class="fas fa-text-width"></i>
                                         Personal Information
                                     </h3>
                                 </div>
                                 <!-- /.card-header -->
                                 <div class="card-body">
                                     <ul style="font-weight: bold; font-size: 18px">
                                         <li>Name:- <?php echo "<span style='color: #1aa67d'>",$userdetails->name?></li>
                                         <li>Email:- <?php echo "<span style='color: #1aa67d'>", $Meemail?></li>
                                         <li>Gender:- <?php echo "<span style='color: #1aa67d'>",$gender?></li>
                                         <li>Name of The Subject You are studing on:- <?php echo "<span style='color: #1aa67d'>",$study?></li>
                                         <li>Background Medium:- <?php echo "<span style='color: #1aa67d'>",$medium?></li>
                                         <li>Present Address:- <?php echo "<span style='color: #1aa67d'>",$address?></li>
                                         <li>Permanent Address:- <?php echo "<span style='color: #1aa67d'>",$address2?></li>
                                     </ul>
                                 </div>
                                 <!-- /.card-body -->
                             </div>
                             <!-- /.card -->
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
                     </div>
                     <div class="row">

                         <!-- ./col -->
                         <div class="col-md-6">
                             <div class="card">
                                 <div class="card-header">
                                     <h3 class="card-title">
                                         <i class="fas fa-text-width"></i>
                                         Educational Information
                                     </h3>
                                 </div>
                                 <!-- /.card-header -->
                                 <div class="card-body">
                                         <ul style="font-weight: bold; font-size: 18px">
                                             <li>SSC Institute:- <?php echo "<span style='color: #1aa67d'>",$ssc_institute?></li>
                                             <li>Year of Passing:- <?php echo "<span style='color: #1aa67d'>", $ssc_yearpassing?></li>
                                             <li>Group:- <?php echo "<span style='color: #1aa67d'>",$ssc_group?></li>
                                             <li>GPA:- <?php echo "<span style='color: #1aa67d'>",$ssc_gpa?></li>
                                             <hr>
                                             <li>HSC Institute:- <?php echo "<span style='color: #1aa67d'>",$hsc_institute?></li>
                                             <li>Year of Passing:- <?php echo "<span style='color: #1aa67d'>", $hsc_yearpassing?></li>
                                             <li>Group:- <?php echo "<span style='color: #1aa67d'>",$hsc_group?></li>
                                             <li>GPA:- <?php echo "<span style='color: #1aa67d'>",$hsc_gpa?></li>
                                             <hr>
                                             <li>Honours  Institute:- <?php echo "<span style='color: #1aa67d'>",$honours_institute?></li>
                                             <li>Year of Admission:- <?php echo "<span style='color: #1aa67d'>", $honours_yearadmission?></li>
                                             <li>Department:- <?php echo "<span style='color: #1aa67d'>",$dept?></li>
                                             <li>CGPA:- <?php echo "<span style='color: #1aa67d'>",$honours_cgpa?></li>

                                         </ul>
                                 </div>
                                 <!-- /.card-body -->
                             </div>
                             <!-- /.card -->
                         </div>
                         <!-- ./col -->
                         <div class="col-md-6">
                             <div class="card">
                                 <div class="card-header">
                                     <h3 class="card-title">
                                         <i class="fas fa-text-width"></i>
                                         Tuition Information
                                     </h3>
                                 </div>
                                 <!-- /.card-header -->
                                 <div class="card-body">
                                     <ul style="font-weight: bold; font-size: 18px">
                                         <li>Preferred Area for tuition:- <?php echo "<span style='color: #1aa67d'>",$tuition_area?></li>
                                         <li>Preferred Medium:- <?php echo "<span style='color: #1aa67d'>", $tuition_medium?></li>
                                         <li>Preferred Subject:- <?php echo "<span style='color: #1aa67d'>",$tuition_subject?></li>
                                         <li>Preferred Classes:- <?php echo "<span style='color: #1aa67d'>",$tuition_class?></li>
                                         <li>Days Per Week:- <?php echo "<span style='color: #1aa67d'>",$tuition_week?></li>
                                         <li>Timing Shift:- <?php echo "<span style='color: #1aa67d'>",$tuition_shift?></li>
                                         <li>Expected Salary:- <?php echo "<span style='color: #1aa67d'>",$tuition_salary?></li>
                                         <li>Preffered Tuition Style:- <?php echo "<span style='color: #1aa67d'>",$tuition_style?></li>
                                     </ul>
                                 </div>
                                 <!-- /.card-body -->
                             </div>
                             <!-- /.card -->
                         </div>
                         <!-- ./col -->
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
