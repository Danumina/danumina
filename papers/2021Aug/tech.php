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
    <title>දැනුමිණ | විදුනැණ</title>
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
                <a class="prev-article-btn " href="./culture.php"><i class="fas fa-angle-double-left"></i> <strong>සංස්කෘතිකාංග</strong></a>
              </div>
              <div class="column is-8">
                <p class="subtitle has-text-centered">අභ්‍යවකාශ සුන්බුන්</p>
              </div>
              <div class="column is-2">
                <a class="next-article-btn has-text-centered" href="./biology.php"><strong>ජෛවගෝලය</strong> <i class="fas fa-angle-double-right"></i></a>
              </div>
            </div><br>
            <div class="content">

              <div class="columns">
                <div class="column is-8">
                  <p class="has-text-justified">
                    අභ්‍යවකාශ සුන්බුන්, අති විශාල ප්‍රමාණයක් පෘථිවිය වටා වූ අභ්‍යවකාශයේ කක්ෂගතව තවදුරටත් ක්‍රියාකාරී නොවන කෘතිම ද්‍රව්‍ය කොටස් හා කැබලි ලෙස රැඳී පවතී. මේවා සියල්ලක්ම පාහේ රොකට් හා චන්ද්‍රිකා වලින් හානිවූ කොටස්ය.
                    <br><br>සුන්බුන් බොහොමයක් පෘථිවි පෘෂ්ඨයේ සිට කිලෝමීටර් 2,000 ක් (සැතපුම් 1,200) ඇතුළත පෘථිවි කක්ෂයේ පවතින අතර සමහරක් කොටස් සමකයට ඉහළින් කිලෝමීටර් 35,786 (සැතපුම් 22,236) ක් පමණ දුරින් වූ භූස්ථාපිත කක්ෂයේද සොයාගත හැකිය. වසර 2020 වන විට ඇමෙරිකා එක්සත් ජනපද අභ්‍යවකාශ නිරීක්ෂණ ජාලය, සෙන්ටිමීටර 10 (අඟල් 4) ට වඩා විශාල අභ්‍යවකාශ සුන්බුන් කැබලි 14,000 කට වැඩි ප්‍රමාණයක් නිරීක්ෂණය කර ඇත. එමෙන්ම සෙන්ටිමීටර 1 ත් 10 ත් අතර (අඟල් 0.4 ත් 4 ත් අතර) කැබලි 200,000 ක් පමණ ඇති බවත්, සෙන්ටිමීටර 1 ට වඩා කුඩා කැබලි මිලියන ගණනක් තිබිය හැකි බවත් ගණන් බලා ඇත.
                  </p>
                </div>
                <div class="column is-4">
                  <figure>
                    <img src="./images/space debris/2.jpg">
                    <figcaption>
                      ඉහල පෘථිවි කක්ෂයේ අභ්‍යවකාශ සුන්බුන් වළල්ලක් ඇතිව තිබෙන ආකාරය - පරිගණක නිර්මාණිත ඡායාරූපයකි
                    </figcaption>
                  </figure>
                </div>
              </div>

              <p class="has-text-justified">
                මෙම අභ්‍යවකාශ සුන්බුන් කැබැල්ලක් නැවත පෘථිවියට වැටීමට කොපමණ කාලයක් ගතවේද යන්න එහි උන්නතාංශය මත රඳා පවතී. සාමාන්‍යයෙන් පෘථිවි පෘෂ්ඨයේ සිට කිලෝමීටර 600 (සැතපුම් 375) ට මෙපිටින් ඇති වස්තූන් වසර කිහිපයකට පෙර කක්ෂගතවූ ඒවා වේ. කිලෝමීටර 1,000 (සැතපුම් 600) ට එපිටින් ඇති වස්තූන් සියවස් ගණනාවක් පුරා කක්ෂගතව පවතී.
              </p>

              <div class="columns">
                <div class="column is-4">
                  <figure>
                    <img src="./images/space debris/7.png">
                    <figcaption>
                      1993 මැයි 13 දියත් කළ ඇමෙරිකානු චන්ද්‍රිකාවක් අභ්‍යවකාශයේදී විනාශ වීමෙන් පසුව එහි PAM-D මොඩියුලය වසර 8ක් කක්ෂගතව පැවතී 2001 වසරේදී සවුදි අරාබියේ කාන්තාර පෙදෙසකට පතිත වුණි.
                    </figcaption>
                  </figure>
                </div>
                <div class="column is-4">
                  <figure>
                    <img src="./images/space debris/12.jpg">
                    <figcaption>
                      ඇලුමිනියම් ඔක්සයිඩ් සුන්බුන් කැබැල්ලක්, අභ්‍යවකාශයේදී රොකට් මෝටරයෙන් නිපදවෙන අතුරු එලයකි.
                    </figcaption>
                  </figure>
                </div>
                <div class="column is-4">
                  <figure>
                    <img src="./images/space debris/5.jpg">
                    <figcaption>
                      රුසියානු අභ්‍යවකාශ මධ්‍යස්ථානයක්වූ මිර්හි (Mir) සුර්ය පැනල මත සුන්බුන් ගැටීමෙන් හානි වී ඇති අයුරු
                    </figcaption>
                  </figure>
                </div>
              </div>


              <div class="columns">
                <div class="column is-9">
                  <p class="has-text-justified">
                    වස්තූන් පෘථිවිය වටා කක්ෂගත වන අධික වේගය (තත්පරයට කිලෝමීටර 8 ක් පමණ) නිසා, අභ්‍යවකාශ සුන්බුන් කුඩා කැබැල්ලක් සමඟ ගැටීමෙන් පවා අභ්‍යවකාශ යානයකට හානි විය හැකිය. නිදසුනක් ලෙස, මිලිමීටර 1 (අඟල් 0.04) ට වඩා කුඩා සුන්බුන් සමඟ ගැටීමෙන් සිදුවන හානිය නිසා අභ්‍යවකාශ ෂටලවල කවුළු බොහෝ විට ඉවත් කිරීමට කිරීමට සිදුවිය.
                  </p>
                  <p class="has-text-justified">
                    මෙලෙස අභ්‍යවකාශයේ ඇති සුන්බුන් ප්‍රමාණය වැඩිවීම අභ්‍යවකාශ ගමන්වලට ඇති බාධාව වැඩි කරයි. අභ්‍යවකාශ සුන්බුන් කැබැල්ලක් සමඟ අභ්‍යවකාශ ෂටල, යානා හා චන්ද්‍රිකා ගැටීමේ අවදානම 300 න් 1 ක් ලෙස ගණන් බල ඇත. මෙලෙස ජාත්‍යන්තර අභ්‍යවකාශ මධ්‍යස්ථානය (International Space Station) මත සුන්බුන් කැබැල්ලක් ගැටීම වළක්වා ගැනීම සඳහා එහි කක්ෂය ඉහළට ඔසවා තබන සුන්බුන් වැළැක්වීමේ විශේෂ තාක්ෂණික උපක්‍රම භාවිත කිරීමටද සිදුවී ඇත.
                  </p>


                  <p class="has-text-justified">
                    1996 ජුලි 24 වන දින, ප්‍රංශ කුඩා චන්ද්‍රිකාවක් වූ සෙරීස් (Cerise) , සුන්බුන් කැබැල්ලක් හා ගැටීම, මෙහෙයුම් චන්ද්‍රිකාවක් සහ අභ්‍යවකාශ සුන්බුන් කැබැල්ලක් අතර සිදුවූ පළමු ගැටුම විය. මෙහිදී චන්ද්‍රිකාවේ ඉහළ කොටසට හානි වූ නමුත් දිගටම ක්‍රියාත්මක විය. මෙලෙස මෙහෙයුම් චන්ද්‍රිකාවක් සම්පුර්ණයෙන් විනාශ වුණු පළමු ගැටුම 2009 පෙබරවාරි 10 වන දින උතුරු සයිබීරියාවට කි.මී. 760 ක් (සැතපුම් 470 ක්) ඉහළ අභ්‍යවකාශයේ සිදු විය. ඇමරිකානු මෝටරෝලා සමාගමට අයත් සන්නිවේදන චන්ද්‍රිකාවක් වන ඉරිඩියම් 33 (Iridium 33) සමඟ අක්‍රීයව පැවති රුසියානු හමුදා සන්නිවේදන චන්ද්‍රිකාවක් වන කොස්මොස් 2251 (Cosmos 2251) අතර සිදුවූ ගැටීමෙන් සුන්බුන් විශාල ප්‍රමාණයක් අභ්‍යවකාශයේ ඉතිරි විණි.
                  </p>

                  <p class="has-text-justified">
                    නරකම අභ්‍යවකාශ සුන්බුන් ගැටීම් අතර 2007 ජනවාරි 11 වන දින චීන හමුදාව විසින් දියත් කළ ෆෙන්ජියුන් 1 සී (Fengyun-1C) කාලගුණ චන්ද්‍රිකාව හා සම්බන්ධ මෙහෙයුමේදී සිදුවූ ප්‍රති-චන්ද්‍රිකා මිසයිලයක ගැටීමෙන් සුන්බුන් කොටස් 3,000 කට වැඩි ප්‍රමාණයක් එනම් දැනට පවතින අභ්‍යවකාශ සුන්බුන් වලින් සියයට 20 කට වැඩි ප්‍රමාණයක් නිර්මාණය කළේය. වසර දෙකක් ඇතුළත එම කොටස් චන්ද්‍රිකාව තිබු මුල් කක්ෂයෙන් විහිදී සුන්බුන් වලාකුළක් නිර්මාණය කර පෘථිවිය මුළුමනින්ම වට කර ඇති අතර එය දශක ගණනාවක් තිස්සේ වායුගෝලයට නොපැමිණ කක්ෂගතව පවතී යැයි විශ්වාස කෙරේ.
                  </p>

                  <div class="columns">
                    <div class="column is-8">
                      <figure>
                        <img src="./images/space debris/10.jpg">
                        <figcaption>
                          අභ්‍යවකාශ සුන්බුන් කාලානුරූපීව වැඩිවූ ආකාරය හා 2030 වනවිට ඇතිවේ යැයි සලකන කෙස්ලර් සින්ඩ්‍රෝමය.
                        </figcaption>
                      </figure>
                    </div>
                    <div class="column is-4">
                      <figure>
                        <img src="./images/space debris/9.jpg">
                        <figcaption>
                          සෙරීස් (Cerise) චන්ද්‍රිකාවේ ඉහළ කොටසේ සුන්බුන් කැබැල්ලක් ගැටීමේ නිරුපණය
                        </figcaption>
                      </figure>
                    </div>
                  </div>

                </div>
                <div class="column is-3">
                  <figure>
                    <img src="./images/space debris/1.jpg">
                    <figcaption>
                      චැලෙන්ජර් යානයේ (Challenger STS-7) ඉදිරිපස ජනේලයක සුන්බුන් කැබැල්ලක් වැදීමෙන් ඇතිවූ සිදුරක්.
                    </figcaption>
                  </figure>

                  <figure>
                    <img src="./images/space debris/3.jpg">
                    <figcaption>
                      එන්ඩේවර් යානයේ (Endeavour  STS-118) සුන්බුන් කැබැල්ලක් වැදීමෙන් එහි රේඩියේටරයේ ඇතිවූ සිදුරක්.
                    </figcaption>
                  </figure>

                  <figure>
                    <img src="./images/space debris/13.jpg">
                    <figcaption>
                      1958 වසරේ දියත් කල බැටරි බලයෙන් ක්‍රියා කරන වැන්ගාර්ඩ් 1(Vanguard 1) කුඩා චන්ද්‍රිකාව, අක්‍රිය වීමත් සමඟ පෘථිවි කක්ෂයේ එය වසර 240ක් පමණ පවතිනු ඇතැයි සැලකිය හැකිය.
                    </figcaption>
                  </figure>
                </div>
              </div>

              <p class="has-text-justified">
                2013 ජනවාරි 22 වන දින රුසියානු ලේසර් පරාසයේ චන්ද්‍රිකාව වන බ්ලිට්ස් (BLITS - Ball Lens In The Space) එහි කක්ෂයේ හා භ්‍රමණයෙහි සිදු වූ හදිසි වෙනසක් නිසා රුසියානු විද්‍යාඥයින් මෙහෙයුම අතහැර දැමීය. එම වෙනසට හේතුව  බ්ලිට්ස් සහ ෆෙන්ජියුන් -1 සී මෙහෙයුමෙන් ඇතිවූ සුන්බුන් අතර ගැටීමක් නිසා යැයි පසුව හෙළි විය. මෙලෙස ෆෙන්ජියුන් -1 සී, ඉරිඩියම් 33 සහ කොස්මොස් 2251 යානා වලින් ඇතිවූ ඒවා, කිලෝමීටර් 1,000 (සැතපුම් 620) කට මෙපිටින් වන සුන්බුන් වලින් අඩක් පමණ ඇති කිරීමට හේතු වී ඇත.
              </p>

              <br><h6>අභ්‍යවකාශ සුන්බුන් ඉවත් කිරීම</h6>

              <p class="has-text-justified">
                වැඩිවන අභ්‍යවකාශ සුන්බුන් සමඟ, ඒවා නැවත නැවත ගැටීමෙන් පහළ පෘථිවි කක්ෂයේ සුන්බුන් ධූමිකාවක් ඇති වී එය  භාවිතයට ගත නොහැකි වන ලෙස දූෂණය වීමත් අභ්‍යවකාශ යානා අනතුරු ඇතිවීමටත් හැකියාව, නාසා විද්‍යාඥ ඩොනල්ඩ් කෙස්ලර් පෙන්වා දීමත් සමඟ සුන්බුන් ඇතිවීම වැළැක්වීම සඳහා සහ සුන්බුන් ඉවත් කිරීමේ මෙහෙයුම් ආරම්භ විය. එහි ප්‍රථිපලයක් ලෙස 2018 වසරේදී බ්‍රිතාන්‍ය චන්ද්‍රිකාවක් වන රීමුව්ඩෙබ්රිස් (RemoveDEBRIS), ජාත්‍යන්තර අභ්‍යවකාශ මධ්‍යස්ථානය හරහා දියත් කර සාර්ථකව අත්හදා බැලීම් කරන ලදී.
              </p>

              <div class="columns">
                <div class="column is-4">
                  <figure>
                    <img src="./images/space debris/8.jpg">
                    <figcaption>
                      ක්ලීන්ස්පේස් (Cleanspace 1) මෙහෙයුම හරහා අභ්‍යවකාශ සුන්බුන් අල්ලාගෙන විනාශ කිරීමට අත්හදා බැලීම් සිදු කරමින් පවතී.
                    </figcaption>
                  </figure>
                </div>
                <div class="column is-4">
                  <figure>
                    <img src="./images/space debris/16.jpg">
                    <figcaption>
                      අභ්‍යවකාශ සුන්බුන් කොටස් වල තොරතුරු ලබා දෙන එල්ඩෙෆ් මොඩියුලය නාසා ආයතනය විසින් 1984 දී දියත් කළ මෙහෙයුමකි.
                    </figcaption>
                  </figure>
                </div>
                <div class="column is-4">
                  <figure>
                    <img src="./images/space debris/11.jpg">
                    <figcaption>
                      RemoveDEBRIS චන්ද්‍රිකා මොඩියුලය
                    </figcaption>
                  </figure>
                </div>
              </div>

              <div class="columns">
                <div class="column is-5">
                  <figure>
                    <img src="./images/space debris/14.jpg">
                    <figcaption>
                      RemoveDEBRIS මෙහෙයුමේදී දැල් මගින් සුන්බුන් අල්ලාගන්නා ආකාරය නිරූපණයකි.
                    </figcaption>
                  </figure>
                </div>
                <div class="column is-4">
                  <figure>
                    <img src="./images/space debris/15.jpg">
                    <figcaption>
                      RemoveDEBRIS මොඩියුලය තුල දැල් විදිනය රඳවා ඇති ආකාරය
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
