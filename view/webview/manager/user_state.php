<?php ini_set('display_errors','Off'); ?>
<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../static/css/bootstrap4.0.min.css" >
    <script src="../static/js/jquery.slim.min.js" ></script>
    <script src="../static/js/popper.min.js" ></script>
    <script src="../static/js/bootstrap4.0.min.js"></script>
    <script type="text/javascript" src="../static/js/ueditor/ueditor.config.js"></script>
    <script type="text/javascript" src="../static/js/ueditor/ueditor.all.js"> </script>
    <script type="text/javascript"  src="../static/js/lang/zh-cn/zh-cn.js"></script>
    <script type="text/javascript" src="../static/js/wangEditor.min.js"></script>
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
    <form action="douseredit.php" method="post">
    <?php
    include("../config.php"); 
    if(isset($_GET['id']))
    $id=$_GET['id'];
    else
    $id=-1;
    $result=$conn->query("select * from user where id=".$id); 
    $user=mysqli_fetch_assoc($result);
    ?>
        <input type="hidden" value="<?php echo $user['id'];?>" name="id">
        <div class="form-group">
            <label for="useranme">用户名</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="用户名" value="<?php echo $user['username'];?>">
        </div>
        <div class="form-group">
            <label for="password">密码</label>
            <input type="text" class="form-control" id="password" name="password" placeholder="密码" value="<?php echo $user['password'];?>">
        </div>
        <div class="form-group">
            <label for="email">邮箱</label>
            <input type="text" class="form-control" id="email" name="email" placeholder="邮箱" value="<?php echo $user['email'];?>">
        </div>
        <div class="form-group">
            <label for="nickname">昵称</label>
            <input type="text" class="form-control" id="nickname" name="nickname" placeholder="昵称" value="<?php echo $user['nickname'];?>">
        </div>
        <div class="form-group">
            <label for="state">状态</label>
            <input type="text" class="form-control" id="state" name="state" placeholder="状态" value="<?php echo $user['state'];?>">
        </div>
            <input type="submit" value="修改">
                </form>
        </div>
</body>
</html>