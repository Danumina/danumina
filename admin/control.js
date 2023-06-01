$(document).ready(function(){

  $('#sin-button').click(function(){
    let e = $('#sin-email').val();
    let p = $('#sin-pswrd').val();
    if (e !== '' & p !== '') {
      $.post('./cquery.php',{func:'s-in',em:e,pw:p},function(data,status,xhr){
        if (status == 'success') {
          if (data == "IN") {
            window.location.reload();
          } else if (data == 'NOT') {
            $('#sin-email').addClass('is-danger');
            $('#sin-pswrd').addClass('is-danger');
          }
        }
      },"json");
    }
  });

  $('#lg-out-btn').click(function(){
    var leave = confirm('You want to leave?');
    if (leave) {
      $.post('./cquery.php',{func:'s-ot'},function(data,status,xhr){
        if (status == 'success' & data == 'OUT') {
          window.location.reload();
        }
      },"json");
    }
  });

  $('#nw-pp-btn').click(function(){
    let pList = document.querySelector('#paperList');
    var pp = prompt("Enter paper code here! FYI : " + pList.options[pList.options.length - 1].text + " is the latest.");
    if (pp != null) {
      $.post('./cquery.php',{func:'n-pp', p:pp},function(data,status,xhr){
        if (status == 'success' & data == 'IN') {
          window.location.reload();
        }
      },"json");
    }
  });

  $('#nw-usr-btn').click(function(){
    var nm = prompt("Enter name of user to generate username and password!");
    var pw = generatePassword();
    var uscd = generateUserCode();
    var usrnm = nm + uscd + "@denumina.lk";
    if (nm != null) {
      $.post('./cquery.php',{func:'n-usr', usr:usrnm, pw:pw},function(data,status,xhr){
        if (status == 'success' & data == 'IN') {
          $("#usr-details").html("New user created with username : <b>"+ usrnm +"</b> and the password : <b>"+ pw +"</b> !");
          $("#usr-details").css("display","inline");
        }
      });
    }
  });

  $('#paperList').change(function(){
    var cd = this.options[this.selectedIndex].text;
    var status = cd_select.options[cd_select.selectedIndex].value;

    document.querySelector('#act-pp-btn').addEventListener("click", function() {
      setStatus(cd, 'ON');
    });

    document.querySelector('#dct-pp-btn').addEventListener("click", function() {
      var disable = confirm('Disable paper?');
      if (disable) setStatus(cd, 'OFF');
    });

    if (status == 'ON') {
      document.querySelector('#dct-pp-btn').style.display = "inline";
      document.querySelector('#act-pp-btn').style.display = "none",

      $.post('./cquery.php',{ func:'g-a', code:cd},function(data,status,xhr) {
        $('#anz-table').css('display','table');
        $('#anz-table > tbody').empty();

        data.forEach((item, i) => {
          var checked = (item.correct == "1") ? 'checked' : '';
          $('#anz-table > tbody:last-child').append('<tr>' +
          '<td>'+ item.email +'</td>' +
          '<td>'+ item.a1 +'</td>' +
          '<td>'+ item.a2 +'</td>' +
          '<td>'+ item.a3 +'</td>' +
          '<td>'+ item.a4 +'</td>' +
          '<td>'+ item.a5 +'</td>' +
          '<td class="last-td"><input type="checkbox" name="" value="'+ item.aid +'" '+ checked +' onchange="toBeRandomized(this)"></td></tr>');
        });

      },"json");

    } else {
      document.querySelector('#act-pp-btn').style.display = "inline";
      document.querySelector('#dct-pp-btn').style.display = "none";
      $('#anz-table').css('display','none');
      $('#anz-table > tbody').empty();
    }
  });

  $('#pg-cr-btn').click(function(){
    let paperListElem = document.querySelector('#paperList');
    let cd = paperListElem.options[paperListElem.selectedIndex].text;
    if (cd != 'Select Paper') {
      window.location.href = "pagecreation.php?p="+cd;
    } else {
      alert('Please select a paper');
    }
  });

  $('#ad-cr-btn').click(function(){
    let paperListElem = document.querySelector('#paperList');
    let cd = paperListElem.options[paperListElem.selectedIndex].text;
    if (cd != 'Select Paper') {
      window.location.href = "adcreation.php?p="+cd;
    } else {
      alert('Please select a paper');
    }
  });

  // if (document.querySelector('#pageList')) {
  //   let pgListElem = document.querySelector('#pageList');
  //   pgListElem.options[pgListElem.selectedIndex].value;
  // }

});

function generatePassword() {
    var length = 8,
        charset = "abcdefghijkmnpqrstuvwxyz123456789",
        retVal = "";
    for (var i = 0, n = charset.length; i < length; ++i) {
        retVal += charset.charAt(Math.random() * n);
    }
    return retVal;
}

function generateUserCode() {
    var length = 3,
        charset = "abcdefghijkmnpqrstuvwxyz123456789",
        retVal = "";
    for (var i = 0, n = charset.length; i < length; ++i) {
        retVal += charset.charAt(Math.random() * n);
    }
    return retVal;
}

var setStatus = function(cd, o){
  $.post('./cquery.php',{ func:'s-p-s', code:cd, status:o },function(data,status,xhr) {
    if(data == 'OK'){
      window.location.reload();
    }
  });
}
