<h1></h1>
<?php
$symbol = "AMZN";
$url = "http://finance.yahoo.com/d/quotes.csv".'?s='.$symbol."&e=.csv&f=sl1d1t1c1ohgv";
if(!($contencts = file_get_contents($url))){
	die("failure to open ".$url);
}

list($symbol,$quote,$date,$time) = explode(",",$contencts);

$date = trim($date,'"');
$time = trim($time,' " ');
echo $symbol." was last sold at :".$quote."<br>";
echo "Quote current as of ".$date." at ".$time."<br>";
?>