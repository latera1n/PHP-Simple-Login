<?php
    session_start();

    //注销登录
    if($_GET['action'] == "logout"){
        unset($_SESSION['id']);
        unset($_SESSION['username']);
        echo '注销登录成功！点击此处 <a href="login.html">登录</a>';
        exit;
    }
    
    //登录
    if(!isset($_POST['submit'])){
        exit('非法访问!');
    }
    $username = ($_POST['username']);
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
        //检测用户名及密码是否正确
        $check_query = mysql_query("select id from users where username='$username' and password='$password' limit 1");
        if($result = mysql_fetch_array($check_query)){
            //登录成功
            $_SESSION['username'] = $username;
            $_SESSION['id'] = $result['id'];
            echo $username,' 欢迎你！进入 <a href="my.html">用户中心</a><br />';
            echo '点击此处 <a href="do-login.php?action=logout">注销</a> 登录！<br />';
            exit;
        } else {
            exit('抱歉！用户名或密码错误，登录失败。点击此处 <a href="javascript:history.back(-1);">返回</a> 重试。');
        }
    }
?>