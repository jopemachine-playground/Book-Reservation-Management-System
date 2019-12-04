// @ File Name : UserEdit.js
// @ Author : jopemachine
// @ Team : team ⓒ EV for BottomUp
// @ Created : 2019-07-14, 15:52:37
// @ Desc :
// @    evCommentService.ga의 유저 정보 변경에 사용됩니다.

var profileImage;

// 클라이언트 쪽에서 유효성 검사를 하고, 유효한 경우에만 넘어감
function SubmitButtonClicked(){

  // 4 ~ 20자의 영문 대소문자 + 숫자만 ID로 유효한 값이 될 수 있음
  let validReg_ID = /^[A-Za-z0-9+]{4,20}$/;
  var validReg_Email = /^[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*.[a-zA-Z]{2,3}$/i;

  // 비밀번호와 비밀번호 확인이 같은 값인지 검사
  if($('#PW').val() != $('#PW_Confirm').val()){
    alert('비밀번호가 비밀번호 확인과 맞지 않습니다');
    return false;
  }

  // 정규식 ID 확인
  if (!validReg_ID.test($('#ID').val())) {
    alert('ID는 대소문자 알파벳과 숫자로만 구성되야 하며, 4자리 이상, 20자리 미만이어야 합니다.');
    return false;
  }

  // 이메일 주소가 빈 칸이 아닌 경우 유효성 검사
  if($('#Email').val() != '' && !validReg_Email.test($('#Email').val())){
    alert('올바른 이메일 주소 형식이 아닙니다.');
    return false;
  }

  return true;
}

function ToMainPage(){
  location.href='URL-Register.php';
}

function changeProfileImage(value){

  $('#userDefaultProfile').hide();
  $('#userProfileImage').show();

  var canvas = document.getElementById('userProfileImage');
  var canvasContext = canvas.getContext("2d");

  canvas.width = 80;
  canvas.height = 80;

  if(value.files && value.files[0]){
    var reader = new FileReader();
    reader.readAsDataURL(value.files[0]);
    // readAsDataURL 메서드는 컨텐츠를 특정 Blob 이나 File에서 읽어 오는 역할

    reader.onload = function(e){

      profileImage = new Image();
      profileImage.src = reader.result;

      profileImage.onload = function(){
        canvasContext.drawImage(this, 0, 0, 80, 80);
      }
    }
  }
}

function manButtonClick(){
  $('#Gender').val('man');
}

function womanButtonClick(){
  $('#Gender').val('woman');
}

// PhoneNumber 란에 숫자만 입력되도록 강제하는 함수. 아래 페이지의 코드를 그대로 사용한 것이다.
// http://blog.tjsrms.me/jquery-%ED%95%B8%EB%93%9C%ED%8F%B0-%EB%B2%88%ED%98%B8-%EC%B2%B4%ED%81%AC%ED%95%98%EA%B8%B0/
$(function(){

  $("#PhoneNumber").on('keydown', function(e){
    // 숫자만 입력받기
    var trans_num = $(this).val().replace(/-/gi,'');
    var k = e.keyCode;

    if(trans_num.length >= 11 && ((k >= 48 && k <=126) || (k >= 12592 && k <= 12687 || k==32 || k==229 || (k>=45032 && k<=55203)) ))
    {
      e.preventDefault();
    }
  }).on('blur', function(){
    // 포커스를 잃었을때 실행합니다.
    if($(this).val() == '') return;

    // 기존 번호에서 - 를 삭제합니다.
    var trans_num = $(this).val().replace(/-/gi,'');

    // 입력값이 있을때만 실행합니다.
    if(trans_num != null && trans_num != '')
    {
      // 총 핸드폰 자리수는 11글자이거나, 10자여야 합니다.
      if(trans_num.length==11 || trans_num.length==10)
      {
        // 유효성 체크
        var regExp_ctn = /^(01[016789]{1}|02|0[3-9]{1}[0-9]{1})([0-9]{3,4})([0-9]{4})$/;
        if(regExp_ctn.test(trans_num))
        {
          // 유효성 체크에 성공하면 하이픈을 넣고 값을 바꿔줍니다.
          trans_num = trans_num.replace(/^(01[016789]{1}|02|0[3-9]{1}[0-9]{1})-?([0-9]{3,4})-?([0-9]{4})$/, "$1-$2-$3");
          $(this).val(trans_num);
        }
        else
        {
          alert("유효하지 않은 전화번호 입니다.");
          $(this).val("");
          $(this).focus();
        }
      }
      else
      {
        alert("유효하지 않은 전화번호 입니다.");
        $(this).val("");
        $(this).focus();
      }
    }
  });
});
