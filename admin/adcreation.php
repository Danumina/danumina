<?php
require_once "func.php";
session_start();
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>DIY - AD Creation Tool</title>
  <link rel="icon" type="image/png" sizes="32x32" href="./favicon.png">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.2/css/bulma.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script defer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script>
  <script src="./control.js"></script>
  <script src="./act.js"></script>
  <link rel="stylesheet" href="./style.css">
  <link rel="stylesheet" href="./pct.css">
</head>
<body>
    <div class="wrapper">
    <?php
      if(isset($_SESSION["admin-loggedin"]) && $_SESSION["admin-loggedin"] === true){
        $pp_dir = '../papers/' . $_GET['p'];
    ?>
    <div class="menu-bar act-menu-bar">
      <a class="button" href="./control.php"><i class="fas fa-home"></i></a>
      <a class="button" id="re-btn" onclick="window.location.reload();"><i class="fas fa-sync-alt"></i></a>&nbsp;&nbsp;&nbsp;
      <?php if(file_exists($pp_dir)) {?>
        <div class="select">
          <select id="ad-pageList" class="" name="pageList">
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
            <option value="quiz">Quiz</option>
          </select>
        </div>
      <?php } ?>
    </div>
    <div class="content main-content" style="margin-top:20px">
      <div class="columns">
        <div id="home-0th-ad" class="column is-4">
          <h3>Home Page ADs</h3>
          <div class="box" data-value="1">
            <?php
            $ad = getHomeAdByAdNo(1);
            $desc = ''; $path = '';$quote = '';$author = '';
            if ($ad) {
              $desc = $ad['description'];
              $path = $ad['media_path'];
              $quote = $ad['quote'];
              $author = $ad['author'];
            }
            ?>
            <form id="main-ad-form">
              <div class="field">
                <input id="image-0" class="input" type="file" name="" value="" accept="" onchange="">
                <img src="<?=$path ?>" alt="" style="max-height:300px">
              </div>
              <div class="field">
                <input id="text-0" class="input" type="text" name="" value="<?= $desc ?>">
              </div>
              <div class="field">
                <input id="text-0-1" class="input" type="text" name="" value="<?= $quote ?>">
              </div>
              <div class="field">
                <input id="text-0-2" class="input" type="text" name="" value="<?= $author ?>">
              </div>
              <div class="field">
                <a class="button" name="" onclick="insOrModAdvert(this.parentElement.parentElement, 1);">Insert</a>
              </div>
            </form>
          </div>
          <div class="box" data-value="2">
            <?php
            $ad = getHomeAdByAdNo(2);
            $desc = ''; $path = '';$quote = '';$author = '';
            if ($ad) {
              $desc = $ad['description'];
              $path = $ad['media_path'];
              $quote = $ad['quote'];
              $author = $ad['author'];
            }
            ?>
            <form id="main-ad-form">
              <div class="field">
                <input id="image-0" class="input" type="file" name="" value="" accept="" onchange="">
                <img src="<?=$path ?>" alt="" style="max-height:300px">
              </div>
              <div class="field">
                <input id="text-0" class="input" type="text" name="" value="<?= $desc ?>">
              </div>
              <div class="field">
                <input id="text-0-1" class="input" type="text" name="" value="<?= $quote ?>">
              </div>
              <div class="field">
                <input id="text-0-2" class="input" type="text" name="" value="<?= $author ?>">
              </div>
              <div class="field">
                <a class="button" name="" onclick="insOrModAdvert(this.parentElement.parentElement, 1);">Insert</a>
              </div>
            </form>
          </div>
          <div class="box" data-value="3">
            <?php
            $ad = getHomeAdByAdNo(3);
            $desc = ''; $path = '';$quote = '';$author = '';
            if ($ad) {
              $desc = $ad['description'];
              $path = $ad['media_path'];
              $quote = $ad['quote'];
              $author = $ad['author'];
            }
            ?>
            <form id="main-ad-form">
              <div class="field">
                <input id="image-0" class="input" type="file" name="" value="" accept="" onchange="">
                <img src="<?=$path ?>" alt="" style="max-height:300px">
              </div>
              <div class="field">
                <input id="text-0" class="input" type="text" name="" value="<?= $desc ?>">
              </div>
              <div class="field">
                <input id="text-0-1" class="input" type="text" name="" value="<?= $quote ?>">
              </div>
              <div class="field">
                <input id="text-0-2" class="input" type="text" name="" value="<?= $author ?>">
              </div>
              <div class="field">
                <a class="button" name="" onclick="insOrModAdvert(this.parentElement.parentElement, 1);">Insert</a>
              </div>
            </form>
          </div>
          <div class="box" data-value="4">
            <?php
            $ad = getHomeAdByAdNo(4);
            $desc = ''; $path = '';$quote = '';$author = '';
            if ($ad) {
              $desc = $ad['description'];
              $path = $ad['media_path'];
              $quote = $ad['quote'];
              $author = $ad['author'];
            }
            ?>
            <form id="main-ad-form">
              <div class="field">
                <input id="image-0" class="input" type="file" name="" value="" accept="" onchange="">
                <img src="<?=$path ?>" alt="" style="max-height:300px">
              </div>
              <div class="field">
                <input id="text-0" class="input" type="text" name="" value="<?= $desc ?>">
              </div>
              <div class="field">
                <input id="text-0-1" class="input" type="text" name="" value="<?= $quote ?>">
              </div>
              <div class="field">
                <input id="text-0-2" class="input" type="text" name="" value="<?= $author ?>">
              </div>
              <div class="field">
                <a class="button" name="" onclick="insOrModAdvert(this.parentElement.parentElement, 1);">Insert</a>
              </div>
            </form>
          </div>
          <div class="box" data-value="5">
            <?php
            $ad = getHomeAdByAdNo(5);
            $desc = ''; $path = '';$quote = '';$author = '';
            if ($ad) {
              $desc = $ad['description'];
              $path = $ad['media_path'];
              $quote = $ad['quote'];
              $author = $ad['author'];
            }
            ?>
            <form id="main-ad-form">
              <div class="field">
                <input id="image-0" class="input" type="file" name="" value="" accept="" onchange="">
                <img src="<?=$path ?>" alt="" style="max-height:300px">
              </div>
              <div class="field">
                <input id="text-0" class="input" type="text" name="" value="<?= $desc ?>">
              </div>
              <div class="field">
                <input id="text-0-1" class="input" type="text" name="" value="<?= $quote ?>">
              </div>
              <div class="field">
                <input id="text-0-2" class="input" type="text" name="" value="<?= $author ?>">
              </div>
              <div class="field">
                <a class="button" name="" onclick="insOrModAdvert(this.parentElement.parentElement, 1);">Insert</a>
              </div>
            </form>
          </div>
        </div>

        <div id="first-ad" class="column is-4">
          <h3>Article Page ADs - 1</h3>
          <div class="box" data-value="1">
            <form id="first-ad-form">
              <div class="field">
                <input id="image-1" class="input" type="file" name="" value="" accept="">
              </div>
              <div class="field">
                <input id="text-1" class="input" type="text" name="" value="" placeholder="AD Description">
              </div>
              <div class="field">
                <input id="text-1-1" class="input" type="text" name="" value="" placeholder="AD Quote">
              </div>
              <div class="field">
                <input id="text-1-2" class="input" type="text" name="" value="" placeholder="Quote Author">
              </div>
              <div class="field">
                <a id="ad-1-btn" class="button" name="" onclick="insOrModAdvert(this.parentElement.parentElement, 2);">Insert</a>
              </div>
            </form>
          </div>
          <div class="box" data-value="2">
            <form id="first-ad-form">
              <div class="field">
                <input id="image-1" class="input" type="file" name="" value="" accept="">
              </div>
              <div class="field">
                <input id="text-1" class="input" type="text" name="" value="" placeholder="AD Description">
              </div>
              <div class="field">
                <input id="text-1-1" class="input" type="text" name="" value="" placeholder="AD Quote">
              </div>
              <div class="field">
                <input id="text-1-2" class="input" type="text" name="" value="" placeholder="Quote Author">
              </div>
              <div class="field">
                <a id="ad-1-btn" class="button" name="" onclick="insOrModAdvert(this.parentElement.parentElement, 2);">Insert</a>
              </div>
            </form>
          </div>
          <div class="box" data-value="3">
            <form id="first-ad-form">
              <div class="field">
                <input id="image-1" class="input" type="file" name="" value="" accept="">
              </div>
              <div class="field">
                <input id="text-1" class="input" type="text" name="" value="" placeholder="AD Description">
              </div>
              <div class="field">
                <input id="text-1-1" class="input" type="text" name="" value="" placeholder="AD Quote">
              </div>
              <div class="field">
                <input id="text-1-2" class="input" type="text" name="" value="" placeholder="Quote Author">
              </div>
              <div class="field">
                <a id="ad-1-btn" class="button" name="" onclick="insOrModAdvert(this.parentElement.parentElement, 2);">Insert</a>
              </div>
            </form>
          </div>
          <div class="box" data-value="4">
            <form id="first-ad-form">
              <div class="field">
                <input id="image-1" class="input" type="file" name="" value="" accept="">
              </div>
              <div class="field">
                <input id="text-1" class="input" type="text" name="" value="" placeholder="AD Description">
              </div>
              <div class="field">
                <input id="text-1-1" class="input" type="text" name="" value="" placeholder="AD Quote">
              </div>
              <div class="field">
                <input id="text-1-2" class="input" type="text" name="" value="" placeholder="Quote Author">
              </div>
              <div class="field">
                <a id="ad-1-btn" class="button" name="" onclick="insOrModAdvert(this.parentElement.parentElement, 2);">Insert</a>
              </div>
            </form>
          </div>
          <div class="box" data-value="5">
            <form id="first-ad-form">
              <div class="field">
                <input id="image-1" class="input" type="file" name="" value="" accept="">
              </div>
              <div class="field">
                <input id="text-1" class="input" type="text" name="" value="" placeholder="AD Description">
              </div>
              <div class="field">
                <input id="text-1-1" class="input" type="text" name="" value="" placeholder="AD Quote">
              </div>
              <div class="field">
                <input id="text-1-2" class="input" type="text" name="" value="" placeholder="Quote Author">
              </div>
              <div class="field">
                <a id="ad-1-btn" class="button" name="" onclick="insOrModAdvert(this.parentElement.parentElement, 2);">Insert</a>
              </div>
            </form>
          </div>
        </div>

        <div id="second-ad" class="column is-4">
          <h3>Article Page ADs - 2</h3>
          <div class="box" data-value="1">
            <form id="second-ad-form">
              <div class="field">
                <input id="image-2" class="input" type="file" name="" value="" accept="">
              </div>
              <div class="field">
                <input id="text-2" class="input" type="text" name="" value="" placeholder="AD Description">
              </div>
              <div class="field">
                <input id="text-2-1" class="input" type="text" name="" value="" placeholder="AD Quote">
              </div>
              <div class="field">
                <input id="text-2-2" class="input" type="text" name="" value="" placeholder="Quote Author">
              </div>
              <div class="field">
                <a id="ad-2-btn" class="button" name="" onclick="insOrModAdvert(this.parentElement.parentElement, 3);">Insert</a>
              </div>
            </form>
          </div>
          <div class="box" data-value="2">
            <form id="second-ad-form">
              <div class="field">
                <input id="image-2" class="input" type="file" name="" value="" accept="">
              </div>
              <div class="field">
                <input id="text-2" class="input" type="text" name="" value="" placeholder="AD Description">
              </div>
              <div class="field">
                <input id="text-2-1" class="input" type="text" name="" value="" placeholder="AD Quote">
              </div>
              <div class="field">
                <input id="text-2-2" class="input" type="text" name="" value="" placeholder="Quote Author">
              </div>
              <div class="field">
                <a id="ad-2-btn" class="button" name="" onclick="insOrModAdvert(this.parentElement.parentElement, 3);">Insert</a>
              </div>
            </form>
          </div>
          <div class="box" data-value="3">
            <form id="second-ad-form">
              <div class="field">
                <input id="image-2" class="input" type="file" name="" value="" accept="">
              </div>
              <div class="field">
                <input id="text-2" class="input" type="text" name="" value="" placeholder="AD Description">
              </div>
              <div class="field">
                <input id="text-2-1" class="input" type="text" name="" value="" placeholder="AD Quote">
              </div>
              <div class="field">
                <input id="text-2-2" class="input" type="text" name="" value="" placeholder="Quote Author">
              </div>
              <div class="field">
                <a id="ad-2-btn" class="button" name="" onclick="insOrModAdvert(this.parentElement.parentElement, 3);">Insert</a>
              </div>
            </form>
          </div>
          <div class="box" data-value="4">
            <form id="second-ad-form">
              <div class="field">
                <input id="image-2" class="input" type="file" name="" value="" accept="">
              </div>
              <div class="field">
                <input id="text-2" class="input" type="text" name="" value="" placeholder="AD Description">
              </div>
              <div class="field">
                <input id="text-2-1" class="input" type="text" name="" value="" placeholder="AD Quote">
              </div>
              <div class="field">
                <input id="text-2-2" class="input" type="text" name="" value="" placeholder="Quote Author">
              </div>
              <div class="field">
                <a id="ad-2-btn" class="button" name="" onclick="insOrModAdvert(this.parentElement.parentElement, 3);">Insert</a>
              </div>
            </form>
          </div>
          <div class="box" data-value="5">
            <form id="second-ad-form">
              <div class="field">
                <input id="image-2" class="input" type="file" name="" value="" accept="">
              </div>
              <div class="field">
                <input id="text-2" class="input" type="text" name="" value="" placeholder="AD Description">
              </div>
              <div class="field">
                <input id="text-2-1" class="input" type="text" name="" value="" placeholder="AD Quote">
              </div>
              <div class="field">
                <input id="text-2-2" class="input" type="text" name="" value="" placeholder="Quote Author">
              </div>
              <div class="field">
                <a id="ad-2-btn" class="button" name="" onclick="insOrModAdvert(this.parentElement.parentElement, 3);">Insert</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

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
<style media="screen">
  img {
    margin-top: 15px;
  }
</style>
</html>
