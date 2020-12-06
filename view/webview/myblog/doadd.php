<?php
include("../config.php");
session_start();
$user_id=$_SESSION['user_id'];
$title=$_POST['title']; 
$catalogId=$_POST['catalogId'];        
$keywords=$_POST['keywords'];       
$desci=$_POST['desci'];        
$content=$_POST['content'];
date_default_timezone_set('PRC');        
$time=date('Y-m-d H:i:s',time());
$result=$conn->query("insert into article(title,keywords,desci,content,time,catalog_id,user_id) values('$title','$keywords','$desci','$content','$time','$catalogId','$user_id')");
if($result){
 $succ="发表文章成功";
 $error="";
}
else{
  $succ="";
 $error="发表文章失败";
}
 session_start();
$_SESSION['succ']=$succ;
$_SESSION['error']=$error;
header("location:article_add.php");
