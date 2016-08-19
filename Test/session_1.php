<?php
session_id($_GET['PHPSESSID']);
session_start();
echo "查看这里能不能获得session的值：".$_SESSION['url'];
?>