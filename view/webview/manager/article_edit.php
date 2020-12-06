<?php ini_set('display_errors','Off'); ?>
<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../static/css/bootstrap4.0.min.css" >
    <script src="../static/js/jquery.slim.min.js" ></script>
    <script src="../static/js/popper.min.js" ></script>
    <script src="../static/js/bootstrap4.0.min.js"></script>
    <script type="text/javascript" src="../static/js/ueditor/ueditor.config.js"></script>
    <script type="text/javascript" src="../static/js/ueditor/ueditor.all.js"> </script>
    <script type="text/javascript"  src="../static/js/lang/zh-cn/zh-cn.js"></script>
    <script type="text/javascript" src="../static/js/wangEditor.min.js"></script>
</head>
<body>
<div style="position: relative;top: 10%">
<?php 
 if(isset($_SESSION['succ']))
$succ=$_SESSION['succ'];
else
$succ="";
if($succ!="")
{
    ?>
    
        <div class="alert alert-success" role="alert">
                <?php  echo $succ; ?>
        </div>
 <?php
 $_SESSION['succ']="";
 }
 ?>
 <?php 
  if(isset($_SESSION['error']))
$error=$_SESSION['error'];
else
$error="";
if($error!="")
{
    ?>
    
        <div class="alert alert-danger" role="alert">
                <?php  echo $error; ?>
        </div>
 <?php
 $_SESSION['error']="";
 }
 ?>
</div>
<div class="container">
    <form action="doedit.php" method="post">
    <?php
    include("../config.php"); 
    if(isset($_GET['id']))
    $id=$_GET['id'];
    else
    $id=-1;
    $result=$conn->query("select * from article where id=".$id); 
    $article=mysqli_fetch_assoc($result);
    ?>
        <input type="hidden" value="<?php echo $article['id'];?>" name="id">
        <div class="form-group">
            <label for="title">文章标题</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="文章标题" value="<?php echo $article['title'];?>">
        </div>
        <div class="form-group">
            <label for="catalogId">栏目</label>
            <select class="form-control" id="catalogId" name="catalogId">
                <option value="0" selected="<?php if($article['catalogId']==0) echo "selected";?>">学习</option>
                <option value="1" selected="<?php if($article['catalogId']==1) echo "selected";?>">生活</option>
            </select>
        </div>
        <div class="form-group">
            <label for="keywords">关键字</label>
            <input type="text" class="form-control" id="keywords" name="keywords" placeholder="关键字" value="<?php echo $article['keywords'];?>">
        </div>
        <div class="form-group">
            <label for="desci">简介</label>
            <textarea class="form-control" id="desci" rows="3" name="desci" placeholder="简介"><?php echo $article['desci'];?></textarea>
        </div>
        <div class="form-group">
            <label for="div1">内容</label>
            <div id="div1">
            <?php echo $article['content'];?>
            </div>
            <textarea id="content" name="content" style="display: none" ></textarea>
        </div>
            <input type="submit" value="修改">
                </form>

                <script>
               var E = window.wangEditor
                var editor = new E('#div1')
                var $text1 = $('#content')
                editor.customConfig.onchange = function (html) {
                    // 监控变化，同步更新到 textarea
                    $text1.val(html)
                }
                editor.customConfig.uploadImgServer = '../uploadImg.php'
                editor.customConfig.uploadFileName = 'imgFile'
                editor.customConfig.uploadImgMaxSize = 1 * 1024 * 1024
                editor.customConfig.uploadImgTimeout = 30000

                editor.customConfig.uploadImgHooks = {
                    before: function (xhr, editor, files) {

                    },
                    success: function (xhr, editor, result) {

                        var url = result.data[0]
                        alert(url)



                    },
                    fail: function (xhr, editor, result) {

                        alert("fail：" + result.data[0]);
                    },
                    error: function (xhr, editor) {

                    },
                    timeout: function (xhr, editor) {

                    },


                    customInsert: function (insertImg, result, editor) {

                        var url = "."+result.data[0]
                         insertImg(url)

                    }
                }
                editor.create()
                // 初始化 textarea 的值
                $text1.val(editor.txt.html())
                
            </script>
        </div>
</body>
</html>