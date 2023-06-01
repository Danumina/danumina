var count = 2;
var content = "";
var selectedColumnId = "0";

$(document).ready(function(){

// START MENU BAR
  $('#cr-dir-btn').click(function() {
    $.post('./cquery.php',{ func:'cr-d', code:getUrlParams('p') },function(data,status,xhr) {
      if(data == 'OK'){
        window.location.reload();
      }
    });
  });

  $('#rm-dir-btn').click(function() {
    let rem = confirm("Do you really wanna remove the directory : " + getUrlParams('p') + ' ?');
    if (rem) {
      $.post('./cquery.php',{ func:'rm-d', code:getUrlParams('p') },function(data,status,xhr) {
        if(data == 'OK'){
          window.location.reload();
        }
      });
    }
  });

  $('#pageList').change(function(){
    document.querySelector('.content').innerHTML = "";
    var a = this.options[this.selectedIndex].value;
    if (a != '0') {
      $('#cr-pg-btn').removeClass('hidden');
    } else {
      $('#cr-pg-btn').addClass('hidden');
    }
  });

  $('#cr-pg-btn').click(function(){
    let pgListElem = document.querySelector('#pageList');
    let pg = pgListElem.options[pgListElem.selectedIndex].value;
    if (pg != '0') {
      $.post('./cquery.php',{ func:'cr-tmp-p', page:pg, code:getUrlParams('p') },function(data,status,xhr) {
        if(data == 'OK'){
          window.location.reload();
        }
      });
    } else {
      alert("Please select an article.")
    }
  });

  $('#pre-btn').click(function(){
    let pgListElem = document.querySelector('#pageList');
    let pg = pgListElem.options[pgListElem.selectedIndex].value;
    let code = getUrlParams('p');

    if (pg == '0') {
      alert("Please select a page");
    } else {
      createContent();
      $.post('./cquery.php',{ func:'pr-p', page:pg, code:code, content:content },function(data,status,xhr) {
        if(data == 'OK'){
          content = "";
          window.open('../papers/' + code + '/' + pg + '.temp.php');
        }
      });
    }
  });

  $('#ad-0-btn').click(function(){
    insOrModAdvert(1);
  });

  $('#ad-1-btn').click(function(){
    let pgListElem = document.querySelector('#ad-pageList');
    let pg = pgListElem.options[pgListElem.selectedIndex].value;
    if (pg == '0') {
      alert("Please select a page");
    } else {
      insOrModAdvert(2);
    }
  });

  $('#ad-2-btn').click(function(){
    let pgListElem = document.querySelector('#ad-pageList');
    let pg = pgListElem.options[pgListElem.selectedIndex].value;
    if (pg == '0') {
      alert("Please select a page");
    } else {
      insOrModAdvert(3);
    }
  });

  function insOrModAdvert(type) {
    let code = getUrlParams('p');
    let rem = confirm("Do you really wanna save the Ad ?");
    if (rem) {
      let pgListElem = document.querySelector('#ad-pageList');
      let pg = pgListElem.options[pgListElem.selectedIndex].value;
      let description;
      let media;
      let quote;
      let author;

      if (type == 1) {
        pg = "home";
        media = $("#image-0");
        description = $("#text-0").val();
        quote = $("#text-0-1").val();
        author = $("#text-0-2").val();
      } else if (type == 2) {
        media = $("#image-1");
        description = $("#text-1").val();
        quote = $("#text-1-1").val();
        author = $("#text-1-2").val();
      } else if (type == 3) {
        media = $("#image-2");
        description = $("#text-2").val();
        quote = $("#text-2-1").val();
        author = $("#text-2-2").val();        
      }

      let adsuccess = uploadMedia(media, pg, description, quote, author, type);
      if (adsuccess) alert("Ad inserted successfully !");
    }
  }

  //upload media
  function uploadMedia(elem, pg, desc, quote, author, type){
    var file_data = $(elem).prop('files')[0];
    var form_data = new FormData();
    form_data.append('file', file_data);
    form_data.append('page', pg);
    form_data.append('code', getUrlParams('p'));
    form_data.append('type', type);
    form_data.append('description', desc);
    form_data.append('quote', quote);
    form_data.append('author', author);

    $.ajax({
        url: 'uploadMedia.php', // <-- point to server-side PHP script
        dataType: 'text',  // <-- what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        success: function(response){
          return true;
        }
    });
  }

  $('#sub-btn').click(function() {
    let code = getUrlParams('p');
    let rem = confirm("Do you really wanna save the page to the " + code + ' paper ?');
    if (rem) {
      let pgListElem = document.querySelector('#pageList');
      let pg = pgListElem.options[pgListElem.selectedIndex].value;
      $.post('./cquery.php',{ func:'cr-p', page:pg, code:code },function(data,status,xhr) {
        if(data == 'OK'){
          alert("New article created.!")
        }
      });
    }
  });

// END MENU BAR

// START DIY

  $("#heading-btn").click(function(){
    if (document.querySelectorAll("[data-id='1']")[0] == undefined & isArticleSelected()) {
      var x = document.createElement("INPUT");
      x.setAttribute("type", "text");
      x.setAttribute("class", "header-input input full-width is-primary");
      x.setAttribute("placeholder", "Heading");
      x.setAttribute("data-id", 1);
      x.setAttribute("style", "margin-top:10px");
      document.querySelector('.content').prepend(x);
    }
    if (!isArticleSelected()) {
      alert("Please select a article.");
    }
  });

  $("#row-btn").click(function(){
    if (isArticleSelected()) {
      let rowList = document.querySelector('#rowList');
      var a = rowList.options[rowList.selectedIndex].value;
      if (a != '0') {
        insertRow(rowList.options[rowList.selectedIndex].text, count);
        count++;
      } else {
        alert('Please select a row style.');
      }
    } else {
      alert("Please select a article.");
    }
  });

  $("#paragraph-btn").click(function(){
    if (isArticleSelected()) {
      var q = document.createElement("DIV");
      q.setAttribute("data-id", count);
      q.setAttribute("style", "background:#eee;padding:5px;margin-top:5px");

      var d = document.createElement("BUTTON");
      d.setAttribute("class", "delete");
      d.setAttribute("id", count);
      d.setAttribute("onclick", "deleteElement(this.id);");

      var x = document.createElement("TEXTAREA");
      x.setAttribute("class", "textarea full-width is-primary");
      x.setAttribute("placeholder", "Paragraph");
      x.setAttribute("data-id", count + '_1');

      q.appendChild(d);
      q.appendChild(x);

      if (selectedColumnId != "0") {
        selectedColumn = document.querySelectorAll("[data-id='"+selectedColumnId+"']")[0];
        selectedColumn.appendChild(q);
      } else {
        document.querySelector('.content').appendChild(q);
      }
      count++;
    } else {
      alert("Please select a article.");
    }
  });

  $("#title-btn").click(function(){
    if (isArticleSelected()) {
      var q = document.createElement("DIV");
      q.setAttribute("data-id", count);
      q.setAttribute("style", "background:#eee;padding:5px;margin-top:5px");

      var d = document.createElement("BUTTON");
      d.setAttribute("class", "delete");
      d.setAttribute("id", count);
      d.setAttribute("onclick", "deleteElement(this.id);");

      var x = document.createElement("INPUT");
      x.setAttribute("type", "text");
      x.setAttribute("class", "title-input input full-width is-primary");
      x.setAttribute("placeholder", "Sub-Heading");
      x.setAttribute("data-id", count + '_1');

      q.appendChild(d);
      q.appendChild(x);

      if (selectedColumnId != "0") {
        selectedColumn = document.querySelectorAll("[data-id='"+selectedColumnId+"']")[0];
        selectedColumn.appendChild(q);
      } else {
        document.querySelector('.content').appendChild(q);
      }
      count++;
    } else {
      alert("Please select a article.");
    }
  });

  $("#img-btn").click(function(){
    if (isArticleSelected()) {
      var q = document.createElement("DIV");
      q.setAttribute("data-id", count);
      q.setAttribute("style", "background:#eee;padding:5px;margin-top:5px");

      var d = document.createElement("BUTTON");
      d.setAttribute("class", "delete");
      d.setAttribute("id", count);
      d.setAttribute("onclick", "deleteElement(this.id);");

      var x = document.createElement("INPUT");
      x.setAttribute("type", "file");
      x.setAttribute("class", "image-select");
      x.setAttribute("data-id", count + '_1');
      x.setAttribute("onchange", "uploadImage(this)");
      x.setAttribute("accept", "image/*");

      var y = document.createElement("INPUT");
      y.setAttribute("type", "text");
      y.setAttribute("class", "image-caption input full-width is-primary");
      y.setAttribute("placeholder", "Caption");
      y.setAttribute("data-id", count + '_2');

      q.appendChild(d);
      q.appendChild(x);
      q.appendChild(y);

      if (selectedColumnId != "0") {
        selectedColumn = document.querySelectorAll("[data-id='"+selectedColumnId+"']")[0];
        selectedColumn.appendChild(q);
      } else {
        document.querySelector('.content').appendChild(q);
      }
      count++;
    } else {
      alert("Please select a article.");
    }
  });

  $("#box-btn").click(function(){
    if (isArticleSelected()) {
      var q = document.createElement("DIV");
      q.setAttribute("data-id", count);
      q.setAttribute("style", "background:#eee;padding:5px;margin-top:5px");

      var d = document.createElement("BUTTON");
      d.setAttribute("class", "delete");
      d.setAttribute("id", count);
      d.setAttribute("onclick", "deleteElement(this.id);");

      var e = document.createElement("DIV");
      e.setAttribute("class", "box-div");

      var s = document.createElement("INPUT");
      s.setAttribute("type", "text");
      s.setAttribute("class", "date-input input full-width is-primary");
      s.setAttribute("placeholder", "Date");
      s.setAttribute("data-id", count + '_1');

      var x = document.createElement("INPUT");
      x.setAttribute("type", "file");
      x.setAttribute("class", "image-select");
      x.setAttribute("data-id", count + '_2');
      x.setAttribute("onchange", "uploadImage(this)");
      x.setAttribute("accept", "image/*");

      var y = document.createElement("INPUT");
      y.setAttribute("type", "text");
      y.setAttribute("class", "image-caption input full-width is-primary");
      y.setAttribute("placeholder", "Image caption");
      y.setAttribute("data-id", count + '_3');

      var z = document.createElement("TEXTAREA");
      z.setAttribute("class", "textarea full-width is-primary");
      z.setAttribute("placeholder", "Paragraph");
      z.setAttribute("data-id", count + '_4');

      e.appendChild(s);
      e.appendChild(x);
      e.appendChild(y);
      e.appendChild(z);

      q.appendChild(d);
      q.appendChild(e);

      if (selectedColumnId != "0") {
        selectedColumn = document.querySelectorAll("[data-id='"+selectedColumnId+"']")[0];
        selectedColumn.appendChild(q);
      } else {
        document.querySelector('.content').appendChild(q);
      }
      count++;
    } else {
      alert("Please select a article.");
    }
  });


//END DIY
});

