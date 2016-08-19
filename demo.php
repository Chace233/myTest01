<?php
header("Content-type:text/html ; character=utf-8");
function getToken($url){
	$header = array("api-key:VY0vQlfwsUM3v5hHEmVtyy3mKGs=");
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	return  curl_exec($ch);
}



function getData($uuid){
	$data = getToken("http://api.heclouds.com/devices/3213513/datastreams/".$uuid);
	$index = strpos($data, "current_value")+16;
	$value = intval(substr($data, $index, 2));
	return $value;
}

$hum = getData("SHT20_hum");
$temp = getData("SHT20_temperature");
$sin = getData("BH1750FVI");

echo '<div style="margin:30px auto ;text-align:center;"><h1 > 衣橱环境监测预警系统</h1></div>';

//温度显示与报警
if($temp < 40){
	echo '<div  style="margin:10px auto; width:400px; height:100px; border:3px solid #F00"><p style="text-align:center;margin-top:20px">现在温度为：'.$temp.' 摄氏度</p> <p style="text-align:center;margin-top:20px">状态良好，请保持 ^_^</p><br>';
}else if($temp >40 && $temp < 60){
		echo '<div  style="margin:10px auto; width:400px; height:100px; border:3px solid #F00"><p style="text-align:center;margin-top:20px">现在温度为：'.$temp.' 摄氏度 </p> <br><p style="text-align:center;margin-top:20px">温度有些高，请及时预防 -_-# </p> <br>';
}else if($temp > 60){
	echo '<div  style="margin:10px auto; width:400px; height:200px; border:3px solid #F00"><p style="text-align:center;margin-top:20px">温度过高，发生危险，启动报警器！</p> <br>';
	echo ('<div  style="text-align:center"><img src="img/warner.gif" ></div> </div>');
}


//湿度显示与报警
if($hum <40){
			echo '<div  style="margin:10px auto; width:400px; height:100px; border:3px solid #F00"><p style="text-align:center;margin-top:20px">现在湿度为：'.$hum.'% </p> <br><p style="text-align:center;margin-top:-20px">状态良好，请保持 ^_^</p> <br>';
}else if($hum >=40 && $hum <60){
		echo '<div  style="margin:10px auto; width:400px; height:100px; border:3px solid #F00"><p style="text-align:center;margin-top:20px">现在湿度为：'.$hum.' % </p> <br><p style="text-align:center;margin-top:-20px">湿度有些高，请及时预防 -_-# </p> <br>';
}else if($hum >= 60){
	echo '<div  style="margin:100px auto; width:400px; height:200px; border:3px solid #F00"><p style="text-align:center;margin-top:20px">湿度度过高，发生危险，启动报警器！</p> <br>';
	echo ('<div  style="text-align:center"><img src="img/warner.gif" ></div> </div>');
}



if($sin < 10){
	echo '<div  style="margin:50px auto; width:400px; height:350px; border:3px solid #F00"><p style="text-align:center;margin-top:20px">光线太弱，打开照明灯</p> <br>';
	echo ('<div  style="text-align:center"><img  height="230" width="160" src="img/deng1.png" ></div> </div>');
}else if($sin > 60){
	echo '<div  style="margin:50px auto; width:400px; height:350px; border:3px solid #F00"><p style="text-align:center;margin-top:20px">光线充足，关闭照明灯！</p> <br>';
	echo ('<div  style="text-align:center"><img height="230" width="160" src="img/deng0.png" ></div> </div>');
}
?>