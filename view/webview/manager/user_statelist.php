<?php ini_set('display_errors','Off'); ?>
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
$result=$conn->query("select count(*) from user where state='未激活'");  
$count=$result->fetch_row(); 
$totalNumber=$count[0];
if($totalNumber)
$totalPage=ceil($totalNumber/$perNumber);  
else
$totalPage=1;
$startCount=($page-1)*$perNumber;  
?>
<br/>
<table class="table table-sm">
    <thead>
    <tr class="table-info">
        <th>id</th>
        <th>用户名</th>
        <th>邮箱</th>
        <th>昵称</th>
        <th>状态</th>
        <th>状态变更</th>
        <th>删除</th>
    </tr>
    </thead>
    <tbody>
    <?php
$articles=$conn->query("select * from user where state='未激活' order by id DESC limit $startCount,$perNumber");  
foreach($articles  as $k => $v):?>
    <tr>
        <th scope="row"><?php echo $v['id'];?></th>
        <td><?php echo $v['username'];?></td>
        <td><?php echo $v['email'];?></td>
        <td><?php echo $v['nickname'];?></td>
        <td><?php echo $v['state'];?></td>
        <td><button type="button" class="btn btn-outline-primary btn-sm" onclick="fullScreen('<?php echo $v['username'];?>|状态变更','user_state.php?id=<?php echo $v['id'];?>')">状态变更</button>&nbsp;&nbsp;</td>
        <td><button type="button" class="btn btn-outline-danger btn-sm" onclick="ifdelete('<?php echo $v['id'];?>','<?php echo $v['username'];?>') ">删除</button></td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<nav aria-label="Page navigation example" style="position: absolute;bottom: 10px;left: 42%">
 
    <ul class="pagination justify-content-center" >
                <li class="page-item <?php if($page==1) echo "disabled"; ?>">
                <a class="page-link" href="<?php if($page==1) echo "index.php?page=1"; else echo "user_statelist.php?page=".($page-1); ?>">&laquo;</a>
                </li>
   <?php
          for ($i=1;$i<=$totalPage;$i++) { 
     ?>
           <li class="page-item <?php if($page==$i) echo "active";?>"><a class="page-link"href="user_statelist.php?page=<?php echo $i;?>"><?php echo $i;?></a></li>
        <?php
  }
?>
                <li class="page-item <?php if($page==$totalPage) echo "disabled";?>"><a class="page-link" href="<?php if($page==$totalPage) echo "user_statelist.php?page=".$totalPage; else echo "user_statelist.php?page=".($page+1); ?>">&raquo;</a></li>
            </ul>
</nav>
<script src="/js/jquery-3.2.1.min.js"></script>
<script>
    function fullScreen(title,url){
        var index = layer.open({
            type: 2,
            title: title,
            area: ['70%', '70%'],
            content: url,
            maxmin: true,
            end: function(){
               location.replace("./user_statelist.php");
            }
        });
        layer.full(index);
    }

    function ifdelete(id,username) {
        layer.confirm('确定注销该用户吗?', {
            btn: ['确定','取消'] //按钮
        }, function(){
        var url="douserdel.php?id="+id+"&username="+username+"&flag=1";
          location.replace(url)
        }, function(){

        });
    }

</script>
</body>
</html>