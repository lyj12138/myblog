<?php ini_set('display_errors','Off'); ?>
<?php session_start();?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>迷失的路</title>
    <link rel="shortcut icon" type="image/x-icon" href="../static/images/web-icon.png" media="screen" />
    <link rel="stylesheet" href="../static/css/bootstrap.min.css">
    <link rel="stylesheet" href="../static/css/article.css">
    <script src="../static/js/jquery-3.2.1.min.js"></script>
    <script src="../static/js/bootstrap.min.js"></script>
</head>
<body background="../static/images/bg.png" >
<?php 
include("../config.php"); 
$perNumber=5;  
if (!isset($_GET['page'])) {
 $page=1;
}  
else
$page=$_GET['page'];  
$result=$conn->query("select count(*) from article");  
$count=$result->fetch_row(); 
$totalNumber=$count[0];
if($totalNumber)
$totalPage=ceil($totalNumber/$perNumber);  
else
$totalPage=1;
$startCount=($page-1)*$perNumber;  
?>
<div>
    <header id="header">
        <nav>
            <ul>
                <li>
                    <a href="index.php">首页</a>
                    <a href="about.php">关于</a>
                    <a href="userlogin.php"><?php if($_SESSION['user_id']) echo "退出登录"; else echo "登录";?></a>
                    <a href="<?php if($_SESSION['user_id']) echo "userblog.php";else echo "userlogin.php"?>">我的博客</a>
                </li>
            </ul>
            <div class="my-info" onmouseover="hiddeewm()" onmouseout="hiddeewm()">
                <figure></figure>
                <span>but are we all lost stars?</span>
                <div id="hiddenewm" hidden="true" >
                    <img src="../static/images/3.jpg" width="200px" height="200px" >
                    <p></p>
                </div>
            </div>
        </nav>
    </header>
    <div id="bg" >
        <p>
            <em>岁月易逝</em>
            <br>
            <em>人生如白驹过隙</em>
        </p>
    </div>
</div>
<div id="container">
<?php
$articles=$conn->query("select * from article order by id DESC limit $startCount,$perNumber");  
foreach($articles  as $k => $v):?>
    <article class="article">
        <time><?php echo $v['time']; ?></time>
        <h2 class="title"><a href="detail.php?id=<?php echo $v['id'];?>"><?php echo $v['title'];?></a></h2>
        <span><i><?php echo $v['keywords'];?></i></span>
        <section class="article-content markdown-body">
            <blockquote>
                <p><?php echo $v['desci'];?></p>
            </blockquote>
            ......
        </section>
        <footer>
            <a href="detail.php?id=<?php echo $v['id'];?>" onclick="<?php $result=$conn->query("select * from article where id=".$v['id']); 
$article=mysqli_fetch_assoc($result); $click=$article['click']+1; $conn->query("update article set click='$click' where id=".$article['id']); ?>">阅读全文</a>
        </footer>
    </article>
<?php endforeach; ?>
 <div style="text-align: center">
            <ul class="pagination" >
                <li class="<?php if($page==1) echo "disabled"; ?>"><a href="<?php if($page==1) echo "index.php?page=1"; else echo "index.php?page=".($page-1); ?>">&laquo;</a></li>
   <?php
          for ($i=1;$i<=$totalPage;$i++) { 
     ?>
           <li class="<?php if($page==$i) echo "active";?>"><a href="index.php?page=<?php echo $i;?>"><?php echo $i;?></a></li>
        <?php
  }
?>
                <li class="<?php if($page==$totalPage) echo "disabled";?>"><a href="<?php if($page==$totalPage) echo "index.php?page=".$totalPage; else echo "index.php?page=".($page+1); ?>">&raquo;</a></li>
            </ul>
        </div>
</div>
    <footer id="footer">
        <section id="copyright">
            <p style="font-size: 20px">
                © 2020 <a href="/">迷失的路</a>
            </p>
        </section>
    </footer>
</body>
</html>