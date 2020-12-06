<?php
include("../config.php");
$id=$_POST['id'];
$_SESSION['user_id']=0;
$password=$_POST['password'];
$result=$conn->query("select * from user where id=".$id);
$user=mysqli_fetch_assoc($result);
if($id==$user['id'])
{
    if($password==$user['password'])
    {
session_start();
$_SESSION['user_id']=$id;
//date_default_timezone_set('PRC');
//$date=date('Y-m-d H:i:s',time());
//$ip=$_SERVER['HTTP_HOST'];
//$result=$conn->query("insert into admin_login_log(admin_id,date,ip) values('$id','$date','$ip')");
echo 2;
    }
    else
    {
        echo 1;
    }

}
else{
   echo 0;
}

