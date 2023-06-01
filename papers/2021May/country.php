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
    <title>දැනුමිණ | රටක වතගොත</title>
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
                <a class="prev-article-btn "  href="./places.php"><i class="fas fa-angle-double-left"></i> <strong>පුදුම හිතෙන තැන්</strong></a>
              </div>
              <div class="column is-8">
                <p class="subtitle has-text-centered">අධිරාජ්‍යයන්ගේ සොහොන්බිම - ඇෆ්ගනිස්ථානය</p>
              </div>
              <div class="column is-2">
                <a class="next-article-btn has-text-centered" href="./today.php"><strong>අද වැනි දවසක</strong> <i class="fas fa-angle-double-right"></i></a>
              </div>
            </div>
            <div class="content">
              <p class="has-text-justified">
                ඇෆ්ගනිස්ථානය, නිල වශයෙන් ඇෆ්ගනිස්ථාන ඉස්ලාමීය ජනරජය, මධ්‍යම හා දකුණු ආසියාවේ සන්ධිස්ථානයක පිහිටි භූමි ප්‍රදේශයකි. ඇෆ්ගනිස්ථානයට නැගෙනහිරින් සහ දකුණින් මායිම්ව ඇත්තේ පකිස්තානයයි. බටහිරින් ඉරානය වන අතර, උතුරින් තුර්ක්මෙනිස්තානය, උස්බෙකිස්තානය සහ ටජිකිස්තානය, චීනය ඊසාන දෙසින් වේ. වර්ග කිලෝමීටර් 652,000 (වර්ග සැතපුම් 252,000) ක පැතිරුනු එය උතුරු හා නිරිත දෙසින් තැනිතලා සහිත කඳුකර රටකි. ජනගහනය මිලියන 32 ක් පමණ වන අතර ජනවර්ගය පෂ්තුන්, ටජික්, හසාරස් සහ උස්බෙකිස්තානුවන්ගෙන් සමන්විතය.
              </p>
              <p class="has-text-justified">
                දකුණු-මධ්‍යම ආසියාවේ හදවතෙහි පිහිටා ඇති ඇෆ්ගනිස්ථානය, ගොඩබිමින් වටවුණු බහු වාර්ගික රටකි. එහි ආසන්නතම වෙරළ තීරය අරාබි මුහුදට සැතපුම් 300 ක් (කි.මී. 480) දකුණට වන්නට පිහිටා ඇත.
                දකුණු හා නැගෙනහිර ආසියාව යුරෝපයට හා මැදපෙරදිගට සම්බන්ධ කරන වැදගත් වෙළඳ මාර්ගයක පිහිටි ඇෆ්ගනිස්ථානය දිගු කලක් තිස්සේ විවිධ අධිරාජ්‍යන් විසින් ඉල්ලා සිටි ත්‍යාගයක් වන අතර සහස්‍ර ගණනාවක් තිස්සේ මහා හමුදාවන් එය යටත් කර ගැනීමට උත්සාහ කර ඇත.
              </p>
              <p class="has-text-justified">
                කාබුල් අගනුවර වන අතර විශාලතම නගරයද එයයි.මෝගල් රාජවංශයේ නිර්මාතෘ වන බාබුර් අධිරාජ්‍යයාගේ (1526-30) පාලන සමයේ මුස්ලිම් පල්ලි සහ උද්‍යාන සහිත සුන්දර නගරයක් සහ ශතවර්ෂ ගණනාවක් තිස්සේ  සේද මාවතේ වැදගත් ස්ථානයක් වූ කාබුල් නගරය විනාශකාරී ඇෆ්ගනිස්ථාන යුද්ධයෙන් පසු නටබුන් විය. එසේම, රටේ බොහෝ ප්‍රදේශ විනාශ වී, එහි ආර්ථිකය අවුල් ජාලයකට පත්වූ අතර, එහි ජනතාව විසිරී ගියේය. 21 වන ශතවර්ෂයේ මුල් භාගය වන විට ඇෆ්ගනිස්ථාන පරම්පරාවක්ම වැඩිහිටිභාවයට පැමිණියේ යුද්ධය හැර වෙන කිසිවක් නොදැන ය.
              </p>

              <br><h6>ජලාපවාහනය</h6>

              <p class="has-text-justified">
                ඇෆ්ගනිස්ථානයේ සමස්ත ජලාපවහන පද්ධතිය රට තුළම අන්තර්ගතය. වර්ග සැතපුම් 32,000 (වර්ග කිලෝමීටර් 83,000) ක භූමි ප්‍රදේශයක් පුරා විහිදෙන ගංගා සමුහයකි. ප්‍රධාන නැගෙනහිර ඇළ වන කෝබුල් ගඟ පාකිස්තානයේ ඉන්දු ගඟට ගලා බසින අතර එය ඉන්දියානු සාගරයේ අරාබි මුහුදට වැටේ. රටේ අනෙකුත් වැදගත් ගංගා සියල්ලම පාහේ මධ්‍යම කඳුකර කලාපයෙන් ආරම්භ වන අතර මිරිදිය විල් වලට හිස්වී හෝ වැලි කාන්තාරවලදී වියළී යයි. ප්‍රධාන ජලාපවහන පද්ධති වන්නේ අමු දාරියා, හෙල්මන්ඩ්, කාබුල් සහ හරෝඩ් ය.
              </p>

              <br><h6>දේශගුණය</h6>

              <p class="has-text-justified">
                පොදුවේ ගත් කල, ඇෆ්ගනිස්ථානයේ අතිශයින්ම ශීත, ශීත සෘතුවක් සහ උණුසුම් ග්‍රීෂ්ම සෘතුවක් ඇත. කලාපීය වෙනස්කම් රාශියක් ඇත. ඊසානදිග කඳුකර ප්‍රදේශවල වියළි, ​​සීත  සෘතුව සහිත උප දේශගුණික දේශගුණයක් පවතින අතර, පාකිස්තානයේ මායිමේ පිහිටි කඳුකර ප්‍රදේශ ඉන්දියානු මෝසම් වැසි වලට බලපෑම් ඇති කරයි. මීට අමතරව, ගිම්හානයේදී නිරිතදිගින් දිනපතාම පාහේ තද සුළං හමයි.
                ඇෆ්ගනිස්ථානයේ උෂ්ණත්වය බොහෝ සෙයින් වෙනස් වේ. නියඟයෙන් පීඩා විඳින නිරිතදිග සානුව කලාපයේ දිවා කාලයේ උෂ්ණත්වය 95° F (35° C) ට වඩා ඉහළ අගයක් ගනී. රටේ උණුසුම්ම ප්‍රදේශවලින් එකක් වන ජලලාබාද්හි ඉහළම උෂ්ණත්වය 120° F (49° C) ලෙස ජූලි මාසයේදී වාර්තා වී තිබේ. උස් කඳුකර ප්‍රදේශවල ජනවාරි මාසයේදී උෂ්ණත්වය 5° F (−15° C) හෝ ඊට අඩු විය හැකි අතර අඩි 5,900 (මීටර් 1,800)ක උසින් පිහිටා ඇති කාබුල් නගරයේ එය −24° F (−31 ° C) උෂ්ණත්වයක් වාර්තා වී ඇත.
              </p>

              <br><h6>ශාක හා සත්ව ජීවිතය</h6>

              <p class="has-text-justified">
                රටේ දකුණු කොටසේ, විශේෂයෙන් බටහිර දෙසට, වියළි කලාප සහ වැලි කාන්තාර බහුලව පවතින නිසා වෘක්ෂලතාදිය විරල ය. ගස් දුර්ලභ වන අතර, වසන්තයේ මුල වැසි සමයේදී පමණක් මල් පිපෙන තණකොළ හා ඖෂධ පැළෑටිවලින් වැසී ඇත. වර්ෂාපතනය වඩාත් බහුල වන උතුරු ප්‍රදේශයේ ශාක ආවරණය ඉහල වේ.උස් කඳු විශාල වනාන්තර ගස් වලින් පිරී ඇති අතර ඒවා අතර පයින් වැනි කේතුධර ශාක ප්‍රමුඛ වේ. මෙම ගස් සමහරක් අඩි 180 (මීටර් 55) ක් උසයි.ඊට අමතරව ඕක්, වොල්නට්, ඇල්ඩර් සහ ජුනිපර් ගස් සොයාගත හැකිය. පඳුරු ලෙස, රෝස මල් වර්ග කිහිපයක්, හනිසකල්, හැව්ටන් සහ කරන්ට් ඇතුළු ගුස්බෙරි පඳුරු ද ඇත.
              </p>
              <p class="has-text-justified">
                උපනිවර්තන සෞම්‍ය කලාපයේ වන සතුන්ගෙන් බොහොමයක් ඇෆ්ගනිස්ථානයේ වාසය කරයි. කලින් බහුල ව සිටි විශාල ක්ෂීරපායින් දැන් විශාල වශයෙන් අඩු වී ඇති අතර කොටියා අතුරුදහන් වී ඇත. වෘකයන්, හිවලුන්, ඉරි සහිත හයිනා සහ හිවලුන් ඇතුළු කඳුකරයේ සහ කඳු පාමුල සැරිසරන වන සතුන් විශාල ප්‍රමාණයක් තවමත් සිටී. ගැසල්, වල් බල්ලන් සහ හිම දිවියන් වැනි වල් බළලුන් බහුලව දක්නට ලැබේ. දුඹුරු වලසුන් කඳුකරයේ සහ වනාන්තරවල දක්නට ලැබේ.
              </p>
              <p class="has-text-justified">
                ගොදුරු කුරුල්ලන් ලෙස උකුස්සන්, රාජාලීන් ඇතුළත් වේ. සංක්‍රමණික පක්ෂීන් වසන්ත කාලවලදී බහුලව සිටිති. වළි කුකුලන්, වටුවන්, කොකුන්, පෙලිකන් කුරුල්ලන් සහ කකුළුවන් ද ඇත.ගංගා, ඇළ දොළ සහ විල් වල මිරිදිය මසුන් වර්ග රාශියක් සිටී, ගංගාවල දුඹුරු පැහැති ට්‍රවුට් මත්ස්‍යයින් විශාල වශයෙන් සිටී.
              </p>

              <br><h6>ජනවර්ග</h6>

              <p class="has-text-justified">
                1979 දී අර්ධ වශයෙන් ගණන් කිරීමෙන් පසු ඇෆ්ගනිස්ථානයේ කිසිදු ජාතික සංගණනයක් සිදු කර නොමැති අතර, වසර ගණනාවක යුද්ධය සහ ජනගහනය අවතැන්වීම නිසා නිවැරදි ජනවාර්ගික ගණනය කිරීමක් කළ නොහැකි විය. එබැවින් වර්තමාන ජනගහන ඇස්තමේන්තු දළ ගණනය කිරීම් වන අතර ඒවායින් පෙන්නුම් කරන්නේ පෂ්තුන් ජනවර්ගය ජනගහනයෙන් පහෙන් දෙකක් පමණ වන බවයි. විශාලතම පෂ්තුන් කණ්ඩායම් දෙක වන්නේ ඩුරෙනේ(Durrānī) සහ ගිල්සේ(Ghilzay) ය. ටජික්වරු ඇෆ්ගනිස්තානුවන්ගෙන් හතරෙන් එකක් පමණ විය හැකි අතර, හසාරා සහ උස්බෙකිස්තානුවන් ඉන් දහයෙන් එකක් පමණ වේ. චහාර් අයිමක්ස්, ටර්ක්මන් සහ අනෙකුත් ජනවාර්ගික කණ්ඩායම් සුළු කොටස් වේ.
              </p>

              <br><h6>භාෂා</h6>

              <p class="has-text-justified">
                ඇෆ්ගනිස්ථානයේ ජනතාව ජනවාර්ගික හා භාෂාමය වශයෙන් සංකීර්ණ වේ. ඉන්දු-යුරෝපීය භාෂා දෙකම වන පැෂ්ටෝ සහ පර්සියානු (ඩාරි) රටේ නිල භාෂා වේ. ජනගහනයෙන් පහෙන් දෙකකට වඩා වැඩි ප්‍රමාණයක් පෂ්තුන්වරුන්ගේ භාෂාව වන පැෂ්ටෝ කතා කරන අතර අඩක් පමණ පර්සියානු බස කතා කරයි. පර්සියානු භාෂාවේ ඇෆ්ගනිස්ථාන උපභාෂාව සාමාන්‍යයෙන් “ඩාරි” ලෙස හැඳින්වුවද, ටජික්, හාසරා, චහාර් අයිමාක් සහ කිසිල්බාෂ් ජනයා අතර උපභාෂා ගණනාවක් කථා කරයි. ඉරානයේ (ෆාර්සි) හෝ පර්සියානු භාෂාවට වඩා සමීපව කතා කරන උපභාෂා ද ඇතුළුව. පර්සියානු භාෂාව ටජිකිස්තානයේ (ටජික්) කතා කරයි. ඩාරි සහ ටජික් උපභාෂාවල තුර්කි සහ මොන්ගෝලියානු වචන ගණනාවක් අඩංගු වන අතර, භාෂා දෙකක් හෝ කිහිපයක් කතා කිරීම සුලභය, සමහර පෂ්තුන් නොවන අය පැෂ්ටෝ භාෂාව කථා කරන අතර, විශේෂයෙන් නාගරික ප්‍රදේශවල පෂ්තුන් විශාල සංඛ්‍යාවක් පර්සියානු භාෂාව කතා කරන අවස්ථාද ඇත.
              </p>

              <br><h6>ආගම</h6>

              <p class="has-text-justified">
                ඇෆ්ගනිස්ථානයේ සියලු ජනතාව මුස්ලිම් ජාතිකයින් වන අතර ඔවුන්ගෙන් පහෙන් හතරක් පමණ සුන්නි මුස්ලිම්වරුන් වේ. අනෙක් අය, විශේෂයෙන් හසරා සහ කිසිල්බාෂ්, ට්වෙල්වර් හෝ ඉස්මයිලි ෂීආ ඉස්ලාම් දහම අනුගමනය කරති. සූෆි ධර්මයද  ඇෆ්ගනිස්ථානයට ඓතිහාසිකව බලපා ඇති අතර හින්දු සහ සීක්වරුන්ද දහස් ගණනක් සිටිති.
              </p>

              <br><h6>වෙළඳාම, ආර්ථිකය සහ තවත් විස්තර මීළඟ කලාපයෙන් බලාපොරොත්තු වන්න.</h6>

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
