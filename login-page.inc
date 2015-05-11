<?php 
	class LoginPage
	{
		public $title = "用户登录";
		public $buttonText = "登录";
		public $pageURL = "login";
		public $links = array (
			"返回首页" => "index",
			"用户注册" => "reg",
			"忘记密码" => "retrieve-password"
		);
		
		public function displayPage() {
			echo "<!DOCTYPE HTML>\n<html>\n<head>\n<meta charset=\"utf-8\">\n";
			$this -> displayTitle();
			$this -> displayStyles();
			echo "</head>\n<body>\n<div class = \"login\">\n";
			echo "<h2>". $this -> title. "</h2>\n";
			$this -> displayFormContents();
			$this -> displayMenus();
			echo "</div>\n<script>\n";
			$this -> displayCheckScript();
			$this -> displayCodeScript();
			echo "</script>\n</body>\n</html>";
		}
		
		public function displayTitle() {
			echo "<title>". $this -> title. "</title>\n";
		}
		
		public function displayStyles() {
			echo "<style>\n";
			?>
.login {font-family: Helvetica, Arial, sans-serif; width: 300px; margin: 150px auto auto auto;}
.login_item {width: 200px;}
.login_text {text-align: right; width: 80px;}
.login_button {font-family: Helvetica, Arial, sans-serif; text-align: center; font-size: 16px;}
input.input_item {height: 30px; font-size: 16px; width: 200px;}
input.input_verification {height: 30px; font-size: 16px; width: 110px; vertical-align: middle;}
img.verification_code {width: 80px; vertical-align: middle; padding-left: 5px; cursor: pointer;}
input.button {height: 50px; font-size: 20px;}
h2 {text-align: center;}
p {text-align: center;}<?php
			echo "\n</style>\n";
		}
		
		public function displayFormContents() {
			echo "<form name=\"". $this -> titleURL. "Form\" action=\"do-". $this -> pageURL. ".php\" method=\"post\" onsubmit=\"return checkInfo(this)\">\n<table>\n";
			$this -> displayInputUsername();
			$this -> displayInputPassword();
			$this -> displayInputVerificationCode();
			echo "</table>\n";
			$this -> displayButton();
			echo "</form>\n";
		}
		
		public function displayInputUsername() {
			?>
<tr>
<td><p class = login_text>用户名：</p></td>
<td><input class ="input_item" type="text" placeholder="请输入用户名" name="username"></td>
</tr>
<?php
		}
		
		public function displayInputPassword() {
			?>
<tr>
<td><p class = login_text>密码：</p></td>
<td><input class ="input_item" type="password" placeholder="请输入密码" name="password"></td>
</tr>
<?php			
		}
		
		public function displayInputVerificationCode() {
			?>
<tr>
<td><p class = login_text>验证码：</p></td>
<td><input class ="input_verification" type="text" placeholder="请输入验证码" name="code">
<img class= "verification_code" id="code" src="generate-code.php" alt="看不清楚？换一张。" onclick="createCode()"></td>
</tr>		
<?php
		}
		
		public function displayInputEmail() {
			?>
<tr>
<td><p class = login_text>电子邮箱：</p></td>
<td><input class ="input_item" type="text" placeholder="请输入电子邮箱" name="email"></td>
</tr>
<?php
		}
		
		public function displayInputPasswordCheck() {
			?>
<tr>
<td><p class = login_text>确认密码：</p></td>
<td><input class ="input_item" type="password" placeholder="请重复输入密码" name="password_check"></td>
</tr>
<?php
		}
		
		public function displayInputNewPassword() {
			?>
<tr>
<td><p class = login_text>新密码：</p></td>
<td><input class ="input_item" type="password" placeholder="请输入新密码" name="password"></td>
</tr>
<?php
		}
		
		public function displayButton() {
			echo "<p class=\"login_button\"><input class =\"button\" type=\"submit\" name=\"submit\" value=\"". $this -> buttonText. "\"></p>";
		}
 		
		public function displayMenus() {
			echo "<table>\n<tr>\n";
			while (list ($text, $link) = each ($this -> links)) {
				echo "<td style=\"width: 100px;\"><p><a href=\"". $link. ".php\">". $text. "</a></p></td>\n";
			}
			echo "</tr>\n</table>\n";
		}
		
		public function displayCheckScript() {
			?>
function checkInfo(form) {
var username = form.username.value;
var password = form.password.value;
var usernamePattern = /^[a-zA-Z0-9_]{4,16}$/;
var passwordPattern = /^[a-zA-Z0-9_]{6,16}$/;
if (!usernamePattern.test(username)) {
alert("请输入正确的用户名，只能由大小写英文字母、数字和下划线组成，长度为4-16位。");
return false;
}
if (!passwordPattern.test(password)) {
alert("请输入正确的密码，只能由大小写英文字母、数字和下划线组成，长度为6-16位。");
return false;
}
return true;
}
<?php
		} 
		
		public function displayCodeScript() {
			?>
function createCode(){
document.getElementById("code").src = "generate-code.php?"+Math.random()*10000;
}
<?php
		}
	}
?>