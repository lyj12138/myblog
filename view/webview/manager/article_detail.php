<?php ini_set('display_errors','Off'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../static/css/bootstrap4.0.min.css" >
    <script src="../static/js/jquery.slim.min.js" ></script>
    <script src="../static/js/popper.min.js" ></script>
    <script src="../static/js/bootstrap4.0.min.js"></script>
</head>
<body>
<table class="table table-striped table-sm">
<?php
include("../config.php"); 
$id=$_GET['id'];
$result=$conn->query("select * from article where id=".$id); 
$article=mysqli_fetch_assoc($result);
?>
    <tr class="table-active">
        <th width="15%">ID</th>
        <td ><?php echo $article['id'] ?></td>
    </tr>
    <tr class="table-secondary">
        <th>标题</th>
        <td><?php echo $article['title'] ?></td>
    </tr>
    <tr class="table-success">
        <th>关键字</th>
        <td><?php echo $article['keywords'] ?></td>
    </tr>
    <tr class="table-danger">
        <th>简介</th>
        <td><?php echo $article['desci'] ?></td>
    </tr>
    <tr class="table-warning">
        <th>发表时间</th>
        <td><?php echo $article['time'] ?></td>
    </tr>
    <tr class="table-info">
        <th>点击量</th>
        <td><?php echo $article['click'] ?></td>
    </tr>
    <tr class="table-light">
        <th>内容</th>
        <td><?php echo $article['content'] ?></td>
    </tr>
</table>
</body>
</html>