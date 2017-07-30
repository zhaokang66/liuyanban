<?php include 'conn.php'; ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>赵康个人留言板</title>
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="http://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
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
    <div class="do" >
      <a class="pull-right btn btn-primary" href="add.php"> 点击留言</a>
    </div>
    <!-- 留言列表 -->
    <div class="list container">
      <?php
      $sql = "SELECT * FROM `article` ORDER BY `id` DESC";
      $re = $con->query($sql);
      if ($re->num_rows>0) {
        while($row = $re->fetch_assoc()){
        ?>



      <h3><?=$row['title']?></h3>
      <div class="article_info">
        <div class="user">
<p ><span class="glyphicon glyphicon-user"><?=$row['username']?></span></p>
        </div>
        <div class="pushtime">
<time ><span class="	glyphicon glyphicon-calendar"><?=$row['date']?></span></time>
        </div>
      </div>


      <div class="content">
        <p ><?=$row['content']?></p>
      </div>
      <?php
      if(!empty($_SESSION)){
            if ($_SESSION['kind']==1 ||$_SESSION['username']==$row['username']) {
              $_SESSION['is_admin'] =1;
          ?>
          <a href="delete.php?id=<?=$row['id']?>" class="btn btn-default">删除</a>
          <a href="preEdit.php?id=<?=$row['id']?>" class="btn btn-default">编辑</a>

          <?php
          }
        }
       ?>
      <hr/>
        <?php
        }
      }else {
        echo "<h2>暂时没有留言</h2>";
      }

      ?>
    </div>

    <div class="cd-user-modal">
      <div class="cd-user-modal-container">
        <ul class="cd-switcher">
          <li id="switch1" ><a href="#0">用户登录</a></li>
          <li id="switch2" ><a href="#0">注册新用户</a></li>
        </ul>

        <div id="cd-login">
            <!-- 登录表单 -->
            <form class=" cd-form" id="login-form" action="login.php" method="post">

                <div class="form-group">
                      <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                          <input class="form-control" id="username" type="text" name="username" v-model="userName" placeholder="请输入用户名"  autofocus  required/>
                      </div>
               </div>
               <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-lock fa-fw"></i></span>
                        <input class="form-control " type="password" name="password" id="password" v-model="password" placeholder="请输入密码"  required/>
                    </div>
              </div>
               <button type="submit" id="btn-login" v-disabled="submitting" class="btn btn-lg btn-primary btn-block" v-on:click="login">登 录</span></button>
          </form>
        </div>

        <div id="cd-signup">
          <form class=" cd-form" id="login-form" action="sign.php" method="post">

            <div class="form-group">
              <label for="username" class="col-sm-2 control-label">用户名:</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="username" id="lastname" placeholder="请输入用户名">
              </div>
            </div>
            <div class="form-group">
                <label for="password" class="col-sm-2 control-label">密码:</label>
                <div class="col-sm-10">
                <input type="text" class="form-control"
                name="password" id="lastname" placeholder="请输入用密码">
                </div>
            </div>
            <div class="form-group">
                <label for="repeatpwd" class="col-sm-2 control-label">重复密码:</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="repeatpwd" id="lastname" placeholder="请输入再次密码">
                </div>
              </div>
             <button type="submit" id="btn-login" v-disabled="submitting" class="btn btn-lg btn-primary btn-block" v-on:click="login">注册</span></button>
        </form>
        </div>
      </div>
    </div>

        <script src="https://cdn.bootcss.com/jquery/2.1.1/jquery.min.js"></script>
        <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script type="text/javascript">
        $(document).ready(function($){
          var $form_modal = $('.cd-user-modal'),
            $form_login = $form_modal.find('#cd-login'),
            $form_signup = $form_modal.find('#cd-signup'),
            $form_modal_tab = $('.cd-switcher'),
            $tab_login = $form_modal_tab.children('li').eq(0).children('a'),
            $tab_signup = $form_modal_tab.children('li').eq(1).children('a'),
            $main_nav = $('.main_nav');

    //弹出窗口
    $main_nav.on('click', function(event){

      if( $(event.target).is($main_nav) ) {
        // on mobile open the submenu
        $(this).children('ul').toggleClass('is-visible');
      } else {
        // on mobile close submenu
        $main_nav.children('ul').removeClass('is-visible');
        //show modal layer
        $form_modal.addClass('is-visible');
        //show the selected form
        ( $(event.target).is('.cd-signup') ) ? signup_selected() : login_selected();
      }

    });
    $('#switch1').click(function(){
      $(this).css('background-color','	#4F4F4F');
      $('#switch2').css('background-color','white');
    });

    $('#switch2').click(function(){
      $(this).css('background-color','#4F4F4F');
      $('#switch1').css('background-color','white');
    });



    //关闭弹出窗口
    $('.cd-user-modal').on('click', function(event){
      if( $(event.target).is($form_modal) || $(event.target).is('.cd-close-form') ) {
        $form_modal.removeClass('is-visible');
      }
    });
    //使用Esc键关闭弹出窗口
    $(document).keyup(function(event){
      if(event.which=='27'){
        $form_modal.removeClass('is-visible');
      }
    });

    //切换表单
    $form_modal_tab.on('click', function(event) {
      event.preventDefault();
      ( $(event.target).is( $tab_login ) ) ? login_selected() : signup_selected();
    });

    function login_selected(){
      $form_login.addClass('is-selected');
      $form_signup.removeClass('is-selected');
      $form_forgot_password.removeClass('is-selected');
      $tab_login.addClass('selected');
      $tab_signup.removeClass('selected');
    }

    function signup_selected(){
      $form_login.removeClass('is-selected');
      $form_signup.addClass('is-selected');
      $form_forgot_password.removeClass('is-selected');
      $tab_login.removeClass('selected');
      $tab_signup.addClass('selected');
    }

    });
        </script>
  </body>
</html>
