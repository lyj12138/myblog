<?php
include("../config.php");
$id=$_POST['id'];
$title=$_POST['title']; 
$catalogId=$_POST['catalogId'];        
$keywords=$_POST['keywords'];       
$desci=$_POST['desci'];        
$content=$_POST['content'];
date_default_timezone_set('PRC');        
$time=date('Y-m-d H:i:s',time());
$result=$conn->query("UPDATE article SET  title='".$title."',catalog_id='".$catalogId."',keywords='".$keywords."',content='".$content."',desci='".$desci."',time='".$time."' where id='".$id."'");
if($result)
{
 $succ="修改文章成功";
 $error="";
}
else{
  $succ="";
 $error="修改文章失败";
}
 session_start();
$_SESSION['succ']=$succ;
$_SESSION['error']=$error;
header("location:article_edit.php");