function xacNhanXoa() {
    return confirm("Bạn có chắc chắn muốn xoá");
}

let password = document.getElementById("password")
let confirm_password = document.getElementById("confirm_password");

function validatePassword(){
  if(password.value != confirm_password.value) {
    confirm_password.setCustomValidity("Mật khẩu không trùng khớp");
  } else {
    confirm_password.setCustomValidity('');
  }
}

password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;