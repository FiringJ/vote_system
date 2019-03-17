<?php
/**
 * Created by PhpStorm.
 * User: 皇阿玛
 * Date: 2019/3/5
 * Time: 21:56
 */


include("../../conn.php");
$do=isset($_GET['do'])?$_GET['do']:'';
if( $do== "delete"){
    $id = $_GET['id'];
    $result = $db->query("delete from options where id in ($id);");
    if($result){
        echo "<script>onload = function(){document.getElementById('response').innerHTML='删除成功';}</script>";
    }else{
        echo "<script>onload = function(){document.getElementById('response').innerHTML='删除失败';}</script>";
    }
}
$sub=isset($_POST['Submit'])?$_POST['Submit']:'';
if($sub){
    $id = $_POST['id'];
    $option_content = $_POST['content'];
    $option_count = $_POST['option_count'];
    $question_id = $_POST['subject'];
    $result = $db->query("update options set content='$option_content',option_count='$option_count',question_id='$question_id' where id='$id';");
    if($result){
        echo "<script>onload = function(){document.getElementById('response').innerHTML='修改成功';}</script>";
    }else{
        echo "<script>onload = function(){document.getElementById('response').innerHTML='修改失败';}</script>";
    }

}


?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>选项管理</title>

    <script language="javascript">
        function SelectAll()
        {
            var node = document.getElementsByName("CheckBoxItem");
            for(var i=0; i<node.length;i++){
                node[i].checked=true;
            }
        }
        function UnSelectAll(){
            var node = document.getElementsByName("CheckBoxItem");
            for(var i=0; i<node.length;i++){
                node[i].checked = false;
            }
        }
        function DeleteSelect(){
            var node = document.getElementsByName("CheckBoxItem");
            id = "";
            for(var i=0; i<node.length;i++){
                if(node[i].checked){
                    if(id == ""){
                        id = node[i].value;
                    }else{
                        id = id+", "+node[i].value;
                    }
                }
            }
            if(id == ""){
                alert("请选择删除项");
            }else{
                location.href="?do=delete&id="+id;
            }
        }
    </script>

</head>
<body>

<div>
    <div>
        <h5 id="response"></h5>
    </div>
    <form name="form1" method="post" action="">
        <table>
            <tr>
                <td>ID</td>
                <td>选项</td>
                <td>选择人数</td>
                <td>问题ID</td>
                <td>修改</td>
                <td>删除</td>
            </tr>
            <?php
            $result = mysqli_query($db,"select * from options;");
            while($row = mysqli_fetch_assoc($result)){
                ?>
                <tr>
                    <td><input name="CheckBoxItem" type="checkbox" value="<?php echo $row['id']; ?>"><?php echo $row['id']; ?></td>
                    <td><?php echo $row['content'] ?></td>
                    <td><?php echo $row['option_count'] ?></td>
                    <td><?php echo $row['question_id'] ?></td>
                    <td><input value="修改" type="button" onClick="location.href='?do=change&id=<?php echo $row['id']; ?>'"></td>
                    <td><input value="删除" type="button" onClick="location.href='?do=delete&id=<?php echo $row['id']; ?>'"></td>
                </tr>
            <?php }?>
            <tr>
                <td colspan="4">
                    <input value="选择全部" type="button" onClick="SelectAll()" />
                    <input value="取消全选" type="button" onClick="UnSelectAll()" />
                    <input value="删除所选" type="button" onClick="DeleteSelect()" />
                </td>
            </tr>
        </table>
    </form>

    <?php
    $do1=isset($_GET['do'])?$_GET['do']:'';
    if($do1== "change"){
        $id = $_GET['id'];
        $result = mysqli_query($db,"select * from options where id='$id';");
        $row = mysqli_fetch_assoc($result)
        ?>
        <br/>
        <div>
            <form action="" method="post">
                <input name="id" type="hidden" value="<?php echo $id; ?>">
                <label>
                    <input name="content" type="text" value="<?php echo $row['content']; ?>">
                </label>
                <label>
                    <input name="option_count" type="text" value="<?php echo $row['option_count']; ?>">
                </label>
                <label>
                    <select name="subject" style="">
                        <?php
                        $result1 = $db->query("select * from questions");
                        while ($row1 = mysqli_fetch_assoc($result1)) {
                            if ($row1['id'] == $row['question_id']) {
                                echo '<option selected value="' . $row1['id'] . '">' . $row1['content'] . '</option>';
                            } else {
                                echo '<option value="' . $row1['id'] . '">' . $row1['content'] . '</option>';
                            }
                        }?>
                    </select>
                </label>
                <label>
                    <input name="submit" type="submit" value="修改">
                </label>
            </form>
        </div>

    <?php } ?>
</div>
</body>
</html>