// 왼쪽 버튼을 누르면 해당하는 php Action을 실행해 serviceSection에 띄운다.
var urlID = getParameterByName('db');
// 현재 로딩 중인지 나타내는 bool형 변수
var isloading = false;

// 코드 양, 중복을 없애기 위해 사용
function ajaxRequest(type, url, dataArr, success, error){
  $.ajax({ type: type, url : url, data: dataArr, success : success, error: error });
}

function search(){
  $.ajax({
    type: "GET",
    url : "php-Action/BookSearch.php",

    data: {
      content : $('#searchBar').val(),
      searchWithISBN: $('#searchWithISBN').is(':checked'),
      searchWithBookName: $('#searchWithBookName').is(':checked'),
    },

    success : function(data, status, xhr) {
      console.log("검색 성공" + data);
      $('#searchContent').html(data);
    },
    error: function(jqXHR, textStatus, errorThrown) {
      console.log("Ajax 전송에 실패했습니다!" + jqXHR.responseText);
    }
  });
}

// 디폴트로 Analysis-recentComments가 클릭되게 한다.
window.onload = function(){
  selectButtons('Analysis-registerBook');
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

    case "Analysis-registerBook":
      selectedService = "RegisterBook.php";
      break;
    case "Analysis-searchBook":
      selectedService = "SearchBooksAction.php"
      break;
    case "Analysis-edit":
      selectedService = "EditBookInfo.php";
      break;
    case "Analysis-acceptReturnBook":
      selectedService = "AcceptBookReturnAction.php";
      break;
  }

  ajaxRequest("POST", `../php-Action/ManagerService/${selectedService}`, { URLID : urlID },
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
