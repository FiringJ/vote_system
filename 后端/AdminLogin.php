<?php
/**
 * Created by PhpStorm.
 * User: 皇阿玛
 * Date: 2019/2/24
 * Time: 18:17
 */
include "../../conn.php";

if(isset($_POST["submit"]) && $_POST["submit"] == '登录')
{
    $user = $_POST["user_name"];
    $psw = $_POST["password"];
    if($user == "" || $psw == "")//信息不全
    {  echo "<script>alert('信息不完整，请重新输入！');history.go(-1)</script>"; }

    else //信息完整
    {
        $sql = "select admin_name,admin_password from admin where admin_name = '$_POST[user_name]' and admin_password = '$_POST[password]'";
        #$sql = "select user_name,password from users where user_name = $user and password = $psw";
        $result = mysqli_query($db,$sql);
        $num = mysqli_num_rows($result);
        $user_msg = mysqli_query($db,"select * from admin where admin_name = '$_POST[user_name]'");
        $user_row = mysqli_fetch_assoc($user_msg);
        if($num)
        {
            $row = mysqli_fetch_array($result);
            session_start();
            $_SESSION['user'] = true;  //登录成功
            $_SESSION['name'] = $user;
            $_SESSION['user_id'] = $user_row['id'];
            header("location:../../Adminindex.php");
        }
        else echo "<script>alert('用户名或密码不正确！');history.go(-1)</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title>用户登录</title>
    <link rel="stylesheet"type="text/css" href="../../server/css/log.css">
</head>
<body background="../../server/background/n.jpg">
<div class = "pg_header">
    <a class = "logo">LOGO</a>

</div>
<form action="AdminLogin.php" method="post">
    <div class="left"></div>
    <div class="pg_body">
        <div class="menu">用户名:</div>
        <div class="kong">
            <input id="text1" type="text" name="user_name" >
        </div>
        <div class="menu">密码:</div>
        <div class="kong">
            <input id="text2" type="password" name="password" >
        </div>
        <div class="can">
            <input id="i111" type="submit" name="submit" value="登录">
            <p style="width: 200px;display: inline-block;"></p>
        </div>

</form>
</body>
</html>

