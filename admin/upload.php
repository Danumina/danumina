<?php
    if ( 0 < $_FILES['file']['error'] ) {
        echo 'Error: ' . $_FILES['file']['error'] . '<br>';
    } else {
        $code = $_POST['code'];
        $page = $_POST['page'];
        $filepath = $_FILES['file']['tmp_name'];
        $destinationPath = "../papers/" . $code . "/images"."/". $page ."/". $_FILES['file']['name'];
        move_uploaded_file($filepath, $destinationPath);
    }
?>
