<?php
include_once ("../../vendor/autoload.php");
include_once ("../../vendor/phpmailer/phpmailer/src/PHPMailer.php");

use App\Utility\Utility;
use App\user_registration\registration;
use App\user_registration\authentication;
use App\DataManipulation\DataManipulation;
$datamanipulation =new DataManipulation();
$authenticate =new authentication();
$registration =new registration();
include_once "../member/config.php";
\Stripe\Stripe::setVerifySslCerts(false);

if(!isset($_SESSION)){
    session_start();
}
if (isset($_POST['stripeToken'])){
    $http_reffer = $_SERVER['HTTP_REFERER'];
    $token = $_POST["stripeToken"];
    $amounts = $_POST["amountInCents"]/100;
    $amount = $_POST["amountInCents"];
    if($amounts == 100){
        $subcription = 1;
    }
    elseif ($amounts == 300){
        $subcription = 6;
    }
    else{
        $subcription = 12;
    }
    $description = $_POST["stripeName"];
    $name = $_POST["stripeName"];
    $data = \Stripe\Charge::create(array(
        "amount"=>$amount,
        "currency"=>"bdt",
        "description"=>$description,
        "source"=>$token,

    ));
    $email = $data->billing_details;
    $email_id =  $email->name;
    $check_status = $datamanipulation->checkSubscriptionToken($email_id);
    if ($check_status){
        $datamanipulation->updatePaymentInfo($token,$email_id,$amounts,$subcription);
        $_SESSION['UpdateSuccessMessageForPassword'] ="<div id=\"toast-container\" class=\"toast-top-right\"><div class=\"toast toast-info\" aria-live=\"assertive\" style=\"\"><div class=\"toast-message\">Subscription Successfully</div></div></div>";
        Utility::redirect("../member/profile.php");
    }
    else{
        $datamanipulation->insertPaymentInfo($token,$name,$email_id,$amounts,$subcription);
        $_SESSION['UpdateSuccessMessageForPassword'] ="<div id=\"toast-container\" class=\"toast-top-right\"><div class=\"toast toast-info\" aria-live=\"assertive\" style=\"\"><div class=\"toast-message\">Subscription Successfully</div></div></div>";
        Utility::redirect("../member/profile.php");
    }

}