//image upload when select
function uploadImage(elem) {
  var file = $(elem).prop("files")[0];
  let pgListElem = document.querySelector('#pageList');
  let pg = pgListElem.options[pgListElem.selectedIndex].value;

  var file_data = $(elem).prop('files')[0];
  var form_data = new FormData();
  form_data.append('file', file_data);
  form_data.append('page', pg);
  form_data.append('code', getUrlParams('p'));
  $.ajax({
      url: 'upload.php', // <-- point to server-side PHP script
      dataType: 'text',  // <-- what to expect back from the PHP script, if anything
      cache: false,
      contentType: false,
      processData: false,
      data: form_data,
      type: 'post',
      success: function(response){}
  });
}

function putImageHere(elem){
  let arr = elem.value.split("\\");
  let pgListElem = document.querySelector('#pageList');
  let pg = pgListElem.options[pgListElem.selectedIndex].value;
  let str = "<figure><img src='./images/"+ pg +"/"+ arr[2] +"'><figcaption>"+ elem.nextElementSibling.value +"</figcaption></figure>";
  return str;
}

function getPrevNextBtnTexts(){
  let pgListElem = document.querySelector('#pageList');
  let pg = pgListElem.options[pgListElem.selectedIndex].value;
  let arr;

  switch (pg) {
    case "biology":
      arr = ["විදුනැණ","ප්‍රකට චරිත","ජෛවගෝලය"];
      break;
    case "biography":
      arr = ["ජෛවගෝලය","පුදුම හිතෙන තැන්","ප්‍රකට චරිත"];
      break;
    case "country":
      arr = ["පුදුම හිතෙන තැන්","අද වැනි දවසක","රටක වතගොත"];
      break;
    case "culture":
      arr = ["ලෝක ඉතිහාසය","විදුනැණ","සංස්කෘතිකාංග"];
      break;
    case "doyouknow":
      arr = ["අද වැනි දවසක","කියන්න දිනන්න","ඔබ දන්නවාද?"];
      break;
    case "history":
      arr = ["ක්‍රීඩා","සංස්කෘතිකාංග","ලෝක ඉතිහාසය"];
      break;
    case "places":
      arr = ["ප්‍රකට චරිත","රටක වතගොත","පුදුම හිතෙන තැන්"];
      break;
    case "sports":
      arr = ["ලොව වටා තතු","ලෝක ඉතිහාසය","ක්‍රීඩා"];
      break;
    case "tech":
      arr = ["සංස්කෘතිකාංග","ජෛවගෝලය","විදුනැණ"];
      break;
    case "today":
      arr = ["රටක වතගොත","ඔබ දන්නවාද?","අද වැනි දවසක"];
      break;
    case "world":
      arr = ["කියන්න දිනන්න","ක්‍රීඩා","ලොව වටා තතු"];
      break;

    default:

  }
  return arr;
}

