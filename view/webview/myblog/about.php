<?php ini_set('display_errors','Off'); ?>
<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>迷失的路</title>
    <link rel="shortcut icon" type="image/x-icon" href="../static/images/web-icon.png" media="screen" />

    <style>

        *{
            padding: 0;
            margin: 0;
        }
        #bg:after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,.4);
            z-index: 1;
        }/*给背景图片设置蒙版*/
        body {
            font: 14px/1.5 微软雅黑, arial, sans-serif;
            width: 100%;
            overflow: scroll;
        }
        #header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 66px;
            color: #fff;
            z-index: 9999;
            transition: all .3s;
        }/*设置页眉*/
        #header nav {
            position: relative;
            width: 80%;
            margin: 0 auto;
        }
        ul {
            list-style: none;
        }/*去掉列表样式*/
        #header nav li {
            border: 0;
            display: inline-block;
            height: 66px;
            line-height: 66px;
            font-size: 16px;
            position: relative;
            cursor: pointer;
        }
        #header nav li a {
            display: inline-block;
            padding: 0 12px;
            white-space: nowrap;
            color: #fff;
        }
        a {
            text-decoration: none;
        }/*去掉链接下划线*/
        #bg {
            position: relative;
            background: url("../static/images/mybackground.jpg") no-repeat gray;
            background-size: cover;
        }/*设置背景图片*/
        #bg p {
            position: relative;
            color: hsla(0,0%,100%,.9);
            text-align: center;
            font-size: 26px;
            line-height: 2;
            z-index: 2;
            letter-spacing: 3px;
            text-shadow: 0 3px 25px rgba(0,0,0,.3);
            cursor: progress;
            padding: 210px 0px;
        }/*设置文字属性*/
        #bg p i {
            text-decoration: line-through;
            font-size: 20px;
            color: hsla(0,0%,100%,.8);
            text-shadow: 0 0 0 transparent;
            font-style: normal;
        }/*设置第二行文字属性*/
        #header nav figure
        {
            background:url("");
            height: 50px;
            width: 50px;
            background-size:cover ;

        }
        #header nav .my-info {
            position: absolute;
            top: 8px;
            right: 0;
        }
        figure {
            display: block;
            -webkit-margin-before: 1em;
            -webkit-margin-after: 1em;
            -webkit-margin-start: 40px;
            -webkit-margin-end: 40px;
            border-radius:100px;
        }

        #header nav span {
            font-size: 18px;
            margin: 0 10px;
        }
        #header nav figure, #header nav span {
            display: inline-block;

            vertical-align: middle;
        }

        #copyright {
            position: absolute;
            top: 0;
            left: 0;
            background: #0e0e0e;
            width: 100%;
            height: 100%;
            transform-origin: 100% 0;
            transition: all .5s;
            z-index: 2;
        }
        #copyright p {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%,-50%);
            line-height: 2;
        }
        #footer {
            position: relative;
            height: 160px;
            border-top: 1px solid #eee;
            color: hsla(0,0%,100%,.69);
            font-size: 12px;
            text-align: center;
            border-top: 2px dashed #98b7ff;
            transition: height .1s 1s;
        }
        #hiddenewm p{
            color: #444;
        }
        #hiddenewm
        {
            background: #fff;
            text-align: center;
            position: absolute;
            left: 25px;
            top: 70px;
        }
        #container {
            position: relative;
            max-width: 95%;
            margin: 0 auto;
        }
        .article {
            box-shadow: 5px 5px 25px #dadada;
            position: relative;
            padding: 0 20px;
            margin: 40px auto;
            max-width: 950px;
            background: #fff;
            text-align: center;
        }
        .article>time {
            position: absolute;
            top: 0;
            left: 0;
            border-bottom: 1px solid #ccc;
            font-size: 14px;
            padding: 4px 5px 0;
            color: #999;
        }
        .article h2 {
            padding-bottom: .5em;
            font-size: 1.75em;
            line-height: 1.225;
        }
        .article>h2 {
            padding: 35px 0 45px;
            font-size: 22px;
            font-weight: 700;
            cursor: pointer;
        }
        #container a {
            color: #333;
        }
        .article>span {
            position: absolute;
            top: 0;
            right: 0;
            color: #999;
            padding: 3px 10px;
            background: #f1f1f1;
            font-size: 14px;
        }
        .article section {
            text-align: left;
            padding: 10px;
            font-size: 16px;
        }
        .article blockquote {
            padding: 0 15px;
            color: #777;
            border-left: 4px solid #ddd;
        }
        .article footer {
            padding: 25px 0 20px;
        }
        .article footer a {
            display: inline-block;
            color: #18bc9c;
            cursor: pointer;
            padding: 4px 20px;
            border-radius: 5px;
            transition: all .5s;
            border: 1px solid #18bc9c;
        }
        #pagebar{
            text-align: center;
        }


    </style>
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