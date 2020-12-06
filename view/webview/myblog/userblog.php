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
    <a class="navbar-brand text-success" href="userblog.php">我的博客管理</a>
 <?php 
 include("../config.php");
 $id=$_SESSION['user_id'];
 $result=$conn->query("select * from user where id=".$id);
 $user=mysqli_fetch_assoc($result);
 ?>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">首页</a>
                </li>
                <li clas="nav-item">
                <a class="nav-link" href="about.php">关于</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="userlogin.php"><?php if($_SESSION['user_id']) echo "退出登录"; else echo "登录";?></a>
                    </li>
            <li class="nav-item">
                <div class="btn-group">
                    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        新建
                    </button>
                    <div class="dropdown-menu">
<a class="dropdown-item" href="javascript:void(0);" <?php if($user['state']!="未激活") {?>onclick="fullScreen('添加文章','article_add.php')" <?php }?> >文章</a>
                    </div>
                </div>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="userblog.php">我的主页 </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="myarticle_list.php">文章管理</a>
            </li>

        </ul>
        <form class="form-inline my-2 my-lg-0" action="myarticle_search.php" method="POST">
            <input class="form-control mr-sm-2" type="search" placeholder="文章标题或内容..." aria-label="Search" name="word">
            <button class="btn btn-outline-success my-2 my-sm-0 btn-sm" type="submit">搜索</button>
        </form>

        <a class="btn btn-outline-danger btn-sm" href="userlogin.php" role="button">退出</a>
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
        if(isset($_SESSION['user_id']))
{
    $id=$_SESSION['user_id']; 
}
else{
    header("userlogin.php");
}
        $result=$conn->query("select * from user where id=".$id);
        $user=mysqli_fetch_assoc($result);
         echo  $user['username'];
          if($user['state']=="未激活") 
          echo "审核还未通过，暂时不能进行创作";
         ?>
        </h4>
    </div>
</div>
<div>
    <table class="table table-hover">
        <p class="text-success" style="text-align: center"> 系统统计</p>
        <thead>
        <tr >
            <th>#</th>
            <th>我的文章数</th>
        </tr>
        </thead>
        <tbody>
        <tr class="table-success">
            <th scope="row">全部</th>
            <td><?php 
            $result2=$conn->query("select count(*) from article where user_id=".$id);  
            $count=$result2->fetch_row(); 
             $totalNumber=$count[0]; 
             echo $totalNumber; 
             ?></td>
            <td><?php echo $totalNumber;?></td>
        </tr>
        </tbody>
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
               location.replace("./userblog.php");
            }
            
        });
        layer.full(index);
    }
</script>
</body>
</html>