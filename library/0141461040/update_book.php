<html>
<head><meta http-equiv="Content-Type" content="text-html;charset=gb2312"></head>
<body>
<?php
	include 'connect.php';
	include 'date.php';

    $book_ID=$_POST["bID"];
    $book_Name=$_POST["bName"];
    $book_Pub=$_POST["bPub"];
    $book_Date=$_POST["bDate"];
    $book_Author=$_POST["bAuthor"];
    $book_Mem=$_POST["bMem"];

    /*检测参数是否有误*/
    $prm=1;
    $isexist=0;

    if(strlen($book_ID)>0&&strlen($book_ID)<=30)
    {
    	if(strlen($book_Name)>0&&strlen($book_Name)<=30)
    	{
    		if (strlen($book_Pub)>0&&strlen($book_Pub)<=30)
    		{
    			if(strlen($book_Date)==10&&is_date("$book_Date"))
    			{
    				if(strlen($book_Author)>0&&strlen($book_Author)<=20)
    				{
    					if(strlen($book_Mem)>0&&strlen($book_Mem)<=30)
    					{
 							 $prm=0;
    						
    					}
    				}
    			}
    		}
    	}
    }

    if($prm==0)
    {
        /*检测书籍是否已经存在*/
    	$sql_test="select bookID from Book";
    	$result_test=odbc_exec($connid, $sql_test);
    	while(odbc_fetch_row($result_test))
    	{
    		$bID_test=odbc_result($result_test, "bookID");
    		if($bID_test==$book_ID)
    		{
    			$isexist=1;
    		}
    	}
    	if($isexist==1)
    	{
    		$sql="update Book set bookName='{$book_Name}',bookPub='{$book_Pub}',bookDate='{$book_Date}',
	                              bookAuthor='{$book_Author}',bookMem='{$book_Mem}'
	                              where bookID='{$book_ID}'";
			$result=odbc_exec($connid,$sql);
            echo "<div id='result' style='display:none'>0</div>成功";
    	}
    	else
    	{
    		echo "<div id='result' style='display:none'>1</div>该书不存在";
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