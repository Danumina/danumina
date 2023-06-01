<?php
    require_once "../config.php";

    if ( 0 < $_FILES['file']['error'] ) {
        echo 'Error: ' . $_FILES['file']['error'] . '<br>';
    } else {
        $code = $_POST['code'];
        $page = $_POST['page'];
        $type = $_POST['type'];
        $desc = $_POST['description'];
        $quote = $_POST['quote'];
        $author = $_POST['author'];
        $adNum = intval($_POST['adNum']);

        $mime = mime_content_type($_FILES['file']['tmp_name']);
        $mediaType = $mime;

        $filepath = $_FILES['file']['tmp_name'];
        $destinationPath = "../ad" . "/" . $type . "_" . $adNum . "_" . $page . "_" . $_FILES['file']['name'];
        $ret = move_uploaded_file($filepath, $destinationPath);

        if ($ret) {
          $sql;

          $mysqli = connect_db();

          $sql0 = "SELECT `adid` FROM `advert` WHERE (`page` = '$page' AND `type` = $type AND `ad_no` = '$adNum');";

          $result = $mysqli -> query($sql0);

          if ($result->num_rows > 0) {
            $row = $result -> fetch_assoc();
            $adid = $row['adid'];
            $sql = "UPDATE `advert` SET `media_path`='$destinationPath', `description`='$desc',`ad_no`=$adNum, `media_type`='$mediaType', `quote`='$quote', `author`='$author', `createdAt`= current_timestamp() WHERE `adid`= $adid";
          } else {
            $sql = "INSERT INTO `advert` (`adid`, `page`, `media_path`, `description`, `ad_no`, `media_type`, `type`, `quote`, `author`, `createdAt`)
            VALUES (NULL, '$page', '$destinationPath', '$desc', $adNum, '$mediaType' , $type, '$quote', '$author', current_timestamp());";
          }

          if (($mysqli->query($sql) === TRUE)) {
            echo "OK";
          } else {
            echo $mysqli->error;
            unlink($destinationPath);
          }

          $mysqli->close();
        }
    }
?>
