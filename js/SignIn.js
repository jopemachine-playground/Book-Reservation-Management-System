// @ File Name : SignIn.js
// @ Author : jopemachine
// @ Team : team ⓒ EV for BottomUp
// @ Created : 2019-07-03, 09:17:25
// @ Desc :
// @    evCommentService.ga의 로그인에 사용됩니다.


function SubmitButtonClicked(){
  return true;
}

window.onload = function(){
  checkOutFooterStyle();
}

window.onresize = function(){
  checkOutFooterStyle();
}

function checkOutFooterStyle(){
  // 문서 전체의 길이와 비교해 스타일을 전환한다

  if(document.body.scrollHeight  > window.innerHeight){
    $('#Copyright').addClass('stikyFooter');
  }
  else if(document.body.scrollHeight < window.innerHeight){
    $('#Copyright').removeClass('stikyFooter');
  }
}
