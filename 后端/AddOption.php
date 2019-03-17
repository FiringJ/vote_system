<?php
/**
 * Created by PhpStorm.
 * User: 皇阿玛
 * Date: 2019/2/28
 * Time: 11:36
 */

include ('../../conn.php');
if(isset($_POST['option']) ? $_POST['option']:''){
    $option = $_POST['option'];
    $question_id = $_POST['question'];
    if($question_id == ''){
        echo "<script>onload=function() {document.getElementById('response').innerHTML='请先选择问题！';}";
    }
    else{
        $sql = $db->query("insert into options (content,question_id) values ('$option','$question_id')");
        if($sql) {
            echo "<script>onload=function() {document.getElementById('response').innerHTML='选项添加成功！';}</script>";}
        else{
            echo "<script>onload=function() {document.getElementById('response').innerHTML='选项添加失败！';}</script>";}
    }
}
?>


<!DOCTYPE HTML>
<html lang="zh">
<head>
    <meta http-equiv="Content-Type" content="text/html" charset="utf-8">
    <title>添加问题选项</title>
</head>
<body>
<div>
    <form action="AddOption.php" method="post" name="form1" id="form1" enctype="multipart/form-data">
        <h5 id="response"></h5>

        <label>添加选项</label>
        <input name="option" type="text" placeholder="请输入题目选项！"><br><br>

        <label>所属问题</label>
        <select name="question">
            <option value="checked">请选择问题</option>
            <?php
            $result = $db->query("select * from questions");
            while($row = mysqli_fetch_assoc($result)){   ?>
                <option value="<?php echo $row['id']; ?>"><?php echo $row['question_name']; ?></option>
            <?php } ?>
        </select><br><br>

        <label></label>
        <button>添加选项</button>
    </form>
</div>
</body>
</html>
