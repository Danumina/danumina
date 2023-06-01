            </div>
          </div>

        </div>
      </div><br><br>
      <a id="homeBtn" class="button has-text-centered is-black" href="../../index.php" title="දැනුමිණ මුල් පිටුවට පිවිසෙන්න"><i class="fas fa-home fa-lg"></i></a>
      <a id="pageTopBtn" class="button  has-text-centered is-black" onclick="topFunction()" title="මුලටම යන්න "><i class="fas fa-angle-double-up fa-lg"></i></a>
    </div>
    </section>

    <?php
    $uri = $_SERVER['REQUEST_URI'];
    $str = explode('/',$uri);
    $str2 = explode('.', $str[count($str) - 1]);
    $page = $str2[0];

    $ad = getFirstAd($page);
    if($ad){
      $mediaType = $ad['media_type'];
      $mediaPath = $ad['media_path'];
      $mediaSrc = "../" . $mediaPath;

      $quote = $ad['quote'];
      $author = $ad['author'];
      ?>
      <div id="first-ad-modal" class="modal">
        <div class="modal-background"></div>
        <div class="modal-content">
        <?php if ($quote) { ?>
          <div class="notification is-warning has-text-centered" style="margin-bottom:0;line-height:1.2rem">
            <p><b>&ldquo;&nbsp;<?=$quote ?>&nbsp;&rdquo;</b></p>
            <br/>
            <span><b>~ <?=$author ?> ~</b></span>
          </div>
        <?php } ?>

        <?php if (substr( $mediaType, 0, 5 ) === 'image') { ?>

          <img class="ad-modal-img" src="<?= $mediaSrc ?>" alt="" loading="lazy">

        <?php } else if (substr( $mediaType, 0, 5 ) === 'video') { ?>

          <video id="ad-modal-vid" class="ad-modal-vid" style="z-index:1;" controls preload="none">
           <source src="<?=$mediaSrc ?>" type="<?= $mediaType ?>">
          </video>

        <?php } ?>
        </div>

        <!-- <a class="bulb" href="#" title=""><img src="../../images/bulb.png" alt="" width="50"></a> -->
        <a class="bulb" href="../../advertising.php" title=""><i class="fas fa-ad fa-2x"></i></a>

        <a class="button ad-close is-danger hidden" aria-label="close"><i class="fas fa-times"></i>&nbsp; දැන්වීම වසන්න</a>
        <div class="countdown-wrap"><span class="countdown">5</span></div>
      </div>
    <?php } ?>

    <?php
    $ad = getSecondAd($page);
    if($ad){
      $mediaType = $ad['media_type'];
      $mediaPath = $ad['media_path'];
      $mediaSrc = "../" . $mediaPath;

      $quote = $ad['quote'];
      $author = $ad['author'];
      ?>
      <div id="second-ad-modal" class="modal">
        <div class="modal-background"></div>

        <div class="modal-content">
        <?php if ($quote) { ?>
          <div class="notification is-warning has-text-centered" style="margin-bottom:0;line-height:1.2rem">
            <p><b>&ldquo;&nbsp;<?=$quote ?>&nbsp;&rdquo;</b></p>
            <br/>
            <span><b>~ <?=$author ?> ~</b></span>
          </div>
        <?php } ?>

        <?php if (substr( $mediaType, 0, 5 ) === 'image') { ?>

          <img class="ad-modal-img" src="<?= $mediaSrc ?>" alt="" loading="lazy">

        <?php } else if (substr( $mediaType, 0, 5 ) === 'video') { ?>

          <video id="ad-modal-vid" class="ad-modal-vid" style="z-index:1;" controls preload="none">
           <source src="<?=$mediaSrc ?>" type="<?= $mediaType ?>">
          </video>

        <?php } ?>
        </div>

        <a class="bulb" href="#" title=""><img src="../../images/bulb.png" alt="" width="50"></a>
        <a class="button ad-close is-danger hidden" aria-label="close"><i class="fas fa-times"></i>&nbsp; දැන්වීම වසන්න</a>
        <div class="countdown-wrap"><span class="countdown">5</span></div>
      </div>
    <?php } ?>

    <div id="img-modal" class="modal">
      <div class="modal-background"></div>
      <img class="modal-img" src="" alt="">
      <div class="modal-card"></div>
      <button class="modal-close is-large" aria-label="close"></button>
    </div>

    <style media="screen">
    #pageTopBtn {
      display: none;
      position: fixed;
      bottom: 20px;
      right: 20px;
      z-index: 99;
    }
    #homeBtn {
      position: fixed;
      bottom: 20px;
      left: 20px;
      z-index: 99;
    }
    </style>
    <script type="text/javascript">
    var countdownInterval;

    setTimeout(showFirstAdModal, 5000);

    function showFirstAdModal(){
      if ($("#first-ad-modal").length) {
        // $("html").addClass("is-clipped");
        $("#img-modal").removeClass("is-active");
        $("#first-ad-modal").addClass("is-active");
        if ($("#first-ad-modal > #ad-modal-vid").length)
          document.getElementById("ad-modal-vid").play();

          countdownInterval = setInterval(countdown, 1000);
      }
      setTimeout(showSecondAdModal, 150000);
    }

    function showSecondAdModal(){
      $(".countdown").text(5);

      if ($("#second-ad-modal").length) {
        // $("html").addClass("is-clipped");
        $("#img-modal").removeClass("is-active");
        $("#second-ad-modal").addClass("is-active");
        if ($("#second-ad-modal > #ad-modal-vid").length)
          document.getElementById("ad-modal-vid").play();

        $(".countdown-wrap").removeClass("hidden");
        $(".ad-close").addClass("hidden");
        countdownInterval = setInterval(countdown, 1000);
      }
    }

    var countVal = 5;
    function countdown() {
      countVal--;
      $(".countdown").text(countVal);
      if (countVal == 0) {
        $(".countdown-wrap").addClass("hidden");
        $(".ad-close").removeClass("hidden");
        countVal = 5;
        clearInterval(countdownInterval);
      }
    }

    let arr = document.querySelectorAll('img');
    for (var i = 0; i < arr.length; i++) {
      $(arr[i]).click(function(){
        let imgsrc = $(this).attr('src');
        $('.modal-img').attr("src", imgsrc);
        // $("html").addClass("is-clipped");
        $("#img-modal").addClass("is-active");
      });
    }

    var pgTopBtn = document.getElementById("pageTopBtn");

    window.onscroll = function() {scrollFunction()};

    function scrollFunction() {
      if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        pgTopBtn.style.display = "block";
      } else {
        pgTopBtn.style.display = "none";
      }
    }

    function topFunction() {
      document.body.scrollTop = 0;
      document.documentElement.scrollTop = 0;
    }

    </script>
    </body>
</html>
