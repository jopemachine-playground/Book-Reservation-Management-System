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
