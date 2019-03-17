<?php
/**
 * Created by PhpStorm.
 * User: 皇阿玛
 * Date: 2019/2/28
 * Time: 18:50
 */

error_reporting(0);
include ('../../conn.php');

?>

<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html" charset="utf-8">
    <title>结果展示</title>
    <link rel="stylesheet" href="../css/add.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="../css/bootstrap.min.css" type="text/css" media="screen" />

</head>
<body>
<div class="div_from_auto" style="width: 80%; margin: 3em 4em; ">
    <?php
    $num = 0;
    $result_question = mysqli_query($db,"select * from questions");
    while($row_question = mysqli_fetch_assoc($result_question)){
        $num += 1;  ?>
        <div class="control-group" style=" height: auto;">
            <label class="label_from" style="line-height: inherit; margin-bottom: 0;width:auto;"><?php echo $num.".".$row_question['question_name']; ?></label>
            <br>
            <?php
            $result_option = mysqli_query($db,"select * from options where question_id='".$row_question['id']."';");
            $count = $row_question['counts'];
            while ($row_option = mysqli_fetch_assoc($result_option)){     ?>
                <div class="controls" style=" float: left; width: 580px; margin: 2px 0 0 2em; clear: both;">
                    <div style="width: 200px;float: left"><?php echo $row_option['content']; ?></div>
                    <div style="float: left">
                    <div style="float:left; text-align:right; width:40px;"><?php echo $row_option['option_count']; ?>票</div>
                    <img src="../../images/option.jpg" height="5" width="<?php echo $row_option['option_count']/$count*100 ?>">
                    <?php echo round($row_option['option_count']/$count*100) ?>%
                </div>
                </div>
            <?php } ?>
            <div style="clear: both;"></div>
        </div>
    <?php } ?>
</div>
</body>
</html>
