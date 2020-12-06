<?php ini_set('display_errors','Off'); ?>
<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>博客管理系统</title>
    <link rel="stylesheet" href="../static/css/bootstrap4.0.min.css" >
    <script src="../static/js/jquery.slim.min.js" ></script>
    <script src="../static/js/popper.min.js" ></script>
    <script src="../static/js/bootstrap4.0.min.js"></script>
    <script src="../static/js/layer.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light" >
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand text-success" href="main.php">博客管理</a>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
        <li class="nav-item">
                <div class="btn-group">
                    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        管理用户
                    </button>
                    <div class="dropdown-menu">
<a class="dropdown-item" href="javascript:void(0);" onclick="fullScreen('审核注册申请','user_statelist.php')">审核注册申请</a>
<a class="dropdown-item" href="javascript:void(0);" onclick="fullScreen('查看用户详情','user_info.php')">查看用户详情</a>
                    </div>
                </div>
            </li>
         
            <li class="nav-item active">
                <a class="nav-link" href="main.php">主页 </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="article_list.php">文章管理</a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0" action="article_search.php" method="POST">
            <input class="form-control mr-sm-2" type="search" placeholder="文章标题或内容..." aria-label="Search" name="word">
            <button class="btn btn-outline-success my-2 my-sm-0 btn-sm" type="submit">搜索</button>
        </form>

        <a class="btn btn-outline-danger btn-sm" href="login.php" role="button">退出</a>
    </div>
</nav>
<div class="card mb-3">
    <div style="height: 180px;overflow: hidden">
        <img class="card-img-top" src="../static/images/4.jpg" alt="Card image cap" style="height: 100%;width:100%;">
    </div>

    <div class="card-body">
        <h4 class="card-title">
        <?php
        include("../config.php");
        if(isset($_SESSION['id']))
{
    $id=$_SESSION['id']; 
}
else{
    header("login.php");
}
        $result=$conn->query("select * from admin where id=".$id);
        $admin=mysqli_fetch_assoc($result);
        $result1=$conn->query("select * from admin_login_log where admin_id='$id' order by id desc");
        $loginlog=mysqli_fetch_assoc($result1);
         echo  $admin['username'];
         ?>
        </h4>
        <p class="card-text"><small class="text-muted">上次登录时间:<?php echo $loginlog['date']; ?></small></p>
        <p class="card-text"><small class="text-muted">上次登录IP:<?php echo $loginlog['ip']; ?></small></p>
        <p class="card-text"><small class="text-muted">本次登录IP:<?php echo $_SERVER['HTTP_HOST'];?></small></p>
    </div>
</div>
<div >
    <table class="table table-hover">
        <p class="text-success" style="text-align: center"> 系统统计</p>
        <thead>
        <tr >
            <th>#</th>
            <th>文章数</th>
            <th>评论数</th>
            <th>登陆次数</th>
        </tr>
        </thead>
        <tbody>
        <tr class="table-success">
            <th scope="row">全部</th>
            <td><?php 
            $result2=$conn->query("select count(*) from article");  
            $count=$result2->fetch_row(); 
             $totalNumber=$count[0]; 
             echo $totalNumber;
             $result3=$conn->query("select count(*) from comment");  
             $count1=$result3->fetch_row(); 
              $totalNumber1=$count1[0]; 
              $result4=$conn->query("select count(*) from admin_login_log ");  
             $count2=$result4->fetch_row(); 
              $totalNumber2=$count2[0]; 
             ?></td>
            <td><?php echo $totalNumber1;?></td>
            <td><?php echo $totalNumber2;?></td>
        </tr>
        </tbody>
    </table>
</div>

<div style="width: 50%;position: relative;left: 25%">
    <table class="table table-sm" >
        <p class="text-success" style="text-align: center"> 系统信息</p>

        <tr>
            <th scope="row">服务器IP</th>
            <td><?php echo $_SERVER['HTTP_HOST'];?></td>
        </tr>
        <tr>
            <th scope="row">服务器端口</th>
            <td><?php echo $_SERVER['SERVER_PORT'];?></td>
        </tr>
        <tr>
            <th scope="row">服务器当前时间</th>
            <td><?php
            date_default_timezone_set('PRC');
           echo date('Y-m-d H:i:s',time());
           ?></td>
        </tr>

    </table>
</div>
<script>
    function fullScreen(title,url){
        var index = layer.open({
            type: 2,
            title: title,
            area: ['70%', '70%'],
            content: url,
            maxmin: true,
            end: function(){
               location.replace("./main.php");
            }
        });
        layer.full(index);
    }
</script>
</body>
</html>