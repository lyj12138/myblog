<?php ini_set('display_errors','Off'); ?>
<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>迷失的路</title>
    <link rel="shortcut icon" type="image/x-icon" href="../static/images/web-icon.png" media="screen" />
    <link rel="stylesheet" href="../static/css/about.css">
</head>
<body background="../static/images/bg.png" >

<div>
    <header id="header">
        <nav>
            <ul>
                <li>
                    <a href="./index.php">首页</a>
                    <a href="./about.php">关于</a>
                    <a href="userlogin.php"><?php if($_SESSION['user_id']) echo "退出登录"; else echo "登录";?></a>
                    <a href="<?php if($_SESSION['user_id']) echo "userblog.php";else echo "userlogin.php"?>">我的博客</a>
                </li>
            </ul>
            <div class="my-info" onmouseover="hiddeewm()" onmouseout="hiddeewm()">
                <figure></figure>
                <span>but are we all lost stars?</span>
                <div id="hiddenewm" hidden="true" >
                    <img src="../static/images/4.jpg" width="200px" height="200px" >
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
    <div id="container">
        <article class="article">
            <p>
                <br><br><br><br>
            <h3>我怀念的</h3>
            <br><br>
            <h3>邮箱:<a href="mailto:290162743@qq.com">290162743@qq.com</a></h3>
            <br><br><br><br>
            </p>
        </article>
    </div>
</div>
<footer id="footer">
    <section id="copyright">
        <p style="font-size: 20px">
            © 2020 <a href="/">迷失的路</a>
        </p>
    </section>
</footer>
</div>
</div>
</body>
</html>