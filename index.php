<?php
require_once "func.php";

session_start();

$code;$sincode;
$livCode = get_latestcode();

if (isset($_SESSION["code"])) {
  $code = $_SESSION["code"];
  $sincode = get_sincode($code);
} else {
  // get latest ON paper-code
  $code = $livCode;
  $_SESSION["code"] = $code;
}

?>

<!DOCTYPE html>
<html lang="si">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>දැනුමිණ | අන්තර්ජාල දැනුම අතිරේකය</title>
    <link rel="stylesheet" href="./css/stylesheet.css">
    <link rel="apple-touch-icon" sizes="180x180" href="./images/favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="./images/favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon_io/favicon-16x16.png">
    <link rel="manifest" href="./images/site.webmanifest">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.1/css/bulma.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script>
    <script defer src="./js/index.js"></script>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/animate.css">
    <style media="screen">
      .games-ico {
        position: absolute;
        bottom: 30px;
        right: 15px;
        width: 150px;
        height: 150px;
        background-color: white;
        border-radius: 50%;
        box-shadow: 0 0 0 5px rgba(252, 205, 33, 0.7);
        z-index : 1000;
        text-align: center;
        cursor: pointer;
      }
      .games-ico img {
        width: 135px;
        height: 135px;
        padding-top: 10px;
        border-radius: 50%;
        margin-top: 8px;
      }
      .games-ico:hover {
        transform: scale(0.9);
        box-shadow: 0 0 0 8px rgba(252, 205, 33, 0.8);
        transition: transform ease-out 0.5s, background 0.2s;
      }
      .games-ico img:hover {
        box-shadow: 0 0 0 8px rgba(252, 205, 33, 0.9);
        transition: transform ease-out 0.5s, background 0.2s;
      }
    </style>
  </head>
  <body>
  <div class="games-ico is-vcentered" onclick="{window.location.href = './games.php';}"><img src="./images/win3.gif"></div>
  <section class="section navbar-section">
    <div class="container is-transparent">
      <nav class="navbar is-transparent" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
          <a class="navbar-item logo-link" href="./index.php">
            oekqusK
          </a>
          <div class="navbar-item">
            <!-- <i class="fas fa-caret-left fa-2x arr-right"></i> -->
            <p class="slide-text" id="slideText"></p>
          </div>
          <a id="burgerMenu" role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarMenu">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
          </a>
        </div>

        <div id="navbarMenu" class="navbar-menu">
          <div class="navbar-end">

            <?php if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){ ?>

              <div class="navbar-item">
                <a class="button is-dark is-fullwidth" href="./myaccount.php"><strong>මගේ පිවිසුම</strong></a>
              </div>
              <div class="navbar-item">
                <a class="button is-danger is-fullwidth lg-out-btn"><i class="fas fa-power-off"></i></a>
              </div>

            <?php } else { ?>

              <div class="navbar-item">
                <div class="buttons">
                  <a class="button is-dark modal-button is-fullwidth" data-target="#sign-modal">
                    <strong>පිවිසෙන්න</strong>
                  </a>
                </div>
              </div>

            <?php } ?>

            <div id="sign-modal" class="modal">
              <div class="modal-background">
              </div>
              <div class="modal-card">
                  <section class="modal-card-body">
                    <div class="sup-success-message has-text-centered">
                      <div class="field has-text-centered">
                        <span class="icon-text has-text-success">
                          <i class="fas fa-check-circle fa-5x"></i>
                        </span><br><br>
                        <span> ඔබේ නව දැනුමිණ පාඨක ගිණුම ක්‍රියාත්මකයි.!</span>
                      </div><br>
                    </div>
                    <div class="sin-modal">
                      <div class="field">
                        <p class="control">දැනුමිණ පාඨක ඔබගේ විද්‍යුත් ලිපිනය හා රහස් පදය ලබාදී පිවිසෙන්න.</p>
                      </div>
                      <div class="field">
                        <div class="control has-icons-left has-icons-right">
                          <input id="sin-email" class="input" type="email" placeholder="ඊමේල් ලිපිනය" maxlength="99">
                          <span class="icon is-small is-left">
                            <i class="fas fa-envelope"></i>
                          </span>
                          <span class="icon is-small is-right">
                            <i class="fas fa-check"></i>
                          </span>
                        </div>
                      </div>
                      <div class="field">
                        <div class="control has-icons-left">
                          <input id="sin-pswrd" class="input" type="password" placeholder="රහස් පදය" maxlength="99">
                          <span class="icon is-small is-left">
                            <i class="fas fa-lock"></i>
                          </span>
                        </div>
                        <p id="sin-warning" class="help is-danger"></p>
                      </div>
                      <div class="field">
                        <button id="sin-button" class="button is-success is-fullwidth">ඇතුලත් කිරීම</button>
                      </div>
                      <div class="field">
                        <p>දැනුමිණ පාඨකයෙක් වීමට බලාපොරොත්තු වන ඔබ <a id="nw-acnt-btn">නව ගිණුමක් අරඹන්න</a>.</p>
                      </div>
                    </div>
                    <div class="sup-modal">
                      <div class="field">
                        <p>ඔබගේ විද්‍යුත් ලිපිනය හා රහස් පදයක් ලබාදී නව ගිණුමක් අරඹන්න</p>
                      </div>
                      <div class="field">
                        <div class="control has-icons-left has-icons-right">
                          <input id="sup-email" class="input" type="email" placeholder="ඊමේල් ලිපිනය" maxlength="99">
                          <span class="icon is-small is-left">
                            <i class="fas fa-envelope"></i>
                          </span>
                          <span class="icon is-small is-right">
                            <i class="fas fa-check"></i>
                          </span>
                        </div>
                        <p id="sup-email-warning" class="help is-danger"></p>
                      </div>
                      <div class="field">
                        <div class="control has-icons-left has-icons-right">
                          <input id="sup-pswrd" class="input" type="password" placeholder="රහස් පදය" maxlength="99">
                          <span class="icon is-small is-left">
                            <i class="fas fa-lock"></i>
                          </span>
                          <span class="icon is-small is-right">
                            <i class="fas fa-exclamation-triangle"></i>
                          </span>
                        </div>
                        <p id="sup-pswrd-warning" class="help is-danger"></p>
                      </div>
                      <div class="field">
                        <p>රහස් පදය නැවතත් ලබාදෙන්න.</p>
                      </div>
                      <div class="field">
                        <p class="control has-icons-left has-icons-right">
                          <input id="sup-re-pswrd" class="input" type="password" placeholder="රහස් පදය" maxlength="99">
                          <span class="icon is-small is-left">
                            <i class="fas fa-lock"></i>
                          </span>
                          <span class="icon is-small is-right is-warning">
                            <i class="fas fa-exclamation-triangle"></i>
                          </span>
                        </p>
                      </div>
                      <div class="field">
                        <button id="sup-button" class="button is-success is-fullwidth">ඇතුලත් කිරීම</button>
                      </div>
                    </div>
                    <hr>
                    <div class="field">
                      <button class="button is-dark is-fullwidth close-modal">ඉවත් වන්න</button>
                      <button class="button is-success close-modal confirm-sup-btn">ඉදිරියට යන්න</button>
                    </div>
                  </section>
              </div>
              <button class="modal-close is-large" aria-label="close"></button>
            </div>

          </div>
        </div>
      </nav>

    </div>
  </section>
  <section class="section content-section">
    <!-- <div class="container slogan-text">
      <p class="slide-text" id="slideText"></p>
    </div> -->
    <div class="container" style="margin-top:8px">
      <div class="tile is-ancestor">
        <div class="tile is-parent">
          <!-- <a href="#"> -->
            <article class="tile is-child notification orange worldnw maintile" onclick="{window.location.href = './papers/<?= $code ?>/world.php';}">
              <p class="title">ලොව වටා තතු</p>
            </article>
          <!-- </a> -->
        </div>
        <div class="tile is-parent">
          <!-- <a href="#"> -->
            <article class="tile is-child notification blue sportsnw maintile" onclick="{window.location.href = './papers/<?= $code ?>/sports.php';}">
              <p class="title sports-title">ක්‍රීඩා</p>
            </article>
          <!-- </a> -->
        </div>
        <div class="tile is-parent">
          <article class="tile is-child notification purple historynw maintile" onclick="{window.location.href = './papers/<?= $code ?>/history.php';}">
            <p class="title">ලෝක ඉතිහාසය</p>
          </article>
        </div>
      </div>
      <div class="tile is-ancestor">
        <div class="tile is-parent">
          <article class="tile is-child notification teal culturenw maintile" onclick="{window.location.href = './papers/<?= $code ?>/culture.php';}">
            <p class="title">සංස්කෘතිකාංග</p>
          </article>
        </div>
        <div class="tile is-parent">
          <article class="tile is-child notification yellow technw maintile" onclick="{window.location.href = './papers/<?= $code ?>/tech.php';}">
            <p class="title">විදුනැණ</p>
          </article>
        </div>
        <div class="tile is-parent">
          <article class="tile is-child notification green plantnw maintile" onclick="{window.location.href = './papers/<?= $code ?>/biology.php';}">
            <p class="title">ජෛවගෝලය</p>
          </article>
        </div>
      </div>
      <div class="tile is-ancestor">
        <div class="tile is-parent">
          <article class="tile is-child notification dark-orange biognw maintile" onclick="{window.location.href = './papers/<?= $code ?>/biography.php';}">
            <p class="title">ප්‍රකට චරිත</p>
          </article>
        </div>
        <div class="tile is-parent">
          <article class="tile is-child notification dark-purple placenw maintile"  onclick="{window.location.href = './papers/<?= $code ?>/places.php';}">
            <p class="title">පුදුම හිතෙන තැන්</p>
          </article>
        </div>
        <div class="tile is-parent">
          <article class="tile is-child notification light-green countrynw maintile" onclick="{window.location.href = './papers/<?= $code ?>/country.php';}">
            <p class="title">රටක වතගොත</p>
          </article>
        </div>
      </div>
      <div class="tile is-ancestor">
        <div class="tile is-parent">
          <article class="tile is-child notification dark-blue todaysnw maintile" onclick="{window.location.href = './papers/<?= $code ?>/today.php';}">
            <p class="title">අද වැනි දවසක</p>
          </article>
        </div>
        <div class="tile is-parent">
          <article class="tile is-child notification light-purple specialnw maintile" onclick="{window.location.href = './papers/<?= $code ?>/doyouknow.php';}">
            <p class="title">ඔබ දන්නවාද?</p>
          </article>
        </div>
        <div class="tile is-parent">
          <article class="tile is-child notification dark-red quiznw maintile" onclick="{window.location.href = './quiz.php';}">
            <p class="title">කියන්න දිනන්න</p>
          </article>
        </div>
        <div id="quiz-modal" class="modal">
          <div class="modal-background confetti2"></div>
          <div class="modal-card quiz-modal-card">
            <section class="modal-card-body">
              <?php
              if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
                $result = check_winnings();
                if (!is_null($result)) {
                  $prizeAccepted = $result['accepted'];
                  if ($prizeAccepted == 0) {
                ?>
                  <script type="text/javascript">
                    document.querySelector('.quiz-modal-card > section').classList.add('confetti1');
                  </script>
                  <div class="field">
                    <p class="subtitle"><strong>සුභ පැතුම්..!</strong></p>
                  </div>
                  <div class="field">
                    <p>ඔබ නවතම දැනුමිණ ජයග්‍රාහකයෙකි.</br>ඔබව සම්බන්ධ කර ගැනීමට ඔබගේ නම හා දුරකථන අංකය පහතින් ලබා දෙන්න.</p>
                  </div>

                  <input type="hidden" id="wid" value="<?= $result['wid'] ?>">
                  <input type="hidden" id="uid" value="<?= $result['uid'] ?>">

                  <div class="field">
                    <p class="control has-icons-left has-icons-right">
                      <input id="pr-name" class="input" type="text" placeholder="සම්පුර්ණ නම" maxlength="99">
                      <span class="icon is-small is-left">
                        <i class="fas fa-id-card"></i>
                      </span>
                    </p>
                  </div>
                  <div class="field">
                    <p class="control has-icons-left has-icons-right">
                      <input id="pr-mobile" class="input" type="text" placeholder="දුරකථන අංකය" maxlength="10">
                      <span class="icon is-small is-left">
                        <i class="fas fa-phone"></i>
                      </span>
                    </p>
                  </div>
                  <div class="field">
                    <button id="pr-button" class="button is-success is-fullwidth">ඇතුලත් කරන්න</button>
                  </div>
                <?php } else { ?>
                  <div class="field">
                    <p class="subtitle"><strong>දැනුමිණ පාඨක ඔබට තෑගි ගෙනෙන <a href="./quiz.php">කියන්න දිනන්න</a> විශේෂාංගය</strong></p>
                  </div>
                  <div class="field">
                    <p>ප්‍රශ්න වලට නිවැරදි පිළිතුරු ලබාදී වටිනා තෑගි දිනන්න.!</p>
                    <br>
                    <a class="button is-danger" href="./quiz.php">මෙතනින් පිවිසෙන්න</a>
                  </div>
                <?php } ?>

              <?php } else { ?>
                <div class="field">
                  <p class="subtitle"><strong>දැනුමිණ පාඨක ඔබට තෑගි ගෙනෙන <a href="./quiz.php">කියන්න දිනන්න</a> විශේෂාංගය</strong></p>
                </div>
                <div class="field">
                  <p>ප්‍රශ්න වලට නිවැරදි පිළිතුරු ලබාදී වටිනා තෑගි දිනන්න.!</p>
                  <br>
                  <a class="button is-danger" href="./quiz.php">මෙතනින් පිවිසෙන්න</a>
                </div>
              <?php } ?>

            <?php } else { ?>
              <div class="field">
                <p class="subtitle"><strong>දැනුමිණ පාඨක ඔබට තෑගි ගෙනෙන <a href="./quiz.php">කියන්න දිනන්න</a> විශේෂාංගය</strong></p>
              </div>
              <div class="field">
                <p>ප්‍රශ්න වලට නිවැරදි පිළිතුරු ලබාදී වටිනා තෑගි දිනන්න.!</p>
                <br>
                <a class="button is-danger" href="./quiz.php">මෙතනින් පිවිසෙන්න</a>
              </div>
            <?php } ?>

            </section>
          </div>
          <button class="modal-close is-large" aria-label="close"></button>
        </div>
      </div>
    </div>

    <?php
    $ad = getHomeAd();
    if($ad){
      $mediaPath = $ad['media_path'];
      $mediaSrc = substr($mediaPath, 1);
      $quote = $ad['quote'];
      $author = $ad['author'];
      ?>
      <div id="home-ad-modal" class="modal">
        <div class="modal-background"></div>

        <div class="modal-content">
          <?php if ($quote) { ?>
            <div class="notification is-warning has-text-centered" style="margin-bottom:0;line-height:1.2rem">
              <p><b>&ldquo;&nbsp;<?=$quote ?>&nbsp;&rdquo;</b></p>
              <br/>
              <span><b>~ <?=$author ?> ~</b></span>
            </div>
          <?php } ?>
          <img class="ad-modal-img" src="<?= $mediaSrc ?>" alt="" loading="lazy">
        </div>

        <!-- <a class="bulb" href="#" title=""><img src="images/bulb.png" alt=""></a> -->
        <a class="bulb" href="./advertising.php" title=""><i class="fas fa-ad fa-2x"></i></a>

        <a class="button ad-close is-danger hidden" aria-label="close"><i class="fas fa-times"></i>&nbsp; දැන්වීම වසන්න</a>
        <div class="countdown-wrap"><span class="countdown">3</span></div>
      </div>
    <?php } else { ?>
      <script>
        setTimeout(function(){
          $("html").addClass("is-clipped");
          $("#quiz-modal").addClass("is-active");
        },2500);
      </script>
    <?php } ?>

  </section>
  <footer class="footer footer-section">
    <div class="container">
      <div class="columns">
        <div class="column is-7 foot-div">
          <a class="logo-link-foot" href="./index.php">oekqusK</a>
          <p><b style="color:black;">denumina.lk</b> is a Srilankan educational platform that publishes articles about world history, sports,
            science, cultures and traditions, world destinations, etc. We use <a href="https://www.wikipedia.org/" target="_blank">wikipedia</a>, <a href="https://www.britannica.com/" target="_blank">britannica</a>, <a href="https://www.reuters.com/" target="_blank">reuters</a>, and more as knowledge resources.
            All our contents aims to inform, educate and inspire.</p>

          <br><p>Join us on <a href="https://www.facebook.com/denuminapaper/" target="_blank">Facebook</a></p>

        </div>
        <div class="column is-1">

        </div>
        <div class="column is-4 tpc">
          <div class="">
            <a href="./terms.php" target="_blank">Terms of Services</a>
            &nbsp;&nbsp;|&nbsp;&nbsp;<a href="./privacy.php" target="_blank">Privacy Policy</a>
            &nbsp;&nbsp;|&nbsp;&nbsp;<a href="mailto:info@denumina.lk" target="_top">Contact Us</a>
          </div>
          <br><p>Email us for inquiries and more information</p>
          <a href="mailto:info@denumina.lk" target="_top"><b style="color:black">info@denumina.lk</b></a>
          <br><br><br><p>Copyright © 2022 denumina.lk. All Rights Reserved.</p>
        </div>

      </div>
    </div>
  </footer>
  </body>

  <script type="text/javascript">
    function get_sincode(cd){
      var yr = cd.substr(0,4);
      var mth = cd.slice(4);

      switch (mth) {
        case 'Jan':
          return yr + " " + "ජනවාරි";
          break;
        case 'Feb':
          return yr + " " + "පෙබරවාරි";
          break;
        case 'Mar':
          return yr + " " + "මාර්තු";
          break;
        case 'Apr':
          return yr + " " + "අප්‍රේල්";
          break;
        case 'May':
          return yr + " " + "මැයි";
          break;
        case 'Jun':
          return yr + " " + "ජුනි";
          break;
        case 'Jul':
          return yr + " " + "ජූලි";
          break;
        case 'Aug':
          return yr + " " + "අගෝස්තු";
          break;
        case 'Sep':
          return yr + " " + "සැප්තැම්බර්";
          break;
        case 'Oct':
          return yr + " " + "ඔක්තෝබර්";
          break;
        case 'Nov':
          return yr + " " + "නොවැම්බර්";
          break;
        case 'Dec':
          return yr + " " + "දෙසැම්බර්";
          break;
        default:
      }
    }

    var code = "<?= $code ?>";
    var scode = get_sincode(code);
    var slideText = "මාසිකව පළ කරන දිවයිනේ පළමු අන්තර්ජාල දැනුම අතිරේකය - " + scode + "";
    var i = 0;
    var txt = slideText;

    function typeWriter() {
      if (i < txt.length) {
        document.getElementById("slideText").innerHTML += txt.charAt(i);
        i++;
        setTimeout(typeWriter, 40);
      }
    }
  </script>

  <script defer type="text/javascript">

    function detectMob() {
      return ( window.innerWidth <= 800 );
    }

    // $(".logo-link").focus(function(){
    //   typeWriter();
    // });
    window.onload = function(){
      var code = "<?= $code ?>";
      var scode = get_sincode(code);
      var logotitle = "දැනුමිණ - " + scode + " කලාපය";

      if (!detectMob()) {
        typeWriter();
      }

      $(".logo-link").attr('title', logotitle);
    }

  </script>

</html>
