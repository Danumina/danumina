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
    <title>දැනුමිණ | ලෝක ඉතිහාසය</title>
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
                <a class="prev-article-btn " href="./sports.php"><i class="fas fa-angle-double-left"></i> <strong>ක්‍රීඩා</strong></a>
              </div>
              <div class="column is-8">
                <p class="subtitle has-text-centered">සුමේරියානු ශිෂ්ටාචාරය - පළමු කොටස</p>
              </div>
              <div class="column is-2">
                <a class="next-article-btn has-text-centered" href="./culture.php"><strong>සංස්කෘතිකාංග</strong> <i class="fas fa-angle-double-right"></i></a>
              </div>
            </div><br>
            <div class="content">
              <figure>
                  <img src="./images/sumer/1.jpg">
                  <figcaption>
                    බ්‍රිතාන්‍ය කෞතුකාගාරයේ සංරක්ෂිතව ඇති උර් යුගයට අයත් සුමේරියානු සිතුවමක්
                  </figcaption>
              </figure>

              <div class="columns">
                <div class="column is-8">
                  <p class="has-text-justified">
                    සුමර් යනු ටයිග්‍රීස් සහ යුප්‍රටීස් ගංගා අතර පිහිටා ඇති සාරවත් ප්‍රදේශයක් වූ මෙසපොතේමියානු කලාපයේ එනම් වත්මන් ඉරාකයේ දකුණු කොටසේ ආරම්භ වුනු මෙතෙක් හඳුනාගත් ලොව පැරණිතම ශිෂ්ටාචාරයයිි. භාෂාව, පාලනය, ගෘහ නිර්මාණ ශිල්පය සහ තවත් බොහෝ දේවල නව්‍යකරණයන් සඳහා ප්‍රසිද්ධ සුමේරියානුවන් නූතන මිනිසුන් තේරුම් ගන්නා පරිදි නුතන මානව ශිෂ්ටාචාරයේ නිර්මාතෘවරුන් ලෙස සැලකිය හැකිය. ක්‍රි පු 2000 දී පමණ බැබිලෝනියානුවන්ගේ බලයට නතුවන තෙක් ඔවුන් වසර 2,000 ක් තරම් කාලයක් කලාපය පාලනය කල බවට සාක්ෂි පවතී.
                  </p>
                  <h6>ශිෂ්ටාචාරයේ බිහිවීම</h6>
                  <p class="has-text-justified">
                    ක්‍රිපූ 4500 - 4000 අතර කාලයේ මුල්ම සුමේරියානු ජනාවාස ඇතිවිය. මෙම මුල් ජනගහනය උබයිඩ් ජනාවාස ලෙස හැඳින්වෙන අතර උබයිඩ් මිනිසුන් ගොවිතැන් කිරීම, ගවයන් ඇති කිරීම, රෙදිපිළි විවීම, වඩු කර්මාන්තය, මැටි භාණ්ඩ සැදීම සහ බියර් නිපදවීම තුලින් කර්මාන්තයෙහි දියුණු පිරිසක් විය. මෙලෙස උබයිඩ් ගොවි ප්‍රජාවන් වටා ගම් සහ නගර බිහිවීමෙන් සුමේරියානු ජනාවාස ඇතිවිය.
                  </p>
                  <p class="has-text-justified">
                    ක්‍රිපූ 3000 පමණ වන විට සුමේරියානු සංස්කෘතිය වඩ වඩාත් නගර-ප්‍රාන්තවල බලවත්ව තිබුණි. ප්‍රධාන නගරය වූ උරුක්හි දල වශයෙන් 80,000ක් පමණ ජනතාවක් වාසය කළේය. එය තාප්ප වලින් වටවුණු වර්ග සැතපුම් 6ක පමණ බිම් ප්‍රමාණයක් සහිතව තිබුණු අතර සමකාලීනව ලොව තිබුණු විශාලතම නගරය යයි කිව හැකිය. එරිදු, නිපුර්, ලගාෂ්, කිෂ්, උර්, තවත් සුමේරියානු නගර කිහිපයකි.
                  </p>
                </div>
                <div class="column is-4">
                  <figure>
                    <img src="./images/sumer/2a.jpg">
                      <figcaption>
                        යුප්‍රටීස් (Euphrates) හා ටයිග්‍රීස් (Tigris) ගංගා අතර පිහිටි පුරාණ මෙසපොතේමියාව
                      </figcaption>
                  </figure>
                </div>
              </div>

              <br><h6>සුමේරියානු භාෂාව හා සාහිත්‍ය</h6>
              <p class="has-text-justified">
                සුමේරියානු භාෂාව ලොව පැරණිතම භාෂාමය සාක්ෂි සපයන අතර ක්‍රිපූ 3100 පමණ සිට, ක්‍රිපූ 2000 දී පමණ අක්කඩියානු භාෂාවෙන් ප්‍රතිස්ථාපනය වන තෙක් වසර දහසකට වැඩි කාලයක් මෙසපොතේමියානු කලාපයේ ප්‍රධාන භාෂාව ලෙස පැවතියේය. ඉන් පසුවත් කියුනිෆෝම් පුවරු මත ලියන ලිඛිත භාෂාවක් ලෙස එනම් රුප-සළකුණු ලෙස ලිඛිත භාවිතයේ පැවතුණි.
              </p>
              <p class="has-text-justified">
                ලිවිම සුමේරියානුවන්ගේ වැදගත්ම සංස්කෘතික ජයග්‍රහණයන්ගෙන් එකක් වන අතර, පාලකයන්ගේ සිට ගොවීන් හා කම්කරුවන් දක්වා ඉතා සූක්ෂම ලෙස වාර්තා තබා ගැනීම සිදු කර ඇත. ලොව මෙතෙක් හමුවූ පැරණිතම නීති පද්ධතිය හමුවන්නේ සුමේරියානුවන්ගෙනි. උර්-නම්මු ලෙසින් නම්වූ එය ක්‍රිපූ 2400 තරම් ඈත අතීතයට දිවයන, කියුනිෆෝම් පුවරු ලෙස ලියා ඇති, එබ්ලා නගරයෙන්(වර්තමානයේ සිරියාව) හමුවූවකි. මේවා කොටස් වශයෙන් හමු වුවද සුමේරියානුවන්ට පොහොසත් ලිඛිත ඉතිහාසයක් පැවති බවට සාක්‍ෂි සපයයි.
              </p>

              <div class="columns">
                <div class="column is-8">
                  <div class="columns">
                    <div class="column is-6">
                      <figure>
                        <img src="./images/sumer/3.jpg">
                          <figcaption>
                            ක්‍රිපූ 3000 දී පමණ ලියන ලද උරුක් යුගයෙන් හමුවන කියුනිෆෝම් පුවරුක් - නිව්යෝක් නුවර මෙට්‍රොපොලිටන් කෞතුකාගාරයේ තබා ඇත.
                          </figcaption>
                      </figure>
                    </div>
                    <div class="column is-6">
                      <figure>
                        <img src="./images/sumer/5.jpg">
                          <figcaption>
                            ක්‍රිපූ 2600 දී පමණ ලියූ නිවසක් සහ වගා බිමක් විකිණීමේ ලියවිල්ලක්
                          </figcaption>
                      </figure>
                    </div>
                  </div>
                </div>
                <div class="column is-3">
                  <figure>
                    <img src="./images/sumer/4.jpg">
                      <figcaption>
                        උර්-නම්මු නීති පද්ධතිය ලියු පුවරුව
                      </figcaption>
                  </figure>
                </div>
              </div>


              <div class="columns">
                <div class="column is-9">
                  <h6>සුමේරියානු චිත්‍ර හා ගෘහ නිර්මාණ ශිල්පය</h6>
                  <p class="has-text-justified">
                    මහා පරිමාණ වශයෙන් ගොඩනැගිලි ඉදිකිරීම් සුමේරියානුවන් යටතේ මුලින්ම සිදුවිණි. උබයිඩ් යුගයෙන් ආරම්භවූ ගෘහ නිර්මාණ ශිල්පය ශතවර්ෂ ගණනාවක් තිස්සේ වැඩි දියුණු විය. මුලින්ම සිදු වුයේ ආගමික ඉදිකිරීමය. ඔවුන්ගේ ගොඩනැගිලි මැටි ගඩොලින් නිමවා බට පතුරු මිටි ඒ මත අතුරා නිම කර ඇත. මේවායේ ආරුක්කු හැඩති දොරවල්, පැතලි වහලවල් කැපී පෙනෙන අංගයන් ය.
                  </p>
                  <p class="has-text-justified">
                    කාලයත් සමඟ වඩ වඩාත් දියුණු වෙමින් සංකීර්ණ ගෘහ නිර්මාණයන් ඇති විය. ටෙරාකොටා විසිතුරු කිරීම්, ලෝකඩ වලින් නිමවූ බඩු බාහිරාදිය, වඩාත් සංකීර්ණ මොසයික් නිර්මාණ, ගඩොලින් නිමවූ කුළුණු, බිතු සිතුවම් සියල්ල ශිෂ්ටාචාරයේ තාක්‍ෂණික දියුණුව මැනවින් පෙන්වයි.
                  </p>
                  <p class="has-text-justified">
                    ක්‍රිපූ 2200 පමණ කාලයේ නිමැවුණු අනු සිගුරත්, සුමේරියානුවන්ගේ පුජනීය ස්ථානයකි. සෘජුකෝණාශ්‍රාකාර හෝ හතරැස්, පිරමීඩ හැඩති මෙම ගොඩනැගිලි,  පඩිපෙළ සහිත, අභ්‍යන්තර කුටි නොතිබූ, අඩි 170 ක් පමණ උස ඒවාය. ඒවායේ බෑවුම් හා ටෙරස් මත ඉදිකල උද්‍යාන තිබී ඇත.
                  </p>
                  <p class="has-text-justified">
                    ආගමික ස්ථාන අලංකාර කිරීමට මුර්ති නිර්මාණ කර ඇත. ඒවා ලෝහ වාත්තු කිරීමෙන් හා ටෙරාකොටා වලින් නිපදවන ලදී. ගල් කැටයම්ද ජනප්‍රිය කලාවක්ව පැවතිනි.
                  </p>
                  <p class="has-text-justified">
                    පසුව බිහිවූ අක්කඩියානු  රාජවංශය යටතේ, මූර්ති නිර්මාණ වඩාත් නවීකරණය විය. ක්‍රිපූ 2100 දී පමණ ඩයරයිට් පාෂාණ වලින් නිමවූ වඩාත් සංකීර්ණ හා විශාල මුර්ති හමුවේ.
                  </p>
                </div>
                <div class="column is-3">
                  <figure>
                    <img src="./images/sumer/10.jpg">
                      <figcaption>
                        උර් යුගයෙන් හමුවන (a) සුමේරියානු රජෙකුගේ සිංහාසනාරූඩ වීම (ක්‍රිපූ 2600) සහ රජු වටා පිරිස පෙන්වන සිතුවමක් (b) වීනා වයන්නෙක්
                      </figcaption>
                  </figure>
                </div>
              </div>

              <div class="columns">
                <div class="column is-5">
                  <figure>
                    <img src="./images/sumer/7b.jpg">
                    <figcaption>
                      උරුක්හි අනු සිගුරත් නටබුන්
                    </figcaption>
                  </figure>
                </div>
                <div class="column is-7">
                  <figure>
                    <img src="./images/sumer/8a.jpg">
                    <figcaption>උර්හි සිගුරත් (ක්‍රිපූ 2200දී උර් නම්මු රජු විසින් ඉදි කරන ලද්දකි)</figcaption>
                  </figure>
                </div>
              </div>

              <h6>සුමේරියානු විද්‍යාව</h6>
              <p class="has-text-justified">
                සුමේරියානුවන්ට ඖෂධ පැළෑටි හා මැජික් ක්‍රම මත පදනම්වූ වෛද්‍ය ක්‍රමයක් තිබුණි. ස්වාභාවික ද්‍රව්‍ය වලින් රසායනික කොටස් ඉවත් කිරීමේ ක්‍රියාවලීන් පිළිබඳව ද ඔවුන් හුරුපුරුදු විය. ඔවුන්ට කායික විද්‍යාව පිළිබඳ උසස් දැනුමක් තිබුණු බව පුරාවිද්‍යාත්මක ස්ථානවලින් හමුවූ ශල්‍ය උපකරණ වලින් කිව හැකිය.
              </p>
              <p class="has-text-justified">
                සුමේරියානුවන්ගේ විශාලතම දියුණුව වූයේ වාරි ඉංජිනේරු ක්ෂේත්‍රයේ ය. ඔවුන්ගේ ඉතිහාසයේ මුල් අවධියේදීම ඔවුන් ගංවතුර පාලනය කිරීම සඳහා කාණු පද්ධතීන් නිර්මාණය කළහ. ගොවිතැන් කිරීම සඳහා ටයිග්‍රීස් සහ යුප්‍රටීස් ගංගා හරහා ඇල මාර්ග තනාගනිමින් වාරිමාර්ගයේ නිර්මාතෘන්ද වූ අතර එම ඇල මාර්ග රාජවංශයෙන් රාජවංශයට ප්‍රතිසංස්කරණය කරමින් අඛණ්ඩව පවත්වා ගත්හ.
              </p>
              <p class="has-text-justified">
                ඉංජිනේරු විද්‍යාව හා ගෘහ නිර්මාණ ශිල්පයෙහි ඔවුන්ගේ කුසලතාව ගණිතය පිළිබඳ ඔවුන්ගේ අවබෝධය පෙන්නුම් කරයි.
              </p>

              <div class="columns">
                <div class="column is-3">
                  <figure>
                    <img src="./images/sumer/11.jpg">
                    <figcaption>සුමේරියානු ගණිත පුවරුවක්</figcaption>
                  </figure>
                </div>
                <div class="column is-3">
                  <figure>
                    <img src="./images/sumer/12.jpg">
                    <figcaption>සුමේරියානු වාරි කෘෂි කර්මාන්තය</figcaption>
                  </figure>
                </div>
                <div class="column is-6">
                  <figure>
                    <img src="./images/sumer/13ab.jpg">
                    <figcaption>(a) සතුන් බැඳි ද්වී රෝද කරත්තයක කොටසක්, (b) සුමේරියානු ගොවියන් භාවිතා කළ නගුලක අනුරුවක්</figcaption>
                  </figure>
                </div>
              </div>

              <h6>සංස්කෘතිය</h6>
              <p class="has-text-justified">
                සුමේරියානු ජන සමාජය තුල ඉගැන්වීම් පාසල් පොදු වූ අතර, සමාජය ගොඩනැගීමට හා පවත්වාගැනීමට දැනුම් පද්ධතියක් පවත්වාගත් ලොව මුල්ම සමාජ ක්‍රමවේදය සුමේරියානුවන්ගෙන් හමුවේ.
              </p>
              <p class="has-text-justified">
                සුමේරියානුවන්ගේ ලිඛිත සාක්‍ෂි රාශියක් ඉතිරිව පවතින අතර ඒ අතරින් ඔවුන්ගේ වීර කාව්‍යයන් පසුකාලීන ග්‍රීසියේ හා රෝම කෘතිවලට සහ බයිබලයේ සමහර කොටස් වලට බලපෑම් ඇති කළේය. ඒ අතරින් මහා ජලගැල්ම, ඒදන් උයන සහ බාබෙල් කුළුණ පිළිබඳ කතාව විශේෂ වේ.
              </p>
              <p class="has-text-justified">
                සුමේරියානුවන් සංගීතයට නැඹුරු වූ අතර සුමේරියානු ගීතිකාවක් වන “හුරියන්” ගීතිකාව ලොව පැරණිතම සංගීතමය වශයෙන් සටහන් වූ ගීතය ලෙස සැලකේ.
              </p>

              <div class="columns">
                <div class="column is-8">
                  <figure>
                    <img src="./images/sumer/19ab.jpg">
                    <figcaption>උර්හි රාජකීය සොහොන් බිමෙන් හමුවූ (a) රැජිනගේ රන් වීනාව (b) රන් හා රිදී වීනා </figcaption>
                  </figure>
                  <figure>
                    <img src="./images/sumer/9ab.jpg">
                    <figcaption>(a) ලොව මුලින්ම යාන්ත්‍රිකව මැටි බඳුන් නිපදවූයේ සුමේරියානුවන්ය. (b) පසු උබයිඩ් යුගයෙන් හමුවන මැටි කෙණ්ඩියක්</figcaption>
                  </figure>
                </div>
                <div class="column is-4">
                  <figure>
                    <img src="./images/sumer/21.jpg">
                    <figcaption>ගිල්ගමේශ් වීර කාව්‍යය ලියා ඇති පුවරුව</figcaption>
                  </figure>
                  <figure>
                    <img src="./images/sumer/6.jpg">
                    <figcaption>ක්‍රිපූ තුන්වන සහශ්‍රකයේ සුමේරියානු මොසයික් නිර්මාණිත කුළුණු - බර්ලින් ජාතික කෞතුකාගාරයේ සංරක්ෂිතව ඇත.</figcaption>
                  </figure>
                </div>
              </div>

              <br><h6>සුමේරියානු බලය බිඳවැටීම හා ආක්‍රමණ පිලිබඳ විස්තර මීළඟ කලාපයෙන් කියවන්න </h6>

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
