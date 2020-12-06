<?php
include("../config.php");
$id=$_GET['id'];
$flag=$_GET['flag'];
$username=$_GET['username'];
$result=$conn->query("delete from user where id=".$id);
$conn->query("delete from article where user_id=".$id);
$conn->query("delete from comment where name='".$username."'");
if($flag)
header("location:./user_statelist.php");
else
header("location:./user_info.php");