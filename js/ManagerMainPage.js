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
    url : "../../Action/BookSearch.php",

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

function deleteBook(delBtn){
  $.ajax({
    type: "POST",
    url : "../../Action/ManagerService/DeleteRegisteredBookAction.php",

    data: {
      ISBN : $('#bookISBNToDelete').val()
    },

    success : function(data, status, xhr) {
      console.log("검색 성공" + data);
      alert("데이터베이스에서 입력하신 도서를 제거했습니다.");
      location.reload();
    },
    error: function(jqXHR, textStatus, errorThrown) {
      console.log("Ajax 전송에 실패했습니다!" + jqXHR.responseText);
    }
  });
}

function withdrawCustomer(){
  $.ajax({
    type: "POST",
    url : "../../Action/ManagerService/CustomerWithdrawalAction.php",

    data: {
      ID : $('#customerIDToDelete').val()
    },

    success : function(data, status, xhr) {
      alert("데이터베이스에서 입력하신 유저를 제거했습니다.");
      location.reload();
    },
    error: function(jqXHR, textStatus, errorThrown) {
      console.log("Ajax 전송에 실패했습니다!" + jqXHR.responseText);
    }
  });
}

function acceptReturn(acceptBtn){

  let ISBNStr = acceptBtn.prev().children(".ISBN").html().split(": ")[1];

  $.ajax({
    type: "POST",
    url : "../../Action/ManagerService/AcceptBookReturnAction.php",

    data: {
      ISBN : ISBNStr
    },

    success : function(data, status, xhr) {
      alert("반납요청을 수락했습니다.");
      location.reload();
    },
    error: function(jqXHR, textStatus, errorThrown) {
      console.log("Ajax 전송에 실패했습니다!" + jqXHR.responseText);
    }
  });
}

// 디폴트로 Analysis-recentComments가 클릭되게 한다.
window.onload = function(){
  selectButtons('Manager-registerBook');
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

  let selectedButton = $('#SidebarBtns').children('.active');

  // 이미 로딩 상태라면, 버튼 클릭에 반응하지 않는다.
  if(isloading){
    return;
  }

  // 클릭한 버튼이 이미 활성화 된 버튼인 경우, 아무 작업도 하지 않음.
  if($('#' + clickedButton).attr('class') == $('#SidebarBtns').children('.active').attr('id')){
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

    case "Manager-registerBook":
      selectedService = "RegisterBookView.php";
      break;
    case "Manager-searchBook":
      selectedService = "SearchBooksView.php"
      break;
    case "Manager-edit":
      selectedService = "EditBookInfoView.php";
      break;
    case "Manager-acceptReturnBook":
      selectedService = "AcceptBookReturnView.php";
      break;
    case "Manager-deleteBook":
      selectedService = "DeleteRegisteredBookView.php";
      break;
    case "Manager-customerInfo":
      selectedService = "CustomerInfoEditView.php";
      break;
    case "Manager-customerWithdrawal":
      selectedService = "CustomerWithdrawalView.php";
      break;
  }

  ajaxRequest("POST", `${selectedService}`, { URLID : urlID },
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
