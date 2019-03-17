<?php
/**
 * Created by PhpStorm.
 * User: 皇阿玛
 * Date: 2019/3/5
 * Time: 19:49
 */

include "../../conn.php";
if(isset($_POST['title']) ? $_POST['title']:''){
    $title = $_POST['title'];
    $description = $_POST['description'];
    $end_time = $_POST['end_time'];
    $sql = $db->query("insert into votes(title,description,end_time) values ('$title','$description','$end_time')");
    if($sql){
        echo "<script>onload=function() {document.getElementById('response').innerHTML ='添加投票成功！';}</script>";}
    else{
        echo "<script>onload=function() {document.getElementById('response').innerHTML ='添加投票失败！';}</script>";}
}

?>

<!DOCTYPE HTML>
<html lang="zh">
<head>
    <meta http-equiv="Content-Type" content="text/html" charset="utf-8">
    <title>添加投票</title>
</head>
<body>
<div>
    <form action="AddVote.php" method="post" name="form1" id="form1" enctype="multipart/form-data">
    <h5 id="response"></h5>
    <label>添加投票</label><br><br>
    <input type="text" name="title" placeholder="请输入投票标题！"><br><br>
    <input type="text" name="description" placeholder="请输入投票描述！"><br><br>
    <input type="date" name="end_time" placeholder="请输入投票截止时间！"><br><br>
    <button>添加投票</button>
    </form>
</div>
</body>
</html>
