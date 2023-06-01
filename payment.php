<?php
require_once "config.php";

function completePayment() {
  session_start();

  $oid = $_POST['oid'];

  $sql = "SELECT `pid`,`status`,`amount`,`uid` FROM `payments` WHERE `order_code` = '$oid';";

  $mysqli = connect_db();

  if ($result = $mysqli -> query($sql)) {
    $info = $result -> fetch_assoc();
    if ($info) {
      if ($info['status'] == '2' & $info['uid'] == $_SESSION['uid']) {
        if (record_subscription($info['amount'])) {
          echo json_encode("OK");
        }
      }
    }
  }

  $mysqli->close();
}

function record_subscription($amount){
  session_start();

  $uid = $_SESSION['uid'];
  $latestcode = $_SESSION['real_code'];

  $mysqli = connect_db();

  if ($amount == '100.00') {
    $sql = "INSERT INTO `subscription`(`sid`, `uid`, `code`) VALUES (NULL,$uid,'$latestcode')";
    if (!record_exists($latestcode)) {
      if ($mysqli->query($sql) === TRUE) {
        return true;
      }
    } else {
      return false; // Already purchased
    }

  } else if ($amount == '1000.00') {
    $oldcodes = get_old_papercodes($latestcode);
    $newcodes = get_new_papercodes($latestcode);

    array_push($oldcodes,$latestcode);
    $allcodes = array_merge($oldcodes,$newcodes);

    for ($a=0; $a < count($allcodes); $a++) {
      if (!record_exists($allcodes[$a])) {
        $sql = "INSERT INTO `subscription`(`sid`, `uid`, `code`) VALUES (NULL,$uid,'$allcodes[$a]');";
        $mysqli->query($sql);
      }
    }
    return true;
  }
}

function get_latestcode_pid($latestcode){
  $sql = "SELECT `pid` FROM `paper` WHERE `code`='$latestcode'";

  $mysqli = connect_db();

  if ($result = $mysqli -> query($sql)) {
    $info = $result -> fetch_assoc();
    if ($info) {
      $pid = $info['pid'];
      return $pid;
    }
  }
  $mysqli->close();
}

function get_new_papercodes($latestcode){
  $pid = get_latestcode_pid($latestcode);
  $sql;
  $mysqli = connect_db();

  if (record_exists($latestcode)) {
    $sql = "SELECT `code` FROM `paper` WHERE `pid` > $pid LIMIT 12";
  } else {
    $sql = "SELECT `code` FROM `paper` WHERE `pid` >= $pid LIMIT 12";
  }
  $newcodesarr = array();
  if ($result = $mysqli -> query($sql)) {
    while($row = $result -> fetch_assoc()){
      array_push($newcodesarr,$row['code']);
    }
  }
  return $newcodesarr;

  $mysqli->close();
}

function get_old_papercodes($latestcode){
  $pid = get_latestcode_pid($latestcode);

  $mysqli = connect_db();

  $sql = "SELECT `code` FROM `paper` WHERE `pid` < $pid";
  $oldcodesarr = array();
  if ($result = $mysqli -> query($sql)) {
    while($row = $result -> fetch_assoc()){
      array_push($oldcodesarr,$row['code']);
    }
  }
  return $oldcodesarr;

  $mysqli->close();
}

// check the code exists in subscription table for the current user.
function record_exists($code){
  $uid = $_SESSION['uid'];
  $sql = "SELECT `sid` FROM `subscription` WHERE `uid`=$uid AND `code`='$code'";

  $mysqli = connect_db();
  $result = $mysqli->query($sql);

  if ($result->num_rows > 0) {
    return true;
  } else {
    return false;
  }

  $mysqli->close();
}

switch ($_POST['func']) {
  case 'c-p':
    completePayment();
    break;

  default:
    // code...
    break;
}

?>
