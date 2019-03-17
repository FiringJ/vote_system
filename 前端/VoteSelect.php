<?php
/**
 * Created by PhpStorm.
 * User: 皇阿玛
 * Date: 2019/3/5
 * Time: 12:09
 */

include "conn.php";

@session_start();
header("cache-control:pravite"); //私人缓存（仅客户端可以缓存）
if(isset($_GET['do']) ? $_GET['do']:''){
    if($_GET['do'] == 'logout'){        //登出
        unset($_SESSION['user']);
        unset($_SESSION['name']);
        unset($_SESSION['user_id']);
        @session_destroy();
    }
}

?>

<!DOCTYPE HTML>
<html lang="zh">
<head>
    <meta http-equiv="Content-Type" content="text/html" charset="utf-8">
    <title>投票选择界面</title>
    <link rel="stylesheet" type="text/css" href="server/css/Voteselet.css" >
    <link rel="stylesheet" type="text/css" href="static/h-ui/css/H-ui.min.css" />
</head>
<body>
<div class = "pg_header">
<div class="pg_dl">
        <?php if(!isset($_SESSION['user']) || ($_SESSION['user']!=true)){  ?>  <!-- 无用户信息 -->

        <?php }else{ ?>
            <span>你好，<?php echo $_SESSION['name']; ?></span>
        <!--    <a href="VoteSelect.php">请先选择投票</a>         -->                 <!--投票结果查看-->
        <?php } ?>
    </div>

    <form action="VoteIndex.php" method="post">  <!-- 表单指向投票界面，选择投票标题，提交后转到此界面 -->
        <div class ="select">投票选择</div>
        <br>

            <label>
                <div class ="option">
            <select name="title">
                <option value="checked">请选择投票</option></div>
                <?php
                $result = $db->query("select * from votes");
                while($row = mysqli_fetch_assoc($result)){  ?>
                    <option value="<?php echo $row['id'] ?>"><?php echo $row['title'] ?></option> <!-- 选项选择列表 -->
                <?php } ?>
            </select>
            </label>
        <br><br>
            <input class="btn btn-primary radius" name="submit" type="submit" value="投票提交">
    </form>
    <script type="text/javascript" src="lib/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript" src="lib/layer/2.4/layer.js"></script>
    <script type="text/javascript" src="static/h-ui/js/H-ui.min.js"></script>
    <script type="text/javascript" src="static/h-ui.admin/js/H-ui.admin.js"></script>
    <script type="text/javascript" src="lib/jquery.contextmenu/jquery.contextmenu.r2.js"></script>
</body>
</html>
