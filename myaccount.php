<?php
require_once "func.php";

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

<html lang="si">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>දැනුමිණ | මගේ ගිණුම</title>
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
  </head>
  <body>
    <section class="section navbar-section">
      <div class="container is-transparent">
        <nav class="navbar is-transparent" role="navigation" aria-label="main navigation">
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
                      <hr class="div-line">
                      <div class="field">
                        <button class="button is-dark is-fullwidth close-modal">ඉවත් වන්න</button>
                        <button class="button is-success close-modal confirm-sup-btn">ඉදිරියට යන්න</button>
                        <a class="home-btn"><i class="fas fa-angle-double-left"></i> දැනුමිණ මුල් පිටුවට පිවිසෙන්න</a>
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
    <section id="content-section" class="section">
      <?php
        if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        $codesArr = get_usercodes();
        $usrDetails = get_user();
      ?>
      <div class="container">
        <div class="columns">
          <div class="column is-5">
            <div id="upd-success-message" class="notification is-success hide">
              <button class="delete"></button>
              තොරතුරු ඇතුලත් කිරීම සාර්ථකයි.
            </div>

            <p>පහතින් ඔබේ තොරතුරු ලබා දීමට හෝ ලබාදුන් තොරතුරු නැවත වෙනස් කිරීම කල හැක.</p><br>

            <div class="field">
              <label class="label">ඊමේල් ලිපිනය</label>
              <div class="control has-icons-left has-icons-right">
                <input id="upd-email" class="input" type="email" value="<?= $_SESSION['email'] ?>" disabled>
                <span class="icon is-small is-left">
                  <i class="fas fa-envelope"></i>
                </span>
              </div>
            </div>
            <div class="field">
              <label class="label">රහස් පදය</label>
              <div class="control has-icons-left has-icons-right">
                <input id="upd-pswrd" class="input" type=""  value="<?= $usrDetails['password'] ?>">
                <span class="icon is-small is-left">
                  <i class="fas fa-lock"></i>
                </span>
              </div>
              <p id="upd-pswrd-warning" class="help is-danger"></p>
            </div>
            <div class="field">
              <label class="label">නම</label>
              <div class="control">
                <input id="upd-name" class="input" type="text"  value="<?= $usrDetails['name'] ?>">
              </div>
            </div>
            <div class="field">
              <label class="label">දුරකථන අංකය</label>
              <div class="control">
                <input id="upd-mob" class="input" type="text" value="<?= $usrDetails['mobile'] ?>">
              </div>
            </div>
            <div class="field">
              <label class="label">ලිපිනය</label>
              <div class="control">
                <textarea rows="1" id="upd-addr" class="textarea"><?= $usrDetails['address'] ?></textarea>
              </div>
            </div><br>

            <div class="field">
              <button id="upd-button" class="button is-success is-outlined">තොරතුරු ඇතුලත් කරන්න</button>
            </div>

          </div>
          <div class="column is-2"></div>
          <div class="column is-5">
            <p>දැනුමිණ කලාප සියල්ලම එක තැනින්</p><br>
            <table class="table is-bordered is-striped is-hoverable is-fullwidth">
              <tbody>
                <?php
                for ($i=0; $i < count($codesArr); $i++) {
                  $sincode = get_sincode($codesArr[$i]['code']);
                  ?>
                  <tr>
                    <th><?= str_replace(' ',' - ',$sincode) ?></th>
                    <td><a id="<?=$codesArr[$i]['code']?>" onclick="r_paper(this.id)">කියවන්න</a></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <?php } else { ?>
        <script>
          window.onload = function(){
            $(".modal-button").click(function() {
              var target = $(this).data("target");
              $("html").addClass("is-clipped");
              $(target).addClass("is-active");
              $(".modal-close").css("display","none");
              // $(".div-line").css("display","none");
              $(".close-modal").css("display","none");
            });
            $(".modal-button").trigger("click");
          };
        </script>
      <?php } ?>
    </section>
  </body>
</html>
