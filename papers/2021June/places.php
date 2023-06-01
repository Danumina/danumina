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
    <title>දැනුමිණ | පුදුම හිතෙන තැන්</title>
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
                <a class="prev-article-btn " href="./biography.php"><i class="fas fa-angle-double-left"></i> <strong>ප්‍රකට චරිත</strong></a>
              </div>
              <div class="column is-8">
                <p class="subtitle has-text-centered">ඉන්කාවරුන්ගේ නැතිවුණු නගරය, මාචු පික්චු  -  පළමු කොටස </p>
              </div>
              <div class="column is-2">
                <a class="next-article-btn has-text-centered" href="./country.php"><strong>රටක වතගොත</strong> <i class="fas fa-angle-double-right"></i></a>
              </div>
            </div><br>
            <div class="content">
              <figure>
                  <img src="./images/Machu Picchu/1.jpg">
                  <figcaption>
                    හුආයිනා කඳු මුදුනේ සිට ගත් මාචු පික්චුහි පැනරොමික් ඡායාරූපයක්.
                  </figcaption>
              </figure>
              <p class="has-text-justified">
                පේරු රාජ්‍යයේ කුස්කෝ නගරයට සැතපුම් 50ක්(කි.මී 80ක්) වයඹ දෙසින් අන්දීස් කඳුකරයේ කෝර්ඩිලෙරා ඩි විල්කබාම්බා ප්‍රදේශයේ පුරාණ ඉන්කා නගරය මාචු පික්චු පිහිටා ඇත. උරුබම්බා ගංගා නිම්නයට ඉහළින් “පරණ කඳු මුදුන” හා හුආනා පික්චු නමින් කියැවෙන “නව කඳු මුදුන”  අතර මුහුදු මට්ටමේ සිට අඩි 7,710(මීටර් 2,350)ක් උසින් පිහිටි මාචු පික්චු පුර්ව කොලොම්බියානු නටබුන් ස්ථාන වලින් එකක් ලෙස නොනැසී පවතින අතර 1983 දී යුනෙස්කෝ ලෝක උරුම අඩවියක් ලෙස නම් කරන ලදී.
              </p>
              <p class="has-text-justified">
                1867 ජර්මානු ජාතික සංචාරකයෙකු වූ ඔගස්ටෝ බර්න්ස් විසින් සංචාරය කල බවට සාක්ෂි ඇතත් 1911 දී යේල් විශ්ව විද්‍යාලයේ මහාචාර්ය හිරාම් බිංහැම් විසින් සොයා ගන්නා තෙක් මාචු පික්චු තිබෙන බව හෝ බටහිර රටවල් දැන සිටියේ නැත. ඉන්කා ශිෂ්ටාචාරය සම්බන්දව පර්යේෂණ පවත්වමින්,  අවසාන ඉන්කා පාලකයන් ස්පාඤ්ඤ පාලනයට එරෙහිව 1572 වනතෙක් ගෙනගිය කැරලි වලින් පසුව නැතිවූ ඉන්කාවරුන්ගේ නගරය වන විල්කාබම්බා (විල්කාපම්පා) නගරය සොයමින් සිටි මහාචාර්ය බිංහැම්ට ක්වෙචුවා භාෂාව කතා කරන එම ප්‍රදේශයේ පදිංචිකරුවෙකු වන මෙල්චෝර් ආර්ටෙගා විසින් මාචු පික්චු නටබුන් පෙන්වන ලදී.
              </p>

              <div class="columns">
                <div class="column is-3">
                  <figure>
                      <img src="./images/Machu Picchu/3.jpg">
                      <figcaption>
                        ආචාර්ය හිරාම් බින්හැම් 1912 දී මාචු පික්චු ප්‍රදේශයේ කැණීම් කරන අතරතුර ඔහුගේ ටෙන්ට් දොර ඉදිරිපිට.
                      </figcaption>
                  </figure>
                </div>
                <div class="column is-9">
                  <p class="has-text-justified">
                    1912දී යේල් විශ්ව විද්‍යාලයේ  සහ ජාතික භූගෝලීය සංගමයේ අනුග්‍රහයෙන් කරන ලද කැණීම්වලින් ලැබුනු සාක්ෂි වලින් පසුව මහාචාර්ය බිංහැම් විසින් මාචු පික්චු ඉන්කාවරුන්ගේ නැතිවුනු නගරය විල්කාබම්බා ලෙස නම්කලත් එස්පිරිටු පම්පා නම්වූ ඉන්කාවරුන්ගේ නටබුන් ස්ථානයක් ගවේෂණයත් සමග එය වැරදි සහගත නම් කිරීමක් ලෙස තහවුරු විය.1964 දී එස්පරිටු පම්පා ප්‍රදේශය ඇමරිකානු ගවේෂක ජීන් සැවෝයිගේ මඟ පෙන්වීම යටතේ කරන ලද පුළුල් කැණීම් මගින් ඉන්කා නිවාස 300 ක් සහ තවත් ගොඩනැගිලි 50 ක් හෝ ඊට වැඩි ප්‍රමාණයක් සහ ගොවිතැන් කිරීමට ගොඩනගන ලදැයි සැලකෙන විශාල ටෙරසයන් සොයාගනු ලැබීමෙන් එස්පරිටු පම්පා වඩා විශාල ජනාවාසයක් බව ඔප්පු විය..
                  </p>
                  <p class="has-text-justified">
                    1915දී බිංග්හැම් විසින් ද, 1934 දී පේරු පුරාවිද්‍යා ගවේෂක ලුයිස් ඊ. වල්කාර්සෙල් විසින් ද, 1940–41 දී පෝල් ෆෙජොස් විසින් ද
                    කරන ලද වැඩිදුර කැණීම් වලින් ලද අතිරේක සොයාගැනීම් වලින් පෙනීගියේ පුරාණ මාචු පික්චු නගරය ඉන්කා බලකොටු පුරයන්ගෙන් එකක් බවයි. එය, සංචාරකයින්ගේ බැරැක්ක හෝ තානායම් සහ සෙබළුන්ට වේගයෙන් ගමන්කල හැකි සංඥා කුළුණු දෙපස ඇති පා අධිවේගී මාර්ග වලින් සමන්විත එකක් බව අනාවරණය විය.
                  </p>
                  <p class="has-text-justified">
                    බොහෝ පුරාවිද්‍යාඥයන් විශ්වාස කරන ආකාරයට මාචු පික්චු, ඉන්කා අධිරාජ්‍යයෙකු වන පචකුටි (Pachacuti ක්‍රිව 1438 - 1472)  විසින් ක්‍රිව 1450දී පමණ ඉදිකර ඉන් සියවසකට පසුව ස්පාඤ්ඤ ආක්‍රමණ නිසා අතහැර දැමුණු එකක් බවයි. එය එසේ වුවත් 1911දී මහාචාර්ය බිංහැම් විසින් සොයාගන්නා තෙක් ස්පාඤ්ඤ ආක්‍රමණිකයින් පවා නොදැන සැගවී තිබී ඇති බවට විශ්වාස කරයි.
                  </p>
                </div>
              </div>

              <p class="has-text-justified">
                සම්භාව්‍ය ඉන්කා ශෛලියේ ඔප දැමූ වියළි ගල් බිත්ති වලින් නිමවා ඇති එහි මූලික ව්‍යුහයන් තුන වන්නේ ඉන්ටිහුටානා, සූර්ය දේවාලය සහ ජනෙල් තුනේ කාමරයයි. මේවයින්, ඉන්ටිහුටනා ගලින් නිමකරන ලද පුරාණ ඉන්කාවරුන්ගේ තාරකා විද්‍යාත්මක ඔරලෝසුවක් හෝ දින දර්ශනයක් වන අතර ආගමික ඇදහිලි සදහාද භාවිත කර ඇත.
              </p>

              <br><div class="columns">
                <div class="column is-9">
                  <h6>මාචු පික්චු ඉතිහාසය</h6>

                  <p class="has-text-justified">
                    ඉතිහාසඥ රිචඩ් එල්. බර්ගර් විසින් සදහන් කරන ආකාරයට මාචු පික්චු ක්‍රිව 1450දී පමණ ඉදිකරන ලද බවත් ශ්‍රේෂ්ඨ ඉන්කා පාලකයින් දෙදෙනෙකු වන පචකුටි(1438–1471) සහ ටෙපාක්(1472–1493) අතර කාලයේ මෙහි ඉදිකිරීම් පැවති බව කියවේ. සාර්ථක යුධ සංග්‍රාමයකින් පසුව පචකුටි අධිරාජ්‍යයා විසින් තමාටම රාජකීය නගරයක් ඉදිකිරීමට නියෝග දුන් බවත්,
                    ඉන්කා අධිරාජ්‍යයේ අනෙකුත් ප්‍රදේශවල ඇතිවූ ආක්‍රමණ නිසා සියවසක පමණ කාලයකට පසුව මාචු පික්චු අතහැර දැමීමට හේතු වූ බවත් සංචාරකයින් ගෙන ආ වසුරිය රෝගයෙන් මාචු පික්චු වැසියන් බොහොමයක් මිය ගිය බවද විශ්වාස කරයි.
                  </p>

                  <br><h6>මාචු පික්චු වැසියන්ගේ ජීවන රටාව</h6>

                  <p class="has-text-justified">
                    මාචු පික්චු රාජකීය නගරය ලෙස භාවිතා කරන අතරතුර, මිනිසුන් 750 ක් පමණ එහි වාසය කළ බවට ගණන් බලා ඇති අතර, බොහෝ දෙනා එහි ස්ථිරව වාසය කළ සහායක කාර්ය මණ්ඩලයට අයත් විය. එවැනිම තාවකාලිකව වාසය කල ආගමික පුජකයින් සහ විවිද වැඩෙහි නිපුණයින්ගෙන් සමන්විත කාර්ය මණ්ඩලයක් පචකුටි අධිරාජ්‍යයාගේ යහපැවැත්ම සහ විනෝදය වෙනුවෙන් සේවා සැලසීමට සිටි බවට සාක්ෂි ඇත.
                  </p>

                </div>
                <div class="column is-3">
                  <figure>
                      <img src="./images/Machu Picchu/5.jpg">
                      <figcaption>
                        පචකුටි අධිරාජ්‍යයා - 17 වන සියවසේ අඳින ලද සිතුවමකි
                      </figcaption>
                  </figure>
                </div>
              </div>

              <p class="has-text-justified">
                මාචු පික්චුහි විසු වැසියන්ගේ ඇටසැකිලි අධ්‍යයනවලින් පෙනී ගිය ආකාරයට එහි ජීවත් වූ බොහෝ දෙනා විවිධ පසුබිම්වලින් පැමිණි සංක්‍රමණිකයන්ය. ඔවුන්ගේ මුළු ජීවිත කාලයම එහි වාසය කර ඇත්නම් ඔවුන්ට තිබිය යුතු රසායනික සලකුණු සහ අස්ථිමය සලකුණු තිබිය යුතුය. එහෙත් එසේ නොතිබුණි. හමුවූ බොහොමයක් ඇටසැකිලි වල කරන ලද පර්යේෂණ වලින් හෙළි වුයේ එහි  වැසියන්ගේ දිගු කාලීන ආහාර වේල බඩ ඉරිඟු, අර්තාපල්, ධාන්‍ය වර්ග, රනිල කුලයට අයත් බෝග සහ මාළු වලින් සමන්විත වුනු බව සහ ඔවුන්ගේ කෙටි කාලීන ආහාර වේල වැඩිවශයෙන් බඩ ඉරිඟු හා මාළු වලින් සමන්විත වුනු බවයි.ඉන් නිගමනය වුණේ මාචු පික්චු වැසියන් බොහොමයක් දෙනා වෙරළබඩ ප්‍රදේශ වල සිට පැමිණි සංක්‍රමිකයින් බවයි.
              </p>

              <p class="has-text-justified">
                එමෙන්ම ඉන්කා අධිරාජ්‍යයේ අනෙකුත් ප්‍රදේශවල වැසියන්ගේ අස්ථි කොටස් වල දක්නට ලැබෙන ආතරයිටිස් තත්ත්ව හා අස්ථි බිඳීම් වලට වඩා මාචු පික්චු වලින් හමුවූ අස්ථි කොටස්වල ඒවා අඩු මට්ටමක පැවතුනි. සාමාන්‍යයෙන් අධික ශාරීරික වෙහෙසක් දරන කම්කරුවන් හා සෙබළුන්ගේ මෙම අස්ථි බිඳීම් වැඩියෙන් තිබුනත් මාචු පික්චු වැසියන්ගේ මේවා අඩුවෙන් පැවතුනේ ඔවුන් සංක්‍රමිකයින් වූ නිසාය.
              </p>

              <div class="columns">
                <div class="column is-6">
                  <figure>
                    <img src="./images/Machu Picchu/6.jpg">
                    <figcaption>
                      ලාමා සතෙක් - මාචු පික්චු නටබුන් පසුබිමින් පෙනේ.
                    </figcaption>
                  </figure>
                </div>
                <div class="column is-6">
                  <figure>
                    <img src="./images/Machu Picchu/10.jpg">
                    <figcaption>
                      මාචු පික්චු නටබුන් මත හිඳින ඇල්පකා පැටවෙක්.
                    </figcaption>
                  </figure>
                </div>
              </div>
              <p class="has-text-justified">
                මාචු පික්චු වැසියන් මෙන්ම එහි සිටි සතුන්ද සංක්‍රමික විශේෂ ලෙස හදුනාගෙන ඇත. ඔටු විශේෂ වන ලාමා සතුන් සහ ඇල්පකා සතුන් මස් පිණිස, ලෝම ලබාගැනීමට සහ ප්‍රවාහන කටයුතු වලට යොදාගෙන ඇත. ඔවුන් මධ්‍යම අන්දියානු පුනා ප්‍රදේශයෙන් ගෙන එන්නට ඇතිබව සැලකේ. එමෙන්ම ගිනියා පිග් නම් කුඩා සතුන් මාචු පික්චු වල සුසාන භුමි වල ඇති ගුහාවලින් හමුවීමෙන් උන් අවමංගල්‍ය කටයුතු වලට යොදාගෙන ඇති බව කියවේ. මියගිය අයගේ සිරුරු අසලින් සුනඛ ඇටසැකිලි හමුවී ඇති නිසා අතීත ඉන්කාවරුන්ගේත් ලගම හිතවතුන් සුනඛයින් බව පිළිගත හැකිය.
              </p>

              <br><h6>කෘෂිකර්මය</h6>

              <p class="has-text-justified">
                මචු පික්චු හි ගොවිතැනෙන් වැඩි ප්‍රමාණයක් සිදු කරනු ලැබුවේ එහි වැසියන් විසින් සාදන ලද ටෙරසයන් සිය ගණනක් මතය. මෙම ටෙරස් සැලකිය යුතු ඉංජිනේරු වැඩක් වන අතර එය හොඳ ජලාපවහනය සහ පාංශු සාරවත් බව සහතික කිරීම සඳහා ඉදිකරන ලද අතර කන්ද ඛාදනය වීම් හා නායයෑම් වලින් ආරක්ෂා කර ඇත.
              </p>
              <p class="has-text-justified">
                ක්‍රි.ව. 1450 සිට මෙම භූමිය අවට ප්‍රදේශයට වසරකට මිලිමීටර් 1,800 (අඟල් 71) කට වඩා වැඩි වර්ෂාපතනයක් ලැබී ඇති බවට ගණන් බලා ඇත. මාචු පික්චු හි විශාල වර්ෂාපතනයක් ඇති බැවින් ටෙරස් සඳහා වාරිමාර්ග අවශ්‍ය නොවන බව පසුව සොයා ගන්නා ලදී. ටෙරස් වලට විශාල වර්ෂාවක් ලැබුණු නිසා ඉන්කාන් ඉංජිනේරුවන් විසින් ඒවා ඉදිකරන ලද්දේ අමතර ජලය ප්‍රමාණවත් ලෙස බැහැර කිරීමට ඉඩ සලසමිනි. 1990 ගණන්වල පුරාවිද්‍යා ගවේෂක කෙනත් රයිට් විසින් කරන ලද කැණීම් හා පාංශු විශ්ලේෂණයන්ගෙන් පෙන්නුම් කළේ එම ටෙරසයන් ස්ථර කිහිපයක් ලෙස සාදා ඇති බවයි. වැලි සහ බොරළු මිශ්‍ර තට්ටුවක් එකට ඇසුරුම් කර ඊටත් යටින් ගල් ස්තරයක් තබා ඒ සියල්ල ආවරණය වන පරිදි සාරවත් මතුපිට පස්  ස්තරයක් තබා ඇත. කඳු මුදුනෙහි ඇති පස්වලට වඩා සාරවත් නිසා ගංගා නිම්නයේ පස් ටෙරස් වෙත ගෙන ගොස් මතුපිට පස් ස්තරය සකසා ඇත.
              </p>

              <div class="columns">
                <div class="column is-4">
                  <figure>
                      <img src="./images/Machu Picchu/7.jpg" height="200">
                      <figcaption>
                        ඉහළ කෘෂිකාර්මික පෙදෙසේ ටෙරසයන්.
                      </figcaption>
                  </figure>
                </div>
                <div class="column is-4">
                  <figure>
                      <img src="./images/Machu Picchu/8.jpg" height="200">
                      <figcaption>
                        ගොවිතැන් කිරීමට ඉදිකරන ලද විශාල ටෙරස් සමුහයක්.
                      </figcaption>
                  </figure>
                </div>
                <div class="column is-4">
                  <figure>
                      <img src="./images/Machu Picchu/9.jpg" height="200">
                      <figcaption>
                        මාචු පික්චු නිවාස හා ටෙරස් සමුහය.
                      </figcaption>
                  </figure>
                </div>

              </div>
              <p class="has-text-justified">
                කෙසේ වෙතත්, ටෙරස් ගොවිතැන් බිම් ප්‍රමාණය හෙක්ටයාර 4.9 (අක්කර 12) ක් පමණ වන බව සොයාගෙන ඇති අතර, ටෙරස් අවට පස අධ්‍යයනය කිරීමෙන් පෙනී ගියේ එහි වගා කර ඇති දේ වැඩිපුරම ඉරිඟු සහ අර්තාපල් වන බවත් එය මාචු පික්චු හි වෙසෙන 750කට වැඩි ජනතාවට ප්‍රමාණවත් නොවන නිසා, ආහාර අවට නිම්න වලින් හා දුර බැහැර ප්‍රදේශවලින් ආනයනය කර ඇති බව හෙළි විය.
              </p>

              <br><h6>මාචු පික්චු හමුවීම සහ ඇමෙරිකානු ගවේෂණ පිළිබඳ විස්තර මීළඟ කලාපයෙන් බලාපොරොත්තු වන්න.</h6>

              <!-- <p class="has-text-justified">
                මාචු පික්චු පිහිටා තිබුණේ කුස්කෝ හි ඉන්කා අගනුවර සිට කිලෝමීටර් 80 ක් (සැතපුම් 50 ක්) දුරින් වුවද, ස්පාඤ්ඤ ජාතිකයන් එය කිසි විටෙකත් සොයා නොගත් අතර වෙනත් බොහෝ  ප්‍රදේශ වලට ඔවුන් කල ආකාරයට එය කොල්ලකෑමට හෝ විනාශ කිරීමට සමත් නොවුනි.
              </p>
              <p class="has-text-justified">
                ශතවර්ෂ ගණනාවක් පුරා, අවට වනාන්තරය භූමිය අභිබවා ගිය අතර, එය තිබෙන බවට ආසන්න ප්‍රදේශයෙන් පිටත ස්වල්ප දෙනෙක් පමණක් දැන සිට ඇත. 1867 දී ඔගස්ටෝ බර්න්ස් නම් ජර්මානු ජාතිකයා මාචු පික්චු ගවේෂණය කර ඇති බවත් සමහර සාක්ෂි වලට අනුව ජර්මානු ඉංජිනේරු ජේ. එම්. වොන් හැසෙල් මීට පෙර මෙහි ගොස් ඇති බවටත් 1874ට පෙර සිතියම්වල  මාචු පික්චු සටහන්ව තිබීමෙන් පෙනී යයි.
              </p>
              <p class="has-text-justified">
                1911 දී ඇමරිකානු ඉතිහාසඥයෙකු හා ගවේෂකයෙකු වූ හීරාම් බිංහැම් පැරණි ඉන්කා අගනුවර සොයමින් කලාපය පුරා සංචාරය කළ අතර මෙල්චෝර් ආර්ටෙගා නම් ගම්වැසියෙකු විසින් ඔහුව මචු පික්චු වෙත ගෙන ගොස් ඇත. බිංහැම්ගේ එම සංචාරයේදී ඔගස්ටින් ලිසරාගා යන නම සහ 1902 වසරේ දිනයක් අඟුරු වලින් මාචු පික්චුහි බිත්තියක ලියා තිබී හමුවී ඇත. එනිසා එහි නටබුන් ප්‍රථම වරට සොයාගත්තේ බිංග්හැම් නොවූවත්, මාචු පික්චු ජාත්‍යන්තර අවධානයට යොමු කළ විද්‍යාත්මක සොයාගැනීම්කරු ලෙස ඔහු සලකනු ලබයි. ඉන්පසුව ප්‍රධාන පර්යේෂණ හා කැණීම් කටයුතු සඳහා බිංග්හැම් 1912 දී තවත් ගවේෂණයක් සංවිධානය කළේය.
              </p>
              <p class="has-text-justified">
                1981 දී පේරුහි මාචු පික්චූ අවට වර්ග කිලෝමීටර් 325.92 (වර්ග සැතපුම් 125.84) ක භූමි ප්‍රදේශයක් “ඓතිහාසික අභයභූමියක්” ලෙස ප්‍රකාශයට පත් විය. එහි නටබුන් වලට අමතරව, අභය භූමියට යාබද කලාපයේ විශාල කොටසක් ඇතුළත් වන අතර, එම කලාපය පේරු යුන්ගාස් සහ මධ්‍යම අන්දියානු තෙත් පූනා පරිසර කලාපවල ශාක හා සත්ත්ව විශේෂ විශාල ප්‍රමාණයකින් පොහොසත්ය.
              </p>
              <p class="has-text-justified">
                1983 දී යුනෙස්කෝව විසින් මාචු පික්චු ලෝක උරුමයක් ලෙස නම් කරන ලද අතර එය “ඉන්කා ශිෂ්ටාචාරයට සහ එහි ගෘහ නිර්මාණ ශිල්පයේ සුවිශේෂී සාක්ෂියක්” ලෙස විස්තර කරන ලදී. පසුව, 2007දී මාචු පික්චු නව ලෝක පුදුමවලින් එකක් ලෙස නම් විය.
              </p>
              <div class="columns">
                <div class="column is-3"></div>
                <div class="column is-6">
                <figure>
                    <img src="./images/Machu Picchu/11.jpg" height="200">
                    <figcaption>
                      ප්‍රතිසංස්කරණ කටයුතු ආරම්භ කිරීමට පෙර පිරිසිදු කිරීමෙන් පසුව 1912 දී හිරාම් බිංහැම් විසින් ගන්නා ලද මාචු පික්චුහි ඡායාරූපයක්.
                    </figcaption>
                </figure>
                </div>
                <div class="column is-3"></div>
              </div> -->

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
