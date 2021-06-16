<?php


include_once ("../../vendor/autoload.php");
include_once ("../../vendor/phpmailer/phpmailer/src/PHPMailer.php");

use App\Utility\Utility;
use App\user_registration\registration;
use App\user_registration\authentication;
use App\DataManipulation\DataManipulation;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
$mail = new PHPMailer( true);
$datamanipulation =new DataManipulation();
$authenticate =new authentication();
$registration =new registration();
if(!isset($_SESSION)){
    session_start();
}
if (isset($_POST['addNotice'])){
    $http_reffer = $_SERVER['HTTP_REFERER'];
    $noticeSuccess = $datamanipulation->addNotice($_POST['name'],$_POST['notice'],$_POST['notice_title']);
    if ($noticeSuccess){
        $_SESSION['SuccessMessageForNewNotice'] = "<div id=\"toast-container\" class=\"toast-top-right\"><div class=\"toast toast-info\" aria-live=\"assertive\" style=\"\"><div class=\"toast-message\">Institute Offer Added Successfully.</div></div></div>";
        Utility::redirect("$http_reffer");
    }
}
if(isset($_GET['delete_notice'])){
    $http = $_SERVER["HTTP_REFERER"];
    $notic = $_GET['delete_notice'];
    $data = $datamanipulation->deleteNotice($_GET['delete_notice']);

    if($data){
        $_SESSION["deleteMsg"] = "<div id=\"toast-container\" class=\"toast-top-right\"><div class=\"toast toast-error\" aria-live=\"assertive\" style=\"\"><div class=\"toast-message\">Delete Offer Successfully.</div></div></div>";
        Utility::redirect("$http");

    }

}
if(isset($_POST['editNotice'])){

    $http_reffer = $_SERVER['HTTP_REFERER'];
    $id = $_POST['notice_id'];
    $noticeInfo = $_POST['notice'];
    $status = $datamanipulation->updateNotice($noticeInfo,$id);
    if ($status){
        $_SESSION['SuccessMsg'] = "<div id=\"toast-container\" class=\"toast-top-right\"><div class=\"toast toast-info\" aria-live=\"assertive\" style=\"\"><div class=\"toast-message\">Institute Offer Update Successfully.</div></div></div>";
        Utility::redirect('../member/instructing_offere.php');

    }
}
if(isset($_POST['send_message_to_adminBySeller']))
{
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message_user = $_POST['mesaage'];
    $http_reffer = $_SERVER["HTTP_REFERER"];
    try {
        //Server settings
        $mail->SMTPDebug = 0;                                       // Enable verbose debug output
        $mail->isSMTP();                                            // Set mailer to use SMTP
        $mail->Host       = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'onlinefarmingassistant@gmail.com';                     // SMTP username
        $mail->Password   = 'Online123';                               // SMTP password
        $mail->SMTPSecure = 'ssl';         // Enable TLS encryption, `PHPMailer::ENCRYPTION_SMTPS` also accepted
        $mail->Port       = 465;                                    // TCP port to connect to

        //Recipients
        $mail->setFrom('onlinefarmingassistant@gmail.com', "Online Farming Assistant");
        //$mail->addAddress("$userEmail", 'User');     // Add a recipient
        $mail->addAddress('onlinefarmingassistant@gmail.com');               // Name is optional
        $mail->addReplyTo($email, 'Information');
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');

        // Attachments
        //  $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = "<table>
                              <tr><th>Message</th></tr>
                              <tr><td>$message_user</td></tr>
                          </table>";
        $mail->AltBody = 'this is the body in plain text for non-HTML main clients';

        if($mail->send()){

            $_SESSION["SendMessage"] = "<div id=\"toast-container\" class=\"toast-top-right\"><div class=\"toast toast-success\" aria-live=\"assertive\" style=\"\"><div class=\"toast-message\">Mail Sent Successfully.</div></div></div>";
            Utility::redirect("$http_reffer");

        }
    }
    catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        //echo 'Message has been sent';
    }
}
if (isset($_POST['Personal_Information'])){
    $http_reffer = $_SERVER['HTTP_REFERER'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $study = $_POST['study'];
    $medium = $_POST['medium'];
    $address = $_POST['address'];
    $address2 = $_POST['address2'];
    $true = $datamanipulation->checkTeacherEmailInList($_POST['email']);
    if ($true){
        $datamanipulation->checkTeacherEmailInListUpdate($name,$email,$gender,$study,$medium,$address,$address2);
        $_SESSION['SuccessMsg'] = "<div id=\"toast-container\" class=\"toast-top-right\"><div class=\"toast toast-info\" aria-live=\"assertive\" style=\"\"><div class=\"toast-message\">Update Successfully.</div></div></div>";
        Utility::redirect("$http_reffer");
    }
    else {
        $datamanipulation->checkTeacherEmailInListInsert($name,$email,$gender,$study,$medium,$address,$address2);
        $_SESSION['SuccessMsg'] = "<div id=\"toast-container\" class=\"toast-top-right\"><div class=\"toast toast-info\" aria-live=\"assertive\" style=\"\"><div class=\"toast-message\">Update Successfully.</div></div></div>";
        Utility::redirect("$http_reffer");
    }
}
if (isset($_POST['Educational_Information'])){
    $http_reffer = $_SERVER['HTTP_REFERER'];
    $ssc_institute = $_POST['ssc_institute'];
    $ssc_yearpassing= $_POST['ssc_yearpassing'];
    $ssc_group = $_POST['ssc_group'];
    $ssc_gpa = $_POST['ssc_gpa'];
    $hsc_institute = $_POST['hsc_institute'];
    $hsc_yearpassing = $_POST['hsc_yearpassing'];
    $hsc_group= $_POST['hsc_group'];
    $hsc_gpa= $_POST['hsc_gpa'];
    $honours_institute = $_POST['honours_institute'];
    $honours_yearadmission = $_POST['honours_yearadmission'];
    $dept= $_POST['dept'];
    $honours_cgpa= $_POST['honours_cgpa'];
    $email= $_POST['email'];
    $true = $datamanipulation->checkTeacherEmailInList($_POST['email']);
    if ($true){
        $datamanipulation->checkTeacherEmailInListUpdateEducational($email,$ssc_institute,$ssc_yearpassing,$ssc_group,$ssc_gpa,$hsc_institute,$hsc_yearpassing
        ,$hsc_group,$hsc_gpa,$honours_institute,$honours_yearadmission,$dept,$honours_cgpa);
        $_SESSION['SuccessMsg'] = "<div id=\"toast-container\" class=\"toast-top-right\"><div class=\"toast toast-info\" aria-live=\"assertive\" style=\"\"><div class=\"toast-message\">Update Successfully.</div></div></div>";
        Utility::redirect("$http_reffer");
    }
    else {
        $datamanipulation->checkTeacherEmailInListInsertEducational($email,$ssc_institute,$ssc_yearpassing,$ssc_group,$ssc_gpa,$hsc_institute,$hsc_yearpassing
            ,$hsc_group,$hsc_gpa,$honours_institute,$honours_yearadmission,$dept,$honours_cgpa);
        $_SESSION['SuccessMsg'] = "<div id=\"toast-container\" class=\"toast-top-right\"><div class=\"toast toast-info\" aria-live=\"assertive\" style=\"\"><div class=\"toast-message\">Update Successfully.</div></div></div>";
        Utility::redirect("$http_reffer");
    }
}
if (isset($_POST['Tuition_Information'])){
    $http_reffer = $_SERVER['HTTP_REFERER'];
    $tuition_area = $_POST['tuition_area'];
    $email = $_POST['email'];
    $tuition_medium = $_POST['tuition_medium'];
    $tuition_subject = $_POST['tuition_subject'];
    $tuition_class = $_POST['tuition_class'];
    $tuition_week = $_POST['tuition_week'];
    $tuition_shift = $_POST['tuition_shift'];
    $tuition_salary = $_POST['tuition_salary'];
    $tuition_style = $_POST['tuition_style'];
    $true = $datamanipulation->checkTeacherEmailInList($_POST['email']);
    if ($true){
        $datamanipulation->checkTeacherEmailInListUpdateTuition($tuition_area,$email,$tuition_medium,$tuition_subject,
            $tuition_class,$tuition_week,$tuition_shift,$tuition_salary,$tuition_style);
        $_SESSION['SuccessMsg'] = "<div id=\"toast-container\" class=\"toast-top-right\"><div class=\"toast toast-info\" aria-live=\"assertive\" style=\"\"><div class=\"toast-message\">Update Successfully.</div></div></div>";
        Utility::redirect("$http_reffer");
    }
    else {
        $datamanipulation->checkTeacherEmailInListInsertTuition($tuition_area,$email,$tuition_medium,$tuition_subject,
            $tuition_class,$tuition_week,$tuition_shift,$tuition_salary,$tuition_style);
        $_SESSION['SuccessMsg'] = "<div id=\"toast-container\" class=\"toast-top-right\"><div class=\"toast toast-info\" aria-live=\"assertive\" style=\"\"><div class=\"toast-message\">Update Successfully.</div></div></div>";
        Utility::redirect("$http_reffer");
    }
}
if (isset($_POST['acccount_verification_info'])){
    $files2 = rand(1000,10000).$_FILES['files']['name'];
    $fileTmpName2 = $_FILES['files']['tmp_name'];
    $destinationFile2 ='../../assets/upload/'.$files2;
    move_uploaded_file($fileTmpName2,$destinationFile2);

    $http_reffer = $_SERVER['HTTP_REFERER'];

    $email = $_POST['email'];

    $files = rand(1000,10000).$_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $destinationFile ='../../assets/upload/'.$files;
    move_uploaded_file($fileTmpName,$destinationFile);
    $true = $datamanipulation->checkTeacherEmailInList($_POST['email']);
    if ($true){
        $datamanipulation->checkTeacherEmailInListUpdateAccountVerificationInfo($email,$destinationFile,$destinationFile2);
        $_SESSION['SuccessMsg'] = "<div id=\"toast-container\" class=\"toast-top-right\"><div class=\"toast toast-info\" aria-live=\"assertive\" style=\"\"><div class=\"toast-message\">Update Successfully.</div></div></div>";
        Utility::redirect("$http_reffer");
    }
    else {
        $datamanipulation->checkTeacherEmailInListInsertAccountVerificationInfo($email,$destinationFile,$destinationFile2);
        $_SESSION['SuccessMsg'] = "<div id=\"toast-container\" class=\"toast-top-right\"><div class=\"toast toast-info\" aria-live=\"assertive\" style=\"\"><div class=\"toast-message\">Update Successfully.</div></div></div>";
        Utility::redirect("$http_reffer");
    }
}
if (isset($_GET['getData']))
{
    $data = $datamanipulation->getPostDataToShow();
    echo json_encode($data);
}
if (isset($_POST['commentValue'])){
    $commentNo = $_POST['commentNo'];
    $user_name = $_POST['user_name'];
    $user_id = $_POST['user_id'];
    $commentValue = $_POST['commentValue'];
    $data = $datamanipulation->insertComment($user_id,$user_name,$commentValue,$commentNo);
}
if (isset($_POST['noticeInfo'])){
    $user_name = $_POST['user_name'];
    $user_id = $_POST['user_id'];
    $textarea = $_POST['noticeInfo'];
    $datamanipulation->textareaPostSave($user_id,$user_name,$textarea);
}
if (isset($_GET['managePostDelete'])){
    $http_reffer = $_SERVER['HTTP_REFERER'];
    $id = $_GET['managePostDelete'];
    $managePostDelete = $datamanipulation->managePostDelete($id);
    if ($managePostDelete){
        $_SESSION['TostUpdate'] ="<div id=\"toast-container\" class=\"toast-top-right\"><div class=\"toast toast-error\" aria-live=\"assertive\" style=\"\"><div class=\"toast-message\">Delete post Successfully</div></div></div>";
        Utility::redirect("$http_reffer");
    }
}
if (isset($_POST['postDataCollect'])){

    $user_id = $_POST['value'];
    $data = $datamanipulation->postDataCollectviaUserIds($user_id);
    echo json_encode($data);
}
if (isset($_POST['btn-save-changes'])){
    $http_reffer = $_SERVER['HTTP_REFERER'];
    $user_id = $_POST['user_no_from'];
    $user_update_post = $_POST['updatePostDataSection'];
    $data = $datamanipulation->postUpdateDataCollectviaUserId($user_id,$user_update_post);
    if ($data){
        $_SESSION['TostUpdate'] = "<div id=\"toast-container\" class=\"toast-top-right\"><div class=\"toast toast-success\" aria-live=\"polite\" style=\"\"><div class=\"toast-message\">Update your post Successfully</div></div></div>";
        Utility::redirect("$http_reffer");
    }
}
if (isset($_POST['studentsDataCollectViaId']))
{
    $teachers_id = $_POST['teachers_id'];
    $students_id = $_POST['students_id'];
    $datas = $datamanipulation->viewStudentTeacherTotalInfo($teachers_id,$students_id);
    echo json_encode($datas);
}
if (isset($_POST['teachers_name']) && isset($_POST['teachers_id'])){
    $teachers_name = $_POST['teachers_name'];
    $teachers_id = $_POST['teachers_id'];
    $students_id = $_POST['students_id'];
    $students_name = $_POST['students_name'];
    $chat_message = $_POST['chat_message'];
    $data = $datamanipulation->insertMessageForChat($teachers_id,$students_id,$teachers_name,$students_name,$chat_message);
}
if (isset($_GET['user_type_for_teachers'])){
    $data = $datamanipulation->showAlertonMessageforTeachers($_GET['user_id']);
    echo json_encode($data);
}