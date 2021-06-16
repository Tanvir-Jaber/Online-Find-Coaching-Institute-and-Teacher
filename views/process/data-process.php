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

if(isset($_POST['reg-btn'])){
    $files = rand(1000,10000).$_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $destinationFile ='../../assets/upload/'.$files;
    move_uploaded_file($fileTmpName,$destinationFile);
    $_POST['blood']=$destinationFile ;
    $receiver=$_POST['email'];
    $emailToken = rand(100000, 999999);
    $name = $_POST['name'];
    $_POST['emailToken'] = $emailToken;

    $registerEmail = $registration->emailIsExits($receiver);
    if ($registerEmail) {
        $http_reffer = $_SERVER['HTTP_REFERER'];
        $_SESSION['errorMessageRegister'] = "<div class=\"alert alert-danger alert-dismissible rounded-0\">
                  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
                  <h5><i class=\"icon fas fa-ban\"></i> Oops!</h5>
                  Already exists this email address. Please try another email address
                </div>";
        Utility::redirect("$http_reffer");
    }
    else{
        try {
            //Server settings
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'onlinefarmingassistant@gmail.com';
            $mail->Password   = 'Online123';
            $mail->SMTPSecure = 'ssl';
            $mail->Port       = 465;

            //Recipients
            $mail->setFrom('julkornaini@gmail.com', 'Banglades E-commerce Industry');
            $mail->addAddress("$receiver", 'User');
            $mail->addAddress('ellen@example.com');
            $mail->addReplyTo('julkornaini@gmail.com', 'Information');

            $mail->isHTML(true);
            $mail->Subject = "Verification Code";
            $mail->Body    = "<p>Here is your code <b> $emailToken </b></p>";
            $mail->AltBody = 'this is the body in plain text for non-HTML main clients';

            if($mail->send()){
                $registration->setData($_POST);
                echo $_POST['emailToken'];
                $insert = $registration->insertRegisterData();
                $_SESSION['m'] = $receiver;
                Utility::redirect("../login-register/verification.php");
            }

        }
        catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";

        }
    }
}
if (isset($_POST['verification-btn'])) {
    $otp = $_POST['otp'];
    $mail = $_POST['mail'];
    $verification = $registration->varification($otp,$mail);
    $http_reffer = $_SERVER['HTTP_REFERER'];
    if ($verification){
        $registration->tokenUpdate($mail);
        Utility::redirect("../login-register/login.php");
    }
    else{
        $_SESSION['errorMessageVerification'] = "<div class=\"alert alert-warning alert-dismissible rounded-0\">
                  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
                  <h5><i class=\"icon fas fa-exclamation-triangle\"></i> Oops!</h5>
                  Sorry. Your verification code is not matched
                </div>";
        Utility::redirect("$http_reffer");
    }

}
if (isset($_POST['signin'])){
    $http_reffer = $_SERVER['HTTP_REFERER'];
    $authenticate->setSignInData($_POST);
    $data = $authenticate->authenticate();
    if($data){
        if($data->position == "Admin"){
            $_SESSION ['Aid'] = $data->no;
            $_SESSION ['Aname'] = $data->name;
            $_SESSION ['Aemail'] = $data->email;
            Utility::redirect("../admin/bHome.php");
        }
        else if($data->position == "InstructingInstitute"){
            $_SESSION ['Mid'] = $data->no;
            $_SESSION ['Mname'] = $data->name;
            $_SESSION ['Memail'] = $data->email;
            Utility::redirect("../member/profile.php");
        }
        else if($data->position == "Teacher"){
            $_SESSION ['Mid'] = $data->no;
            $_SESSION ['Mname'] = $data->name;
            $_SESSION ['Memail'] = $data->email;
            Utility::redirect("../teacher/profile.php");
        }
        else{
            $_SESSION ['Mid'] = $data->no;
            $_SESSION ['Mname'] = $data->name;
            $_SESSION ['Memail'] = $data->email;
            Utility::redirect("../student/home.php");
        }
    }
    else{
        $_SESSION['errorMessageSignin'] = "<div class=\"alert alert-danger alert-dismissible rounded-0\">
                  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
                  <h5><i class=\"icon fas fa-exclamation-triangle\"></i> Oops!</h5>
                  Sorry. Your email and password not matched
                </div>";
        Utility::redirect("$http_reffer");
    }

}

