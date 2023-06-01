<?php
require_once "../config.php";


function get_papers(){
  $sql = "SELECT code, status FROM `paper`";
  $mysqli = connect_db();

  $arr = array();
  if ($result = $mysqli -> query($sql)) {
    while($row = $result -> fetch_assoc()){
      array_push($arr, $row);
    }
    return $arr;
  }
  $mysqli->close();
}

function getHomeAdByAdNo($adNum) {
  $sql = "SELECT `adid`,`media_path`,`description`,`quote`,`author` FROM `advert` WHERE (`type` = 1 AND `ad_no` = '$adNum');";
  $mysqli = connect_db();

  if ($result = $mysqli -> query($sql)) {
    $info = $result -> fetch_assoc();
    return $info;
  } else {
    return false;
  }
  $mysqli->close();
}
