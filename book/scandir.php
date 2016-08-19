<?php
chdir("upload/");
exec('dir',$result);
foreach ($result as  $value) {
	echo $value."<br>";
}

echo "-----------------------------<br>";
//passthru('dir');
$result = system('dir');
echo "-----------------------------<br>";

$result = `dir`;
echo $result;
?>