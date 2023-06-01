<?php
require_once "func.php";
// require_once "payment.php";

session_start();

// get latest ON paper-code
$code = get_latestcode();
$sincode = get_sincode($code);
$sincode = str_replace(" "," - ",$sincode);
?>

<html lang="si">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>දැනුමිණ | මිලදී ගන්න</title>
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
    <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
  </head>
  <body>
    <section class="section navbar-section">
      <div class="container">
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

                <div id="dropdownMenu" class="navbar-item has-dropdown is-hoverable">
                    <a class="navbar-link"><strong>මගේ පිවිසුම</strong></a>
                    <div class="navbar-dropdown is-boxed">
                      <a class="navbar-item" href="./myaccount.php">මගේ ගිණුම</a>
                      <a class="navbar-item" href="./pricing.php">මිලදී ගන්න</a>
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
      <div class="container">
        <div class="columns">
          <div class="column">
            <div class="card">
              <header class="card-header">
                  <p class="card-header-title title">100 LKR</p>
              </header>
              <div class="card-content">
                <div class="row">
                  <p class="">දැනුමිණ අතිරේකය<br><?= $sincode ?> නවතම මාසික කලාපය<br>මිලදී ගන්න</p>
                </div>
              </div>
              <div class="card-footer">
                  <a id="pay100" class="button is-info is-outlined" onclick="subscribe(this.id);">ඉදිරියට යන්න</a>
              </div>
            </div>
          </div>
          <div class="column">
            <div class="card">
              <header class="card-header">
                  <p class="card-header-title title">1000 LKR</p>
              </header>
              <div class="card-content">
                <div class="row">
                  <p class="">දැනුමිණ අතිරේකය<br><?= $sincode ?>
                    නවතම මාසික කලාපය සමගින් ඉදිරි මාසික කලාප 11 ම එකවර මිලදී ගන්න,<br>දැනුමිණ පැරණි කලාප සියල්ල කියවන්න
                  </p>
                </div>
              </div>
              <div class="card-footer">
                  <a id="pay1000" class="button is-info is-outlined" onclick="subscribe(this.id);">ඉදිරියට යන්න</a>
              </div>
            </div>
          </div>
        </div>

        <div id="paid-modal" class="modal">
          <div class="modal-background"></div>
          <div class="modal-card">
            <section class="modal-card-body">
              <div class="confirm-quiz">
                <div class="field">
                  <span class="icon-text has-text-success">
                    <i class="fas fa-check-circle fa-5x"></i>
                  </span><br><br>
                  <span>ඔබගේ මිලදී ගැනීම සාර්ථකයි.!</span>
                </div><br>
                <a class="button hm-btn is-success" href="./index.php?r=win">දැනුමිණ මුල් පිටුවට පිවිසෙන්න</a>
              </div>
            </section>
          </div>
        </div>

      </div>
      <script type="text/javascript">
        var pay = "pay100";

        window.onload = function(){
          $(".modal-button").click(function() {
            var target = $(this).data("target");
            $("html").addClass("is-clipped");
            $(target).addClass("is-active");
            $(".modal-close").css("display","none");
            $(".close-modal").css("display","none");
          });
        };


        // Called when user completed the payment. It can be a successful payment or failure
        payhere.onCompleted = function onCompleted(orderId) {
            console.log("Payment completed. OrderID:" + orderId);
            $.post( "payment.php", { func:'c-p',oid:orderId },function(data) {
                if (data == "OK"){
                  $("html").addClass("is-clipped");
                  $("#paid-modal").addClass("is-active");
                }
            },"json");
        };

        // Called when user closes the payment without completing
        payhere.onDismissed = function onDismissed() {
            //Note: Prompt user to pay again or show an error page
            console.log("Payment dismissed");
        };

        // Called when error happens when initializing payment such as invalid parameters
        payhere.onError = function onError(error) {
            // Note: show an error page
            console.log("Error:"  + error);
        };



        // Show the payhere.js popup, when "PayHere Pay" is clicked
        function subscribe(id){
          <?php
          if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
          ?>
            pay = id;

            // Put the payment variables here
            var payment = {
                "sandbox": true,
                "merchant_id": "1219542",
                "return_url": "https://staging.denumina.lk",
                "cancel_url": undefined,
                "notify_url": "https://staging.denumina.lk",
                "order_id": "<?= $code ?>" + "_" + "<?= $_SESSION['uid'] ?>",
                "items": "දැනුමිණ - <?= $sincode ?> කලාපය",
                "amount": pay.substr(3) + ".00",
                "currency": "LKR",
                "first_name": "A",
                "last_name": "B",
                "email": "<?= $_SESSION["email"] ?>",
                "phone": "07X XXX XXXX",
                "address": "ABC",
                "city": "COLOMBO",
                "country": "LK"
            };

            payhere.startPayment(payment);
          <?php } else { ?>
            $(".modal-button").trigger("click");
          <?php } ?>
        }
    </script>

    <!-- <div class="footer-div">
      <center><a href="https://www.payhere.lk?utm_source=logo" target="_blank"><img src="https://www.payhere.lk/downloads/images/payhere_short_banner_dark.png" alt="PayHere" width="280"/></a></center>
    </div> -->

  </body>
</html>
