<?php
/**
 * Created by PhpStorm.
 * User: 皇阿玛
 * Date: 2019/2/24
 * Time: 15:26
 */
if(isset($_POST['submit']) && $_POST['submit']=="注册") {
    $user = $_POST["user_name"];
    $email = $_POST["user_email"];
    $psw = $_POST["password"];
    $psw_confirm = $_POST["confirm"];
    # print var_dump($user);
    # print var_dump($email);
    # print var_dump($psw);

 #  if ($_POST['user_name'] = "" || $_POST['user_email'] = "" || $_POST['password'] = "" || $_POST['confirm'] = "") {
    if ($user = "" || $email = "" || $psw = "" || $psw_confirm = "") {
        echo "<script>alert('信息不完整，请重新输入！');history.go(-1);</script>";
    } //信息不全

    else {
        if ($psw == $psw_confirm) { //密码输入正确
            $con = mysqli_connect("localhost", "root", "", "vote_system"); //连接数据库
            if (!$con) {
                die('数据库连接失败：' . mysqli_connect_error());
            }
            echo "数据库连接成功！";

            $sql = "select user_name from users where user_name = '$_POST[user_name]'";
            $result = mysqli_query($con, $sql);
            $num = mysqli_num_rows($result);
           # print($num);
            if ($num) {
                echo "<script>alert('用户名已存在！');history.go(-1)</script>";
            }

            $sql1 = "select email from users where email = '$_POST[user_email]'";
            $result1 = mysqli_query($con, $sql1);
            $num1 = mysqli_num_rows($result1);
           # print($num1);
            if($num1)
            {
                echo "<script>alert('该邮箱已被注册！');history.go(-1)</script>";
            }

            else //信息正确，录入数据库
            {
                $ip = getenv("REMOTE_ADDR");

                $sql_insert = "insert into users (ip,cpu_id,user_name,email,password) values ('$ip','','$_POST[user_name]','$_POST[user_email]','$_POST[password]')";
                $result_insert = mysqli_query($con,$sql_insert);
            #    print $result_insert;
                if($result_insert){
                    echo"<script>alert('注册成功！');history.go(-1)</script>";
                }

                else{
                    echo "<script>alert('信息未成功录入，注册失败！');history.go(-1)</script>";
                }
            }
        }
        else echo "<script>alert('密码输入有误，请重新输入！');history.go(-1)</script>";
    }
}

# else echo"<script>alert('提交失败，请稍后再试！');history.go(-1)</script>";
?>


<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title>用户注册</title>
    <link rel="stylesheet"type="text/css" href="server/css/Regi.css">
</head>
<body background="server/background/n.jpg">
<div class = "pg_header">
    <a class = "logo">LOGO</a>
    <a href="Login.php" class="pg_dl" >登录</a>
</div>
<form name="注册" method="post" action="Register.php">
    <div class="left"></div>
    <div class="pg_body">
        <div class="menu">*用户名:</div>
        <div class="kong">
            <input id="text1" type="text" name="user_name" *(为必填)>
            <span id="div1" class="tian">*(为必填)<span>
        </div>
        <div class="menu">*邮箱地址:</div>
        <div class="kong">
            <input id="text2" type="text" name="user_email">
            <span id="div2" class="tian">*(为必填)<span>
        </div>
        <div class="menu">*密码:</div>
        <div class="kong">
            <input id="text3" type="password" name="password" >
            <span id="div3" class="tian">*(为必填)<span>
        </div>
        <div class="menu">*确认密码:</div>
        <div class="kong">
            <input id="text4" type="password" name="confirm">
            <span id="div4" class="tian">*(为必填)<span>
        </div>
        <div class="can">
            <input id="i111" type="submit" name="submit" value="注册">
            <p style="width: 200px;display: inline-block;"></p>
            <input id="i222" type="button" name="cancle" value="取消">
        </div>
</form>
<script type="text/javascript" src="server/js/reg.js"></script>
</body>
</html>