<?php
if(!isset($_SESSION)){
    session_start();
}
include_once ("../../vendor/autoload.php");
include_once "config.php";
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
<style>
    h2,
    h3,
    h4 {
        text-align: center;
        margin-bottom: 1.8rem;
        margin-top: 2rem;
    }
    form {
        border-radius: 0.2rem;
        padding-left: 3rem;
        padding-right: 3rem;
        width: 350px;
        margin: 2rem auto;
    }
    .btn2 {
        width: 100%;
        padding: 11px;
        border: 0;
        background: #7fe489;
        font-size: 1.2em;
        color: #fff;
        text-shadow: 1px 1px 0px rgba(0, 0, 0, 0.4);
        box-shadow: 0px 3px 0px #4dbc51;
        margin-top: 1.2rem;
        border-radius: 0.25rem;
        transition: 0.5s;
    }

    .btn2:hover {
        color: #fff;
        background: #63b968;
        border-color: #166f67;
    }

    .form-control {
        display: block;
        width: 100%;
        padding: 0.5rem 0.75rem;
        font-size: 1rem;
        line-height: 1.25;
        color: #55595c;
        background-color: transparent;
        background-image: none;
        -webkit-background-clip: padding-box;
        background-clip: padding-box;
        border: 1px solid rgba(0, 0, 0, 0.15);
        border-radius: 0.25rem;
    }
    .row {
        background: transparent;
    }

    .well {
       /* margin-top: 3rem;*/
        border: 1px solid rgb(255, 255, 255);
        border-radius: 0.25rem;
        background: #f9f9f9;
        box-shadow: 16px 16px 5px 0px rgba(0, 0, 0, 0.1);
        transition: 0.5s;
    }

    .well:hover {
        margin-top: 1rem;
    }

    .container {
        /*margin-top: 3rem;*/
    }
    .text-muted {
        font-size: 0.7rem;
    }
    .hr {
        width: 50%;
    }
    .col-lg-4 {
        padding-right: 10px;
        padding-left: 10px;
    }



