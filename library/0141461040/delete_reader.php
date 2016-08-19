<html>
<head><meta http-equiv="Content-Type" content="text-html;charset=gb2312"></head>
<body>
<?php
    include 'connect.php';

	$reader_ID=$_POST["rID"];

	$isexist=0;

	$sql_test="select readerID from Reader";
    $result_test=odbc_exec($connid, $sql_test);
    while(odbc_fetch_row($result_test))
    {
    	$rID_test=odbc_result($result_test, "readerID");
    	if($rID_test==$reader_ID)
    		{
    			$isexist=1;
    		}
    }
    if($isexist==1)
    {
        $sql_isreturn ="select Record.readerID from Record where readerID='{$reader_ID}' and IsReturn=0";
		$result_isreturn=odbc_exec($connid, $sql_isreturn);
		$isreturn =odbc_fetch_row($result_isreturn);
		if($isreturn=="")
		{
			$sql1="delete from Record where Record.readerID='{$reader_ID}'";
			$result1=odbc_exec($connid, $sql1);
			$sql="delete from Reader where Reader.readerID='{$reader_ID}'";
			$result=odbc_exec($connid,$sql);
			echo "<div id='result' style='display:none'>0</div>成功";
		}
		else
		{
			echo "<div id='result' style='display:none'>2</div>该读者尚有书籍未归还";
		}
    }
    else
    {
    	echo "<div id='result' style='display:none'>1</div>该证号不存在";
    }
    odbc_close($connid);
?>
</body>
</html>