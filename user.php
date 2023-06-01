<?php
require_once "config.php";

$email;

function validate_email(){
  $emailavailable;
  $sql = "SELECT uid FROM `user` WHERE email = ? ";

  $mysqli = connect_db();

  if($stmt = $mysqli->prepare($sql)){
      $stmt->bind_param("s", $param_email);
      $param_email = trim($_POST['em']);

      if($stmt->execute()){
          $stmt->store_result();

          if($stmt->num_rows == 1){
              $emailavailable = 0;
          } else {
              $emailavailable = 1;
          }
      } else {
          echo json_encode("Oops! Something went wrong. Please try again later.");
      }
      $stmt->close();
  }
  echo json_encode($emailavailable);
  $mysqli->close();
}

function sign_up(){
  $mysqli = connect_db();

  $sql = "INSERT INTO `user` (`uid`, `email`, `password`, `mobile`, `address`, `type`, `datetime`)
  VALUES (NULL, ?, ?, NULL, NULL, '2', current_timestamp());";

  if($stmt = $mysqli->prepare($sql)){
      $stmt->bind_param("ss", $param_email, $param_password);

      $param_email = trim($_POST['em']);
      $param_password = trim($_POST['pw']);
      // $param_password = password_hash($_POST['pw'], PASSWORD_DEFAULT); //Creates a password hash

      if($stmt->execute()){
          session_start();
          $_SESSION["loggedin"] = true;
          $_SESSION["type"] = "2";
          $_SESSION["email"] = trim($_POST['em']);
          $_SESSION["uid"] = $stmt->insert_id;
          echo json_encode('IN');
      } else {
          echo "Something went wrong. Please try again later.";
      }
      $stmt->close();
  }
  $mysqli->close();
}

function sign_in(){
  $mysqli = connect_db();

  $sql = "SELECT uid, email, password FROM `user` WHERE email = ? ";

  if($stmt = $mysqli->prepare($sql)){
      $stmt->bind_param("s", $param_email);

      $param_email = trim($_POST['em']);

      if($stmt->execute()){
          $stmt->store_result();

          if($stmt->num_rows == 1){
              // Bind result variables
              $stmt->bind_result($uid, $email, $password);
              if($stmt->fetch()){
                  if($password == trim($_POST['pw'])){
                      session_start();

                      $_SESSION["loggedin"] = true;
                      $_SESSION["uid"] = $uid;
                      $_SESSION["email"] = $email;
                      $_SESSION["type"] = "2";

                      echo json_encode("IN");

                  } else { echo json_encode("NOT");}
              }
          } else { echo json_encode("NOT");}

      } else {echo json_encode("NOT");}

      $stmt->close();
  }
  $mysqli->close();
}

function sign_out(){
  session_start();
  if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    // $_SESSION = array();
    session_unset();
    session_destroy();
    echo json_encode('OUT');
  } else {
    // code...
  }
}

function read_paper(){
  session_start();
  if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    $_SESSION["code"] = $_POST['cd'];
    echo json_encode('OK');
  }
}

function answer_quiz(){
  session_start();
  if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    $sql;
    $code = $_SESSION["real_code"];
    $uid = $_SESSION["uid"];

    $q1 = $_POST["q1"];
    $q2 = $_POST["q2"];
    $q3 = $_POST["q3"];
    $q4 = $_POST["q4"];
    $q5 = $_POST["q5"];

    $sql = "SELECT `aid` FROM `answers` WHERE `uid`=$uid AND `code`='$code'";

    $mysqli = connect_db();
    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) {
      $info = $result -> fetch_assoc();
      $aid = $info['aid'];
      $sql = "UPDATE `answers` SET `a1`='$q1',`a2`='$q2',`a3`='$q3',`a4`='$q4',`a5`='$q5',`anz_date`=current_timestamp() WHERE `aid`=$aid";
    } else {
      $sql = "INSERT INTO `answers`(`aid`, `uid`, `code`, `a1`, `a2`, `a3`, `a4`, `a5`, `anz_date`) VALUES (NULL,$uid,'$code','$q1','$q2','$q3','$q4','$q5',current_timestamp());";
    }

    if ($mysqli->query($sql) === TRUE) {
      echo json_encode('OK');
    } else {
      echo json_encode('NOT');
    }

    $mysqli->close();
  }
}

function record_subscription(){
  session_start();

  $paymethod = $_POST['pm'];
  $uid = $_SESSION['uid'];
  $latestcode = $_SESSION['real_code'];

  $mysqli = connect_db();

  if ($paymethod == 'pay100') {
    $sql = "INSERT INTO `subscription`(`sid`, `uid`, `code`) VALUES (NULL,$uid,'$latestcode')";
    if (!record_exists($latestcode)) {
      if ($mysqli->query($sql) === TRUE) {
        echo json_encode("OK");
      }
    } else {
      echo json_encode("NOT"); // Already purchased
    }

  } else if ($paymethod == 'pay1000') {
    $oldcodes = get_old_papercodes($latestcode);
    $newcodes = get_new_papercodes($latestcode);

    array_push($oldcodes,$latestcode);
    $allcodes = array_merge($oldcodes,$newcodes);

    for ($a=0; $a < count($allcodes); $a++) {
      if (!record_exists($allcodes[$a])) {
        $sql = "INSERT INTO `subscription`(`sid`, `uid`, `code`) VALUES (NULL,$uid,'$allcodes[$a]')";
        if ($mysqli->query($sql) === TRUE) {
          echo json_encode("OK");
        }
      }
    }
  }

}

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
    $sql = "SELECT `code` FROM `paper` WHERE `pid` > $pid LIMIT 11";
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

function update_winner(){
  $mysqli = connect_db();

  $wid = $_POST['wd'];
  $uid = $_POST['ud'];
  $mobile = $_POST['mb'];
  $name = $_POST['nm'];

  $sql1 =  "UPDATE `winner` SET `accepted` = 1 WHERE `winner`.`wid` = $wid";
  $sql2 =  "UPDATE `user` SET `name`='$name' ,`mobile`=$mobile WHERE `uid` = $uid";

  if (($mysqli->query($sql1) === TRUE)) {
    if (($mysqli->query($sql2) === TRUE)) {
      echo "OK";
    } else {
      echo "NOT";
    }
  } else {
    echo "NOT";
  }

  $mysqli->close();
}

function update_user(){
  session_start();

  $mysqli = connect_db();

  $uid = $_SESSION['uid'];
  $mobile = $_POST['mb'];
  $name = $_POST['nm'];
  $address = $_POST['addr'];
  $password = $_POST['pw'];

  $sql =  "UPDATE `user` SET `name` = '$name' , `mobile` = '$mobile', `address` = '$address', `password` = '$password' WHERE `uid` = $uid";

  if (($mysqli->query($sql) === TRUE)) {
    echo "IN";
  } else {
    echo "NOT";
  }

  $mysqli->close();
}

switch ($_POST['func']) {
  case 'v-em':
    validate_email();
    break;
  case 's-up':
    sign_up();
    break;
  case 's-in':
    sign_in();
    break;
  case 's-ot':
    sign_out();
    break;
  case 'r-p':
    read_paper();
    break;
  case 'a-qz':
    answer_quiz();
    break;
  case 'r-subs':
    record_subscription();
    break;
  case 'u-w':
    update_winner();
    break;
  case 'u-u':
    update_user();
    break;

  default:
    // code...
    break;
}
?>
