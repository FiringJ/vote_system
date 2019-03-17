<?php
/**
 * Created by PhpStorm.
 * User: 皇阿玛
 * Date: 2019/3/5
 * Time: 22:25
 */

	include("../../conn.php");
    $do=isset($_GET['do'])?$_GET['do']:'';
	if( $do== "delete"){
		$id = $_GET['id'];
		$result = $db->query("delete from votes where id in ($id);");
        $result1 = $db->query("delete from questions where vote_id in ($id);");
		if($result && $result1){
			echo "<script>onload = function(){document.getElementById('response').innerHTML='删除成功';}</script>";
		}else{
			echo "<script>onload = function(){document.getElementById('response').innerHTML='删除失败';}</script>";
		}
	}
$sub=isset($_POST['Submit'])?$_POST['Submit']:'';
	if($sub){
		$id = $_POST['id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $end_time = $_POST['end_time'];
		$result = $db->query("update votes set title='$title',description='$description',end_time='$end_time' where id='$id';");
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
<title>投票管理</title>

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
        <td>标题</td>
        <td>描述</td>
        <td>截止日期</td>
        <td>修改</td>
        <td>删除</td>
      </tr>
	  <?php
			$result = mysqli_query($db,"select * from votes;");
	  		while($row = mysqli_fetch_assoc($result)){
	  ?>
      <tr>
        <td><input name="CheckBoxItem" type="checkbox" value="<?php echo $row['id']; ?>"><?php echo $row['id']; ?></td>
          <td><?php echo $row['title']; ?></td>                                                                         <!-- 投票标题 -->
          <td><?php echo $row['description']; ?></td>
          <td><?php echo $row['end_time']; ?></td>
        <td><input value="修改" type="button" onClick="location.href='?do=change&id=<?php echo $row['id']; ?>'"></td>
        <td><input value="删除" type="button" onClick="location.href='?do=delete&id=<?php echo $row['id']; ?>'"></td>
      </tr>
	  <?php }?>
	  <tr>
        <td colspan="4"><input value="选择全部" type="button" onClick="SelectAll()" />
						<input value="取消全选" type="button" onClick="UnSelectAll()" />
						<input value="删除所选" type="button" onClick="DeleteSelect()" /></td>
	  </tr>
    </table>
  </form>

 <?php
 $do1=isset($_GET['do'])?$_GET['do']:'';
	if($do1== "change"){
		$id = $_GET['id'];
		$result = mysqli_query($db,"select * from votes where id='$id';");
	  	$row = mysqli_fetch_assoc($result)
 ?>
  	<br/>
	<div>
	<form action="" method="post">
	  <input name="id" type="hidden" value="<?php echo $id; ?>">
      <label>
        <input name="title" value="<?php echo $row['title']; ?>" type=text>
      </label>
      <label>
        <input name="description" value="<?php echo $row['description']; ?>" type=text>
      </label>
	  <label>
	    <input name="end_time" type="date"  value="<?php echo $row['end_time']; ?>">
	  </label>
	  <label>
	    <input type="submit" name="Submit" value="修改">
	  </label>
	</form>
	</div>

 <?php } ?>
</div>
</body>
</html>