<?php
include "conn.php";
$username = validate($_POST['username']);
$password = validate($_POST['password']);
$repeatpwd = validate($_POST['repeatpwd']);
$sql = "SELECT * FROM `user` WHERE `username`='".$username."'";
$result = $con->query($sql);
if ($result->num_rows > 0) {
      echo "<script>alert('用户名已存在')</script>";
      echo "<script>history.go(-1)</script>";
      return false;
}
$sql1 = "INSERT INTO `user` (`username`, `password`)
VALUES ('$username', '$password')";
if ($password==$repeatpwd) {
  $result = $con->query($sql1);
  if ($result) {
    echo "<script>alert('注册成功！')</script>";
    $_SESSION['username']=$username;
    $_SESSION['kind']=0;
    echo "<script>window.location.href='index.php';</script>";
  }else {
    echo "<script>alert('注册失败！')</script>";
  }
}else {
  echo "<script>alert('两次密码不一致！')</script>";
  echo "<script>history.go(-1)</script>";
}
