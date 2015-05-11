<?php
    session_start();
    
    if(!isset($_POST['submit'])){
        exit('非法访问!');
    }
    $username = $_POST['username'];
    $password = MD5($password);
    $email = $_POST['email'];
    $code = mb_strtoupper($_POST['code']);
    
    if($code != $_SESSION['code']){
        echo '验证码不正确！点击此处 <a href="javascript:history.back(-1);">返回</a> 重试。';
        unset($_SESSION['code']);
        exit;
    } else {
        unset($_SESSION['code']);
        
        //包含数据库连接文件
        include('connect-db.php');
        
        //检测用户名是否已经存在
        $check_query = mysql_query("select id from users where username='$username' limit 1");
        if(mysql_fetch_array($check_query)){
            echo '错误：用户名 ',$username,' 已被注册。<a href="javascript:history.back(-1);">返回</a>';
            exit;
        }
        $check_email_query = mysql_query("select id from users where email='$email' limit 1");
        if(mysql_fetch_array($check_email_query)){
            echo '错误：电子邮件 ',$email,' 已被注册。<a href="javascript:history.back(-1);">返回</a>';
            exit;
        }
        
        //写入数据
        $reg_date = date("Y-m-d H:i:s",time());
        $sql = "INSERT INTO users(username,password,email,reg_date)VALUES('$username','$password','$email',
        '$reg_date')";
        if(mysql_query($sql,$conn)){
            exit('用户注册成功！点击此处 <a href="login.php">登录</a>');
        } else {
            echo '抱歉！添加数据失败：',mysql_error(),'<br />';
            echo '点击此处 <a href="javascript:history.back(-1);">返回</a> 重试';
        }
    }
?>