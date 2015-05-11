<?php
$conn = @mysql_connect("localhost","root","root");
if (!$conn){
    die("连接数据库失败：" . mysql_error());
}
mysql_select_db("login_users", $conn);
?>