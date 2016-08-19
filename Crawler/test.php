<?php
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://daily.zhihu.com/");
curl_setopt($ch, CURLOPT_HEADER, 2);

curl_exec($ch);
curl_close($ch);

?>