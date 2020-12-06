<?php
include("../config.php");
$result=$conn->query("select * from user order by id desc");
$user=mysqli_fetch_assoc($result);
$id=$user['id']+1;
$username=$_POST['username'];
$email=$_POST['email'];
$nickname=$_POST['nickname'];
$password=$_POST['password'];
$result=mysqli_query($conn,"select * from user where email='".$email."'");
$rowcount=mysqli_num_rows($result);
$result=mysqli_query($conn,"select * from user where username='".$username."'");
$rowcount1=mysqli_num_rows($result);
if($rowcount)
{
echo 0;
}
else if($rowcount1)
{
    echo 1;
}
else
{
$conn->query("insert into user(id,username,password,email,nickname) values('$id','$username','$password','$email','$nickname')");
session_start();
$_SESSION['user_id']=$id;
echo  2;
}
