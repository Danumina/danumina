<?php
require_once "../config.php";

function sign_in(){
  $mysqli = connect_db();

  $sql = "SELECT uid, email, password FROM `user` WHERE email = ? AND type = 1";

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

                      $_SESSION["admin-loggedin"] = true;
                      $_SESSION["loggedin"] = true;
                      $_SESSION["type"] = "1";
                      $_SESSION["uid"] = $uid;
                      $_SESSION["email"] = $email;

                      echo json_encode("IN");

                  } else { echo json_encode("NOT");}
              }
          } else { echo json_encode("NOT");}

      } else {echo json_encode("NOT");}

      $stmt->close();
  }
  $mysqli->close();
}

function get_answers(){
  $code = $_POST["code"];

  $sql = "SELECT user.uid, user.email,answers.aid,answers.correct,answers.a1,answers.a2,answers.a3,answers.a4,answers.a5 FROM answers INNER JOIN user ON answers.uid = user.uid where answers.code = '$code'";

  $mysqli = connect_db();

  $arr = array();
  if ($result = $mysqli -> query($sql)) {
    while($row = $result -> fetch_assoc()){
      array_push($arr,$row);
    }
    echo json_encode($arr);
  }
  $mysqli->close();
}

function get_correct_answers(){
  $code = $_POST["code"];

  $sql = "SELECT user.uid, user.email, answers.aid FROM answers INNER JOIN user ON answers.uid = user.uid WHERE answers.code = '$code' AND answers.correct = 1";

  $mysqli = connect_db();

  $arr = array();
  if ($result = $mysqli -> query($sql)) {
    while($row = $result -> fetch_assoc()){
      array_push($arr,$row);
    }
    echo json_encode($arr);
  }
  $mysqli->close();
}

function update_answer(){
  $mysqli = connect_db();

  $aid = $_POST['aid'];
  $correct = $_POST['crt'];
  $sql =  "UPDATE `answers` SET `correct` = $correct WHERE `answers`.`aid` = $aid";

  if ($mysqli->query($sql) === TRUE) {
    echo "OK";
  } else {
    echo "NOT";
  }

  $mysqli->close();
}

function sign_out(){
  session_start();
  if(isset($_SESSION["admin-loggedin"]) && $_SESSION["admin-loggedin"] === true){
    // $_SESSION = array();
    session_unset();
    session_destroy();
    echo json_encode('OUT');
  } else {
    // code...
  }
}

function add_winner(){
  session_start();
  if(isset($_SESSION["admin-loggedin"]) && $_SESSION["admin-loggedin"] === true){
    $sql;

    $uid = $_POST["uid"];
    $code = $_POST["paper"];

    $sql = "SELECT `wid` FROM `winner` WHERE `uid`=$uid AND `paper`='$code'";

    $mysqli = connect_db();
    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) {
      $info = $result -> fetch_assoc();
      $wid = $info['wid'];
      $sql = "DELETE FROM `winner` WHERE `wid`=$wid";
      if ($mysqli->query($sql) === TRUE) {
        echo "0";
      }
    } else {
      $sql = "INSERT INTO `winner`(`wid`, `uid`, `paper`) VALUES (NULL,$uid,'$code')";
      if ($mysqli->query($sql) === TRUE) {
        echo "1";
      }
    }
    $mysqli->close();
  }
}

function number_of_winnings(){
  $uid = $_POST['uid'];
  $sql = "SELECT COUNT(`wid`) AS count FROM `winner` WHERE `uid`=$uid";

  $mysqli = connect_db();
  $result = $mysqli->query($sql);

  $info = $result -> fetch_assoc();

  echo $info["count"];

  $mysqli->close();
}

// Enable and Disable paper
function set_paper_status(){
  $mysqli = connect_db();

  $code = $_POST['code'];
  $status = $_POST['status'];

  $sql =  "UPDATE `paper` SET `status` = '$status' WHERE `paper`.`code` = '$code'";

  if (($mysqli->query($sql) === TRUE)) {
    echo "OK";
  } else {
    echo "NOT";
  }

  $mysqli->close();
}

