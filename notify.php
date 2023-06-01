<?php
require_once "config.php";

$merchant_id        = $_POST['merchant_id'];
$order_id           = $_POST['order_id'];
$payhere_amount     = $_POST['payhere_amount'];
$payhere_currency   = $_POST['payhere_currency'];
$status_code        = $_POST['status_code'];
$md5sig             = $_POST['md5sig'];
$method             = $_POST['method'];
$status_message     = $_POST['status_message'];
$card_holder_name   = $_POST['card_holder_name'];
$card_no            = $_POST['card_no'];
$card_expiry        = $_POST['card_expiry'];

$merchant_secret = '8Qp6Nda5b2h4OZpm5thhZL4ZAG1STXtX14EvfGdwRwOH'; // Replace with your Merchant Secret (Can be found on your PayHere account's Settings page)
$local_md5sig = strtoupper (md5 ( $merchant_id . $order_id . $payhere_amount . $payhere_currency . $status_code . strtoupper(md5($merchant_secret)) ) );
if (($local_md5sig === $md5sig) AND ($status_code == 2) ){

    session_start();

    $mysqli = connect_db();

    $sql = "INSERT INTO `payment`(`pid`, `uid`, `order_code`, `amount`, `status`, `pay_method`, `message`, `c_holder_name`, `c_no`, `c_expiry`, `p_time`)
     VALUES (NULL,$uid,'$order_id','$payhere_amount',$status_code, '$method', '$status_message', '$card_holder_name', '$card_no', '$card_expiry', NULL)";
    if ($mysqli->query($sql) === TRUE) {
      $pay_id = $mysqli->insert_id;
      $_SESSION['pay_id'] = $pay_id;
    }

}

?>
