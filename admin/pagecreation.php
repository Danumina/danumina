<?php
require_once "func.php";
session_start();
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>DIY - Page Creation Tool</title>
  <link rel="icon" type="image/png" sizes="32x32" href="./favicon.png">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.2/css/bulma.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script defer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script>
  <script src="./control.js"></script>
  <script src="./pct.js"></script>
  <link rel="stylesheet" href="./style.css">
  <link rel="stylesheet" href="./pct.css">
</head>
<body>
    <div class="wrapper">
    <?php
      if(isset($_SESSION["admin-loggedin"]) && $_SESSION["admin-loggedin"] === true){
        $pp_dir = '../papers/' . $_GET['p'];
    ?>
    <div class="menu-bar">
      <a class="button" href="./control.php"><i class="fas fa-home"></i></a>
      <a class="button" id="re-btn" onclick="window.location.reload();"><i class="fas fa-sync-alt"></i></a>&nbsp;&nbsp;&nbsp;
      <?php if(file_exists($pp_dir)) {?>
        <button class="button" id="rm-dir-btn" type="button" name="button" style="color:red" title="Remove Folder"><i class="fas fa-folder-minus"></i></button>
        <div class="select">
          <select id="pageList" class="" name="pageList">
            <option value="0">Article Type</option>
            <option value="biography">Biography</option>
            <option value="biology">Biology</option>
            <option value="country">Country</option>
            <option value="culture">Culture</option>
            <option value="doyouknow">Do you know?</option>
            <option value="history">History</option>
            <option value="places">Places</option>
            <option value="sports">Sports</option>
            <option value="tech">Technology</option>
            <option value="today">Today in history</option>
            <option value="world">Around the world</option>
          </select>
        </div>
        <button class="button" type="button" id="cr-pg-btn" name="button" style="color: blue;" class="hidden" title="Create Article"><i class="fas fa-file-alt"></i></button>&nbsp;&nbsp;&nbsp;
        <button class="button" id="heading-btn" type="button" name="button" title="Add main title"><i class="fas fa-heading"></i></button>
        <div class="select">
          <select id="rowList" class="" name="">
            <option value="0">Select</option>
            <option value="1">2,10</option>
            <option value="2">3,9</option>
            <option value="3">4,8</option>
            <option value="4">5,7</option>
            <option value="5">6,6</option>
            <option value="6">7,5</option>
            <option value="7">8,4</option>
            <option value="8">9,3</option>
            <option value="9">10,2</option>
            <option value="10">12</option>
            <option value="11">3,3,3,3</option>
            <option value="12">4,4,4</option>
          </select>
        </div>
        <button class="button" id="row-btn" type="button" name="button" title="Insert row"><i class="fas fa-plus"></i></button>
        <button class="button" id="paragraph-btn" type="button" name="button" title="Insert Paragraph"><i class="fas fa-paragraph"></i></button>
        <button class="button" id="title-btn" type="button" name="button" title="Add sub-heading"><b>h2</b></button>
        <button class="button" id="img-btn" type="button" name="button" title="Insert image"><i class="fas fa-image"></i></button>
        <button class="button" id="box-btn" type="button" name="button" title="Insert div box"><i class="fas fa-box"></i></button>        
        <button class="button" type="button" id="pre-btn" name="button" title="Preview article" style="color:blue"><i class="fas fa-eye"></i></button>
        <button class="button" type="button" id="sub-btn" name="button" style="color: green;" title="Save article"><i class="fas fa-file-export"></i></button>
      <?php } else { ?>
        <button class="button" id="cr-dir-btn" type="button" name="button" title="Create Folder" style="color:blue"><i class="fas fa-folder-plus"></i></button>
      <?php } ?>
    </div>
    <div class="content main-content"></div>

    <?php } else { ?>

    <div class="columns">
      <div class="column is-4"></div>
      <div class="column is-4">
        <br><br>
        <h1 class="title has-text-centered">Denumina Dashboard</h2>
        <div class="field">
          <p class="control has-icons-left has-icons-right">
            <input id="sin-email" class="input" type="email" placeholder="Email">
            <span class="icon is-small is-left">
              <i class="fas fa-envelope"></i>
            </span>
            <span class="icon is-small is-right">
              <i class="fas fa-check"></i>
            </span>
          </p>
        </div>
        <div class="field">
          <p class="control has-icons-left">
            <input id="sin-pswrd" class="input" type="password" placeholder="Password">
            <span class="icon is-small is-left">
              <i class="fas fa-lock"></i>
            </span>
          </p>
        </div>
        <div class="field">
          <p class="control">
            <button id="sin-button" class="button is-dark is-fullwidth is-outlined">
              Login
            </button>
          </p>
        </div>
      </div>
      <div class="column is-4"></div>
    </div>

    <?php } ?>

    </div>
</body>
</html>
