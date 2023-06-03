<?php 
require_once('stripe/vendor/autoload.php');
session_start();
ob_end_clean();
ob_start();
$db = new mysqli('localhost','root','','e-grocerry');
date_default_timezone_set('Asia/Manila');

$stripe = array(
  "secret_key"      => "sk_test_51Ka9pqFR1HZ5SmxFtflhjXrkEAK6HsKBiZTgzJK8C8pcrzOTXuhpIVlcn4ZkzIKpiBZp9uVyykLkEVURjmfIf3zQ00z7Q8q0Fk",
  "publishable_key" => "pk_test_51Ka9pqFR1HZ5SmxFPUj3ENDjYQxVCtIspgZyuk4xPR3W6321QAFGXm2PuzfJSPORe2etTc0sCx4xkRfsbZ4VqY7f00KveORD9v"
);

\Stripe\Stripe::setApiKey($stripe['secret_key']);