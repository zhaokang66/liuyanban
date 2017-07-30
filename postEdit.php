<?php
include 'conn.php';
if (empty($_SESSION)) {
  echo "<script>alert('请先登录！')</script>";
  echo "<script>window.location.href='index.php';</script>";
  return false;
}
if ($_SESSION['is_admin'] !=1) {
  echo "<script>alert('对不起，您没有权限！')</script>";
  echo "<script>history.go(-1)</script>";
  return false;
}
$id = $_POST['id'];
$title = $_POST['title'];
$content = $_POST['content'];
$result = $con->query("UPDATE `article` SET `title`='".$title."'
, `content`='".$content."' WHERE `id`='".$id."'");
if ($result) {
  echo "<script>alert('更新成功！')</script>";
  echo "<script>window.location.href='index.php';</script>";
}
else {
  echo "<script>alert('更新失败！')</script>";
  echo "<script>history.go(-1)</script>";
}
