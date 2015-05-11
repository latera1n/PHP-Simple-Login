<?php
    session_start();
    //验证用户名和邮箱
    if(!isset($_POST['submit'])){
        exit('非法访问!');
    }
    
    $username = ($_POST['username']);
    $email = ($_POST['email']);
    $password = MD5($_POST['password']);
    $code = mb_strtoupper($_POST['code']);
    
    if($code != $_SESSION['code']){
        echo '验证码不正确！点击此处 <a href="javascript:history.back(-1);">返回</a> 重试。';
        unset($_SESSION['code']);
        exit;
    } else {
        unset($_SESSION['code']);
        //包含数据库连接文件
        include('connect-db.php');
        //检测用户名及电子邮箱是否正确
        $check_query = mysql_query("SELECT id FROM users WHERE username='$username' and email='$email' limit 1");
        $id_result = mysql_fetch_row($check_query);
        if($id_result[0]){
            //验证成功，重设密码
            $sql = "UPDATE users SET password = '$password' WHERE id = '$id_result'";
            if (mysql_query($sql, $conn)) {
                echo '密码修改成功！点击此处 <a href="login.php">重新登录</a>';
            } else {
                echo '抱歉！密码修改失败：',mysql_error(),'<br />';
                echo '点击此处 <a href="javascript:history.back(-1);">返回</a> 重试';
            }
        } else {
            echo '抱歉！用户信息不正确，密码修改失败。<br />';
            echo '点击此处 <a href="javascript:history.back(-1);">返回</a> 重试';
        }
    }
?>