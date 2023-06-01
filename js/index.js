//index.js

// Mobile menu
const burgerIcon = document.querySelector('#burgerMenu');
const navbarMenu = document.querySelector('#navbarMenu');

burgerIcon.addEventListener('click', () => {
    navbarMenu.classList.toggle('is-active');
    burgerIcon.classList.toggle('is-active');
});

function r_paper(a_id){
  $.post( "user.php", { func:'r-p',cd:a_id },function(data) {
      if (data == "OK") window.location.href = "index.php";
  },"json");
}

$(document).ready(function(){

  // Show AD on home page
  setTimeout(showHomeAdModal, 3000);

  var user_locate,index_locate;

  if (window.location.href.indexOf("papers") > -1) {
    user_locate = "../../user.php";
    index_locate = "../../index.php";
  } else if (window.location.href.indexOf("settings") > -1) {
    user_locate = "../user.php";
    index_locate = "../index.php";
  } else {
    user_locate = "user.php";
    index_locate = "index.php";
  }

  $(".confirm-btn").click(function(){
    var q1 = $("#qinput1").val();
    var q2 = $("#qinput2").val();
    var q3 = $("#qinput3").val();
    var q4 = $("#qinput4").val();
    var q5 = $("#qinput5").val();

    $.post( "user.php", { func:'a-qz',q1:q1,q2:q2,q3:q3,q4:q4,q5:q5 },function(data) {
        if (data == "OK") window.location.href = "index.php?r=win";
    },"json");
  });

  $(".home-btn").click(function(){
    window.location.href = index_locate;
  });

  //Signin & signup modals
  $("#nw-acnt-btn").click(function(){
    $('.sin-modal').css("display","none");
    $('.sup-modal').css("display","inline");
  });
  $('.close-modal').click(function(){
    $('.sup-modal').css("display","none");
    $('.sin-modal').css("display","inline");
  });
  $('.modal-close').click(function(){
    $('.sup-modal').css("display","none");
    $('.sin-modal').css("display","inline");
  });

  $(".modal-button").click(function() {
    var target = $(this).data("target");
    $("html").addClass("is-clipped");
    $(target).addClass("is-active");
  });

  //close the modals
  $(".modal-close").click(function() {
    $("html").removeClass("is-clipped");
    $(this).parent().removeClass("is-active");
  });

  $(".ad-close").click(function() {
    $("html").removeClass("is-clipped");
    $(this).parent().removeClass("is-active");
    let uri = window.location.href;
    if(!uri.includes("papers"))
      showQuizModalNotifi();
  });

  $("#sign-modal .modal-close").click(function() {
    window.location.href = "./index.php";
  });

  $(".close-modal").click(function() {
    $("html").removeClass("is-clipped");
    $(".modal-close").parent().removeClass("is-active");
  });

  $("#img-modal .modal-background").click(function() {
    $("html").removeClass("is-clipped");
    $(this).parent().removeClass("is-active");
  });

  function showQuizModalNotifi(){
    $("html").addClass("is-clipped");
    $("#quiz-modal").addClass("is-active");
  }

  function showHomeAdModal(){
    if ($("#home-ad-modal").length) {
      $("html").addClass("is-clipped");
      $("#home-ad-modal").addClass("is-active");

      let countdownInterval = setInterval(countdown, 1000);
    }
  }

  function countdown() {
    let val = parseInt($(".countdown").text());
    $(".countdown").text(--val);
    if (val == 0) {
      $(".countdown-wrap").addClass("hidden");
      $(".ad-close").removeClass("hidden");
    }
  }

  $('#prevbtn').removeClass('enabled');

  $('#nextbtn').click(function(){
      var x = document.getElementById("q1");
      if (window.getComputedStyle(x).display !== "none") {
        $('#q1').css('display','none');
        $('#q2').css('display','block');
        $('.quiz-progress').attr('value','20');
        $('#prevbtn').addClass('enabled');
        return;
      }
      var x = document.getElementById("q2");
      if (window.getComputedStyle(x).display !== "none") {
        $('#q2').css('display','none');
        $('#q3').css('display','block');
        $('.quiz-progress').attr('value','40');
        return;
      }
      var x = document.getElementById("q3");
      if (window.getComputedStyle(x).display !== "none") {
        $('#q3').css('display','none');
        $('#q4').css('display','block');
        $('.quiz-progress').attr('value','60');
        return;
      }
      var x = document.getElementById("q4");
      if (window.getComputedStyle(x).display !== "none") {
        $('#q4').css('display','none');
        $('#q5').css('display','block');
        $('.quiz-progress').attr('value','80');
        return;
      }
      var x = document.getElementById("q5");
      if (window.getComputedStyle(x).display !== "none") {
        $('.quiz-progress').attr('value','100');

          setTimeout(function(){
            if (window.getComputedStyle(x).display !== "none") {
              $('.npbtndiv').css('display','none');
              $('#q5').css('display','none');
              $('.quiz-progress').css('display','none');
              // $('.confirm-quiz').css('display','block');
              showQuizCompletedModal();
            }
          },1000);
        return;
      }
  });

  function showQuizCompletedModal(){
      $("html").addClass("is-clipped");
      $("#quiz-completed-modal").addClass("is-active");
  }

  $('#prevbtn').click(function(){
    var x = document.getElementById("q2");
    if (window.getComputedStyle(x).display !== "none") {
      $('#q2').css('display','none');
      $('#q1').css('display','block');
      $('.quiz-progress').attr('value','0');
      $('#prevbtn').removeClass('enabled');
      return;
    }
    var x = document.getElementById("q3");
    if (window.getComputedStyle(x).display !== "none") {
      $('#q3').css('display','none');
      $('#q2').css('display','block');
      $('.quiz-progress').attr('value','20');
      return;
    }
    var x = document.getElementById("q4");
    if (window.getComputedStyle(x).display !== "none") {
      $('#q4').css('display','none');
      $('#q3').css('display','block');
      $('.quiz-progress').attr('value','40');
      return;
    }
    var x = document.getElementById("q5");
    if (window.getComputedStyle(x).display !== "none") {
      $('#q5').css('display','none');
      $('#q4').css('display','block');
      $('.quiz-progress').attr('value','60');
      return;
    }
  });

  //re-answer
  $('.reanz-btn').click(function(){
    $("html").removeClass("is-clipped");
    $("#quiz-completed-modal").removeClass("is-active");

    $('#q1').css('display','block');
    $('.quiz-progress').attr('value','0');
    $('.quiz-progress').css('display','block');
    $('.npbtndiv').css('display','block');
    $('#prevbtn').removeClass('enabled');
    return;
  });
  //End of quiz page js

  //check whether the email is valid
  function isValidEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
  }
  //AJAX events
  var nvEmail = false;

  $('#sup-email').focusout(function(){
    let e = $(this).val();
    if (e != '') {
      if(isValidEmail(e)){
        $('#sup-email-warning').text('');
        $.post(user_locate,{func:'v-em',em:e},function(data,status,xhr){
          if (data == 0) {
            $('#sup-email-warning').text('මෙම ඊමේල් ලිපිනය දැනටමත් ලියාපදිංචිව ඇත!');
            nvEmail = true;
          } else {
            $('#sup-email').removeClass('is-danger');
            $('#sup-email-warning').text('');
            nvEmail = false;
          }
        },"json");
      } else {
        nvEmail = true;
        $('#sup-email-warning').text('ඊමේල් ලිපිනය වැරදියි!');
      }
    } else {
      nvEmail = true;
    }
  });

  $('#sup-button').click(function(event){
    $('#sup-re-pswrd').removeClass('is-danger');
    $('#sup-pswrd').removeClass('is-danger');
    $('#sup-email').removeClass('is-danger');
    $('#sup-pswrd-warning').text('');

    if (nvEmail) {
      $('#sup-email').addClass('is-danger');
      // event.preventDefault();
    } else {
      $('#sup-email').removeClass('is-danger');
      let e = $('#sup-email').val();
      let p = $('#sup-pswrd').val();
      let rp = $('#sup-re-pswrd').val();
      if (p == rp) {
        if (p.length > 8) {
          $('#sup-re-pswrd').removeClass('is-danger');
          $('#sup-pswrd').removeClass('is-danger');
          $('#sup-pswrd-warning').text('');

          $.post(user_locate,{func:'s-up',em:e,pw:p},function(data,status,xhr){
            if (status == 'success' & data == 'IN') {
              $('#sup-email').val('');
              $('#sup-pswrd').val('');
              $('#sup-re-pswrd').val('');

              $('.sin-modal').css("display","none");
              $('.sup-modal').css("display","none");
              $('.close-modal').css("display","none");

              $('.sup-success-message').css('display','inline');
              $('.confirm-sup-btn').css('display','inline');
              $('.confirm-sup-btn').addClass('is-fullwidth');
            }
          },"json");
        } else {
          $('#sup-pswrd').addClass('is-danger');
          $('#sup-pswrd-warning').text('රහස් පදය අකුරු 8 කට වඩා වැඩි විය යුතුයි!');
        }
      } else {
        $('#sup-re-pswrd').addClass('is-danger');
        $('#sup-pswrd-warning').text('');
      }
    }
  });
  //
  $('.confirm-sup-btn').click(function(){
    window.location.reload();
  });
  //
  $('.lg-out-btn').click(function(){

    $.post(user_locate,{func:'s-ot'},function(data,status,xhr){
      if (status == 'success' & data == 'OUT') {
        window.location.reload();
        window.location.reload();
      }
    },"json");
  });

  $('#sin-button').click(function(){
    let e = $('#sin-email').val();
    let p = $('#sin-pswrd').val();

  if (e !== '' & p !== '') {
    if (p.length >= 8) {
      $.post(user_locate,{func:'s-in',em:e,pw:p},function(data,status,xhr){
        if (status == 'success') {
          if (data == "IN") {
            $('#sin-warning').text('');
            $('#sin-email').removeClass('is-danger');
            $('#sin-pswrd').removeClass('is-danger');
            window.location.reload();
          } else if (data == 'NOT') {
            $('#sin-email').addClass('is-danger');
            $('#sin-pswrd').addClass('is-danger');
            $('#sin-warning').text('ඔබ ඇතුලත් කල ඊමේල් ලිපිනය හෝ රහස් පදය වැරදියි.!');
          }
        }
      },"json");
    } else {
      $('#sin-email').addClass('is-danger');
      $('#sin-pswrd').addClass('is-danger');
      $('#sin-warning').text('ඔබ ඇතුලත් කල ඊමේල් ලිපිනය හෝ රහස් පදය වැරදියි.!');
    }
  } else {
    $('#sin-warning').text('');
    $('#sin-email').addClass('is-danger');
    $('#sin-pswrd').addClass('is-danger');
  }

  });

  $("#pr-button").click(function(){
    var ud = $("#uid").val();
    var wd = $("#wid").val();
    var mb = $("#pr-mobile").val();
    var nm = $("#pr-name").val();

    $.post( "user.php", { func:'u-w',ud:ud,wd:wd,mb:mb,nm:nm },function(data, status) {
        if (status == 'success' & data == "OK") window.location.reload();
    });
  });

  $("#upd-button").click(function(){
    var p = $("#upd-pswrd").val();
    var n = $("#upd-name").val();
    var m = $("#upd-mob").val();
    var a = $("#upd-addr").val();

    if (p.length >= 8) {
      $('#upd-pswrd').removeClass('is-danger');
      $('#upd-pswrd-warning').text('');

      $.post(user_locate,{func:'u-u',pw:p,nm:n,mb:m,addr:a},function(data,status,xhr){
        if (status == 'success' & data == 'IN')
          $('#upd-success-message').removeClass("hide");
      });

    } else {
      $('#upd-pswrd').addClass('is-danger');
      $('#upd-pswrd-warning').text('රහස් පදය අකුරු 8 කට වඩා වැඩි විය යුතුයි!');
    }

  });

});

document.addEventListener('DOMContentLoaded', () => {
  (document.querySelectorAll('.notification .delete') || []).forEach(($delete) => {
    const $notification = $delete.parentNode;

    $delete.addEventListener('click', () => {
      $($notification).addClass("hide");
    });
  });
});
