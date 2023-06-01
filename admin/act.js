$(document).ready(function(){

  $('#ad-pageList').change(function(){
    clearFields();
  });
});

function clearFields() {
  $("#first-ad-form").each(function(index){
    $("#first-ad-form")[index].reset();
  });
  $("#second-ad-form").each(function(index){
    $("#second-ad-form")[index].reset();
  });
}

function insOrModAdvert(elem, type) {
  let code = getUrlParams('p');
  let rem = confirm("Do you really wanna save the Ad ?");
  if (rem) {
    let pgListElem = document.querySelector('#ad-pageList');
    let pg = pgListElem.options[pgListElem.selectedIndex].value;
    let description, media, adNum, quote, author;

    if (type == 1) {
      pg = "home";
    }

    media = elem.children[0].firstElementChild;
    description = $(elem.children[1].firstElementChild).val();
    quote = $(elem.children[2].firstElementChild).val();
    author = $(elem.children[3].firstElementChild).val();
    
    adNum = elem.parentElement.dataset.value;
    uploadMedia(media, pg, description, type, quote, author, adNum);
  }
}

//upload media
function uploadMedia(media, pg, desc, type, quote, author, adNum){
  var file_data = $(media).prop('files')[0];
  var form_data = new FormData();
  form_data.append('file', file_data);
  form_data.append('page', pg);
  form_data.append('code', getUrlParams('p'));
  form_data.append('type', type);
  form_data.append('description', desc);
  form_data.append('quote', quote);
  form_data.append('author', author);
  form_data.append('adNum', adNum);
  $.ajax({
      url: 'uploadMedia.php', // <-- point to server-side PHP script
      dataType: 'text',  // <-- what to expect back from the PHP script, if anything
      cache: false,
      contentType: false,
      processData: false,
      data: form_data,
      type: 'post',
      success: function(response){
        window.alert("Ad inserted successfully !");
      }
  });
}

function getUrlParams(param){
  let url = new URL(window.location.href);
  let p = url.searchParams.get(param);
  return p;
}
