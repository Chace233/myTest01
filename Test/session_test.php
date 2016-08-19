<?php
session_start();
$_SESSION['url'] = 'http://www.phpddt.com';
echo "这个界面取到的session是 ：".$_SESSION['url'];
echo "<a href='session_1.php '> 另一个界面</a><br>";
?>
<a href="session_1.php?<?php print session_name()  ?>=<?php print session_id() ?>">另一个界面</a>