<?php
include("../config.php");
$id=$_POST['id'];
$username=$_POST['username']; 
$password=$_POST['password'];        
$email=$_POST['email'];       
$nickname=$_POST['nickname'];        
$state=$_POST['state'];
      
$result=$conn->query("UPDATE user SET  username='".$username."', password='".$password."',email='".$email."',nickname='".$nickname."',state='".$state."' where id='".$id."'");
if($result)
{
 $succ="修改用户成功";
 $error="";
}
else{
  $succ="";
 $error="修改用户失败";
}
 session_start();
$_SESSION['succ']=$succ;
$_SESSION['error']=$error;
header("location:user_state.php");