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
    <title>දැනුමිණ | සංස්කෘතිකාංග</title>
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
                <a class="prev-article-btn " href="./history.php"><i class="fas fa-angle-double-left"></i> <strong>ලෝක ඉතිහාසය</strong></a>
              </div>
              <div class="column is-8">
                <p class="subtitle has-text-centered">තායි ජල සැණකෙළිය - සොන්ක්රාන්</p>
              </div>
              <div class="column is-2">
                <a class="next-article-btn has-text-centered" href="./tech.php"><strong>විදුනැණ</strong> <i class="fas fa-angle-double-right"></i></a>
              </div>
            </div><br>
            <div class="content">
              <div class="columns">
                <div class="column is-3">
                  <figure>
                    <img src="./images/Songkran/1.jpg">
                    <img src="./images/Songkran/1b.jpg">
                    <figcaption>
                      සුන්දර තායි යුවතියක් සොන්ක්රාන් කුමරිය ලෙස ගමන් කරන සොන්ක්රාන් පෙරහැරක් - බැංකොක්
                    </figcaption>
                  </figure>
                </div>
                <div class="column is-9">
                  <p class="has-text-justified">
                    සොන්ක්රාන් සාම්ප්‍රදායික තායිලන්ත අලුත් අවුරුදු දිනයයි. සෑම වසරකම අප්‍රේල් 13 වන දින මෙම උත්සවය සැමරුවත් නිවාඩු කාලය අප්‍රේල් 14,15 දක්වා පවතී. රටේ පුරවැසියන්ට නිවාඩුව සඳහා නිවෙස් බලා යාමට අවස්ථාව ලබා දීම සඳහා 2018 දී තායි රජය විසින් රට පුරා උත්සවය දින පහක් එනම් අප්‍රේල් 12-16 දක්වා දීර්ඝ කරන ලදී.
                  </p>
                  <p class="has-text-justified">
                    බෞද්ධ දින දර්ශනයට අනුකූලව දකුණු හා ගිනිකොනදිග ආසියාවේ බොහෝ රටවල දින දර්ශනවල නව වසර එකම දිනවල යෙදේ. ශ්‍රී ලංකාව ,චීනය (යුනාන් පළාතේ ඩයි ජනතාව), ලාඕසය, මියන්මාරය, කාම්බෝජය, නේපාලය, ඉන්දියාව සහ බංග්ලාදේශය වැනි දකුණු ආසියාවේ බොහෝ රටවල අලුත් අවුරුදු සැමරුම්වලට සමගාමීව නව වසර සමරනු ලබයි.
                  </p>
                  <p class="has-text-justified">
                    තායිලන්තයේ, අලුත් අවුරුද්ද ජනවාරි 1 වන දින නිල වශයෙන් සමරනු ලබයි. 1888 වසරේ සිට ස්ථාවර දිනයකට මාරු වන තෙක් සොන්ක්රාන් දිනය නිල අලුත් අවුරුද්ද ලෙස සමරන ලද අතර 1940 දී මෙම දිනය ජනවාරි 1 ලෙස වෙනස් කරන ලදී. එතැන් පටන් සාම්ප්‍රදායික තායි අලුත් අවුරුද්ද ලෙස සොන්ක්රාන් දිනය(අප්‍රේල් 13) ජාතික නිවාඩු දිනයක් බවට පරිවර්තනය විය.
                  </p>

                  <div class="columns">
                    <div class="column">
                      <p class="has-text-justified">
                        සොන්ක්රාන් යනු සංස්කෘත සංක්‍රාන්ති යන වචනයෙන් ව්‍යුත්පන්න වූ වචනයක් වන අතර එහි අර්ථය 'එක තැනක සිට තවත් තැනකට චලනය වීම' යන්නයි. මෙහිදී එය රාශි චක්‍රයේ එක් ස්ථානයක සිට තවත් ස්ථානයකට සූර්යයා ගමන් කිරීමෙන් සිදුවේ. මෙම සංක්‍රාන්තීන් සෑම මසකම සිදු වුවත්, තායි ජාතිකයන් සොන්ක්රාන් ලෙස හඳුන්වන කාල පරිච්ඡේදය සිදුවන්නේ සූර්යයා රාශි චක්‍රයේ මීන රාශියේ සිට මේෂ දක්වා ගමන් කරන විටය.
                      </p>
                    </div>
                    <div class="column">
                      <figure>
                        <img src="./images/Songkran/6.jpg">
                        <figcaption>
                          සම්ප්‍රදායික තායි නැට්ටුවන් කණ්ඩායමක්
                        </figcaption>
                      </figure>
                    </div>
                  </div>

                </div>
              </div>

              <p class="has-text-justified">
                මෙම කාලය අලුත් අවුරුදු පැමිණීම සමග සමපාත වන නිසා මහා සොන්ක්රාන් (great songkran) ලෙස ඔවුන් හදුන්වයි. එබැවින් සොන්ක්රාන් උත්සවය සූර්ය දින දර්ශනයට අනුකූලව අලුත් අවුරුදු සැමරුමකි. දින තුනක කාලයක් පුරා පවතින මෙම සැමරුම රාශි චක්‍රයේ සූර්යයා මේෂ රාශිය වෙත ගමන් කරන දිනය හෝ පැරණි වසරේ අවසාන දිනය වන අප්‍රේල් 13 මහා සොන්ක්රාන් ලෙස සලකනු ලැබේ. ඊළඟ දවසේ එනම් පැරණි හා නව වසර අතර සංක්‍රාන්ති දිනය, අප්‍රේල් 14, වන් නාඕ(Wan Nao) ලෙසත්, අප්‍රේල් 15 දිනය වන් තාලොං සොක්(Wan Thaloeng Sok) එනම් තායි නව වසරක් ආරම්භ වන අලුත් අවුරුදු දිනය ලෙසද හැඳින්වේ.
              </p>
              <p class="has-text-justified">
                අතීත තායි ක්‍රමයට අනුව දේශීය හෝ රාජකීය ජ්‍යෝතිෂ වේදීන්,සොන්ක්රාන් සමරන දින දෙක අතර කාලය තුල කරන නිරීක්ෂණ අනුව රටේ ආර්ථිකය, කෘෂිකර්මාන්තය, වර්ෂාපතනය සහ දේශපාලන කටයුතු පිළිබඳ අනාවැකි පළ කරති. රජු හෝ ඔහු වෙනුවෙන් ප්‍රධාන රාජකීය ජ්‍යෝතිෂ වේදියා නව වසර පිළිබඳ නිල නිවේදනයක් මහජනයාට නිකුත් කරයි. ප්‍රකාත් සොන්ක්රාන් (සොන්ක්‍රාන් දැනුම්දීම) යනුවෙන් හැඳින්වෙන මෙම නිවේදනයේ මහා සොන්ක්‍රාන්, තාලොන්ග්සොක්, ලුනිසෝලර් දින දර්ශනය සහ ආගමික හා රාජකීය උත්සව පිළිබඳ තොරතුරු අඩංගු වේ. රජය මෙම නිවේදනය පිළිපදින අතර, රාජකීය ජ්‍යෝතිෂ වේදීයා විසින් කරන ලද ගණනය කිරීම් අනුව උත්සව කිහිපයක් සංවිධානය කරයි.
              </p>
              <p class="has-text-justified">
                වර්තමානයේ රාජකීය මාළිගාව සොන්ක්රාන් නිවේදනය නිකුත් කිරීම අලුත් අවුරුදු දිනයේ කුඩා දින දර්ශන පොත් පිංචක් මහජනයාට ලබා දෙයි. රජයේ බැංකු එක් පිටුවක චන්ද්‍ර දින දර්ශනයක් මුද්‍රණය කර ලබා දෙයි. චීන රාශි චක්‍රයේ කියවෙන සොන්ක්රාන් දේවතාවියගේ වාහනය සහ යටත් නිලධාරීන් සමඟ රූප සටහන මෙම දින දර්ශනයේ දැක්වේ. නිවැරදි සොන්ක්රාන් දිනය සහ ආගමික දින පිළිබඳ සවිස්තර තොරතුරු ද එහි අඩංගු වේ. සමහර ජ්‍යෝතිෂ වේදීන් යින්, විශේෂයෙන් උතුරු තායිලන්තයේ, අනාවැකි සහ වෙනත් තොරතුරු අඩංගු ඔවුන්ගේම සොන්ක්රාන් නිවේදනය අතීතයේ ලෙසටම තවමත් නිකුත් කරති.
              </p>


              <br><h6>ආරම්භය හා සම්බන්ධ ඉතිහාසය</h6>
              <p class="has-text-justified">
                වට් ෆෝහි බෞද්ධ ග්‍රන්ථ වලට අනුව, සොන්ක්රාන් ආරම්භ වූයේ කපිල බ්‍රහ්මගේ මරණයෙන් පසුවයි.කපිල බ්‍රහ්ම බුදුදහමේ එන බ්‍රහ්ම සහම්පති වරයායි.
                සොන්ක්රාන් ආරම්භය පිළිබද කතාවට අනුව අතීතයේ දී ධනවත් මිනිසෙකු සිටි අතර ඔහුගේ අසල්වැසියා බේබද්දෙකු විය. පුතුන් දෙදෙනෙකු සිටි බේබදු පුද්ගලයා දරුවන් නොමැති ධනවතාව පහත් කොට සැලකුවේය. ධනවතා අවමානයට ලක් වූ අතර ඔහු තමන්ට පුතෙකු ලබා දෙන ලෙස සූර්යයා සහ සඳ දෙවිවරුන්ගෙන් අයැද සිටියේය. රූස්ස ගසක වාසය කරන ගස් දෙවියන්ට පිසූ බත් පූජා කර පසු ඔහුගේ උත්සාහය සාර්ථක විය. මිනිසාගේ පැතුම ලබා දෙන ලෙස ගස් දෙවියා ඉන්ද්‍රා දෙවියන්ගෙන් ඉල්ලා සිටියේය. ඒ අනුව ඔහුට පුතෙකු ලැබුණු අතර 'ධර්මිෂ්ටකම ආරක්ෂා කරන තැනැත්තෙක්' නම් තේරුම සහිතව තම්බාල් (ධම්මපාල) යන නම තැබීය.
              </p>
              <p class="has-text-justified">
                තමබාල් දක්ෂ දරුවෙක් වූ අතර, ඔහු ත්‍රිවේදය, කුරුලු භාෂාව ඉගෙන ගත් අතර පාපයෙන් වැළකී සිටීමට මිනිසුන්ට ඉගැන්වීම් සිදු කළේය. කපිල බ්‍රහ්ම දරුවා ගැන දැනගත් අතර දරුවාගේ දක්ෂතාවය පරීක්ෂා කිරීමට ඔහුට අවශ්‍ය විය. දෙවියන් වහන්සේ ඇසුවේ, “උදේ දහවල් හා සවස තුන් වරුවේ මිනිසුන්ගේ මහිමය තිබෙන්නේ කොහේද?" යන ප්‍රශ්නයයි. විසඳුමක් නොදෙන්නේ නම් හිස කපා දැමීමට සිදු වන බවට අණ කරේය.
              </p>
              <p class="has-text-justified">
                තම්බාල් දින හයක් තිස්සේ කල්පනා කලත්, ප්‍රශ්නයට පිළිතුරක් සොයා ගැනීමට නොහැකි විය. ඔහු තල් ගසක් යට වැතිර සිටින අතර රාජාලීන් දෙදෙනෙක් අතර සංවාදයක් ඇසුනි. "ඔයා හෙට මොනවද කන්න යන්නේ?", ගැහැණු කුරුල්ලා කීවාය. "දෙවියන්ගේ ප්‍රශ්නයට පිළිතුරු නොදී මරණයට පත්වන තම්බාල්ගේ සිරුර ආහාරයට ගමු" කියා පිරිමි කුරුල්ලා පිළිතුරු දුන්නේය.
                ගැහැණු රාජාලියා තම සහකරුගෙන් ඇසුවේ ඔහු පිළිතුර දන්නවාද යන්නයි. ඔහු පිළිතුරු දෙමින්, "උදේට, ශ්‍රී(මහිමය) මුහුණ මත පැමිණේ, එබැවින් මිනිසුන් සෑම උදෑසනකම ඔවුන්ගේ මුහුණු සෝදා ගනී. දහවල් වන විට, ශ්‍රී පපුවේ වාඩි වී සිටින අතර සෑම දහවල් කාලයේදී මිනිසුන් සුවඳ විලවුන් ඉසියි. සවස් වරුවේ ශ්‍රී, පාද වලට යයි, ඒ නිසා මිනිස්සු හැමදාම හවසට තම පාද සෝදයි". තමබාල්ට සියල්ල මතක් විය.
              </p>

              <div class="columns">
                <div class="column is-8">
                  <p class="has-text-justified">
                    හත්වන දවසේදී දෙවියන් වහන්සේ පිරිමි ළමයා මුණගැසී පිළිතුරක් ඇසු විට. ඔහු රාජාලීන්ගෙන් ඉගෙන ගත් දේ නැවත කීවේය, නිවැරදි පිළිතුර ලැබුණු පසු තමන් පරාජය වුනු නිසා කබිලප්‍රොම් දෙවියා තම දියණියන් හත්දෙනා කැඳවා තමන්ගේ හිස කපා දැමිය යුතු බව ඔවුන්ට කීවේය. එහෙත්, ඔහුගේ හිස පොළොවට වැටුනහොත්, එය ලෝකය වටා ගිලී යන පාතාලයක් නිර්මාණය වෙනු ඇති බවත්. ඔහුගේ හිස අහසට විසි කළහොත් වර්ෂාව නතර වනු ඇති බවත්. සාගරයට දැමුවහොත් සියලු මුහුදු ජලය වියළී යනු ඇති බවත් එම නිසා මෙම විපත් වලක්වා ගැනීම සඳහා කපිල බ්‍රහ්ම තම දියණියන්ට කීවේ හිස ඔසවා උස් තැනක තබන්නැයි කියාය. ඔහුගේ වැඩිමහල් දරුවා වන තුංසා සිය පියාගේ හිස කයිලාෂ් කන්දේ ගුහාවක ගබඩා කර තැබුවාය.
                  </p>
                </div>
                <div class="column is-4">
                  <figure>
                    <img src="./images/Songkran/2.jpg">
                    <figcaption>
                      අතීතයේ මහා මේරු පර්වතය යැයි විශ්වාස කරන කයිලාෂ්හි මේරු කඳු මුදුන
                    </figcaption>
                  </figure>
                </div>
              </div>

              <p class="has-text-justified">
                කපිල බ්‍රහ්මයාගේ දියණියන් සත් දෙනාගෙන්  එක් අයෙක් වූ සොන්ක්රාන් තම පියා සිහිකරමින් කයිලාෂ් කන්ද වටේ සැම වසරකම පෙරහැරක් ගිය බව පුරාවෘත්තයේ සදහන් වේ. එම සිදුවීම සිහි කරමින් අදත් සොන්ක්රාන් දේවදුතිය ලෙස සුන්දර තායි තරුණියක් සරසවා සොන්ක්රාන් පෙරහැරක් වීදි සංචාරය කරයි.
              </p>

              <br><h6>අලුත් අවුරුදු සැමරුම් හා සම්ප්‍රදායික ක්‍රියාකාරකම් </h6>

              <div class="columns is-centered is-vcentered">
                <div class="column is-4">
                  <figure>
                    <img src="./images/Songkran/8.jpg">
                    <figcaption>
                      මුතුන් මිත්තන්ට සංග්‍රහ කිරීම ප්‍රධාන සොන්ක්රාන් අංගයකි.
                    </figcaption>
                  </figure>

                </div>
                <div class="column is-4">
                  <figure>
                    <img src="./images/Songkran/18.jpg">
                    <figcaption>
                      තායි වැසියන් පාරිශුද්ධත්වයේ සංකේතය ලෙස සලකන ජලය සොන්ක්රාන් සැමරුමේ මූලික අංගයයි.
                    </figcaption>
                  </figure>
                </div>
                <div class="column is-4">
                  <figure>
                    <img src="./images/Songkran/11.jpg">
                    <figcaption>
                      වෙරළේ තැනූ අලංකාර වැලි ස්තූප
                    </figcaption>
                  </figure>
                </div>
              </div>

              <div class="columns">
                <div class="column is-8">
                  <p class="has-text-justified">
                    මහා සොන්ක්රාන් එනම් අප්‍රේල් 13 යෙදෙන දවස අනුව සොන්ක්රාන් පෙරහැර විවිධාකාර වේ. මෙහිදී සොන්ක්රාන් කුමරිය ගමන් ගන්නා වාහනය විවිධ සතුන්ගේ හැඩයෙන් පිළියෙළ කල එකකි.
                  </p>
                  <p class="has-text-justified">
                    මහා සොන්ක්රාන් යෙදෙන්නේ ඉරිදා දිනයක නම් එය ගරුඬ පක්ෂියාගේ හැඩයට නිර්මාණය වේ. සඳුදා නම් කොටියෙකු ලෙසද, අඟහරුවාදා නම් ඌරෙකු ලෙසද බදාදා නම් බූරුවෙකු ලෙසද බ්‍රහස්පතින්දා නම් අලියෙකු ලෙසද සිකුරාදා නම් මී ගවයෙකු ලෙසද සෙනසුරාදා නම් මොණරෙකු ලෙසද පිළියෙළ වේ.
                  </p>
                </div>
                <div class="column is-4">
                  <figure>
                    <img src="./images/Songkran/3.jpg">
                    <figcaption>
                      සොන්ක්රාන් කුමරිය සංකේතාත්මකව ඌරෙකු මත ගමන් කරන පෙරහැර
                    </figcaption>
                  </figure>
                </div>
              </div>

              <p class="has-text-justified">
                සොන්ක්රාන් සැමරුම සංකේතාත්මක ය. උදේ පාන්දර ආරම්භ වන සැමරුමේදී ප්‍රදේශයේ බෞද්ධ විහාර වලට යාම සහ බෞද්ධ භික්ෂූන් වහන්සේලාට ආහාර පූජා කිරීම බහුලව සිදු වේ. මෙම විශේෂිත අවස්ථාවෙහිදී, බුද්ධ ප්‍රතිමා සහ බෞද්ධ භික්ෂූන් වහන්සේලා මත ජලය වත් කිරීම මෙම දිනයේ සම්ප්‍රදායික චාරිත්‍රයකි.එමෙන්ම නුතන වශයෙන් ජල සැණකෙළි පැවැත්වීම සිදු කරන්නේ එය පවිත්‍රතාවයේ සංකේතයක් ලෙස හා කෙනෙකුගේ පව් හා අවාසනාව සොදහැරීමේ සංකේතයක් ලෙසයි. එකමුතුකම සහ මුතුන් මිත්තන්ට ගරු කිරීම සොන්ක්‍රාන් සම්ප්‍රදායේ වැදගත් අංගයකි.
              </p>

              <div class="columns">
                <div class="column is-3">
                  <figure>
                    <img src="./images/Songkran/13a.jpg">
                    <img src="./images/Songkran/13b.jpg">
                    <img src="./images/Songkran/13c.jpg">
                    <img src="./images/Songkran/13d.jpg">
                    <figcaption>
                      වීදි දිගේ ජල ක්‍රීඩාවල යෙදෙන තායි වැසියන්
                    </figcaption>
                  </figure>
                  <figure>
                    <img src="./images/Songkran/7.jpg">
                    <figcaption>
                      සොන්ක්රාන් සැමරුම් - ඇමෙරිකාවේ ලොස් ඇන්ජලීස්හි පිහිටි වට් තායි පන්සල
                    </figcaption>
                  </figure>
                </div>
                <div class="column is-9">
                  <p class="has-text-justified">
                    මෙම දිනයේ ප්‍රදාන වීදි වසා දමා ඒවා මිනිසුන්ට ජල සැණකෙළි සදහාම වෙන් කෙරේ. හැම දෙනාම එකිනෙකාට ජලය ඉසිමින් විනෝද වෙන අතරේ අලංකාර ඇදුමින් සැරසුණු සුන්දර තායි තරුණියන් සොන්ක්රාන් ආර්යාව ලෙස කිරුළු පළදියි.
                  </p>

                  <div class="columns">
                    <div class="column is-8">
                      <p class="has-text-justified">
                        මධ්‍යම තායිලන්තයේ සොන්ක්රාන් සමය වන විට ජනතාව තම නිවාස පිරිසිදු කරති. සියල්ලෝම වර්ණවත් ඇඳුම් හෝ තායි ඇඳුමින් සැරසී සිටිති. භික්ෂූන් වහන්සේලාට ආහාර පූජා කිරීමෙන් පසු මිනිසුන් තම මුතුන් මිත්තන්ට සැලකීම කරති. පන්සල ඉදිකිරීම හෝ අලුත්වැඩියා කිරීම සඳහා වැලි ලබා දීම වැනි පූජාවන් ජනතාව විසින් සිදු කරනු ලැබේ. ඔවුන් කුසලයන් ලෙස සලකා කුරුල්ලන් හා මාළු නිදහස් කිරීම සිදු කරයි. වර්තමානයේ මිනිසුන් මී හරකුන් සහ එළදෙනුන් වැනි සතුන් ද නිදහස් කරති. වර්ණවත් සාම්ප්‍රදායික ඇඳුම්වලින් පෙළපාළි සහ ජනකතා ප්‍රසංග වැනි මොන් ජනයාගේ සාම්ප්‍රදායික උත්සවද පැවැත්වේ.
                      </p>
                      <p class="has-text-justified">
                        දකුණු  තායිලන්ත වැසියන් සොන්ක්රාන් නීති තුනක් පිලිපදියි. හැකි තරම් සුළු වශයෙන් වැඩ කර මුදල් වියදම් කිරීමෙන් වැළකීම,සතුන්ට හානි නොකිරීම හා බොරු නොකීම ඒවායි.
                      </p>
                      <p class="has-text-justified">
                        උතුරු තායිලන්තයේ අප්‍රේල් 7 වන දින,  සොන්ක්රාන් උත්සවය අලි ඇතුන්ගෙන් යුත් වර්ණවත් පෙළපාලියක් සමඟ පවත්වනු ලබන අතර එහිදී සාම්ප්‍රදායික ඇඳුම් ඇඳගත් පිරිමින් අලි ඇතුන් පන්සල් වෙත ගෙන යනු ලැබේ. අප්‍රේල් 13 සමරනු ලබන්නේ අවාසනාව දුරු කිරීම සඳහා වෙඩි තැබීම් හෝ රතිඤ්ඤ පත්තු කරමිනි. ඊළඟ දවසේ මිනිසුන් පන්සලේ භික්ෂූන් වහන්සේලාට පූජා කිරීම සඳහා ආහාර සහ ප්‍රයෝජනවත් දේවල් පිළියෙළ කරති. බුදුරජාණන් වහන්සේගේ පිළිරුව ස්නානය කිරීමට හා ස්නානය කිරීමට මිනිසුන්ට පන්සලට යා යුතු අතර, පසුව ඔවුන් වැඩිහිටියන්ගේ අතට වතුර වත් කර ඔවුන්ගේ ආශිර්වාදය ඉල්ලා සිටිති.
                      </p>
                    </div>
                    <div class="column is-4">
                      <figure>
                        <img src="./images/Songkran/12a.jpg">
                        <img src="./images/Songkran/12b.jpg">
                        <figcaption>
                          බුද්ධ ප්‍රතිමා ජලයෙන් නැහැවීම
                        </figcaption>
                      </figure>
                      <figure>
                        <img src="./images/Songkran/9.jpg">
                        <figcaption>
                          බුද්ධ ප්‍රතිමාවක් ජලයෙන් සෝදන තායි දරුවෙක්
                        </figcaption>
                      </figure>
                    </div>
                  </div>
                  <p class="has-text-justified">
                    නැගෙනහිර කලාපයේ තායිලන්තයේ අනෙක් ප්‍රදේශවලට සමාන ක්‍රියාකාරකම් ඇතත්, නැගෙනහිර ජනයා සෑම විටම සොන්ක්‍රාන් උත්සවයේ සෑම දිනක්ම පන්සලේ ගත කරමින් වැලි චෛත්‍යයන් නිර්මාණය කරති. සමහර අය දේවමාළිගාවේ ගත කිරීමෙන් පසු තම පවුලේ වැඩිහිටි සාමාජිකයින්ට ලබා දිය යුතු ආහාර පිළියෙළ කරති.
                  </p>
                </div>
              </div>

              <p class="has-text-justified">
                තායිලන්තයේ අගනුවර බැංකොක් සොන්ක්රාන් උත්සවය සැමරුමේ කේන්ද්‍රස්ථානයක් වන අතර මාර්ග වසා ජල තුවක්කු වලින් සහ බාල්දි වලින් ජල ක්‍රියාකාරකම් වල යෙදෙයි. දහවල් හා රාත්‍රිය පුරා ඔවුන් සාද පවත්වයි.
              </p>

              <div class="columns">
                <div class="column is-3">
                  <figure>
                    <img src="./images/Songkran/10.jpg">
                    <figcaption>
                      තම මුතුන් මිත්තන් සිහිවීමට තැනූ ස්තූප, සොන්ක්රාන් දිනයේදී ජලයෙන් නහවයි.
                    </figcaption>
                  </figure>
                </div>
                <div class="column is-5">
                  <figure>
                    <img src="./images/Songkran/15.jpg">
                    <figcaption>
                      තායි බෞද්ධ භික්ෂුන් ආශීර්වාද ලබමින්
                    </figcaption>
                  </figure>
                </div>
                <div class="column is-4">
                  <figure>
                    <img src="./images/Songkran/16.jpg">
                    <figcaption>
                      සම්ප්‍රදායික තායි ඇඳුමින් සැරසුණු යුවතියක් ඇමෙරිකානු නාවුක පිරිසකට ජල ආශීර්වාද කරමින්
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
