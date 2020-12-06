<?php ini_set('display_errors','Off'); session_start(); ?>
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
<?php 
include("../config.php"); 
$perNumber=5;  
if (!isset($_GET['page'])) {
 $page=1;
}  
else
$page=$_GET['page'];
if(isset($_POST['word']))
{
$word=$_POST['word'];
$_SESSION['word']=$word;
}
else{
    $word=$_SESSION['word'];
}
$articles=$conn->query("select * from article where title LIKE '%".$word."%' OR content  LIKE '%".$word."%'");  
$totalNumber=Intval(mysqli_num_rows($articles));
if($totalNumber)
$totalPage=ceil($totalNumber/$perNumber);  
else
$totalPage=1;  
$startCount=($page-1)*$perNumber;  
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light" >
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand text-success" href="main.php">博客管理</a>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item">
                <!-- Example single danger button -->
                <div class="btn-group">
                    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        新建
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="javascript:void(0);" onclick="fullScreen('添加文章','article_add.php')">文章</a>
                        <!-- <a class="dropdown-item" href="#">评论</a>-->
                    </div>
                </div>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="main.php">主页 </a>
            </li>
            <li class="nav-item active">
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
<br/>
<table class="table table-sm">
    <thead>
    <tr class="table-info">
        <th>id</th>
        <th width="25%">标题</th>
        <th>发表时间</th>
        <th>点击量</th>
        <th>详情</th>
        <th>评论</th>
        <th>编辑</th>
        <th>删除</th>
    </tr>
    </thead>
    <tbody>
    <?php
$articles=$conn->query("select * from article where title LIKE '%".$word."%' OR content  LIKE '%".$word."%' order by id DESC limit $startCount,$perNumber");  
foreach($articles  as $k => $v):?>
    <tr>
        <th scope="row"><?php echo $v['id'];?></th>
        <td><?php echo $v['title'];?></td>
        <td><?php echo $v['time'];?></td>
        <td><?php echo $v['click'];?></td>
        <td><button type="button" class="btn btn-outline-info btn-sm" onclick="fullScreen('《<?php echo $v['title'];?>》','article_detail.php?id=<?php echo $v['id'];?>')">详情</button></td>
        <td><button type="button" class="btn btn-outline-success btn-sm" onclick="fullScreen('《<?php echo $v['title'];?>》|评论管理','comment_list.php?id=<?php echo $v['id'];?>')">评论</button></td>
        <td><button type="button" class="btn btn-outline-primary btn-sm" onclick="fullScreen('《<?php echo $v['title'];?>》|编辑','article_edit.php?id=<?php echo $v['id'];?>')">编辑</button>&nbsp;&nbsp;</td>
        <td><button type="button" class="btn btn-outline-danger btn-sm" onclick="ifdelete('<?php echo $v['id'];?>','<?php echo $v['title'];?>') ">删除</button></td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<nav aria-label="Page navigation example" style="position: absolute;bottom: 10px;left: 42%">
 
    <ul class="pagination justify-content-center" >
                <li class="page-item <?php if($page==1) echo "disabled"; ?>">
                <a class="page-link" href="<?php if($page==1) echo "index.php?page=1"; else echo "article_search.php?page=".($page-1); ?>">&laquo;</a>
                </li>
   <?php
          for ($i=1;$i<=$totalPage;$i++) { 
     ?>
           <li class="page-item <?php if($page==$i) echo "active";?>"><a class="page-link"href="article_search.php?page=<?php echo $i;?>"><?php echo $i;?></a></li>
        <?php
  }
?>
                <li class="page-item <?php if($page==$totalPage) echo "disabled";?>"><a class="page-link" href="<?php if($page==$totalPage) echo "article_search.php?page=".$totalPage; else echo "article_search.php?page=".($page+1); ?>">&raquo;</a></li>
            </ul>
</nav>
<script src="../static/js/jquery-3.2.1.min.js"></script>
<script>
    function fullScreen(title,url){
        var index = layer.open({
            type: 2,
            title: title,
            area: ['70%', '70%'],
            content: url,
            maxmin: true,
            end: function(){
               location.replace("./article_search.php");
            }
        });
        layer.full(index);
    }

    function ifdelete(id,title) {
        layer.confirm('确定删除该文章吗?', {
            btn: ['确定','取消'] //按钮
        }, function(){
        var url="dodel.php?id="+id;
          location.replace(url)
        }, function(){

        });
    }

</script>
</body>
</html>