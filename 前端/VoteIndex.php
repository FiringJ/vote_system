<?php
/**
 * Created by PhpStorm.
 * User: 皇阿玛
 * Date: 2019/3/5
 * Time: 12:19
 */

include "conn.php";

@session_start();
if(isset($_POST['submit'])||$_POST['submit']!=''){
    $vote_id = $_POST['title'];   //vote-id
    $_SESSION['vote_id'] = $vote_id;
}
else{
    echo "<script>alert('请先选择投票');</script>";
    header("location:VoteSelect.php");
}

 $result = $db->query("select * from votes where id=$vote_id");
 $row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE HTML>
<html lang="zh">
<head>
    <meta http-equiv="Content-Type" content="text/html" charset="utf-8">
    <title>投票界面</title>
    <link rel="stylesheet" type="text/css" href="server/css/Voteindex.css" >
    <link rel="stylesheet" type="text/css" href="static/h-ui/css/H-ui.min.css" />
</head>
<body>
<div class="panel panel-primary">
    <div class="panel-header">
        <h1>
            <?php echo $row['title']; ?></h1>  </div> <!-- vote信息展示 -->
    <div class="panel-body">
        <?php echo $row['description']; ?>
    </div>
</div>
<div class="content">

    <form action="Vote.php" method="post">
        <?php
        $num = 0;
        $result_question = mysqli_query($db,"select * from questions where vote_id= $vote_id");
        while($row_question = mysqli_fetch_assoc($result_question)){
        $num += 1;                                          //此投票下问题数目
        ?>
            <h3><?php echo $num.".".$row_question['question_name']; ?></h3>   <!-- 投票下的问题 -->
            <?php
            $result_option = mysqli_query($db,"select * from options where question_id=$row_question[id]");
            while($row_option = mysqli_fetch_assoc($result_option)){ ?>
                <div class="votechoice">
                    <ul class="vote1">
                        <li><?php echo '<input name="'.$row_question['id'].'" type="radio" value="'.$row_option['id'].'">'.$row_option['content']; ?> </li>
                    </ul>
                </div>

                <!-- 问题下的选项 -->

            <?php }?>
            <?php } ?>


        <?php if ($result_question->num_rows > 0){ ?>  <!--问题数目大于0-->
            <div class="">
                <br>
                <input type="text" name="code_num" maxlength="4" placeholder="请输入验证码">
                <img onclick="this.src='VCode.php'" src="VCode.php" alt="看不清？点击换一张">
                <br><br>
                <input class="btn btn-primary radius" name="vote" type="submit" value="投票">
                <input name="num" type="hidden" value="<?php echo $num ?>" >  <!-- 问题数目 -->
            </div>

        <?php }else{ ?>
            <h1>当前没有投票</h1>
        <?php } ?>
    </form>
    <script type="text/javascript" src=""></script>
</div>
</body>
</html>
