<?php
require_once "config.php";

function get_usercodes(){
  $uid = $_SESSION["uid"];

  $sql = "SELECT paper.code FROM paper WHERE paper.status = 'ON';";
  $mysqli = connect_db();

  $arr = array();
  if ($result = $mysqli -> query($sql)) {
    while($row = $result -> fetch_assoc()){
      array_push($arr,$row);
    }
    return $arr;
  }
  $mysqli->close();
}

function get_latestcode(){
  $sql = "SELECT code FROM `paper` WHERE status = 'ON' ORDER BY pid DESC LIMIT 1";
  $mysqli = connect_db();

  if ($result = $mysqli -> query($sql)) {
    $info = $result -> fetch_assoc();
    if ($info) {
      $_SESSION['real_code'] = $info['code'];
      // $_SESSION["code"] = $info['code'];
      return $info['code'];
    }
  }
  $mysqli->close();
}

function has_purchased_latest(){
  $uid = $_SESSION['uid'];
  $utype = $_SESSION['type'];
  $code = $_SESSION['real_code'];
  $sql = "SELECT `sid` FROM `subscription` WHERE `uid`=$uid AND `code`='$code'";

  $mysqli = connect_db();
  $result = $mysqli->query($sql);

  if ($utype == "2") {
    if ($result->num_rows > 0) {
      return true;
    } else {
      return false;
    }
  } else {
    return true;
  }

  $mysqli->close();
}

function has_purchased($code){
  $uid = $_SESSION['uid'];
  $utype = $_SESSION['type'];
  $sql = "SELECT `sid` FROM `subscription` WHERE `uid`=$uid AND `code`='$code'";

  $mysqli = connect_db();
  $result = $mysqli->query($sql);

  if ($utype == "2") {
    if ($result->num_rows > 0) {
      return true;
    } else {
      return false;
    }
  } else {
    return true;
  }

  $mysqli->close();
}

function check_winnings(){
  $uid = $_SESSION['uid'];
  $sql = "SELECT `wid`, `uid`, `paper`, `accepted` FROM `winner` WHERE `uid` = $uid";
  $mysqli = connect_db();

  if ($result = $mysqli -> query($sql)) {
    $info = $result -> fetch_assoc();
    return $info;
  }

  $mysqli->close();
}

function get_user(){
  $uid = $_SESSION["uid"];

  $sql = "SELECT `name`, `password`, `mobile`, `address`, `datetime` FROM `user` WHERE `uid` = $uid";
  $mysqli = connect_db();

  if ($result = $mysqli -> query($sql)) {
    $info = $result -> fetch_assoc();
    return $info;
  }
  $mysqli->close();
}

function get_sincode($cd) {
  $arr = str_split($cd, 4);
  $scode;

  switch ($arr[1]) {
    case 'Jan':
      $scode = $arr[0] . ' ' . 'ජනවාරි';
      return $scode;
      break;
    case 'Feb':
      $scode = $arr[0] . ' ' . 'පෙබරවාරි';
      return $scode;
      break;
    case 'Mar':
      $scode = $arr[0] . ' ' . 'මාර්තු';
      return $scode;
      break;
    case 'Apr':
      $scode = $arr[0] . ' ' . 'අප්‍රේල්';
      return $scode;
      break;
    case 'May':
      $scode = $arr[0] . ' ' . 'මැයි';
      return $scode;
      break;
    case 'Jun':
      $scode = $arr[0] . ' ' . 'ජුනි';
      return $scode;
      break;
    case 'Jul':
      $scode = $arr[0] . ' ' . 'ජූලි';
      return $scode;
      break;
    case 'Aug':
      $scode = $arr[0] . ' ' . 'අගෝස්තු';
      return $scode;
      break;
    case 'Sep':
      $scode = $arr[0] . ' ' . 'සැප්තැම්බර්';
      return $scode;
      break;
    case 'Oct':
      $scode = $arr[0] . ' ' . 'ඔක්තෝබර්';
      return $scode;
      break;
    case 'Nov':
      $scode = $arr[0] . ' ' . 'නොවැම්බර්';
      return $scode;
      break;
    case 'Dec':
      $scode = $arr[0] . ' ' . 'දෙසැම්බර්';
      return $scode;
      break;

    default:
      // code...
      break;
  }
}

