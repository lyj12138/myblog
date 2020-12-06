<?php ini_set('display_errors','Off'); ?>
<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>博客管理系统</title>
    <link rel="stylesheet" href="../static/css/bootstrap4.0.min.css" >
    <script src="../static/js/jquery.slim.min.js" ></script>
    <script src="../static/js/popper.min.js" ></script>
    <script src="../static/js/bootstrap4.0.min.js"></script>
    <script src="../static/js/layer.js"></script>
</head>
<body>
<div style="position: relative;top: 10%">
<?php 
 if(isset($_SESSION['succ']))
$succ=$_SESSION['succ'];
else
$succ="";
if($succ!="")
{
    ?>
    
        <div class="alert alert-success" role="alert">
                <?php  echo $succ; ?>
        </div>
 <?php
 $_SESSION['succ']="";
 }
 ?>
 <?php 
  if(isset($_SESSION['error']))
$error=$_SESSION['error'];
else
$error="";
if($error!="")
{
    ?>
    
        <div class="alert alert-danger" role="alert">
                <?php  echo $error; ?>
        </div>
 <?php
 $_SESSION['error']="";
 }
 ?>
</div>
<div class="container">
<?php
include("../config.php");
if(isset($_GET['id']))
$id=$_GET['id'];
else
$id=-1;
$comments=$conn->query("select * from comment where article_id=".$id); 
if($comments)
$count=mysqli_num_rows($comments);
else
$count=0;
if($count)
{
?>
    <table class="table">
        <thead class="thead-default">
        <tr>
            <th>流水号</th>
            <th>评论内容</th>
            <th>日期</th>
            <th>昵称</th>
            <th>邮箱</th>
            <th>删除</th>
        </tr>
        </thead>
        <tbody>
<?php
foreach($comments  as $k => $v):
?>
        <tr>
            <th scope="row"><?php echo $v['id']; ?></th>
            <td><?php echo $v['content']; ?></td>
            <td><?php echo $v['date']; ?></td>
            <td><?php echo $v['name']; ?></td>
            <td><?php echo $v['email']; ?></td>
            <td><button type="button" class="btn btn-outline-danger btn-sm" onclick="ifdelete('<?php echo $v['id']; ?>','<?php echo $id; ?>') ">删除</button></td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
        <script src="../static/js/jquery-3.2.1.min.js"></script>
        <script>
            function ifdelete(id,article_id) {
                layer.confirm('确定删除该评论吗?', {
                    btn: ['确定','取消'] //按钮
                }, function(){
                    var url="dodelcomment.php?id="+id+"&article_id="+article_id
                       location.replace(url)
                }, function(){

                });
            }
        </script>
    <?php
}
?>
    

        <div class="card" style="<?php if($count)echo "display:none";?>">
            <div class="card-body">
                该文章暂无评论!
            </div>
        </div>

</div>
</body>
</html>