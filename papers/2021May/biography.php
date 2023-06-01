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
    <title>දැනුමිණ | ප්‍රකට චරිත</title>
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
                <a class="prev-article-btn " href="./biology.php"><i class="fas fa-angle-double-left"></i> <strong>ජෛවගෝලය</strong></a>
              </div>
              <div class="column is-8">
                <p class="subtitle has-text-centered">හොලිවුඩ් සිනෙමාවේ විනෝදාස්වාදයේ රජු - ස්ටීවන් ස්පීල්බර්ග්</p>
              </div>
              <div class="column is-2">
                <a class="next-article-btn has-text-centered" href="./places.php"><strong>පුදුම හිතෙන තැන්</strong> <i class="fas fa-angle-double-right"></i></a>
              </div>
            </div><br>
            <div class="content">
              <p class="has-text-justified">
                අපි කවුරුත් දන්නා ස්ටීවන් ස්පීල්බර්ග්, එනම් ස්ටීවන් ඇලන් ස්පීල්බර්ග් උපත ලැබුවේ 1946 දෙසැම්බර් 18 දින, ඇමෙරිකා එක්සත් ජනපදයේ ඔහියෝ ප්‍රාන්තයේ සින්සිනාටි ප්‍රදේශයේයි.
              </p>
              <p class="has-text-justified">
                ඇමෙරිකානු මෝෂන් පික්චර්ස් සමාගමේ අධ්‍යක්ෂකවරයෙකු මෙන්ම නිෂ්පාදකයෙකුද වූ ඔහු අතිශය සාර්ථක හා නිර්මාණාත්මක චිත්‍රපට හොලිවුඩ් සිනමාවට දායාද කල ජනප්‍රිය පුද්ගලයෙකි. ඔහුගේ චිත්‍රපට විද්‍යා ප්‍රබන්ධ වල සිට සම්භාව්‍ය ගනයේ චිත්‍රපට දක්වා විවිධවේ. ඔහුගේ චිත්‍රපට අතරින්, ඊටී: ද එක්ස්ට්‍රා-ටෙරෙස්ට්‍රියල් (E.T.: The Extra-Terrestrial - 1982), ක්ලෝස් එන්කවුන්ටර්ස් ඔෆ් ද තර්ඩ් ක්යින්ඩ්(Close Encounters of the Third Kind - 1977) සහ විශේෂයෙන් ෂින්ඩ්ලර්ස් ලිස්ට් (Schindler’s List - 1993) සහ සේවිං ප්‍රයිවට් රයන් (Saving Private Ryan - 1998) වැනි චිත්‍රපට අතිශය සාර්ථක හා සම්මානලාභී ඒවා විය.
              </p>
              <p class="has-text-justified">
                ස්පීල්බර්ග් යොවුන් වියේදීම චිත්‍රපට නිෂ්පාදනය කෙරෙහි උනන්දුවක් දැක්වූ අතර, ඔහුගේ යෞවන වියේදී නිපදවූ මිනිත්තු 40 ක යුද චිත්‍රපටයක් වූ එස්කේප් ටු නෝවෙයාර් ( Escape to Nowhere - 1962 ) චිත්‍රපටය, චිත්‍රපට උළෙලකදී පළමු ත්‍යාගය දිනා ගත්තේය. ඔහු ඊළඟට අධ්‍යක්ෂණය කළේ ෆයර්ලයිට් ( Firelight 1964 ) නම්වූ විද්‍යා-ප්‍රබන්ධයකි, ඉන් පසුව ඇම්බ්ලින් (1968) නමින් කෙටි චිත්‍රපටයක් නිර්මාණය විය.
                ඔහුගේ අවසාන චිත්‍රපටය දුටු යුනිවර්සල් ස්ටූඩියෝස් හි විධායක නිලධාරියෙක් ස්පීල්බර්ග්ට කොන්ත්‍රාත්තුවක් ලබා දුන්නේය. ඒ අනුව ඔහු යුනිවර්සල් ස්ටූඩියෝහි රූපවාහිනී අංශයේ වැඩ කිරීමට පටන් ගත්තේ ලෝන්ග් බීච් හි කැලිෆෝනියා ප්‍රාන්ත විද්‍යාලයට (දැන් කැලිෆෝනියා ප්‍රාන්ත විශ්ව විද්‍යාලය) ඇතුලත් වීමෙන් පසුවයි. ඔහු එහිදී විවිධ රූපවාහිනී කතා මාලා අධ්‍යක්ෂණය කළේය, විශේෂයෙන් කොලම්බෝ(Columbo), මාකස් වෙල්බි(Marcus Welby), එම්.ඩී(M.D.), සහ ඕවන් මාෂල්(Owen Marshall) ඔහුගේ කතා මාලා කිහිපයක් විය.
              </p>
              <p class="has-text-justified">
                ස්පීල්බර්ග්ගේ මීළඟ චිත්‍රපටය වූ ජාවුස් (Jaws - 1975) ඔහුව ප්‍රමුඛ පෙලේ අධ්‍යක්ෂවරයකු බවට පත් කල අතර එය එතෙක් මෙතෙක් වැඩිම ආදායම් උපයාගත් චිත්‍රපටි වලින් එකකි. චිත්‍රපටයේදී හොලිවුඩ් නළු රෝයි ෂයිඩර් නිවාඩු නිකේතනයක පොලිස් ප්‍රධානියා ලෙස පෙනී සිටිමින් මිනිසුන් දඩයම් කරන සුදු මෝරෙකු ඇල්ලීමට උත්සහ කරයි. ඔහු සමඟ එක් වන්නේ සමුද්‍ර ජීව විද්‍යාඥයෙකු ලෙස රිචඩ් ඩ්‍රෙෆස් සහ මෝර දඩයම්කරුවෙකු ලෙස රොබට් ෂෝ ය. ඉහළ ප්‍රශංසාවට ලක් වූ මෙම ත්‍රාසජනක චිත්‍රපටයට හොඳම චිත්‍රපටය සඳහා ඇකඩමි සම්මානයකට නම් කෙරුනු අතර එහිදී ජෝන් විලියම්ස් විසින් රචිත සංගීත පටය ඔස්කාර් සම්මානය දිනා ගත්තේය.
              </p>
              <p class="has-text-justified">
                ස්පීල්බර්ග් පසුව ක්ලෝස් එන්කවුන්ටර්ස් ඔෆ් ද තර්ඩ් කයින්ඩ් (Close Encounters of the Third Kind - 1977) නම් ගුප්ත විද්‍යා ප්‍රබන්ධ කථාව අධ්‍යක්ෂණය කළේය. රිචඩ් ඩ්‍රෙෆස් මෙහි ප්‍රධාන චරිතය රඟපෑ අතර, එහිදී ඔහු සිය වෘත්තීය ජීවිතයේ හොඳම රංගනයක් ඉදිරිපත් කළේය. චිත්‍රපටය සඳහා ස්පීල්බර්ග් හොඳම අධ්‍යක්ෂවරයා සඳහා වන ඔහුගේ පළමු ඇකඩමි සම්මානය ලබා ගත්තේය. විශිෂ්ට සිනමාකරණය සඳහා ඔස්කාර් සම්මානය දිනාගත් අතර ස්පීල්බර්ග්ගේ විශේෂ ප්‍රයෝග අතිශය ප්‍රශංසාවට ලක් විය. ඇමෙරිකානු ඩොලර් මිලියන 100 ක දළ ආදායමක්, දෙවරක් එකපිට උපයාගත් ඉතිහාසයේ දෙවන අධ්‍යක්ෂවරයා බවට ස්පීල්බර්ග් පත්විය.
              </p>
              <p class="has-text-justified">
                අසාර්ථක චිත්‍රපටයක් වූ 1941 (1979) චිත්‍රපටයෙන් පසු ස්පීල්බර්ග් විසින් 1981 වසරේදී රයිඩර්ස් ඔෆ් ද ලොස්ට් ආර්ක් ( Raiders of the Lost Ark ) අධ්‍යක්ෂණය කරන ලදී. නළු හැරිසන් ෆෝඩ් කඩවසම් පුරාවිද්‍යා ගවේශකයෙකු ලෙස ඉන්දියානා ජෝන්ස් නමින්  මෙම චිත්‍රපටයේ රඟපෑවේය. එහිදී පොහොසත් වර්ණ සිනමාකරණය, දීප්තිමත් සංස්කරණය, මතකයේ රැඳෙන සංගීත පටි සහ නව නිපැයුම් විශේෂ ප්‍රයෝග භාවිතා කරමින් සරල නමුත් අතිශය නිර්මාණශීලි සිනමා අත්දැකීමක් නිර්මාණය කළේය. හොඳම අධ්‍යක්ෂවරයා සඳහා ස්පීල්බර්ග්ට ඔහුගේ දෙවන ඇකඩමි සම්මානය මෙම චිත්‍රපටයෙන් හිමි වූ අතර හොඳම චිත්‍රපටය සඳහාද  නාමයෝජනා විය.
              </p>
              <p class="has-text-justified">
                ස්පීල්බර්ග්ගේ ඊළඟ චිත්‍රපටය ඊටත් වඩා සාර්ථක විය. වසර 1982 දී තිරගත වූ ඊ.ටී. ද එක්ස්ට්‍රා ටෙරෙස්ට්‍රියල් ( E.T.: The Extra-Terrestrial )  චිත්‍රපටයෙන් පෘථිවියේ අතරමං වුනු පිටසක්වල ජීවියෙක් සහ එම ජීවියා හා මිතුරු වන කැලිෆෝනියා පවුලකට වන බලපෑම විග්‍රහ කෙරුණු අතර අතරමං වූ පිටසක්වලයා සොයා මිතුරු වන පිරිමි ළමයා ලෙස හෙන්රි තෝමස් ප්‍රබල රංගනයක් ඉදිරිපත් කළේය. ඩී වොලස් ඔහුගේ කාරුණික මවගේ චරිතය නිරූපණය කළේය. මෙම චිත්‍රපටයේ වයස අවුරුදු 6 ක කුඩා දරුවෙකු වූ දෘ බැරිමෝර් ඇගේ පළමු චරිත නිරූපණය කළේය. එතෙක් පැවති බොහෝ ස්පීල්බර්ග් චිත්‍රපටවල මෙන්, විශේෂ ප්‍රයෝග චිත්‍රපටයේ සාර්ථකත්වයට විශාල ලෙස හේතු විය. ස්පීල්බර්ග් සහ චිත්‍රපටය යන දෙකම ඇකඩමි සම්මාන සඳහා නම් කරන ලද අතර මෙලිසා මැතිසන්ගේ තිර රචනය, ඇලන් ඩාවියාගේ සිනමාකරණය සහ ජෝන් විලියම්ස්ගේ සංගීතය සම්මාන දින ගත්තේය.
              </p>
              <p class="has-text-justified">
                1984 දී ඉන්දියානා ජෝන්ස් ඇන්ඩ් ද ටෙම්පල් ඔෆ් ඩූම් ( Indiana Jones and the Temple of Doom ) අධ්‍යක්ෂණය කිරීමෙන් පසුව 1985 දී ස්පීල්බර්ග්, ඇලිස් වෝකර්ගේ පුලිට්සර් ත්‍යාගලාභී නවකතාව වන ද කලර් පර්පල් ( The Color Purple ) චිත්‍රපටයකට අනුවර්තනය කළේය. මෙම චිත්‍රපටයෙන් අප්‍රිකානු-ඇමරිකානු කාන්තාවකගේ දරාගත නොහැකි තරම් රළු ජීවිතය ගවේෂණය කළේය. චිත්‍රපටිය විවේචනයන්ට ලක්වුවත් රංගනයෙන් දායක වූ හූපී ගෝල්ඩ්බර්ග්, මාග්‍රට් ඇවරි සහ ඔප්රා වින්ෆ්‍රේ ද, තිර රචනය (මෙනෝ මයිජස් විසින්) සහ සංගීත නිර්මාණ(ක්වින්සි ජෝන්ස් විසිනි) ඇකඩමි සම්මාන සඳහා නම් විය. මෙම චිත්‍රපටයට හොඳම චිත්‍රපටය සඳහා නාමයෝජනා ලැබුණද, ස්පීල්බර්ග් ඔස්කාර් සම්මානයක් ලබා ගැනීම අපොහොසත් වීමට වංචනික කරුණු හේතු විය. ඒ කෙසේ වෙතත් ස්පීල්බර්ග් අප්‍රිකානු ඇමරිකානුවන්ගේ අත්දැකීම් පිළිබඳ වාණිජමය වශයෙන් සාර්ථකම චිත්‍රපට කිහිපයෙන් එකක් නිපදවීමට සමත් විය.
              </p>
              <p class="has-text-justified">
                1987 වසරේදී තිරගත වූ ඔහුගේ මීළඟ චිත්‍රපටයේ පදනම ලෙස විවේචනාත්මකව පිළිගත් තවත් පොතක් ස්පීල්බර්ග් විසින් තෝරා ගත්තේය. එය එම්පයර් ඔෆ් ද සන් ( Empire of the Sun ) නම්වූ දෙවන ලෝක සංග්‍රාමයේ සිර කඳවුරු වටපිටාව ගැන කියවුණු ජේ.ජී. බැලාර්ඩ්ගේ ස්වයං චරිතාපදාන නවකතාවයි. එහි තරුණ ප්‍රධාන චරිතයට ක්‍රිස්ටියන් බේල් රඟපෑ අතර කලර් පර්පල් තරම් සාර්ථක නොවුනු හා බොක්ස් ඔෆිස් නම්කිරීම් වල අසාර්ථක චිත්‍රපටයක් විය.
              </p>
              <p class="has-text-justified">
                ස්පීල්බර්ග් 1980 දශකය අවසන් කළේ 1989 වසරේදී තිරගත වූ ඉන්දියානා ජෝන්ස් ඇන්ඩ් ද ලාස්ට් කෘසෙඩ් (  Indiana Jones and the Last Crusade ) සහ ඕල්වේස් ( Always ) යන සිනමා නිර්මාණ වලිනි.
              </p>
              <p class="has-text-justified">
                1990 දශකයේ ස්පීල්බර්ග්ගේ ආරම්භක චිත්‍රපටය වූ හූක් ( Hook ), 1991 දී තිරගත වූ අතර එය ජේ. එම්. බැරීගේ පීටර් පෑන් නවකථාව ඇසුරින් නිර්මාණය කරන ලද චිත්‍රපටයකි. ප්‍රධාන පෙළේ හොලිවුඩ් තරු වන රොබින් විලියම්ස් සහ ජූලියා රොබට්ස් ඇතුලු නළු නිළියන් සිටියද, චිත්‍රපටය වාණිජමය වශයෙන් අසාර්ථක විය. කෙසේවෙතත්, වසර දෙකකට පසුව එනම් 1993 දී ස්පීල්බර්ග් නැවතත් අති සාර්ථක සිනෙමා නිර්මාණ දෙකක් නිර්මාණය කළේය. ඉන් පළමුවැන්න, ජුරාසික් පාක් නමින්, මයිකල් ක්‍රික්ටන්ගේ වඩාත්ම අලෙවි වූ නවකතාවේ අනුවර්තනයක් විය. එහි අනතුරුදායක දර්ශන නිර්මාණය කිරීමේදී ජාව්ස් ( Jaws ) වලට වඩා තාක්‍ෂනික ප්‍රයෝග යොදාගත් අතර ස්පීල්බර්ග්ගේ සිනෙමා ප්‍රයෝග යෙදීමේ දක්ෂතාවය මැනෙවින් පෙන්වීය.
              </p>
              <p class="has-text-justified">

              </p>
              <p class="has-text-justified">

              </p>
              <p class="has-text-justified">

              </p>
              <p class="has-text-justified">

              </p>
              <p class="has-text-justified">

              </p>

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
