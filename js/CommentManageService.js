// @ File Name : CommentManageService.js
// @ Author : jopemachine
// @ Team : team ⓒ EV for BottomUp
// @ Created : 2019-07-14, 17:38:31
// @ Desc :
// @    evCommentService.ga에서 블로그 통계를 제공하기 위해 사용됩니다.

// 왼쪽 버튼을 누르면 해당하는 php Action을 실행해 serviceSection에 띄운다.
var urlID = getParameterByName('db');
// 현재 로딩 중인지 나타내는 bool형 변수
var isloading = false;

// 코드 양, 중복을 없애기 위해 사용
function ajaxRequest(type, url, dataArr, success, error){
  $.ajax({ type: type, url : url, data: dataArr, success : success, error: error });
}

// 디폴트로 Analysis-recentComments가 클릭되게 한다.
window.onload = function(){
  selectButtons('Analysis-recentComments');
}

function Loading(){
  $('#Loader').show();
  $('#ServiceSection').hide();
  isloading = true;
}

function containerLoad(){
  $('#Loader').hide();
  $('#ServiceSection').show();
  isloading = false;
}

function selectButtons(clickedButton){

  let selectedButton = $('#AnalysisButtons').children('.active');

  // 이미 로딩 상태라면, 버튼 클릭에 반응하지 않는다.
  if(isloading){
    return;
  }

  // 클릭한 버튼이 이미 활성화 된 버튼인 경우, 아무 작업도 하지 않음.
  if($('#' + clickedButton).attr('class') == $('#AnalysisButtons').children('.active').attr('id')){
    return;
  }
  // 이외의 경우라면 기존 버튼에서 active를 제거하고 클릭된 버튼에 active를 준다.
  else{
    selectedButton.removeClass('active');
    $('#' + clickedButton).addClass('active');
  }

  Loading();

  let selectedService;
  switch (clickedButton) {

    case "Analysis-recentComments":
      selectedService = "recentComments.php";
      break;

    // 미구현 서비스
    case "Analysis-visitorsNumber":
      break;

    case "Analysis-positiveness":
      selectedService = "Positiveness.php";
      break;

    case "Analysis-postsSortingByCommentsNumber":
      selectedService = "PostsSortingByCommentsNumber.php";
      break;

    case "Analysis-popularness":
      selectedService = "PopularPosting.php";
      break;
  }

  ajaxRequest("POST", `../php-Action/CommentManageService/${selectedService}`, { URLID : urlID },
    (serviceHTML)=>{
      $('#ServiceSection').html(serviceHTML);
      containerLoad();
    });
}

// get 방식 파라미터 값을 가져오는 함수
// http://naminsik.com/blog/3070 참고
function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}
