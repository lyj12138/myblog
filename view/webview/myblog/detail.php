<?php ini_set('display_errors','Off'); session_start(); ?>
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
    <script src="../static/js/layer.js"></script>
</head>
<body background="../static/images/bg.png" >

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
<?php
include("../config.php"); 
$id=$_GET['id'];
if(isset($_GET['reference']))
$reference=$_GET['reference'];
else
$reference=0;
if(isset($_GET['floor']))
$floor=$_GET['floor'];
else
$floor=0;
$user_id=$_SESSION['user_id'];
$result=$conn->query("select * from article where id=".$id); 
$article=mysqli_fetch_assoc($result);
?>
<article class="article">
            <time id="time1"><?php echo $article['time']; ?></time>
            <h2 style="text-align: center; "><?php echo $article['title']; ?></h2>
            <p style="position: center" class="text-info">点击量:<?php echo $article['click']; ?></p>
            <section>
                <blockquote>
                    <p><?php echo $article['desci']; ?></p>
                </blockquote>
                <p id="zhengwen">
                <?php echo $article['content']; ?>
                </p>
                <p style="text-align:center;color:#ccc;font-size:12px;margin-top:40px;">
                    But are we all lost stars
                    <br>
                    trying to light up the world?
                </p>
                <p style="margin: 5em 0 1em;text-align: center;color: #83b8ec;font-size: .8em">
                    <span>Happy Everyday</span>
                </p>
            </section>
        </article>
    </div>
   
    <?php
    $i=1;
    $comments=$conn->query("select * from comment  where article_id='".$id."' order by id");  
   foreach($comments  as $k => $v):?>
        <article class="comment" id="<?php echo "comment_".$v['id'].","."floor_".$i;?>">
                <?php
                if($v['reference'])
                {
                    ?>
                <section style="text-align:left">
                <?php $result4=$conn->query("select * from comment where id=".$v['reference']);
                      $ref=mysqli_fetch_assoc($result4);
                ?>
                回复<?php echo $ref['floor'];  ?>楼&nbsp;&nbsp;<?php echo $ref['nickname']; ?>&nbsp;&nbsp;<?php echo $ref['date']; ?><br/><br/>
                <p><?php echo $ref['content']; ?></p><br/>
                </section>
                <?php
            }?>
                <section style="text-align:left">
                <?php echo $i++;  ?>楼&nbsp;&nbsp;<?php echo $v['nickname']; ?>&nbsp;&nbsp;<?php echo $v['date']; ?><br/><br/>
                <p><?php echo $v['content']; ?></p><br/>
                </section>
            </article>
   <?php
   endforeach;
   ?>
   <form id="myform" action="doaddcomment.php" method="post">
   <input type="hidden" name="article_id" value="<?php echo $id;?>">
   <input type="hidden" name="flag" id="flag" value="true">
   <input id="reference" type="hidden" name="reference" value="<?php echo $reference; ?>">
   <input id="floor" type="hidden" name="floor" value="<?php echo $i; ?>">
    		<div class="form-horizontal" role="form" style="margin:10px">
    			<div class="form-group">
                        <label for="inputPassword" class="col-sm-2 control-label"><?php if($reference)echo"回复第".$floor."楼：";else echo "评论";?></label>
                        <div class="col-sm-3">
                               <textarea name="content" id="content"  class="form-control" rows="3"  placeholder="文明上网，理性发言" ></textarea>
                         </div>
                 </div>
                        <div class="form-group" style="position:relative;left:13%">
     <br/>
        <p style="text-align: right;color: red;position: absolute" id="info"></p>
        <br/>
     <button id="commentButton" class="btn btn-default" type="submit">提交</button>
                                                </div>

    			</div>
                </form>
    			 <script>
                        $('article').each(function(){
                            $(this).click(function(){
                                str=$(this).attr('id');
                                str=str.replace("comment_","");
                                str=str.replace("floor_","");
                                var arr=new Array();
                                var arr=str.split(",");
                                if(arr[0]==<?php echo "".$reference;?>)
                                {
                                    layer.confirm('确定取消回复该条评论吗?', {
                         btn: ['确定','取消'] 
                   }, function(){
                    var url="detail.php?id=<?php echo $id;?>";
                       location.replace(url)
      
                      }, function(){
                       
                      });
                                }
                                else{
                                layer.confirm('确定回复该条评论吗?', {
                         btn: ['确定','取消'] 
                   }, function(){
                      var url="detail.php?id=<?php echo $id;?>&reference="+arr[0]+"&floor="+arr[1];
                       location.replace(url)
      
                      }, function(){
                      });
                            }
                        }
                            )
                        })
                        $("#commentButton").click(function () {
                           <?php 
                           if(!$user_id)
                           {
                               ?>
                           alert("提示：请登录后再操作");
                           $("#flag").attr("value","false");
                           <?php
                           }
                           else{
                               $result3=$conn->query("select * from user where id=".$user_id);
                               $user=mysqli_fetch_assoc($result3);
                               if($user['state']=="未激活")
                               {
                           ?>
                                 alert("提示:请等待审核通过后再进行操作");
                                 $("#flag").attr("value","false");
                                 <?php
                               }
                               else{
                                 ?>
                             if($("#content").val()==''){
                                alert("提示:请输入评论内容");
                                 $("#flag").attr("value","false");
                            }
                        <?php
                               }
                        }?>
                           
                        })

                    </script>
    <div style="position: relative;left: 12%">
    <?php
     $result1=$conn->query("select * from article where id=".($id-1));
     $result2=$conn->query("select * from article where id=".($id+1));
     $lastArticle=mysqli_fetch_assoc($result1);
     $nextArticle=mysqli_fetch_assoc($result2);
     if($lastArticle!=null){
         ?>
            <div ><a href="detail.php?id=<?php echo $lastArticle['id'] ?>"><h4><span class="label label-primary">上一篇:<?php echo $lastArticle['title']?></span></h4></a></div>
     <?php
                    }
     ?>
     <?php
      if($nextArticle!=null){
     ?>
            <div><a href="detail.php?id=<?php echo $nextArticle['id'] ?>"><h4><span class="label label-success">下一篇:<?php echo $nextArticle['title']?></span></h4></a></div>
     <?php
     }
     ?>
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