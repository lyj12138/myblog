<?php
include("../config.php");
$id=$_POST['id'];
$password=$_POST['password'];
$result=$conn->query("select * from admin where id=".$id);
$user=mysqli_fetch_assoc($result);
if($id==$user['id'])
{
if($password==$user['password'])
{
date_default_timezone_set('PRC');
$date=date('Y-m-d H:i:s',time());
$ip=$_SERVER['HTTP_HOST'];
$result=$conn->query("insert into admin_login_log(admin_id,date,ip) values('$id','$date','$ip')");
session_start();
$_SESSION['id']=$id;
echo 2;
}
else{
    echo 1;
}
}
else
{
    echo 0;
}
