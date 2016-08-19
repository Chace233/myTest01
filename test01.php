<?php
function getImage($url, $filename="", $type=0){
	if($url == ""){
		return false;
	}
	if($filename == ""){
		$ext = strrchr($url, '.');
		if($ext != ".gif" && $ext != ".jpg"){
			echo "格式不正确！";
			return false;
		}
		$filename = time().$ext;
	}
	if($type){
		$ch = curl_init();
		$timeout = 5;
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		$img = curl_exec($ch);
		curl_close($ch);
	}else{
		ob_start();
		readfile($url);
		$img = ob_get_contents();
		ob_end_clean();
	}
	$size = strlen($img);
	$fp2 = @fopen($filename, 'a');
	fwrite($fp2,  $img);
	fclose($fp2);
	return $filename;
}

$fp = fsockopen("www.example.com",80,$errno,$errstr,30);
if(!$fp){
	echo "$errstr($errno)<br>";
}else{
	$out = "GET/HTTP/1.1\r\n";
	$out .= "Connection:Close\r\n\r\n";
	fwrite($fp, $out);
	while($feof($fp)){
		echo fge
	}
}
?>