<html>
<head><meta http-equiv="Content-Type" content="text-html;charset=gb2312"></head>
<body>
<?php
    include 'connect.php';

    $reader_ID=$_POST["rID"];
    $reader_Name=$_POST["rName"];
    $reader_Sex=$_POST["rSex"];
    $reader_Dept=$_POST["rDept"];
    $reader_Grade=$_POST["rGrade"];
    $sex_w="女";
    $sex_m="男";

	$prm=1;
	$isexist=0;
    
    if(strlen($reader_ID)>0&&strlen($reader_ID<8))
    {
    	if(strlen($reader_Name)>0&&strlen($reader_Name)<10)
    	{
    		if($reader_Sex==$sex_w||$reader_Sex==$sex_m)
    		{
    			if(strlen($reader_Dept)>0&&strlen($reader_Dept)<10)
    			{
    				if(ctype_digit($reader_Grade)&&$reader_Grade!=0)
    				{
                        $prm=0;
    				}
    			}
    		}
    	}
    }

    if($prm==0)
    {
    	/*检测读者是否已经存在*/
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
    	if($isexist==0)
    	{
            $sql="insert into Reader(readerID,readerName,readerSex,readerDept,readerGrade) values('{$reader_ID}','{$reader_Name}',
				                                                                                 '{$reader_Sex}','{$reader_Dept}',
				                                                                                  '{$reader_Grade}')";   
            $result=odbc_exec($connid,$sql);
            echo "<div id='result' style='display:none'>0</div>成功";
    	}
    	else
    	{
    		echo "<div id='result' style='display:none'>1</div>该证号已经存在";
    	}
    }
    else
    {
    	echo "<div id='result' style='display:none'>2</div>提交的参数有误";
    }
    odbc_close($connid);
?>
</body>
</html>