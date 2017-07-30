<?php
session_start();
$host = "localhost";
$user = "root";
$pwd = "root";
$dbname = "liuyanban";
$con = new mysqli($host,$user,$pwd,$dbname);
$con->set_charset('utf8');
function validate($value){
  $value = trim($value);
  $valude = htmlspecialchars($value);
  return $value;
}
