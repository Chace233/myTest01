<html>
<head><meta http-equiv="Content-Type" content="text-html;charset=gb2312"></head>
<body>
<?php
	include 'connect.php';

    $book_ID=$_POST["bID"];
    $book_Cnt=$_POST["bCnt"];

	$prm=1;
	$isexist=0;

	if(strlen($book_ID)>0&&strlen($book_ID)<=30)
    {
    	if(ctype_digit($book_Cnt)&&$book_Cnt!=0)
    	{
    		$prm=0;
    	}
    }

    if($prm==0)
    {
    	$sql_test="select bookID,bookTotalCnt,bookInCnt from Book where bookID='{$book_ID}'";
		$result_test=odbc_exec($connid, $sql_test);
        odbc_fetch_row($result_test);
        $bID_test=odbc_result($result_test, "bookID");
        if($bID_test!="")
        	$isexist=1;
        if($isexist==1)
        {
        	$totalcnt_test=odbc_result($result_test, "bookTotalCnt");
        	$incnt_test=odbc_result($result_test, "bookInCnt");
        	if($incnt_test<$book_Cnt)
        		echo "<div id='result' style='display:none'>2</div>减少的数量大于该书目前在库数量";
            else if($totalcnt_test==$book_Cnt && $incnt_test==$book_Cnt)
            {
                $sql="delete from Book where bookID='{$book_ID}'";
                $result=odbc_exec($connid,$sql);
                echo "<div id='result' style='display:none'>0</div>成功";
            }
        	else
        	{
        		$sql="update Book set bookTotalCnt=bookTotalCnt-'{$book_Cnt}',bookInCnt=bookInCnt-'{$book_Cnt}' where bookID='{$book_ID}'";
				$result=odbc_exec($connid,$sql);
                echo "<div id='result' style='display:none'>0</div>成功";
        	}   
        }
        else
        {
        	echo "<div id='result' style='display:none'>1</div>该书不存在";
        }
    }
    else
    {
    	echo "<div id='result' style='display:none'>3</div>提交的参数有误";
    }
?>
</body>
</html>