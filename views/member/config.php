<?php
include_once "stripe-php-master/init.php";
$Publishablekey = "pk_test_51J0XmZLTphVospsTEPQSPeSeH5DtvRBLNmz3vcI69G9126zHkNhO1AV9E3MWu13oDrPEKUNYERSbvBY895SNQK8P00OlvFyGGx";
$Secretkey = "sk_test_51J0XmZLTphVospsTHwfkmuFZGSaKtbkmHbvKQqb55sndAzgh5SZ2VmfDRYShMuMpmqzZ3UcXmiHHeMwuVsDMrUga002st8pBqZ";
\Stripe\Stripe::setApiKey($Secretkey);