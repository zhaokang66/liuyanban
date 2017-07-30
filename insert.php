<?php
include "conn.php";
$title = validate($_POST['title']);
$content = validate($_POST['content']);
$date = date("Y-m-d H:i:s");
if (empty($_SESSION)) {
  echo "<script>alert('请先登录！')</script>";
  echo "<script>window.location.href='index.php';</script>";
  return false;
}
$username = $_SESSION['username'];
if ($title==null ) {
    echo "<script>alert('标题不能为空！')</script>";
    echo "<script>history.go(-1)</script>";
    return false;
}
if ($content==null) {
  echo "<script>alert('内容不能为空！')</script>";
  echo "<script>history.go(-1)</script>";
  return false;
}
$sql = "INSERT INTO `article` (`title`, `content`, `username`,`date`)
VALUES ('$title', '$content', '$username','$date')";

$result = $con->query($sql);
if ($result) {
  echo "<script>alert('留言成功！')</script>";
  echo "<script>window.location.href='index.php';</script>";
}else {
  echo "<script>alert('留言失败！')</script>";
  echo "<script>history.go(-1)</script>";
}
