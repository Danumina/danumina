<?php
require_once "func.php";

$level = $_GET['level'];
$characterSet = getCharacterSet($level);
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>දැනුමිණ | ප්‍රකට චරිත</title>
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

    <section class="section" style="padding-top: 1rem;">
      <div class="container">
        <div class="content">
          <div class="columns is-mobile">
            <div class="column is-4">
              <div class="counter-wrap"><span class="counter">0</span> / <?= count($characterSet)?></div>
            </div>
            <div class="column is-4">
              <div class="qcount-wrap"><span class="q-count">1</span></div>
            </div>
            <div class="column is-4">
              <div class="timer-wrap"><span class="timer">30</span></div>
            </div>
          </div>
          <style>
            .timer-wrap {
              text-align: end;
              font-size:1.6rem;
            }
            .timer {
              display: block;
            }
            .counter-wrap {
              font-size:1.6rem;
            }
            .qcount-wrap {
              text-align: center;
              font-size:1.6rem;
            }
            .counter {
              /* display: block;               */
              color: #48c78e;
            }
            .cbox-container {
              background-color:#fff;
              border-radius:.25rem;
              box-shadow:0 .5em 1em -.125em rgba(10,10,10,.1),0 0 0 1px rgba(10,10,10,.02);
              color:#4a4a4a;
              height:305px;
              text-align: center;
            }
            .c-image {
              height: 305px;
              border-radius:.25rem;
              box-shadow:0 .5em 1em -.125em rgba(10,10,10,.1),0 0 0 1px rgba(10,10,10,.02);
              width: fit-content;
            }

            @media screen and (max-width: 480px) {
              .cbox-container {
                height: 450px;
              }

            }
            .box {
              font-weight: bolder;
              padding: 0.3rem;
              margin-bottom: 0.5%;
            }
            .disabled {
              cursor: not-allowed !important;
              /* color: white !important; */
              /* background-color: grey; */
              /* border: transparent; */
            }
            .enabled {
              cursor: pointer;
              color: #53b9fd;
            }
            #nextbtn {
              cursor: pointer;
              padding: 1rem;
            }
            #retrybtn, #homebtn {
              /* display: none; */
              cursor: pointer;
              padding: 1rem;
            }
            #retrybtn:hover, #homebtn:hover {
              color: #53b9fd;
              transform :scale(1.1);
            }
            .answer-box {
              cursor: pointer;
            }
            .hovering:hover {
              background-color: #53b9fd;
              /* border: 1px solid #53b9fd; */
              color: white;
            }
            .answer-box:hover {
              transform: scale(1.02);
              font-size: 1.02em;
              /*
              text-shadow:2px 2px 8px #ccc; */
              /* border-bottom: 1px solid #53b9fd !important; */
            }
            .success {
              background-color: #48c78e;
              color: white;
            }
            .fail {
              background-color: #f14668;
              color: white;
            }
            #totSpan {
              display: none;
              color: blue;
              font-size: 3rem;
            }
          </style>

          <?php
          shuffle($characterSet);
          for ($i=0; $i < count($characterSet); $i++) {
            $name = $characterSet[$i]['name'];
            $description = $characterSet[$i]['description'];
            $code = $characterSet[$i]['code'];
            $id = $characterSet[$i]['id'];
          ?>

          <div class="columns chr-box" data-id="<?=$id ?>" data-code="<?=$id ?>">
            <div class="column is-3 is-centered">
                <div class="cbox-container" style="background-image:url('images/people/<?=$level?>/<?=$id?>.jpg'); background-position:top; background-size:cover">
                </div>
            </div>
            <div class="column is-9">
              <p style="background-color: #eee;padding: 1%;padding-left: 2%;border-left: 6px solid #53b9fd !important;"><?=$description?></p>

              <?php
              $answerSet = getAnswersForCharacters($level, $code, $id);
              $answerSet[3]['id'] = $id;
              $answerSet[3]['name'] = $name;
              $answerSet[3]['code'] = $code;

              shuffle($answerSet);
              for ($j=0; $j < count($answerSet); $j++) {
                $anzName = $answerSet[$j]['name'];
                $anzId = $answerSet[$j]['id'];
              ?>

              <!-- <div class="column"> -->
                <div class="box answer-box hovering" onclick="selectAnswer(this)" data-code="<?=$anzId?>">
                  <p><?=$anzName ?></p>
                </div>
              <!-- </div> -->

             <?php } ?>

            </div>
          </div>

          <?php } ?>

          <div class="columns is-centered">
            <!-- <div class="column is-centered"> -->
              <span id="totSpan"></span>
            <!-- </div> -->
          </div>
          <hr>
          <div class="columns is-centered" style="text-align:center">
              <span class="" id="homebtn" onclick="{window.location.href = 'games.php'}" title="තරඟ පිටුවට"><i class="fas fa-home fa-3x"></i></span>
              <span class="disabled" id="nextbtn" onclick="goNext()" title="මීලඟ ප්‍රශ්නය"><i class="fas fa-arrow-alt-circle-right fa-3x"></i></span>
              <span class="" id="retrybtn" onclick="{window.location.reload()}" title="නැවත තරඟ කරන්න"><i class="fas fa-redo-alt fa-3x"></i></span>
          </div>
          <div class="columns is-centered">
          </div>

          <script type="text/javascript">
          // $("html"). on("contextmenu",function(e){ return false; });

          let countdownInterval = setInterval(countdown, 1000);

          var fBoxes = document.querySelectorAll(".chr-box");
          for (var i = 0; i < fBoxes.length; i++) {
            if (i > 0)
              fBoxes[i].style.display = "none";
          }
          // fBoxes[0].style.display = "flex";

          var displayingQCode = fBoxes[0].dataset.code;
          var displayingQId = fBoxes[0].dataset.id;
          var successCount = 0;
          var countryCount = fBoxes.length;
          var qCounter = 1;
          function goNext(){
            clearInterval(countdownInterval);
            setTimeout(() => {
              if (qCounter == countryCount) {
                fBoxes[qCounter - 1].style.display = "none";
                completeQuiz();
              } else {
                var btnElem = document.getElementById("nextbtn");
                if (!btnElem.classList.contains("disabled")) {
                  fBoxes[qCounter - 1].style.display = "none";
                  fBoxes[qCounter].style.display = "";
                  displayingQCode = fBoxes[qCounter].dataset.code;
                  displayingQId = fBoxes[qCounter].dataset.id;
                  qCounter++;
                  $(".q-count").text(qCounter);
                }
                btnElem.classList.add("disabled");
                btnElem.classList.remove("enabled");

                $(".timer").text(30);
                countdownInterval = setInterval(countdown, 1000);
              }
            }, "500");
          }

          function completeQuiz(){
            document.querySelector("#nextbtn").style.display = "none";
            document.querySelector(".timer").style.display = "none";
            document.querySelector(".counter-wrap").style.display = "none";
            document.querySelector(".q-count").style.display = "none";
            // document.querySelector("#retrybtn").style.display = "flex";
            // document.querySelector("#homebtn").style.display = "flex";

            var winPercent = successCount/countryCount * 100;
            document.querySelector("#totSpan").textContent = winPercent.toFixed() + "%";
            if (winPercent >= 80) {
              document.querySelector("#totSpan").style.color = "#48c78e";
            } else if (winPercent <= 50) {
              document.querySelector("#totSpan").style.color = "#f14668";
            }
            document.querySelector("#totSpan").style.display = "flex";
          }

          function selectAnswer(anzElem){
            document.getElementById("nextbtn").classList.remove("disabled");
            document.getElementById("nextbtn").classList.add("enabled");
            anzElem.classList.add("selected");
            if (anzElem.dataset.code == displayingQCode) {
              anzElem.classList.add("success");
              freezeAnswerList(anzElem.parentNode, true);
              updateSuccessCounter();
              goNext();
            } else {
              anzElem.classList.add("fail");
              freezeAnswerList(anzElem.parentNode, false);
            }
            clearInterval(countdownInterval);
          }

          function freezeAnswerList(anzContainer, success){
            // anzContainer = anzContainer.parentNode;
            var anzElems = anzContainer.children;
            for (var i = 0; i < anzElems.length; i++) {
              if (!success)
                if(anzElems[i].dataset.code == displayingQCode) anzElems[i].classList.add("green");
              anzElems[i].onclick = null;
              anzElems[i].classList.remove("hovering");
            }
          }

          function countdown(){
            let val = parseInt($(".timer").text());
            $(".timer").text(--val);
            if (val == 0) {
              clearInterval(countdownInterval);
              var qElem = document.querySelector('[data-id="'+displayingQId+'"]');
              freezeAnswerList(qElem.children[1], false);
              document.getElementById("nextbtn").classList.remove("disabled");
              document.getElementById("nextbtn").classList.add("enabled");
            }
          }

          function updateSuccessCounter(){
            successCount++;
            $(".counter").text(successCount);
          }

          </script>
        </div>
      </div>
    </section>
  </body>
</html>
