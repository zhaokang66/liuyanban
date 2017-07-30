<?php include 'conn.php'; ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>赵康个人留言板</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">

  </head>
  <body>
    <nav class="navbar navbar-default" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#example-navbar-collapse">
             <span class="sr-only">切换导航</span>
             <span class="icon-bar"></span>
             <span class="icon-bar"></span>
           </button>
          <a class="navbar-brand" href="index.php">赵康的个人留言板</a>
        </div>
      <?php
      if (empty($_SESSION['username'])) {
      ?>
      <div class="collapse navbar-collapse" id="example-navbar-collapse">
        <div class="main_nav">
          <ul class="nav navbar-nav navbar-right">
            <li><a role="button"  data-category="UserAccount" data-action="login" data-toggle="modal" href="#login-modal"><span class="glyphicon glyphicon-user"></span> 注册</a></li>
            <li><a role="button"  data-category="UserAccount" data-action="login" data-toggle="modal" href="#signup-modal"><span class="glyphicon glyphicon-log-in"></span> 登录</a></li>
          </ul>
        </div>
  </div>
      <?php
      }else {
        ?>
       <div class="collapse navbar-collapse" id="example-navbar-collapse">
    <ul class="nav navbar-nav navbar-right">
       <li><a href="#"><span class="glyphicon glyphicon-user"></span> <?=$_SESSION['username']?></a></li>
      <li><a href="loginout.php"><span class="glyphicon glyphicon-log-in"></span> 注销</a>
    </ul>
  </div>
        <?php
      }
      ?>
      </div>
    </nav>
      <div class="container">
          <?php
            $id = $_GET['id'];
            $result = $con->query("SELECT * FROM article
            WHERE id='".$id."'");

            while($row = mysqli_fetch_array($result))
            {
             ?>
               <form class="form-horizontal" role="form" action="postEdit.php" method="post">
    <div class="form-group">
      <label for="title" class="col-sm-2 control-label">标 题</label>
      <div class="col-sm-4">
        <input type="text" class="form-control" name="title"  value="<?=$row['title']?>" placeholder="请输入标题">
      </div>
    </div>
    <div class="form-group">
      <label for="content" class="col-sm-2 control-label">内 容</label>
      <div class="col-sm-10">
        <textarea name="content" class="form-control"  rows="8" placeholder="请输入留言内容"><?=$row['content']?></textarea>
      </div>
      <input type="hidden" name="id" value="<?=$row['id']?>">
    </div>
  <div class="submit">
    <input type="submit" name="submit" value="提交" class="btn btn-primary btn-lg btn-block">
  </div>
  </form>
  <?php
  }
 ?>
      </div>
      <script src="https://cdn.bootcss.com/jquery/2.1.1/jquery.min.js"></script>
      <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </body>
</html>
