<?php
include("../config.php");
$id=$_GET['id'];
if(isset($_GET['flag']))
$flag=$_GET['flag'];
else
$flag=0;
$result=$conn->query("delete from article where id=".$id);
$conn->query("delete from comment where article_id=".$id);
if($flag)
{
header("location:../myblog/myarticle_list.php"); 
}
else
header("location:./article_list.php");



