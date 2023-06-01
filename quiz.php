<?php
require_once "func.php";

session_start();

$code = get_latestcode();
$sincode = get_sincode($code);
$_SESSION["real_code"] = $code;

?>

<html lang="si">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>දැනුමිණ | කියන්න දිනන්න</title>
    <link rel="apple-touch-icon" sizes="180x180" href="./images/favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="./images/favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon_io/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="stylesheet" href="./css/stylesheet.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.1/css/bulma.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script>
    <script defer src="./js/index.js"></script>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/animate.css">
    <style media="screen">
      .card {
        border-radius: 0px !important;
      }
      #info-modal .modal-card-body {
        background-color: white !important;
        text-align: center;
      }

      .info-button:hover {
        color:#53b9fd !important;
      }

    </style>
  </head>
  <body>
    <section class="section navbar-section">
      <div class="container">
        <nav class="navbar" role="navigation" aria-label="main navigation">
          <div class="navbar-brand">
            <a class="navbar-item logo-link" href="./index.php">
              oekqusK
            </a>
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
                    <a class="button is-light modal-button is-fullwidth" data-target="#sign-modal">
                      <strong>පිවිසෙන්න</strong>
                    </a>
                  </div>
                </div>
              <?php } ?>
            </div>
          </div>

        </nav>
      </div>
    </section>
    <section id="content-section" class="section">
      <?php
        if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        // $codesArr = get_usercodes();
      ?>
        <div class="container">

          <div class="notification is-warning">
            <button class="delete"></button>
            <a class="modal-button info-button" data-target="#info-modal">
              <i class="fas fa-info-circle" style="font-size:1.2rem"></i></a> &nbsp; මෙම ප්‍රශ්න වටය මැයි 01 වනදායින් අවසන් වේ.
          </div>

          <div id="info-modal" class="modal">
            <div class="modal-background"></div>
            <div class="modal-card">
              <section class="modal-card-body">
                <p>මෙවර කියන්න දිනන්න විශේෂාංගයෙන් ප්‍රශ්න අසනු ලබන්නේ 2022 මාර්තු කලාපයේ ලිපි පෙළෙහි අඩංගු තොරතුරු වලිණි.</p>
                <br><p>2022 මාර්තු කලාපය කියවන්න, <a href="./myaccount.php" style="color:#53b9fd">මගේ පිවිසුම</a> ට පිවිසෙන්න.</p>
                <br><p>කියවා අවසානයේ අසන ප්‍රශ්න 05ට නිවැරදි පිළිතුරු ලබාදී ඉතා වටිනා තෑගි දිනාගන්න.</p>
              </section>
            </div>
            <button class="modal-close is-large" aria-label="close"></button>
          </div>

          <progress class="progress is-info quiz-progress" value="0" max="100"></progress>
          <div id="quiz-completed-modal" class="modal">
            <div class="modal-background"></div>
            <div class="modal-card">
              <section class="modal-card-body">
                <div class="confirm-quiz">
                  <div class="field">
                    <span class="icon-text has-text-success">
                      <i class="fas fa-check-circle fa-5x"></i>
                    </span><br><br>
                    <span> ඔබේ පිළිතුරු සැපයීම අවසානයි.</span>
                  </div><br>
                  <div class="columns">
                    <div class="column is-6">
                      <a class="button confirm-btn is-success is-fullwidth">තහවුරු කරන්න</a>
                    </div>
                    <div class="column is-6">
                      <a class="button reanz-btn is-dark is-fullwidth">නැවත පිළිතුරු දෙන්න</a>
                    </div>
                  </div>
                </div>
              </section>
            </div>
            <!-- <button class="modal-close is-large" aria-label="close"></button> -->
          </div>

          <div id="q1" class="card">
            <header class="card-header">
              <span class="card-header-icon" aria-label="1">1</span>
              <p class="card-header-title">මුල් වරට ෆිෆා පාපන්දු ලෝක කුසලානය දිනු රට කුමක්ද ?</p>
            </header>
            <div class="card-content">
              <input id="qinput1" class="input" type="text" placeholder="පිළිතුර මෙතනින් ලබාදෙන්න" maxlength="99" autofocus/>
            </div>
            <footer class="card-footer">
            </footer>
          </div>
          <div id="q2" class="card">
            <header class="card-header">
              <span class="card-header-icon" aria-label="2">2</span>
              <p class="card-header-title">වොලිබෝල් ක්‍රීඩාව ආරම්භයේදී හැඳින්වුයේ කුමන නමකින්ද ?</p>
            </header>
            <div class="card-content">
              <input id="qinput2" class="input" type="text" placeholder="පිළිතුර මෙතනින් ලබාදෙන්න" maxlength="99"/>
            </div>
          </div>
          <div id="q3" class="card">
            <header class="card-header">
              <span class="card-header-icon" aria-label="3">3</span>
              <p class="card-header-title">නිදහස් ඉන්දියාවේ ප්‍රථම අගමැතිවරයා කවුද ?</p>
            </header>
            <div class="card-content">
              <input id="qinput3" class="input" type="text" placeholder="පිළිතුර මෙතනින් ලබාදෙන්න" maxlength="99"/>
            </div>
          </div>
          <div id="q4" class="card">
            <header class="card-header">
              <span class="card-header-icon" aria-label="4">4</span>
              <p class="card-header-title">පුරාණ ඉන්කා නගරයක්වූ මාචු පික්චු(Machu Picchu) අයත් රට කුමක්ද ? ?</p>
            </header>
            <div class="card-content">
              <input id="qinput4" class="input" type="text" placeholder="පිළිතුර මෙතනින් ලබාදෙන්න" maxlength="99"/>
            </div>
          </div>
          <div id="q5" class="card">
            <header class="card-header">
              <span class="card-header-icon" aria-label="5">5</span>
              <p class="card-header-title">ඇෆ්ගනිස්ථානයේ නිල භාෂා මොනවාද ?</p>
            </header>
            <div class="card-content">
              <input id="qinput5" class="input" type="text" placeholder="පිළිතුර මෙතනින් ලබාදෙන්න" maxlength="99"/>
            </div>
          </div>
          <br>
          <div class="column npbtndiv">
              <span id="prevbtn" class="icon"><i class="fas fa-chevron-circle-left fa-2x"></i></span>
              <span id="nextbtn" class="icon enabled"><i class="fas fa-chevron-circle-right fa-2x"></i></span>
          </div>
        </div>

        <?php
        $ad = getQuizAd();
        if($ad){
          $mediaType = $ad['media_type'];
          $mediaPath = $ad['media_path'];
          $mediaSrc = substr($mediaPath, 1);
          $quote = $ad['quote'];
          $author = $ad['author'];
          ?>
          <div id="first-ad-modal" class="modal">

            <div class="modal-background"></div>
            <div class="modal-content">

            <?php if ($quote) { ?>
              <div class="notification is-warning has-text-centered" style="margin-bottom:0;line-height:1.2rem">
                <p><b>&ldquo;&nbsp;<?=$quote ?>&nbsp;&rdquo;</b></p>
                <br/>
                <span><b>~ <?=$author ?> ~</b></span>
              </div>
            <?php } ?>

            <?php if (substr( $mediaType, 0, 5 ) === 'image') { ?>

              <img class="ad-modal-img" src="<?= $mediaSrc ?>" alt="" loading="lazy">

            <?php } else if (substr( $mediaType, 0, 5 ) === 'video') { ?>

              <video id="ad-modal-vid" class="ad-modal-vid" style="z-index:1;" controls preload="none">
               <source src="<?=$mediaSrc ?>" type="<?= $mediaType ?>">
              </video>

            <?php } ?>
            </div>

            <!-- <a class="bulb" href="#" title=""><img src="images/bulb.png" alt="" width="50"></a> -->
            <a class="bulb" href="./advertising.php" title=""><i class="fas fa-ad fa-2x"></i></a>

            <a class="button ad-close is-danger hidden" aria-label="close"><i class="fas fa-times"></i>&nbsp; දැන්වීම වසන්න</a>
            <div class="countdown-wrap"><span class="countdown">3</span></div>
          </div>

          <script type="text/javascript">
          setTimeout(showFirstAdModal, 5000);

          function showFirstAdModal(){
            if ($("#first-ad-modal").length) {
              $("html").addClass("is-clipped");
              $("#first-ad-modal").addClass("is-active");
              if ($("#first-ad-modal > #ad-modal-vid").length)
                document.getElementById("ad-modal-vid").play();

                let countdownInterval = setInterval(countdown, 1000);
            }
          }

          function countdown(){
            let val = parseInt($(".countdown").text());
            $(".countdown").text(--val);
            if (val == 0) {
              $(".countdown-wrap").addClass("hidden");
              $(".ad-close").removeClass("hidden");
            }
          }

          </script>

        <?php } ?>

      <?php } else { ?>
      <div id="sign-modal" class="modal" style="font-weight: bold;text-align:center">
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
                <!-- <div class="field">
                  <p class="control" style="color:red">කියන්න දිනන්න විශේෂාංගයෙන් අසන ප්‍රශ්න වලට පිළිතුරු ලබාදී තෑගි දිනාගැනීමට නම් ඔබ දැනුමිණ සාමාජිකයෙකු විය යුතුයි.</p>
                </div> -->
                <div class="field">
                  <p class="control">ඔබ දැනටමත් දැනුමිණ සාමාජිකයෙකු නම්, විද්‍යුත් ලිපිනය හා රහස් පදය ලබාදී පිවිසෙන්න.</p>
                </div>
                <div class="field">
                  <div class="control has-icons-left has-icons-right">
                    <input id="sin-email" class="input" type="email" placeholder="ඊමේල් ලිපිනය">
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
                    <input id="sin-pswrd" class="input" type="password" placeholder="රහස් පදය">
                    <span class="icon is-small is-left">
                      <i class="fas fa-lock"></i>
                    </span>
                  </div>
                  <p id="sin-warning" class="help is-danger"></p>
                </div>
                <div class="field">
                  <button id="sin-button" class="button is-success is-fullwidth">ඇතුලත් කිරීම</button>
                </div>
                <div class="field" style="margin-top:25px !important">
                  <p>නව දැනුමිණ පාඨකයෙක් වීමට බලාපොරොත්තු වන ඔබ</p>
                </div>
                <div class="field">
                  <a id="nw-acnt-btn" class="button is-danger is-fullwidth" style="color:white !important">නව ගිණුමක් අරඹන්න</a>
                </div>
              </div>
              <div class="sup-modal">
                <div class="field">
                  <p>ඔබගේ විද්‍යුත් ලිපිනය හා රහස් පදයක් ලබාදී නව ගිණුමක් අරඹන්න</p>
                </div>
                <div class="field">
                  <div class="control has-icons-left has-icons-right">
                    <input id="sup-email" class="input" type="email" placeholder="ඊමේල් ලිපිනය">
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
                    <input id="sup-pswrd" class="input" type="password" placeholder="රහස් පදය">
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
                    <input id="sup-re-pswrd" class="input" placeholder="රහස් පදය">
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
              <!-- <hr class="div-line"> -->
              <div class="field" style="margin-top:20px">
                <button class="button is-dark is-fullwidth close-modal">ඉවත් වන්න</button>
                <button class="button is-success close-modal confirm-sup-btn">ඉදිරියට යන්න</button>
                <a class="home-btn"><i class="fas fa-angle-double-left"></i> දැනුමිණ මුල් පිටුවට පිවිසෙන්න</a>
              </div>
            </section>
        </div>
        <button class="modal-close is-large" aria-label="close"></button>
      </div>
      <script>
        window.onload = function(){
          $(".modal-button").click(function() {
            var target = $(this).data("target");
            $("html").addClass("is-clipped");
            $(target).addClass("is-active");
            $(".modal-close").css("display","none");
            $(".close-modal").css("display","none");
          });
          $(".modal-button").trigger("click");
        };
      </script>
      <?php } ?>
    </section>
  </body>
</html>
