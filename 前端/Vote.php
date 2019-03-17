<?php
/**
 * Created by PhpStorm.
 * User: 皇阿玛
 * Date: 2019/2/27
 * Time: 16:00
 */

include ("conn.php");

@session_start();
$ss = $_POST;

/*
if($_POST['num'] != count($ss)-2){
    echo "<script>alert('请完善你的选择!');</script>";
    echo "<script>history.go(-1);</script>";
    exit();
}
*/

if($_POST['code_num']!=$_SESSION['VCode'] || $_POST['code_num']=='') {     //验证码

    if ($_POST['code_num'] != $_SESSION['VCode']) {
        #  echo "<script>alert($_SESSION[VCode]);</script>";
        #  echo "<script>alert($_POST[code_num]);</script>";
        echo "<script>alert('验证码错误！');</script>";
        echo "<script>history.go(-1);</script>";
        exit();
    }
}

$user_id =$_SESSION['user_id'];
$vote_id =$_SESSION['vote_id'];
#var_dump($_SESSION['user_id']);
#var_dump($_SESSION['vote_id']);


function vote($ss,$db){
    $success = true;

    foreach ($ss as &$value){
        $result = $db->query("select option_count from options where id='".$value."'");
        $row = mysqli_fetch_assoc($result);
        $result = $db->query("update options set option_count='".($row['option_count']+1)."' where id='".$value."'");  //选项选择人数 + 1
        if(!$result){
            $success = false;
        }
    }

    if($success){
        foreach ($ss as $key => $value){
            $result = $db->query("select sum(option_count) from options where question_id='".$key."'");
            $row = mysqli_fetch_assoc($result);
            $result = $db->query("update questions set counts='".$row['sum(option_count)']."' where id='".$key."'");
            if(!$result){
                $success = false;}
        }
        if($success){return true;}
    }
    return false;
}


$result = $db->query("select * from votes");
$row = mysqli_fetch_assoc($result);

$now = mktime(0,0,0,date('m'),date('d'),date('y'));
$arr = explode("-",$row['end_time']);
@$end_time = mktime(0,0,0,$arr[1],$arr[2],$arr[0]);  //month,day,year

if(round(($end_time-$now)/3600/24) < 0){
    echo "<script>alert('当前已过投票时间！')</script>";
    echo "<meta http-equiv=\"Refresh\" content=\"0;url=VoteSelect.php\">";  //返回投票选择界面
    exit();
}

$user_msg = $db->query("select * from users");
$row_user = mysqli_fetch_assoc($user_msg);
# $question_msg = $db->query("select * from questions");
# $row_question = mysqli_fetch_assoc($question_msg);
if($_SESSION['user'] == true){
    #$test = mysqli_query($db,"select * from links where user_id='".$_SESSION['user_id']."' and vote_id='".$_SESSION['vote_id']."'");  //是否已投过票
    $test = mysqli_query($db,"select * from links where user_id='$user_id' and vote_id='$vote_id'");
    #$sql = "select * from links where user_id=$_SESSION[user_id] and vote_id=$_SESSION[vote_id]";
    #$test = mysqli_query($db,$sql);
    $test_row = mysqli_fetch_array($test);
    if($test_row){
        echo "<script>alert('你已经投过票了');</script>";
        echo "<meta http-equiv=\"Refresh\" content=\"0;url=VoteSelect.php\">";  //返回投票选择界面
        exit();}
    else{
        vote($ss, $db);
        #$db->query("insert into links set user_id='".$_SESSION['user_id']."' and vote_id='".$_SESSION['vote_id']."'");
        #mysqli_query($db,"insert into links set user_id='$_SESSION[user_id]' and vote_id='$_SESSION[vote_id]'");  //插入links
        mysqli_query($db,"insert into links(vote_id, user_id) values($vote_id,$user_id)");
        echo "<script>alert('投票成功');</script>";
        echo "<meta http-equiv=\"Refresh\" content=\"0;url=server/admin/ResultShow.php\">";
        exit();}
    }
else{
    echo "<script>alert('请先登录再投票');</script>";
    echo "<script>history.go(-1);</script>";
    exit();
}