if (isset($_POST['forgot-pass'])){
    $emailToken = rand(100000, 999999);
    $_POST['emailToken'] = $emailToken;
    $http_reffer = $_SERVER['HTTP_REFERER'];
    $email = $_POST['email'];
    $check = $authenticate->checkEmail($email);
    if($check){
        try {
            //Server settings
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'onlinefarmingassistant@gmail.com';
            $mail->Password   = 'Online123';
            $mail->SMTPSecure = 'ssl';
            $mail->Port       = 465;

            //Recipients
            $mail->setFrom('julkornaini@gmail.com', 'Banglades E-commerce Industry');
            $mail->addAddress("$email", 'User');
            $mail->addAddress('ellen@example.com');
            $mail->addReplyTo('julkornaini@gmail.com', 'Information');

            $mail->isHTML(true);
            $mail->Subject = "Verification Code";
            $mail->Body    = "<p>Here is your code <b> $emailToken </b></p>";
            $mail->AltBody = 'this is the body in plain text for non-HTML main clients';

            if($mail->send()){
                $update_forgot = $registration->checkActivetokenUpdate($email,$emailToken);
                $_SESSION['mm'] = $email;
                Utility::redirect("../login-register/recover-password.php");
            }

        }
        catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";

        }
    }
    else{
        $_SESSION['errorMessageForgot'] = "<div class=\"alert alert-danger alert-dismissible rounded-0\">
                  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
                  <h5><i class=\"icon fas fa-exclamation-triangle\"></i> Oops!</h5>
                  Sorry. Your email address is not registered.
                </div>";
        Utility::redirect("$http_reffer");
    }
}
if(isset($_GET['user_no'])){
    $http_reffer = $_SERVER['HTTP_REFERER'];
    $id = $_GET['user_no'];
    $status = $datamanipulation->usercheckactive($id);
    if ($status){
        Utility::redirect("$http_reffer");
    }
}
if(isset($_GET['user_status_active'])){
    $http_reffer = $_SERVER['HTTP_REFERER'];
    $id = $_GET['user_status_active'];
    $status = $datamanipulation->userupdateStatusTrash($id);
    if ($status){
        Utility::redirect("$http_reffer");
    }
}
if(isset($_GET['user_status_active_via_id'])){
    $http_reffer = $_SERVER['HTTP_REFERER'];
    $id = $_GET['user_status_active_via_id'];
    $status = $datamanipulation->userupdateStatusTrashReover($id);
    if ($status){
        Utility::redirect("$http_reffer");
    }
}
if(isset($_POST['edit-information'])){
    $http_reffer = $_SERVER['HTTP_REFERER'];
    $id = $_POST['user_no'];
    $name= $_POST['name'];
    $address = $_POST['address'];
    $status = $datamanipulation->userProfileUdate($id,$name,$address);
    $_SESSION['UpdateSuccessMessageForPassword'] ="<div id=\"toast-container\" class=\"toast-top-right\"><div class=\"toast toast-info\" aria-live=\"assertive\" style=\"\"><div class=\"toast-message\">Update Successfully</div></div></div>";
    Utility::redirect("$http_reffer");

}
if(isset($_GET['user_bno22'])){
    $http_reffer = $_SERVER['HTTP_REFERER'];
    $id = $_GET['user_bno22'];
    $status = $datamanipulation->usercheckactiveDelete($id);
    if ($status){
        Utility::redirect("$http_reffer");
    }
}
if (isset($_POST['change-pass'])){
    $http_reffer = $_SERVER['HTTP_REFERER'];
    $user_id = $_POST['user_no'];
    $pass = $_POST['password'];
    $statusTrue = $datamanipulation->updateUserPassword($user_id,$pass);
    if ($statusTrue){
        $_SESSION['UpdateSuccessMessageForPassword'] = "<div class=\"alert alert-success alert-dismissible ml-2 mr-2 rounded-0\">
                  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
                  <h5><i class=\"icon fas fa-check\"></i> Success!</h5>
                  Your password is successfully changed.
                </div>";
        Utility::redirect("$http_reffer");
    }
}
if(isset($_GET['Alogout'])){
    session_destroy();
    Utility::redirect("../login-register/login.php");
}
if (isset($_POST['change_recover_password'])){
    $http_reffer = $_SERVER['HTTP_REFERER'];
    $user_mail = $_POST['email'];
    $otp = $_POST['otp'];
    $pass = $_POST['password'];
    $statusTrue = $registration->recoverEmailToken($user_mail,$otp);
    if ($statusTrue){
        $status = $registration->updateUserPassword($user_mail,$pass);
        Utility::redirect("../login-register/login.php");
    }
    else{
        $_SESSION['errorMessageRecover'] = "<div class=\"alert alert-danger alert-dismissible rounded-0\">
                  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
                  <h5><i class=\"icon fas fa-exclamation-triangle\"></i> Oops!</h5>
                  Sorry. Your otp not matched
                </div>";
        Utility::redirect("$http_reffer");
    }
}
if (isset($_GET['user_Details_Preview']))
{
    $data = $datamanipulation->getUserDataToShow($_GET['user_Details_Preview']);
    echo json_encode($data);
}
if (isset($_POST['newAdmin'])){
    $http_reffer = $_SERVER['HTTP_REFERER'];
    $_POST['emailToken'] = "yes";
    $_POST['position'] = "Admin";
    $registration->setData($_POST);
    $insertNewAdmin = $registration->insertRegisterData();
    if ($insertNewAdmin){
        $_SESSION['CreateSuccessMessageForNewAdmin'] ="<div id=\"toast-container\" class=\"toast-top-right\"><div class=\"toast toast-info\" aria-live=\"assertive\" style=\"\"><div class=\"toast-message\">Admin Create Successfully</div></div></div>";
        Utility::redirect("$http_reffer");
    }
}