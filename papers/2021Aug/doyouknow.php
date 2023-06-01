<?php
require_once $_SERVER["DOCUMENT_ROOT"]."denumina/func.php";

session_start();

$code;$sincode;

if (isset($_SESSION["code"])) {
  $code = $_SESSION["code"];
  $sincode = get_sincode($code);
} else {
  // get latest ON paper-code
  $code = get_latestcode();
  $_SESSION["code"] = $code;

}
?>

<html lang="sin">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>දැනුමිණ | ඔබ දන්නවාද?</title>
    <link rel="apple-touch-icon" sizes="180x180" href="../../images/favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../../images/favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../../images/favicon_io/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.1/css/bulma.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script>
    <script defer src="../../js/index.js"></script>
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/animate.css">
  </head>
  <body>
    <section class="section navbar-section">
      <div class="container">
        <nav class="navbar" role="navigation" aria-label="main navigation">
          <div class="navbar-brand">
            <a class="navbar-item" href="../../index.php">
              <img class="logo" src="../../images/logo1.png" title="දැනුමිණ - <?= $sincode ?> කලාපය">
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

                <div id="dropdownMenu" class="navbar-item has-dropdown is-hoverable">
                    <a class="navbar-link"><strong>මගේ පිවිසුම</strong></a>
                    <div class="navbar-dropdown">
                      <a class="navbar-item" href="../../myaccount.php">මගේ ගිණුම</a>
                      <a class="navbar-item" href="../../pricing.php">මිලදී ගන්න</a>
                      <hr class="navbar-divider">
                      <a class="navbar-item lg-out-btn">ඉවත් වෙන්න</a>
                    </div>
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
                          <button id="sin-button" class="button is-success is-outlined is-fullwidth">ඇතුලත් කිරීම</button>
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
                          <button id="sup-button" class="button is-success is-outlined is-fullwidth">ඇතුලත් කිරීම</button>
                        </div>
                      </div>
                      <hr>
                      <div class="field">
                        <button class="button is-dark is-fullwidth close-modal">ඉවත් වන්න</button>
                        <button class="button is-success close-modal confirm-sup-btn">ඉදිරියට යන්න</button>
                        <a class="home-btn"><i class="fas fa-angle-double-left"></i> දැනුමිණ මුල් පිටුවට පිවිසෙන්න</a>
                      </div>
                    </section>
                    <!-- <footer class="modal-card-foot">
                      <button class="button is-success">Save changes</button>
                      <button class="button">Cancel</button>
                    </footer> -->
                </div>
                <button class="modal-close is-large" aria-label="close"></button>
              </div>
            </div>
          </div>

        </nav>

      </div>
    </section>

    <section id="content-section" class="section">
      <?php if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        $uri = $_SERVER['REQUEST_URI'];
        $arr = array();
        $arr = explode("/",$uri);
        $thiscode = $arr[count($arr) - 2];
        if (has_purchased($thiscode)) {
      ?>
        <div class="container">
          <div class="row article-first-row">
            <div class="columns has-text-centered">
              <div class="column is-2">
                <a class="prev-article-btn " href="./today.php"><i class="fas fa-angle-double-left"></i> <strong>අද වැනි දවසක</strong></a>
              </div>
              <div class="column is-8">
                <p class="subtitle has-text-centered">ඩයිනෝසෝරයන්ට සිදු වූයේ කුමක්ද?</p>
              </div>
              <div class="column is-2">
                <a class="next-article-btn has-text-centered" href="../../quiz.php"><strong>කියන්න දිනන්න</strong> <i class="fas fa-angle-double-right"></i></a>
              </div>
            </div><br>
            <div class="content">
              <div class="columns">
                <div class="column is-5">
                  <figure>
                      <img src="./images/demistified/2.jpg">
                      <figcaption>
                        නිදැල්ලේ ඇවිදින පැරාසෝරෝලෝපස් සහ ඉගිල්ලෙන ප්ටෙරසෝර් ඩයිනසෝරයින් පෙන්වන නිර්මාණය කල ඡායාරූපයක්
                      </figcaption>
                  </figure>
                </div>
                <div class="column is-7">
                  <p class="has-text-justified">
                    මීට වසර මිලියන 66 කට පෙර එක් දිනයක, යුකැටින් අර්ධද්වීපය අසලට කන්දක් තරම් වූ විශාල ඇස්ටෙරොයිඩයක් (ග්‍රාහකයක්) ඇද වැටුණු බව සැලකේ. එය ටී.එන්.ටී පුපුරණ ද්‍රව්‍යය ටොන් ට්‍රිලියන 100 කට සමාන පිපිරීමක් විය. එම ව්‍යසනකාරී මොහොතේදී ඩයිනෝසෝරයන්ගේ වසර මිලියන 165 ක පෘථිවි කාලය අවසන් වුනා යයි විශ්වාස කරයි.
                  </p>
                  <p class="has-text-justified">
                    ඩයිනෝසෝරයන්ගේ අභාවය පිළිබඳ ග‍්‍රහක න්‍යාය(Asteroid theory) මුලින්ම යෝජනා කරනු ලැබුවේ 1980 දී ය. දශකයකට වැඩි කාලයකට පසු මෙක්සිකෝ බොක්කෙහි චික්සුලුබ් ආවාටය(Chicxulub Crater) හඳුනා ගැනීමත් සමග එය සිදුවුයේ කොහේද සහ කවදාද යන්න තහවුරු විය.
                  </p>
                </div>
              </div>

              <div class="columns">
                <div class="column is-7">
                  <p class="has-text-justified">
                    පර්ඩියු විශ්ව විද්‍යාලයේ සහ ලන්ඩනයේ ඉම්පීරියල් කොලේජ් හි භූ-භෞතික විද්‍යාඥයන් විසින් නිර්මාණය කරන ලද කම්පන බලපෑම් ගණනය කල හැකි කැල්කියුලේටරයක් ​​භාවිතා කරමින්, පර්යේෂකයන් ග්‍රහකය ගැටුණු මොහොතේ සිදු වූ දේ පිළිබඳව ඉතා හොඳ අදහසක් ලබා ගත්තේය. පැයට සැතපුම් 40,000 (කිලෝමීටර 64,000) ක වේගයෙන් ග්‍රහකය පෘථිවියේ ගැටුණු අතර සැතපුම් 115 කට වඩා වැඩි ආවාටයක් නිර්මාණය කළ අතර සැතපුම් දහස් ගණනක් දුරින් වූ පාෂාණ පවා  ක්ෂණිකව වාෂ්ප විය. එය දැකීමට තරම් සමීප ඕනෑම සතෙකු, සියලු ශාක සමඟ ගිනිබත් විය. වෙරළබඩ ප්‍රදේශවල, බලපෑම සුනාමි තත්වයන් බවට පත්වෙමින් අඩි 1000 (මීටර් 305) ක් තරම් ඉහළට මුහුදු ජලය ඉහළ ගියේය. එහි බලපෑම නිසා ඇතිවූ දරුණු භූමිකම්පා නූතන මිනිසුන් අත්විඳින ඕනෑම ව්‍යසනයකට වඩා විශාල විය.
                  </p>
                </div>
                <div class="column is-5">
                  <figure>
                      <img src="./images/demistified/1.jpg">
                      <figcaption>
                        ඩයිනසෝර් වඳවී යාම නිර්මාණය කල ඡායාරූපයක්
                      </figcaption>
                  </figure>
                </div>
              </div>

              <p class="has-text-justified">
                විනාශය අවසන් නොවී ඇස්ටෙරොයිඩය ගැටී මිනිත්තු කිහිපයකට පසු, රතු-ගිනියම් වූ සුන්බුන් වර්ෂාවක් ඇතිවිය. ඒ සමගින් ඇතිවූ අළු හා කුණු වලින් බිම වැසී ගියේය. එම කලාපය වටා භූමිය, අඩි සිය ගණනක් පාෂාණමය සුන්බුන් වලින් වැසී තිබෙන්නට ඇතැයි සැලකේ. ගැටුමෙන් පැයකටත් අඩු කාලයකදී, විශාල සුළඟක් කලාපය පුරා හැමීම නිසා, තවත් ව්‍යසනයන් ඇති විය.
              </p>

              <div class="columns">
                <div class="column is-8">
                  <p class="has-text-justified">
                    එවිට වායුගෝලය තුළ අළු, දුම හා සුන්බුන් පෘථිවිය පුරා පැතිරී සුර්යාලෝකය නැතිවී යාමෙන් නිරන්තර අන්ධකාරයක් බවට පත් වූ අතර එය මාස ගණනක් හෝ සමහර විට වසර ගණනාවක් පැවතුනි. උෂ්ණත්වය පහත වැටුණු අතර ආහාර වැඩි වැඩියෙන් හිඟ විය. මුළු පරිසර පද්ධතිම කඩා වැටුණි. එම සියල්ල අවසන් වන විට පෘථිවියේ ජීවීන්ගෙන් සියයට 75 ත් 80 ත් අතර ප්‍රමාණයක් විනාශ වී තිබුණි.
                  </p>
                  <p class="has-text-justified">
                    ග්‍රහක ප්‍රහාරයෙන් පසුව ඩයිනෝසෝරයන් ඉතා ඉක්මණින් වඳ වී ගොස් ඇති බව බොහෝ දෙනා උපකල්පනය කරති. එහෙත්, ග්‍රහකය ගැටෙන විට පොළොවට ආසන්නවම සිටි ජීවින් විශාල ප්‍රමාණයක් මිය ගිය අතර, සුර්යාලෝකය නැතිවීම සහ වායුගෝලය අවහිර වීම නිසා කෙටි කාලයකින් ශාක ඇතුළු ජීවින් වැඩි ප්‍රමාණයක් මිය ගියේය, එහෙත් සමහර ජීවී විශේෂ නිදසුනක් වශයෙන්, ඩයිනෝසෝරයන් අතර ජීවත් වූ කුඩා ක්ෂීරපායින් බොහෝ දෙනෙකුට දිවි ගලවා ගැනීමට හැකි වූයේ ඔවුන් පොළොව තුල ගුල් හාරාගෙන ජීවත් වූ නිසා සහ ඕනෑම දෙයක් ආහාරයට ගත හැකි බැවිනි. මීට අමතරව, ගැබුරු මුහුදේ හා මිරිදිය ජීවීන් යම් ප්‍රමාණයක් ඉතිරි විය.
                  </p>
                  <p class="has-text-justified">
                    බොහෝ පර්යේෂකයන් දැන් විශ්වාස කරන්නේ මෙම වඳවීමේ සිදුවීම සිදු වුයේ ලෝකය පාරිසරික අර්බුධයක හා ඩයිනසෝරයන් ජිවත් වීමට අරගලයක යෙදී සිටි අවධියක බවයි. අධික සත්ව ගහනය හේතුවෙන් ආහාර සැපයුම් අඩුවීම සහ වායුගෝලය සිසිල් වීම නිසා ඔවුන්ගේ ජීවිතය ඉතා දුෂ්කර වී තිබුණි.
                  </p>

                  <figure>
                      <img src="./images/demistified/6.jpg">
                      <figcaption>
                        නිරිතදිග ආර්ජන්ටිනාවෙන් හමුවූ වසර මිලියන 98කට වඩා පැරණි ඩයිනසෝර් පොසිලයන්
                      </figcaption>
                  </figure>

                </div>
                <div class="column is-4">
                  <figure>
                      <img src="./images/demistified/5.jpg">
                      <figcaption>
                        මෙක්සිකන් බොක්කේ පවතින චික්සුලුබ් ආවාටයෙහි (Chicxulub Crater) පිහිටීම සහ වර්ථමානයේ පෙනෙන ආකාරය
                      </figcaption>
                  </figure>
                </div>
              </div>

            </div>

          </div>
        </div>
        <?php } else { ?>
          <script type="text/javascript">
          window.onload = function(){
            window.location.href = "../../pricing.php"
          };
          </script>
        <?php } ?>
      <?php } else { ?>
        <script>
          window.onload = function(){
            $(".modal-button").click(function() {
              var target = $(this).data("target");
              $("html").addClass("is-clipped");
              $(target).addClass("is-active");
              $(".modal-close").css("display","none");
              $(".div-line").css("display","none");
              $(".close-modal").css("display","none");
            });
            $(".modal-button").trigger("click");
          };
        </script>
      <?php } ?>
    </section>
  </body>
</html>
