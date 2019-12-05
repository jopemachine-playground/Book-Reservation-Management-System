// 왼쪽 버튼을 누르면 해당하는 php Action을 실행해 serviceSection에 띄운다.
var urlID = getParameterByName('db');
// 현재 로딩 중인지 나타내는 bool형 변수
var isloading = false;

function ajaxRequest(type, url, dataArr, success, error){
  $.ajax({ type: type, url : url, data: dataArr, success : success, error: error });
}

// 책을 대출
function borrow(borrowBtn){

  let ISBNStr = borrowBtn.prev().children(".ISBN").html().split(": ")[1];
  let canBorrow = borrowBtn.prev().children(".canBorrow").html().split(": ")[1];

  if(canBorrow === "대출 가능"){
    $.ajax({
      type: "POST",
      url : "php-Action/CustomerService/BorrowAction.php",

      data: {
        ISBN: ISBNStr
      },

      success : function(data, status, xhr) {
        console.log("대출 성공");
        alert("대출 성공했습니다.");
        location.reload();
      },
      error: function(jqXHR, textStatus, errorThrown) {
        console.log("Ajax 전송에 실패했습니다!" + jqXHR.responseText);
      }
    });
  }
  else {
    alert("이미 대출중인 도서입니다!");
  }

}

// 책을 예약
function reserve(reserveBtn){

  let ISBNStr = reserveBtn.prev().prev().children(".ISBN").html().split(": ")[1];
  let canReserve = reserveBtn.prev().prev().children(".canReserve").html().split(": ")[1];

  console.log(canReserve);
  console.log(canReserve === "예약 가능");

  if(canReserve === "예약 가능"){
    $.ajax({
      type: "POST",
      url : "php-Action/CustomerService/ReserveAction.php",

      data: {
        ISBN: ISBNStr
      },

      success : function(data, status, xhr) {
        console.log("예약 성공");
        alert("예약 성공했습니다.");
        location.reload();
      },

      error: function(jqXHR, textStatus, errorThrown) {
        console.log("Ajax 전송에 실패했습니다!" + jqXHR.responseText);
      }
    });
  }
  else{
    alert("이미 예약중인 도서입니다!");
  }
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
      console.log("검색 성공");
      $('#searchContent').html(data);
    },
    error: function(jqXHR, textStatus, errorThrown) {
      console.log("Ajax 전송에 실패했습니다!" + jqXHR.responseText);
    }
  });
}

// 디폴트로 Analysis-recentComments가 클릭되게 한다.
window.onload = function(){
  selectButtons('Analysis-search');
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

    case "Analysis-search":
      selectedService = "SearchBooksAction.php";
      break;
    case "Analysis-leave":
      selectedService = "LeaveAction.php";
      break;
    case "Analysis-borrowedBook":
      selectedService = "BorrowedBooks.php";
      break;
    case "Analysis-reservedBook":
      selectedService = "ReservedBooks.php";
      break;
  }

  ajaxRequest("POST", `../php-Action/CustomerService/${selectedService}`, { URLID : urlID },
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
