<?php
require_once "func.php";
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>දැනුමිණ | මතකයෙන් දිනන්න</title>
    <link rel="apple-touch-icon" sizes="180x180" href="./images/favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="./images/favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon_io/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.1/css/bulma.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script>
    <script defer src="./js/index.js"></script>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/animate.css">
    <link rel="stylesheet" href="./css/stylesheet.css">
  </head>
  <body>
    <section class="section navbar-section">
      <div class="container">
        <nav class="navbar " role="navigation" aria-label="main navigation">
          <div class="navbar-brand">
            <a class="navbar-item logo-link" href="./index.php">
              oekqusK
            </a>
          </div>
        </nav>
      </div>
    </section>

    <section id="content-section" class="section">
      <div class="container">
        <div class="content">
          <div class="columns is-vcentered">
            <div class="column is-3">
              රට රටවල ජාතික කොඩි
              <!-- <i class="fas fa-flag-usa fa-3x"></i> -->
            </div>
            <div class="column is-1">
              <button class="button is-fullwidth" name="button" onclick="playGame(1,'flags')" title="පළමු වටය">1</button>
            </div>
            <div class="column is-1">
              <button class="button is-fullwidth" name="button" onclick="playGame(2, 'flags')" title="දෙවන වටය">2</button>
            </div>
            <div class="column is-1">
              <button class="button is-fullwidth" name="button" onclick="playGame(3, 'flags')" title="තෙවන වටය">3</button>
            </div>
            <div class="column is-1">
              <button class="button is-fullwidth" name="button" onclick="playGame(4, 'flags')" title="සිව්වන වටය">4</button>
            </div>
            <div class="column is-1">
              <button class="button is-fullwidth" name="button" onclick="playGame(5, 'flags')" title="පස්වන වටය">5</button>
            </div>
            <!-- <div class="column is-1">
              <div class="tooltip"><a target="" style="font-size:2rem"><i class="far fa-info-circle"></i></a>
                <span class="tooltiptext">විවිධ රටවල ජාතික කොඩි මතකයෙන් තෝරන්න. පහසුම සිට අපහසු මට්ටම දක්වා තරඟ වට 05 කි.</span>
              </div>
            </div> -->
          </div>

          <div class="columns is-vcentered">
            <div class="column is-3">
              ලොව ප්‍රකට චරිත
            </div>
            <div class="column is-1">
              <button class="button is-fullwidth" name="button" onclick="playGame(1, 'people')" title="පළමු වටය">1</button>
            </div>
            <div class="column is-1">
              <button class="button is-fullwidth" name="button" onclick="playGame(2, 'people')" title="දෙවන වටය">2</button>
            </div>
            <!-- <div class="column is-1">
              <button class="button is-fullwidth" name="button" onclick="playGame(3)" title="තෙවන වටය">3</button>
            </div>
            <div class="column is-1">
              <button class="button is-fullwidth" name="button" onclick="playGame(4)" title="සිව්වන වටය">4</button>
            </div>
            <div class="column is-1">
              <button class="button is-fullwidth" name="button" onclick="playGame(5)" title="පස්වන වටය">5</button>
            </div> -->
            <!-- <div class="column is-1"></div> -->

            <!-- <div class="column is-1">
              <div class="tooltip"><a target="" style="font-size:2rem"><i class="far fa-info-circle"></i></a>
                <span class="tooltiptext">ලොව ප්‍රකට චරිතවල රූප, මතකයෙන් හඳුනාගන්න. තරඟ වට 02 කි.</span>
              </div>
            </div> -->
          </div>

        </div>

        <script type="text/javascript">
          function playGame(level, page) {
            window.location.href = page+".php?level="+level;
          }
        </script>
        <style media="screen">
        .tooltip {
          position: relative;
          display: inline-block;
        }
        .tooltip a {
          cursor: help;
        }

        .tooltip .tooltiptext {
          visibility: hidden;
          width: 310px;
          background-color: #555;
          color: #fff;
          text-align: center;
          border-radius: 6px;
          padding: 5px 0;
          position: absolute;
          z-index: 1;
          bottom: 125%;
          left: 50%;
          margin-left: -155px;
          opacity: 0;
          transition: opacity 0.3s;
          font-size: 0.7rem;
          line-height: normal;
        }

        .tooltip .tooltiptext::after {
          content: "";
          position: absolute;
          top: 100%;
          left: 50%;
          margin-left: -5px;
          border-width: 5px;
          border-style: solid;
          border-color: #555 transparent transparent transparent;
        }

        .tooltip:hover .tooltiptext {
          visibility: visible;
          opacity: 1;
        }

        </style>
      </div>
    </section>
  </body>
</html>
