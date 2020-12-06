<?php
include("../config.php");
$id=$_GET['id'];
$article_id=$_GET['article_id'];
$result=$conn->query("delete from comment where id=".$id);
if($result){
    $succ="删除评论成功";
    $error="";
   }
   else{
     $succ="";
    $error="删除评论失败";
   }
    session_start();
   $_SESSION['succ']=$succ;
   $_SESSION['error']=$error;
header("location:comment_list.php?id=".$article_id);