function getHomeAd(){
  $sql = "SELECT `adid`,`media_path`,`description`,`quote`,`author`,`media_type` FROM `advert` WHERE `type` = 1 ORDER BY RAND() LIMIT 1;";
  $mysqli = connect_db();

  if ($result = $mysqli -> query($sql)) {
    $info = $result -> fetch_assoc();
    return $info;
  } else {
    return false;
  }
  $mysqli->close();
}

function getFirstAd($page){
  $sql = "SELECT `adid`,`media_path`,`description`,`quote`,`author`,`media_type` FROM `advert` WHERE (`page`='$page' AND `type` = 2) ORDER BY RAND() LIMIT 1;";
  $mysqli = connect_db();

  if ($result = $mysqli -> query($sql)) {
    $info = $result -> fetch_assoc();
    return $info;
  } else {
    return false;
  }
  $mysqli->close();
}

function getQuizAd(){
  $sql = "SELECT `adid`,`media_path`,`description`,`quote`,`author`,`media_type` FROM `advert` WHERE (`page`='quiz' AND `type` = 2) ORDER BY RAND() LIMIT 1;";
  $mysqli = connect_db();

  if ($result = $mysqli -> query($sql)) {
    $info = $result -> fetch_assoc();
    return $info;
  } else {
    return false;
  }
  $mysqli->close();
}

function getSecondAd($page){
  $sql = "SELECT `adid`,`media_path`,`description`,`quote`,`author`,`media_type` FROM `advert` WHERE (`page`='$page' AND `type` = 3) ORDER BY RAND() LIMIT 1;";
  $mysqli = connect_db();

  if ($result = $mysqli -> query($sql)) {
    $info = $result -> fetch_assoc();
    return $info;
  } else {
    return false;
  }
  $mysqli->close();
}

//GAMES
function getCountrySet($level){
  $sql = "SELECT `id`,`country`,`code` FROM `flags` WHERE `level` = $level ORDER BY RAND()";
  $mysqli = connect_db();

  $arr = array();
  if ($result = $mysqli -> query($sql)) {
    while($row = $result -> fetch_assoc()){
      array_push($arr,$row);
    }
    return $arr;
  }
  $mysqli->close();
}

function getAnswersForFlags($level,$code){
  $sql = "SELECT `id`,`country`,`code` FROM `flags` WHERE `code` <> '$code' AND `level` = $level ORDER BY RAND() LIMIT 3;";
  $mysqli = connect_db();

  $arr = array();
  if ($result = $mysqli -> query($sql)) {
    while($row = $result -> fetch_assoc()){
      array_push($arr,$row);
    }
    return $arr;
  }
  $mysqli->close();
}

function getCharacterSet($level){
  $sql = "SELECT `id`,`name`,`description`,`code` FROM `people` WHERE `level` = $level ORDER BY RAND()";
  $mysqli = connect_db();

  $arr = array();
  if ($result = $mysqli -> query($sql)) {
    while($row = $result -> fetch_assoc()){
      array_push($arr,$row);
    }
    return $arr;
  }
  $mysqli->close();
}

function getAnswersForCharacters($level, $code, $id){
  $sql = "SELECT `id`,`name`,`code` FROM `people` WHERE `id` <> $id AND `level` = $level AND `code` = '$code' ORDER BY RAND() LIMIT 3;";
  $mysqli = connect_db();

  $arr = array();
  if ($result = $mysqli -> query($sql)) {
    while($row = $result -> fetch_assoc()){
      array_push($arr,$row);
    }
    return $arr;
  }
  $mysqli->close();
}

?>
