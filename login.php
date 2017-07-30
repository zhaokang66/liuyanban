<?php
include "conn.php";
$username = validate($_POST['username']);
$password = validate($_POST['password']);
$sql = "SELECT * FROM `user` WHERE `username`='".$username."'";
$result = $con->query($sql);
if ($result->num_rows > 0) {
    // 输出数据
    while($row = $result->fetch_assoc()) {
      if ($row['password']==$password) {
          echo "<script>alert('登录成功！')</script>";
          $_SESSION['username']=$username;
          $_SESSION['kind']=$row['kind'];
          echo "<script>window.location.href='index.php';</script>";
      }
      else {
        echo "<script>alert('密码不正确！')</script>";
          echo "<script>history.go(-1)</script>";
      }
    }
} else {
    echo "<script>alert('用户不存在')</script>";
    echo "<script>history.go(-1)</script>";
}
