<?php
require_once "func.php";

session_start();

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Denumina CPanel</title>
  <link rel="icon" type="image/png" sizes="32x32" href="./favicon.png">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.2/css/bulma.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script defer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script>
  <script src="./control.js"></script>
  <link rel="stylesheet" href="./style.css">
</head>
<body>
  <section class="section">
    <div class="container">

    <?php
      if(isset($_SESSION["admin-loggedin"]) && $_SESSION["admin-loggedin"] === true){
      $codes = get_papers();
    ?>
    <div class="content">
      <select id="paperList" class="" name="paperList">
        <option value="">Select Paper</option>
        <?php for ($i=0; $i < count($codes); $i++) { ?>
          <?php if ($codes[$i]['status'] == 'ON') { ?>
            <option value="<?= $codes[$i]['status'] ?>" style="background-color:green"><?= $codes[$i]['code'] ?></option>
          <?php } else { ?>
            <option value="<?= $codes[$i]['status'] ?>"><?= $codes[$i]['code'] ?></option>
          <?php } ?>
        <?php } ?>
      </select>
      <button id="act-pp-btn" type="button" name="button" style="display:none;color:blue">Enable</button>
      <button id="dct-pp-btn" type="button" name="button" style="display:none;color:red">Disable</button>
      <button id="nw-pp-btn" type="button" name="button" style="color:green">New Paper</button>
      <button id="nw-usr-btn" type="button" name="button" style="color:green">New User</button>
      <button id="pg-cr-btn" type="button" name="button" style="color:purple">DIY-Page Creation Tool</button>
      <button id="ad-cr-btn" type="button" name="button" style="color:purple">DIY-Ad Creation Tool</button>
      <button id="lg-out-btn" type="button" name="button" style="color:red">Logout</button>
      <span id="re-btn" class="fas fa-sync-alt" style="cursor:pointer;margin-left:5px;" onclick="window.location.reload();"></span>
      <span id="usr-details" style="background-color:green;display:none;color:white;padding:2px"></span>
      <br/>
      <br/>
      <div class="columns">
        <div class="column is-8">
          <h3>Answers</h3>
          <table id="anz-table" class="table table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
            <thead>
              <tr>
                <th>EMAIL</th>
                <th>A1</th>
                <th>A2</th>
                <th>A3</th>
                <th>A4</th>
                <th>A5</th>
                <th></th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
        </div>
        <div class="column is-4">
          <h3>Winners Selection</h3>
          <table id="sel-table" class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
            <thead>
              <tr>
                <th></th>
                <th>EMAIL</th>
                <th>NOWs</th>
                <th>PICK</th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
          <button id="randomiseBtn" type="button" name="button" onclick="randomiseData()">Randomise</button>
        </div>
      </div>
    </div>
    <?php } else { ?>

    <div class="columns">
      <div class="column is-4"></div>
      <div class="column is-4">
        <br><br>
        <h1 class="title has-text-centered">Denumina Dashboard</h2>
        <div class="field">
          <p class="control has-icons-left has-icons-right">
            <input id="sin-email" class="input" type="email" placeholder="Email">
            <span class="icon is-small is-left">
              <i class="fas fa-envelope"></i>
            </span>
            <span class="icon is-small is-right">
              <i class="fas fa-check"></i>
            </span>
          </p>
        </div>
        <div class="field">
          <p class="control has-icons-left">
            <input id="sin-pswrd" class="input" type="password" placeholder="Password">
            <span class="icon is-small is-left">
              <i class="fas fa-lock"></i>
            </span>
          </p>
        </div>
        <div class="field">
          <p class="control">
            <button id="sin-button" class="button is-dark is-fullwidth is-outlined">
              Login
            </button>
          </p>
        </div>
      </div>
      <div class="column is-4"></div>
    </div>

    <?php } ?>

    </div>
  </section>

  <script type="text/javascript">
  var cd_select = document.getElementById('paperList');
  var selectedAnzData;

  var toBeRandomized = function(input){
    var isCorrect = (input.checked) ? 1 : 0;

    $.post('./cquery.php',{ func:'u-a', aid:input.value, crt: isCorrect},function(data,status,xhr) {
      if (data == 'OK') {
        var cd = cd_select.options[cd_select.selectedIndex].text;

        $.post('./cquery.php',{ func:'g-c-a', code:cd },function(data,status,xhr) {
          $('#sel-table').css('display','table');
          $('#randomiseBtn').css('display','inline');
          $('#sel-table > tbody').empty();

          selectedAnzData = JSON.parse(data);
          var x = 1;

          selectedAnzData.forEach((item, i) => {
            var wonornothtml = '<tr>';
            var count = 0;

            $.post('./cquery.php',{ func:'n-w', uid:item.uid },function(data,status,xhr) {
              count = parseInt(data);
              if (count > 0) {
                wonornothtml = '<tr class="won">';
              }
              $('#sel-table > tbody:last-child').append('' + wonornothtml
              + '<td>'+ (x++) +'</td>'
              + '<td>'+ item.email +'</td>'
              + '<td>'+ count +'</td>'
              + '<td class="last-td"><input type="checkbox" name="" value="'+ item.uid +'" onchange="toBeSelected(this)"></td></tr>');
            });

          });
        });
      }
    });
  }

  var toBeSelected = function(input){
    var cd = cd_select.options[cd_select.selectedIndex].text;
    $.post('./cquery.php',{ func:'a-w', uid:input.value, paper: cd},function(data,status,xhr) {
      if (status == 'success') {
        let trElem = input.parentNode.parentNode;
        (data == '1') ? (trElem.classList.remove('won'),trElem.classList.add('win')) : trElem.classList.remove('win');
      }
    });
  }

  var randomiseData = function(){
    randomisedAnzData = shuffle(selectedAnzData);
    $('#sel-table').css('display','table');
    $('#randomiseBtn').css('display','inline');
    $('#sel-table > tbody').empty();

    var x = 1;
    randomisedAnzData.forEach((item, i) => {
      var wonornothtml = '<tr>';
      var count = 0;

      $.post('./cquery.php',{ func:'n-w', uid:item.uid },function(data,status,xhr) {
        count = parseInt(data);
        if (count > 0) {
          wonornothtml = '<tr class="won">';
        }
        if (i <= 10) {
          $('#sel-table > tbody:last-child').append(wonornothtml +
          '<td>'+ (x++) +'</td>' +
          '<td>'+ item.email +'</td>' +
          '<td>'+ count +'</td>' +
          '<td class="last-td"><input type="checkbox" name="" value="'+ item.uid +'" onchange="toBeSelected(this)"></td></tr>');
        }
      });

    });
  }

  function shuffle(array) {
    var currentIndex = array.length,  randomIndex;
    // While there remain elements to shuffle...
    while (0 !== currentIndex) {
      // Pick a remaining element...
      randomIndex = Math.floor(Math.random() * currentIndex);
      currentIndex--;
      // And swap it with the current element.
      [array[currentIndex], array[randomIndex]] = [array[randomIndex], array[currentIndex]];
    }
    return array;
  }

  </script>

</body>
</html>
