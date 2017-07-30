<?php
include 'conn.php';
$id = $_GET['id'];
if ($_SESSION['is_admin'] !=1) {
  echo "<script>alert('对不起，您没有权限！')</script>";
  echo "<script>history.go(-1)</script>";
  return false;
}
$sql = "DELETE FROM `article` WHERE `id`='".$id."'";
$result = $con->query($sql);
if ($result) {
  echo "<script>alert('删除成功！')</script>";
  echo "<script>window.location.href='index.php';</script>";
}else {
  echo "<script>alert('删除失败！')</script>";
  echo "<script>history.go(-1)</script>";
}
