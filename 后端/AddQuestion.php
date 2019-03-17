<?php
/**
 * Created by PhpStorm.
 * User: 皇阿玛
 * Date: 2019/2/28
 * Time: 10:57
 */

include ('../../conn.php');
if(isset($_POST['question']) ? $_POST['question']:''){
    $question = $_POST['question'];
    $question_type = $_POST['type'];
    $vote_id = $_POST['vote'];
    $sql = $db->query("insert into questions(question_name,type,vote_id) values ('$question','$question_type','$vote_id')");
    if($sql){
        echo "<script>onload=function() {document.getElementById('response').innerHTML ='添加问题成功！';}</script>";}
    else{
        echo "<script>onload=function() {document.getElementById('response').innerHTML ='添加问题失败！';}</script>";}
}
?>

<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html" charset="utf=8">
    <title>添加问题</title>
</head>
<body>
<div>
    <form action="AddQuestion.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
        <h5 id="response"></h5>
        <label>添加问题</label><br><br>
        <input type="text" name="question" placeholder="请输入要添加的问题！"><br><br>

        <label>问题类型</label>
        <input type="radio" name="type" value="0">单选
        <input type="radio" name="type" value="1">多选    <!-- 0单选，1多选 --> <br><br>

        <label>所属投票</label>
        <select name="vote">
            <option value="checked">请选择投票</option>
            <?php
            $result = $db->query("select * from votes");
            while($row = mysqli_fetch_assoc($result)){   ?>
                <option value="<?php echo $row['id']; ?>"><?php echo $row['title']; ?></option>
            <?php } ?>
        </select>

        <button>添加问题</button>
    </form>
</div>
</body>
</html>