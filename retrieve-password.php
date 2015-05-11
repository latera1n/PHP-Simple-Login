<?php
	require ("login-page.inc");
	
	class RetrievePasswordPage extends LoginPage {
		public $title = "密码找回";
		public $buttonText = "重设密码";
		public $pageURL = "retrieve-password";
		public $links = array (
			"返回首页" => "index",
			"用户登录" => "login",
			"用户注册" => "reg"
		);
	
		public function displayFormContents() {
			echo "<form name=\"". $this -> titleURL. "Form\" action=\"do-". $this -> pageURL. ".php\" method=\"post\" onsubmit=\"return checkInfo(this)\">\n<table>\n";
			$this -> displayInputUsername();
			$this -> displayInputEmail();
			$this -> displayInputNewPassword();
			$this -> displayInputPasswordCheck();
			$this -> displayInputVerificationCode();
			echo "</table>\n";
			$this -> displayButton();
			echo "</form>\n";
		}
		
		public function displayCheckScript() {
			?>
function checkInfo(form) {
var code = form.code.value;
if (code == "") {
    alert("请输入验证码。");
    return false;
}
                
var username = form.username.value;
var password = form.password.value;
var passwordCheck = form.password_check.value;
var email = form.email.value;
var usernamePattern = /^[a-zA-Z0-9_]{4,16}$/;
var passwordPattern = /^[a-zA-Z0-9_]{6,16}$/;
var emailPattern = /^[a-z]([a-z0-9]*[-_]?[a-z0-9]+)*@([a-z0-9]*[-_]?[a-z0-9]+)+[\.][a-z]{2,3}([\.][a-z]{2})?$/i;
if (!usernamePattern.test(username)) {
     alert("请输入正确的用户名，只能由大小写英文字母、数字和下划线组成，长度为4-16位。");
     return false;
}
if (!passwordPattern.test(password)) {
     alert("请输入正确的密码，只能由大小写英文字母、数字和下划线组成，长度为6-16位。");
     return false;
}
if (!emailPattern.test(email)) {
    alert("请输入正确的电子邮箱。");
    return false;
}
if (password !== passwordCheck) {
    alert("两次输入的密码不一致，请检查。");
    return false;
}
return true;
}
<?php
		}
	}
	
	$retrievePasswordPage = new RetrievePasswordPage();
	
	$retrievePasswordPage -> displayPage();
	
?>