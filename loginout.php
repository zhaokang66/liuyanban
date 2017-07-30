<?php
session_start();
session_unset();
session_destroy();
if (empty($_SESSION)) {
    echo "<script>alert('注销成功！')</script>";
    echo "<script>window.location.href='index.php';</script>";
}
