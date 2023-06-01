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
    <title>දැනුමිණ | ජෛවගෝලය</title>
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
                <a class="prev-article-btn " href="./tech.php"><i class="fas fa-angle-double-left"></i> <strong>විදුනැණ</strong></a>
              </div>
              <div class="column is-8">
                <p class="subtitle has-text-centered">බැක්ටීරියාවන්ගේ ලෝකය  -  පළමු කොටස</p>
              </div>
              <div class="column is-2">
                <a class="next-article-btn has-text-centered" href="./biography.php"><strong>ප්‍රකට චරිත</strong> <i class="fas fa-angle-double-right"></i></a>
              </div>
            </div><br>

            <div class="content">
              <p class="has-text-justified">
                බැක්ටීරියා තනි සෛලයකින් සැදි ක්ෂුද්‍ර ජීවීන් වර්ගයකි. සාමාන්‍යයෙන් මයික්‍රොමීටර කිහිපයක් දිගු වන අතර ගෝලාකාර සිට සර්පිලාකාර දක්වා හැඩයෙන් විවිධ වේ. පෘථිවියේ දර්ශනය වූ පළමු ජීව ස්වරූපයන් අතර බැක්ටීරියා ද ඇති අතර ඒවා බොහෝ වාසස්ථානවල දක්නට ලැබේ. පස, ජලය තුල මෙන්ම සාමාන්‍ය ජිවින්ට වාසයට අපහසු, ආම්ලික උණු දිය උල්පත්, විකිරණශීලී අපද්‍රව්‍ය සහ පෘථිවි පෘෂ්ඨයේ ගැඹුරේ පවා බැක්ටීරියා වාසය කරයි. එමෙන්ම බැක්ටීරියා ශාක හා සතුන් සමඟ සහජීවන හා පරපෝෂිත සම්බන්ධතා ඇතිකරමින් ද ජීවත් වේ. බොහෝ බැක්ටීරියා වර්ගීකරණය කර නොමැති අතර රසායනාගාරයේ වගා කළ හැකි විශේෂ ඇත්තේ බැක්ටීරියා වර්ග වලින් සියයට 27 ක් පමණි. බැක්ටීරියා අධ්‍යයනය ක්ෂුද්‍රජීව විද්‍යාවේ කොටසක් වන බැක්ටීරියා විද්‍යාව ලෙස හැඳින්වේ.
              </p>

              <div class="columns">
                <div class="column is-4">
                  <figure>
                      <img src="./images/Bacteria/1.jpg">
                      <figcaption>
                        ඇමෙරිකාවේ යෙලෝව්ස්ටෝන් ජාතික උද්‍යානයේ ඇති උණුදිය උල්පත් - තැඹිලි වර්ණයෙන්  තර්මොෆිල් / තාපකාමී බැක්ටීරියා ජනාවාස පෙනේ. මෙම උණුදිය උල්පත් අවට උෂ්ණත්වය සෙල්සියස් අංශක 50 ඉක්මවයි.
                      </figcaption>
                  </figure>
                </div>
                <div class="column is-8">
                  <p class="has-text-justified">
                    සියළුම සත්වන්ගේ පාහේ පැවැත්ම බැක්ටීරියා මත රඳා පවතින අතර සමහර බැක්ටීරියා විශේෂ විටමින් බී-12 සංස්ලේෂණය කිරීමට අවශ්‍ය ජාන සහ එන්සයිම(කොබැලමින් = cobalamin) දරමින් ආහාර දාමය හරහා සතුන්ට සපයයි. විටමින් බී-12 යනු ජලයේ ද්‍රාව්‍ය විටමින් වර්ගයක් වන අතර එය මිනිස් සිරුරේ සෑම සෛලයකම පරිවෘත්තීය ක්‍රියාවලියට සම්බන්ධ වේ. එය ඩීඑන්ඒ සංස්ලේෂණයේ සහ මේද අම්ල හා ඇමයිනෝ අම්ල පරිවෘත්තීය යන දෙඅංශයේම සහසාධකයක් ලෙස ක්‍රියා කරයි. මයිලින් සංශ්ලේෂණය කිරීමේ කාර්යභාරය හරහා ස්නායු පද්ධතියේ සාමාන්‍ය ක්‍රියාකාරිත්වයේ දීද එය විශේෂයෙන් වැදගත් වේ.
                  </p>
                  <p class="has-text-justified">
                    සාමාන්‍යයෙන් පාංශු ග්‍රෑම් එකක බැක්ටීරියා සෛල මිලියන 40 ක් පමණ අඩංගු වන අතර මිරිදිය ජලය මිලිලීටරයක බැක්ටීරියා සෛල මිලියනයක් පමණ ඇත. පෘථිවියේ දළ වශයෙන් 5 x 10<sup>30</sup> බැක්ටීරියා ප්‍රමාණයක් ඇති අතර එය ශාක පමණක් ඉක්මවා යන ජෛව ස්කන්ධයක් සාදයි.
                  </p>
                </div>
              </div>

              <p class="has-text-justified">
                වායුගෝලයෙන් නයිට්‍රජන් තිර කිරීම වැනි පෝෂ්‍ය පදාර්ථ ප්‍රතිචක්‍රීකරණය කිරීමෙන් පෝෂක චක්‍රයේ බොහෝ අවස්ථා වලදී බැක්ටීරියා ඉතා වැදගත් වේ. පෝෂක චක්‍රයට සත්ව මළ දේහ දිරාපත් වීමද ඇතුළත් වේ.
              </p>
              <p class="has-text-justified">
                මිනිසුන් සහ බොහෝ සතුන් තුළ, බඩවැලේ විශාල බැක්ටීරියා සංඛ්‍යාවක් ජීවත් වන අතර සම මතද විශාල සංඛ්‍යාවක් ඇත. ශරීරයේ ඇති බැක්ටීරියා වලින් බහුතරයක් හානිකර නොවන අතර ඇතැම්වා බොහෝ ප්‍රයෝජනවත් වේ. කෙසේ වෙතත්, බැක්ටීරියා විශේෂ කිහිපයක් ව්‍යාධිජනක වන අතර කොලරාව, සිෆිලිස්, ඇන්ත්‍රැක්ස්, ලාදුරු සහ බුබොනික් වසංගතය වැනි බෝවන රෝග ඇති කරයි. වඩාත් සුලභ හා මාරාන්තික බැක්ටීරියා රෝග වන්නේ ශ්වසන ආසාදනය. ඒ අතරින් ක්ෂය රෝගයෙන් පමණක් වසරකට මිලියන 2 ක් පමණ උප සහරා අප්‍රිකානු කලාපයේ මිනිසුන් මිය යන බවට ගණන් බලා ඇත.
              </p>
              <p class="has-text-justified">
                ඖෂධ නිශ්පාදනයේදී බැක්ටීරියා ආසාදන වලට ප්‍රතිකාර ලෙස ප්‍රතිජීවක නිපද වීමටත්, කර්මාන්තයේ දී, අපද්‍රව්‍ය පිරිපහදු කිරීම හා තෙල් කාන්දු වීම් වලදීත්, පැසවීම තුළින් චීස් හා යෝගට් නිෂ්පාදනය කිරීම, පතල් ක්‍ෂේත්‍රයේ රන්, පැලේඩියම්, තඹ සහ වෙනත් ලෝහ ලබා ගැනීමට මෙන්ම ජෛව තාක්‍ෂණය හා එහි නිෂ්පාදන සඳහාද බැක්ටීරියා වැදගත් වේ.
              </p>

              <br><h6>මූලාරම්භය සහ පරිණාමය</h6>
              <p class="has-text-justified">
                නූතන බැක්ටීරියාවන්ගේ මුතුන් මිත්තන් මීට වසර බිලියන 4 කට පමණ පෙර පෘථිවියේ සිටි පළමු ජීව ස්වරූපය වූ ඒකීය සෛලීය ක්ෂුද්‍ර ජීවීන් විය. වසර බිලියන 3 කට පමණ පෙර, බොහෝ ජීවීන් අන්වීක්ෂීය වූ අතර, බැක්ටීරියා සහ ආකියා(ඒක සෛලීකයන්) ප්‍රමුඛතම ජීවීන් විය. ගොඩබිම පැරණිතම ජීවිතය මීට වසර බිලියන 3.22 කට පමණ පෙර බැක්ටීරියා විය හැකි බවට අනුමාන කරයි. මීට වසර බිලියන 2.5 - 3.2 අතර කාලයේ බැක්ටීරියාවන්ගේ ආසන්නතම මුතුන්මිත්තන් වන තර්මොෆිල් / තාපකාමී බැක්ටීරියා තිබුණු බවට අනාවරණය වී ඇත.
              </p>

              <br><h6>විවිධත්වය</h6>

              <div class="columns">
                <div class="column is-9">
                  <p class="has-text-justified">
                    බැක්ටීරියා හැඩයෙන් සහ ප්‍රමාණයන්  විවිධාකාරවේ. දිග සාමාන්‍යයෙන් මයික්‍රොමීටර(µm) 0.5 – 5.0 ක් පමණ වේ (1000µm = 1mm). කෙසේ වෙතත්, විශේෂ කිහිපයක් පියවි ඇසට දැකිය හැකිය. නිදසුනක් ලෙස, තියෝමාර්ගරිටා නැමීබියන්සිස් (Thiomargarita namibiensis) මිලිමීටර භාගයක් පමණ දිග වන අතර Epulopiscium fishelsoni මි.මී. 0.7 පමණ වේ. ප්‍රමාණයෙන් කුඩාම බැක්ටීරියා මයිකොප්ලාස්මා කුලයට අයත් වන අතර ඒවා මයික්‍රොමීටර 0.3 ක් පමණ වන වෛරස් තරම් කුඩා වේ.
                  </p>
                  <p class="has-text-justified">
                    බොහෝ බැක්ටීරියා විශේෂ හැඩයෙන් ගෝලාකාර වේ, ඒවා කොකුසාකාර(Cocci) ලෙසත්, දිගැටි හැඩැති ඒවා බැසිලාකාර(Bacilli) ලෙසත් වක්‍ර හෝ කොමා හැඩති විබ්‍රියෝ සහ සර්පිලාකාර හැඩැති ස්පිරිල්ලා ලෙසද පවතී, නැතහොත් තදින් දඟර ලෙස පෙනෙන ස්පිරෝකයිටා ලෙසද ඇත. තරු හැඩැති බැක්ටීරියා වැනි වෙනත් අසාමාන්‍ය හැඩයන්ගෙන් යුත් බැක්ටීරියා කුඩා සංඛ්‍යාවක්ද හඳුනාගෙන ඇත. මෙම විවිධාකාර හැඩයන් වැදගත් වන්නේ ඒවාට පෝෂ්‍ය පදාර්ථ ලබා ගැනීමට, මතුපිට පෘෂ්ඨ වල ඇලීමට, දියර හරහා පිහිනීමට සහ විලෝපිකයන්ගෙන් බේරී සිටීමටයි.
                  </p>
                </div>
                <div class="column is-3">
                  <figure>
                    <img src="./images/Bacteria/2.jpg">
                    <figcaption>
                      දැනට හමුව ඇති විශාලතම බැක්ටීරියා විශේෂයක් වන තියෝමාර්ගරිටා නැමීබියන්සිස් (Thiomargarita namibiensis)
                    </figcaption>
                  </figure>
                </div>
              </div>

              <div class="columns">
                <div class="column is-3">
                  <figure>
                    <img src="./images/Bacteria/3.jpg">
                    <figcaption>
                      කොළරාව සාදන බැක්ටීරියාව (Vibrio cholerae) විබ්‍රියෝ කොලරේ අන්වීක්ශීය ඡායාරූපයක් - ඒවා කොමා/වක්‍ර හැඩතිය.
                    </figcaption>
                  </figure>
                  <figure>
                    <img src="./images/Bacteria/4.jpg">
                    <figcaption>
                      ශ්වසන ආසාදන, සමේ අසාදන ඇතිකරන කොකුසාකාර ස්ටැෆිලොකොකස් අවුරියස් - (Staphylococcus aureus) බැක්ටීරියාවේ වර්ණගන්වන ලද ඉලෙක්ට්‍රෝන අන්වීක්ශීය ඡායාරූපයක්.
                    </figcaption>
                  </figure>
                </div>
                <div class="column is-9">
                  <br><h6>ශක්තිය ලබාගැනීම</h6>
                  <p class="has-text-justified">
                    ශක්තිය ලබා ගන්නා ආකාරය අනුව බැක්ටීරියා වර්ග කරයි. ප්‍රභාසංස්ලේෂනය මගින් ශක්තිය නිපදවාගන්නා විශේෂ ප්‍රභාකාමී බැක්ටීරියා වේ.  සයනෝබැක්ටීරියා(Cyanobacteria), කොළ-සල්ෆර් බැක්ටීරියා ඒවාට නිදසුන්වේ. ඉතා අපහසු පරිසර වල වෙසෙමින් අකාබනික ද්‍රව්‍ය බිඳහෙලා ශක්තිය ලබා ගන්නා බැක්ටීරියා විශේෂද ඇත.
                  </p>

                  <div class="columns">
                    <div class="column is-4">
                      <figure>
                        <img src="./images/Bacteria/7.jpg">
                        <figcaption>
                          ප්‍රභාකාමී සයනෝබැක්ටීරියා(Cyanobacteria) විශේෂ
                        </figcaption>
                      </figure>
                    </div>
                    <div class="column is-4">
                      <figure>
                        <img src="./images/Bacteria/8.jpg">
                        <figcaption>
                          සයනෝබැක්ටීරියා ආක්‍රමණයට ලක්වූ ජලාශයක්
                        </figcaption>
                      </figure>
                    </div>
                    <div class="column is-4">
                      <figure>
                        <img src="./images/Bacteria/9.jpeg">
                        <figcaption>
                          ප්‍රභාකාමී බැක්ටීරියාවක් වන දම්-සල්ෆර් බැක්ටීරියා ආක්‍රමණයට ලක්වූ ජලය
                        </figcaption>
                      </figure>
                    </div>
                  </div>

                  <br><h6>තාක්ෂණයේදී සහ කර්මාන්තයේදී බැක්ටීරියා දායක වීම</h6>
                  <p class="has-text-justified">
                    වසර දහස් ගණනක් තිස්සේ ලැක්ටික් අම්ල බැක්ටීරියා වන ලැක්ටොබැසිලස්(Lactobacillus) සහ ලැක්ටොකොකස්(Lactobacillus) සමගින් යීස්ට් සංයෝග කර චීස්, අච්චාරු, සෝයා සෝස්, ගෝවා, විනාකිරි, වයින් සහ යෝගට් වැනි පැසුණු ආහාර පිළියෙල කිරීම සඳහා භාවිතා කරයි.
                  </p>


                  <p class="has-text-justified">
                    විවිධ කාබනික සංයෝග ජීර්ණයට බැක්ටීරියා වලට ඇති විශිෂ්ට හැකියාව හේතුවෙන් අපද්‍රව්‍ය පිරිසැකසුම් කිරීමේදී හා ජෛවමිතිකකරණය සඳහා භාවිතා කර ඇතැම්  බැක්ටීරියා භාවිත කරයි.
                    ඛනිජ තෙල්වල ඇති හයිඩ්‍රොකාබන ජීර්ණය කළ හැකි බැක්ටීරියා බොහෝ විට තෙල් කාන්දු පිරිසිදු කිරීම සඳහා යොදා ගනී. 1989දී ඇතිවූ එක්සෝන් වැල්ඩෙස් තෙල් කාන්දුවෙන් පසු  මුහුදු ජලයේ ස්වාභාවිකව වෙසෙන මෙම බැක්ටීරියා වල වර්ධනය ප්‍රවර්ධනය කිරීමේ උත්සාහයක් ලෙස ප්‍රින්ස් විලියම් සවුන්ඩ් මුහුදු වෙරළට පොහොර එකතු කරන ලදී.
                  </p>
                </div>
              </div>

              <div class="columns">
                <div class="column is-8">
                  <p class="has-text-justified">
                    මෙමගින් තෙල්වලින් ආවරණය වූ වෙරළ තීරයන්හි පලදායී ලෙස තෙල් ඉවත් කරගත හැකි විය. කාර්මික විෂ අපද්‍රව්‍ය ජෛවමිතිකකරණය සඳහා ද බැක්ටීරියා භාවිතා කරයි. රසායනික කර්මාන්තයේ දී, ඖෂධ, කෘෂි රසායන හා  රසායනික ද්‍රව්‍ය නිෂ්පාදනය කිරීමේදී බැක්ටීරියා වඩාත් වැදගත්වේ.
                  </p>
                  <p class="has-text-justified">
                    ජෛව පළිබෝධ පාලනය සඳහා පළිබෝධනාශක වෙනුවට බැක්ටීරියා භාවිතා කළ හැකිය. ග්‍රෑම් +, පාංශු වාසී බැක්ටීරියාවක් වන බැසිලස් තුරින්ජියන්සිස් (Bacillus thuringiensis - BT ලෙසද හැඳින්වේ) මෙයට සම්බන්ධ වේ. මෙම බැක්ටීරියා වල උප විශේෂ ඩිපෙල් සහ තුරයිසයිඩ් වැනි වෙළඳ නාම යටතේ විශේෂිත කෘමිනාශක ලෙස භාවිතා කරයි. මෙම පළිබෝධනාශක පරිසර හිතකාමී ලෙස සලකනු ලබන අතර මිනිසුන්ට, වන ජීවීන්ට, පරාග කාරකයන්ට සහ වෙනත් බොහෝ ප්‍රයෝජනවත් කෘමීන්ට බලපෑම් නොකරයි.
                  </p>
                </div>
                <div class="column is-4">
                  <figure>
                    <img src="./images/Bacteria/14.jpg">
                    <figcaption>
                      1989 වසරේදී ඇතිවූ එක්සෝන් වැල්ඩෙස් තෙල් කාන්දුව - විලියම් සවුන්ඩ් වෙරළ තීරය, ඇලස්කාව
                    </figcaption>
                  </figure>
                </div>
              </div>


              <br><h6>බැක්ටීරියා විද්‍යාවේ ඉතිහාසය පිළිබඳ විස්තර මීළඟ කලාපයෙන් බලාපොරොත්තු වන්න.</h6>
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