function getNextPrevBtnHref(){
  let pgListElem = document.querySelector('#pageList');
  let pg = pgListElem.options[pgListElem.selectedIndex].value;
  let arr;

  switch (pg) {
    case "biology":
      arr = ["./tech.php","./biography.php"];
      break;
    case "biography":
      arr = ["./biology.php","./places.php"];
      break;
    case "country":
      arr = ["./places.php","./today.php"];
      break;
    case "culture":
      arr = ["./history.php","./tech.php"];
      break;
    case "doyouknow":
      arr = ["./today.php","../../quiz.php"];
      break;
    case "history":
      arr = ["./sports.php","./culture.php"];
      break;
    case "places":
      arr = ["./biography.php","./country.php"];
      break;
    case "sports":
      arr = ["./world.php","./history.php"];
      break;
    case "tech":
      arr = ["./culture.php","./biology.php"];
      break;
    case "today":
      arr = ["./country.php","./doyouknow.php"];
      break;
    case "world":
      arr = ["../../quiz.php","./sports.php"];
      break;

    default:

  }
  return arr;
}

function createContent(){
  content = "";
  let childset = document.querySelector(".content").children;
  for (var j = 0; j < childset.length; j++) {
    if (childset[j].dataset.id == "1") {
      let txtAr = getPrevNextBtnTexts();
      let hrfAr = getNextPrevBtnHref();

      content = "<script>"
                +"document.title = 'දැනුමිණ | "+ txtAr[2] +"';"
                +"document.querySelector('[data-class="+'heading'+"]').textContent = '"+ childset[j].value +"';"
                +"document.querySelector('.prev-article-btn').lastElementChild.innerText = '"+ txtAr[0] +"';"
                +"document.querySelector('.next-article-btn').firstElementChild.innerText = '"+ txtAr[1] +"';"
                +"document.querySelector('.prev-article-btn').setAttribute('href','"+ hrfAr[0] +"');"
                +"document.querySelector('.next-article-btn').setAttribute('href','"+ hrfAr[1] +"');"
                +"</script>";
    } else {
      let arr0 = childset[j].children;
      for (var i = 0; i < arr0.length; i++){
        if(arr0[i].className != "delete"){
          if (arr0[i].tagName == "INPUT"){
            if (arr0[i].classList.contains("title-input")) content = content + "<h6>"+ arr0[i].value +"</h6>";
            if (arr0[i].classList.contains("image-select")) content = content + putImageHere(arr0[i]);
          }
          if (arr0[i].className == "columns") {
              let colContent = "<div class='columns'>";
              let arr1 = arr0[i].children;
              for (var k = 0; k < arr1.length; k++) {
                colContent = colContent + "<div class='column "+ arr1[k].classList[1] +"'>";
                let arr2 = arr1[k].children;
                for (var m = 0; m < arr2.length; m++) {
                  let arr3 = arr2[m].children;
                  for (var n = 0; n < arr3.length; n++) {
                    if(arr3[n].className != "delete"){
                      if (arr3[n].tagName == "INPUT") {
                        if (arr3[n].classList.contains("title-input")) colContent = colContent + "<h6>"+ arr3[n].value +"</h6>";
                        if (arr3[n].classList.contains("image-select")) colContent = colContent + putImageHere(arr3[n]);
                      }
                      if (arr3[n].tagName == "TEXTAREA") {
                        colContent = colContent + "<p class='has-text-justified'>"+ arr3[n].value +"</p>";
                      }
                      if (arr3[n].tagName == "DIV" & arr3[n].className == "box-div") {
                        colContent = colContent + "<div class='box'>";
                        var arr4 = arr3[n].children;
                        for (var p = 0; p < arr4.length; p++) {
                          if (arr4[p].tagName == "INPUT") {
                            if (arr4[p].classList.contains("date-input")) colContent = colContent + "<h5>"+ arr4[p].value +"</h5>";
                            if (arr4[p].classList.contains("image-select")) colContent = colContent + putImageHere(arr4[p]);
                          }
                          if (arr4[p].tagName == "TEXTAREA") {
                            colContent = colContent + "<p class='has-text-justified'>"+ arr4[p].value +"</p>";
                          }
                        }
                        colContent = colContent + "</div>";
                      }

                    }
                  }
                }
                colContent = colContent + "</div>";
              }
              colContent = colContent + "</div>";
              content = content + colContent;
          }
          if (arr0[i].tagName == "TEXTAREA") {
            content = content + "<p class='has-text-justified'>"+ arr0[i].value +"</p>";
          }
        }
      }
    }
  }
}