</style>
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Pricing List</h1>
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
                    if (!$trueStatus){
                        ?>
                        <div class="row">
                            <div class="container">
                                    <div class="row text-center">


                                        <div class="col-md-4">
                                            <div class="well">
                                                <h2 class="display-4">Small</h2>
                                                <hr width="75%">
                                                <h3>BDT 100.00 TK<small class="text-muted"> P/M</small></h3>
                                                <h4>One Month</h4>
                                                <h4>Subscription</h4>
                                                <form id="myForm"  action="../process/payment_process.php" method="post">
                                                    <input type="hidden" name="stripeName" id="stripeName"  value="<?php echo $userdetails->name?>">
                                                    <input type="hidden" id="amountInDollars" value="100" />
                                                    <input type="hidden" id="stripeToken" name="stripeToken" />
                                                    <input type="hidden" id="stripeEmail" value="<?php echo $userdetails->email?>" />
                                                    <input type="hidden" id="amountInCents" name="amountInCents" />
                                                    <button type="submit" id="customButton" class="btn2 btn-primary">Buy</button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="well">
                                                <h2 class="display-4">Medium</h2>
                                                <hr width="75%">
                                                <h3>BDT 300.00 TK<small class="text-muted"> P/M</small></h3>
                                                <h4>Six Month</h4>
                                                <h4>Subscription</h4>
                                                <form id="myFormTwo" action="../process/payment_process.php" method="post">
                                                    <input type="hidden" name="stripeName" id="stripeNameTwo"  value="<?php echo $userdetails->name?>">
                                                    <input type="hidden" id="amountInDollarsTwo" value="300" />
                                                    <input type="hidden" id="stripeTokenTwo" name="stripeToken" />
                                                    <input type="hidden" id="stripeEmailTwo" value="<?php echo $userdetails->email?>" />
                                                    <input type="hidden" id="amountInCentsTwo" name="amountInCents" />
                                                    <button type="submit" id="customButtonTwo" class="btn2 btn-primary">Buy</button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="well">
                                                <h2 class="display-4">Large</h2>
                                                <hr width="75%">
                                                <h3>BDT 500.00 TK<small class="text-muted"> P/M</small></h3>
                                                <h4>One Year</h4>
                                                <h4>Subscription</h4>
                                                <form id="myFormThree" action="../process/payment_process.php" method="post">
                                                    <input type="hidden" name="stripeName" id="stripeNameThree"  value="<?php echo $userdetails->name?>">
                                                    <input type="hidden" id="amountInDollarsThree" value="500" />
                                                    <input type="hidden" id="stripeTokenThree" name="stripeToken" />
                                                    <input type="hidden" id="stripeEmailThree" value="<?php echo $userdetails->email?>" />
                                                    <input type="hidden" id="amountInCentsThree" name="amountInCents" />
                                                    <button type="submit" id="customButtonThree" class="btn2 btn-primary">Buy</button>
                                                </form>
                                            </div>
                                        </div>

                                    </div>
                            </div>
                        </div>
                        <?php
                    }
                    else{
                        echo "<div class=\"alert alert-success alert-dismissible ml-1 mr-1\">
                  <h5><i class=\"icon fas fa-check\"></i> Opps!</h5>
                  Your account is not activated.
                </div>";
                    }
                    ?>
            </div>

            </section>
            <!-- /.content -->
        </div>

    <?php
    include_once "institue_foot.php";
    ?>
    <script src="https://checkout.stripe.com/checkout.js"></script>
    <script>
        var handler = StripeCheckout.configure({
            key: "<?php echo $Publishablekey ?>",
            image: 'https://stripe.com/img/documentation/checkout/marketplace.png',
            currency:"bdt",
            token: function(token) {
                $("#stripeToken").val(token.id);
                $("#stripeEmail").val(token.email);
                $("#amountInCents").val(Math.floor($("#amountInDollars").val() * 100));
                $("#stripeName").val($("#stripeName").val());
                $("#myForm").submit();
            }
        });
        var handlerTwo = StripeCheckout.configure({
            key: "<?php echo $Publishablekey ?>",
            image: 'https://stripe.com/img/documentation/checkout/marketplace.png',
            currency:"bdt",
            token: function(token) {
                $("#stripeTokenTwo").val(token.id);
                $("#stripeEmailTwo").val(token.email);
                $("#amountInCentsTwo").val(Math.floor($("#amountInDollarsTwo").val() * 100));
                $("#stripeNameTwo").val($("#stripeNameTwo").val());
                $("#myFormTwo").submit();
            }
        });
        var handlerThree = StripeCheckout.configure({
            key: "<?php echo $Publishablekey ?>",
            image: 'https://stripe.com/img/documentation/checkout/marketplace.png',
            currency:"bdt",
            token: function(token) {
                $("#stripeTokenThree").val(token.id);
                $("#stripeEmailThree").val(token.email);
                $("#amountInCentsThree").val(Math.floor($("#amountInDollarsThree").val() * 100));
                $("#stripeNameThree").val($("#stripeNameThree").val());
                $("#myFormThree").submit();
            }
        });

        $('#customButton').on('click', function(e) {
            var stripeName = $("#stripeName").val();
            var stripeEmail = $("#stripeEmail").val();
            var amountInCents = Math.floor($("#amountInDollars").val() * 100);
            var displayAmount = parseFloat(Math.floor($("#amountInDollars").val() * 100) / 100).toFixed(2);
            // Open Checkout with further options
            handler.open({
                name: stripeName,
                description: 'Custom amount (' + displayAmount + 'TK)',
                amount: amountInCents,
                email: stripeEmail,
            });
            e.preventDefault();
        });
        $('#customButtonTwo').on('click', function(e) {
            var stripeNameTwo = $("#stripeNameTwo").val();
            var stripeEmailTwo = $("#stripeEmailTwo").val();
            var amountInCentsTwo = Math.floor($("#amountInDollarsTwo").val() * 100);
            var displayAmountTwo = parseFloat(Math.floor($("#amountInDollarsTwo").val() * 100) / 100).toFixed(2);
            // Open Checkout with further options
            handlerTwo.open({
                name: stripeNameTwo,
                description: 'Custom amount (' + displayAmountTwo + 'TK)',
                amount: amountInCentsTwo,
                email: stripeEmailTwo,
            });
            e.preventDefault();
        });
        $('#customButtonThree').on('click', function(e) {
            var stripeNameThree = $("#stripeNameThree").val();
            var stripeEmailThree = $("#stripeEmailThree").val();
            var amountInCentsThree = Math.floor($("#amountInDollarsThree").val() * 100);
            var displayAmountThree= parseFloat(Math.floor($("#amountInDollarsThree").val() * 100) / 100).toFixed(2);
            // Open Checkout with further options
            handlerThree.open({
                name: stripeNameThree,
                description: 'Custom amount (' + displayAmountThree + 'TK)',
                amount: amountInCentsThree,
                email: stripeEmailThree,
            });
            e.preventDefault();
        });

        // Close Checkout on page navigation
        $(window).on('popstate', function() {
            handler.close();
        });
    </script>
    <?php
}
else{
    header("Location: ../login-register/login.php");
}
?>
