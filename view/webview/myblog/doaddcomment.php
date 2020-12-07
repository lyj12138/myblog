<?php
include("../config.php");
$article_id=$_POST['article_id'];
session_start();
$flag=$_POST['flag'];
$floor=$_POST['floor'];
$reference=$_POST['reference'];
$user_id=$_SESSION['user_id'];
$result=$conn->query("select * from user where id=".$user_id);
$user=mysqli_fetch_assoc($result);
$name=$user['username'];
$nickname=$user['nickname'];
$content=$_POST['content'];
date_default_timezone_set('PRC');
$date=date('Y-m-d H:i:s',time());
if($flag=="true")
$result=$conn->query("insert into comment(article_id,content,date,name,nickname,reference,floor) values('$article_id','$content','$date','$name','$nickname','$reference','$floor')");
header("location:./detail.php?id=".$article_id);