// when delete button pressed
function deleteElement(id){
  selectedCol = document.querySelectorAll("[data-id='"+selectedColumnId+"']")[0];
  if(selectedColumnId != "0") selectColumn(selectedCol);
  elemToDel = document.querySelectorAll("[data-id='"+id+"']")[0];
  elemToDel.remove();
}

function insertRow(p, count){
  var q = document.createElement("DIV");
  q.setAttribute("data-id", count + "_0");
  q.setAttribute("style", "background:#eee;padding:5px;margin-top:5px; min-height:70px;");

  var d = document.createElement("BUTTON");
  d.setAttribute("class", "delete");
  d.setAttribute("id", count + "_0");
  d.setAttribute("onclick", "deleteElement(this.id);");

  var x = document.createElement("DIV");
  x.setAttribute("class", "columns");
  x.setAttribute("data-id", count);
  x.setAttribute("style", "min-height:50px;border: 1px solid black;margin-left:0;margin-right:0;");

  q.appendChild(d);

  let arr = p.split(',');
  for (var i = 1; i <= arr.length; i++) {
    var y = document.createElement("DIV");
    y.setAttribute("class", "column is-"+arr[i-1]);
    y.setAttribute("data-id", count+"_"+i);
    y.setAttribute("style", "background-color:#ccc;border:1px solid black;cursor:pointer;");
    y.setAttribute("onclick", "selectColumn(this)");
    x.appendChild(y);
  }

  q.appendChild(x);

  document.querySelector('.content').appendChild(q);
  count++;
}

function selectColumn(col){
  if (col.getAttribute("data-id") == selectedColumnId) {
    col.style.background = "#ccc";
    selectedColumnId = "0";
  } else {
    let colArr = document.querySelectorAll(".column");
    for (var i = 0; i < colArr.length; i++) {
      colArr[i].style.background = "#ccc";
    }
    col.style.background = "grey";
    selectedColumnId = col.getAttribute("data-id");
  }
}

function lineSpace(){
  var x = document.createElement("BR");
  document.querySelector('.content').appendChild(x);
}

function isArticleSelected(){
  let pgListElem = document.querySelector('#pageList');
  if (pgListElem.options[pgListElem.selectedIndex].value != '0') {
    return true;
  } else {
    return false;
  }
}

function getUrlParams(param){
  let url = new URL(window.location.href);
  let p = url.searchParams.get(param);
  return p;
}
