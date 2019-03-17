<?php
/**
 * Created by PhpStorm.
 * User: 皇阿玛
 * Date: 2019/2/25
 * Time: 20:15
 */

include('../../conn.php');

if(isset($_POST['title']) && $_POST['title']!='')
{
    $title = $_POST['title'];
    $creater_name = $_POST['creater'];
    $end_time = $_POST['end_time'];
    # var_dump($title); die();
    $description = $_POST['description'];


    $sql = mysqli_db_query("update votes set title='$title',creater_name='$creater_name',end_time='$end_time' where id='1';");
    $result = $sql;
    if($result) {
        echo "<script>onload = function() {document.getElementById('response').innerHTML = '配置保存成功！';}</script>";}
    else {
        echo "<script>onload = function() {document.getElementById('response').innerHTML = '配置保存失败！';}</script>";}
}

$result = $db->query("select * from votes where id='1'");
$row = mysqli_fetch_assoc($result);  //关键字索引

?>

<html>
<head>
    <meta charset="utf-8">
    <title>投票设置</title>
    <script type="text/javascript" src=""></script>
    <script type="text/javascript" src="../js/Calendar3.js"></script>
    <link rel="stylesheet" type="text/css" href="">
    <link rel="stylesheet" type="text/css" href="">
</head>
<body>
<div class="" style="">
    <div id="" class="" style="">
        <h5 id="response"></h5>
    </div>
    <form action="VoteSet.php" method="post" enctype="multipart/form-data" name="form1" id="form1">

     <!-- 投票信息显示 -->
        <div class="">
            <label class="">投票标题</label>
            <div class="">
                <input class="" name="title" type="text" value="<?php echo $row['title']; ?>">
                <p></p>
            </div>
        </div>

        <div class="">
            <label class="">投票发起者</label>
            <div class="">
                <input class="" name="creater" type="text" value="<?php echo $row['creater_name']; ?>">
                <p></p>
            </div>
        </div>

        <div class="">
            <label class="">投票描述</label>
            <div class="">
                <input class="" name="description" type="text" value="<?php echo $row['description']; ?>">
                <p></p>
            </div>
        </div>


        <div class="">
            <label>投票截止时间</label>
            <div class="">
                <input class="" name="end_time" type="text" value="<?php echo $row['end_time']; ?>" size="12"
                 id="" readonly="readonly" maxlength="12" onClick="new Calendar.show(this)" />
                <p></p>
            </div>
        </div>

        <div class="">
            <label class=""></label>
            <div class="">
                <button class="" style="" type="submit">保存配置</button>
            </div>
        </div>
    </form>
</div>
</body>
</html>

