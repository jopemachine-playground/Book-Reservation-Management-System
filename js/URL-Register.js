// @ File Name : URL-Register.js
// @ Author : jopemachine
// @ Team : team ⓒ EV for BottomUp
// @ Created : 2019-07-03, 18:29:58
// @ Desc :
// @     evCommentService.ga의 블로그 서비스 등록 및 관리에 사용됩니다.

var DeletingURLID;

function AddURLButtonClicked(){
  if(checkUrlForm($('#URL').val())){
    return true;
  }
  alert('올바른 URL이 아닙니다. 블로그의 URL 형식이 맞는지 확인해주세요.');
  return false;
}

// url 형식인지를 체크( http, https 를 포함하는 형식 )
function checkUrlForm(strUrl) {
    var expUrl = /^http[s]?\:\/\//i;
    return expUrl.test(strUrl);
}

function DeleteService(){

  $.ajax({
    type: "POST",
    url : "../php-Action/DeleteService.php",
    data : {
      URLID : DeletingURLID,
    },

    success : function(response) {
      console.log(response);
      $('#' + DeletingURLID).hide();
    },
    error: function(jqXHR, textStatus, errorThrown) {
      console.log("Ajax 수신에 실패했습니다!" + jqXHR.responseText);
    }
  })
}

function setIndexToDeleteRoom(urlID){
  DeletingURLID = urlID;
}

function ToCommentManagePage(serviceTitle, urlID){
  location.href=`CommentManageService.php?db=${urlID}&title=${serviceTitle}`;
}