// this will create a paper directory for a given paper code
function create_dir() {
  $code = $_POST['code'];
  $dirPath = '../papers/'.$code;
  if (!file_exists($dirPath)) {
    mkdir($dirPath, 0777, true);
    mkdir($dirPath.'/images', 0777, true);
    mkdir($dirPath.'/images'.'/biography', 0777, true);
    mkdir($dirPath.'/images'.'/biology', 0777, true);
    mkdir($dirPath.'/images'.'/country', 0777, true);
    mkdir($dirPath.'/images'.'/culture', 0777, true);
    mkdir($dirPath.'/images'.'/doyouknow', 0777, true);
    mkdir($dirPath.'/images'.'/history', 0777, true);
    mkdir($dirPath.'/images'.'/places', 0777, true);
    mkdir($dirPath.'/images'.'/sports', 0777, true);
    mkdir($dirPath.'/images'.'/tech', 0777, true);
    mkdir($dirPath.'/images'.'/today', 0777, true);
    mkdir($dirPath.'/images'.'/world', 0777, true);

    echo "OK";
  }
}

// Remove paper directory when disabling the paper
function remove_dir() {
  $code = $_POST['code'];
  $dirPath = '../papers/'.$code;

  $it = new RecursiveDirectoryIterator($dirPath, RecursiveDirectoryIterator::SKIP_DOTS);
  $files = new RecursiveIteratorIterator($it, RecursiveIteratorIterator::CHILD_FIRST);
  foreach($files as $file) {
      if ($file->isDir()){
          rmdir($file->getRealPath());
      } else {
          unlink($file->getRealPath());
      }
  }
  rmdir($dirPath);
  echo "OK";
}

//create a temporary page for preview
function create_temp_page(){
  $page = $_POST['page'];
  $code = $_POST['code'];

  $content = "";
  $filePath = "../papers/" . $code . "/" . $page. ".temp.php";
  if (!file_exists($filePath)) {
    $fp = fopen($filePath , "wb");
    fwrite($fp,"");
    fclose($fp);
  }
  echo "OK";
}

//create the original page then remove the .temp.php file.
function create_page(){
  $page = $_POST['page'];
  $code = $_POST['code'];

  $content = "";
  $fp = fopen("../papers/" . $code . "/" . $page. ".php" , "wb");
  fwrite($fp,"");
  copy("../papers/" . $code . "/" . $page . ".temp.php" , "../papers/" . $code . "/" . $page. ".php");
  fclose($fp);

  unlink("../papers/" . $code . "/" . $page. ".temp.php");
  echo "OK";
}

function preview(){
  session_start();
  $page = $_POST['page'];
  $code = $_POST['code'];

  $_SESSION['code'] = $code;

  $headertmpRoot = "../../template/header.php";
  $footertmpRoot = "../../template/footer.php";
  $content = "<?php require_once '". $headertmpRoot ."'; ?>";
  $content = $content . $_POST['content'];
  $content = $content . "<?php require_once '". $footertmpRoot ."'; ?>";

  $bts = file_put_contents("../papers/" . $code . "/" . $page. ".temp.php", $content);

  echo 'OK';
}

function new_paper(){
  $mysqli = connect_db();

  $code = $_POST['p'];
  $sql =  "INSERT INTO `paper`(`pid`, `code`, `status`) VALUES (NULL,'$code','OFF')";

  if ($mysqli->query($sql) === TRUE) {
    echo "IN";
  } else {
    echo "NOT";
  }
  $mysqli->close();
}

function new_user(){
  $mysqli = connect_db();

  $sql = "INSERT INTO `user` (`uid`, `email`, `password`, `mobile`, `address`, `type`, `datetime`)
  VALUES (NULL, ?, ?, NULL, NULL, '2', current_timestamp());";

  if($stmt = $mysqli->prepare($sql)){
      $stmt->bind_param("ss", $param_email, $param_password);

      $param_email = trim($_POST['usr']);
      $param_password = trim($_POST['pw']);

      if($stmt->execute()){
        echo "IN";
      } else {
        echo "NOT";
      }
      $stmt->close();
  }
  $mysqli->close();
}

switch ($_POST["func"]) {
  case 'g-a':
    get_answers();
    break;
  case 's-in':
    sign_in();
    break;
  case 'u-a':
    update_answer();
    break;
  case 'g-c-a':
    get_correct_answers();
    break;
  case 's-ot':
    sign_out();
    break;
  case 'a-w':
    add_winner();
    break;
  case 'n-w':
    number_of_winnings();
    break;
  case 's-p-s':
    set_paper_status();
    break;
  case 'n-pp':
    new_paper();
    break;
  case 'n-usr':
    new_user();
    break;
  case 'cr-d':
    create_dir();
    break;
  case 'rm-d':
    remove_dir();
    break;
  case 'cr-tmp-p':
    create_temp_page();
    break;
  case 'cr-p':
    create_page();
    break;
  // case 'a-f':
  //   append_footer();
  //   break;
  case 'pr-p':
    preview();
    break;

  default:
    // code...
    break;
}

?>
