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
	$book_Cnt=$_POST["bCnt"];
	
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
    						if(ctype_digit($book_Cnt)&&$book_Cnt!=0)
    						{
    							$prm=0;
    						}
    					}
    				}
    			}
    		}
    	}
    }


    if($prm==0)
    {
    	/*检测书籍是否已经存在*/
    	$sql_test="select bookID from Book where bookID='{$book_ID}'";
    	$result_test=odbc_exec($connid, $sql_test);
    	while(odbc_fetch_row($result_test))
    	{
    		$bID_test=odbc_result($result_test, "bookID");
    		if($bID_test!="")
    		{
    			$isexist=1;
    		}
    	}
    	if($isexist==0)
    	{
    		$sql="insert into Book(bookID,bookName,bookPub,bookDate,bookAuthor,bookMem,bookTotalCnt,bookInCnt) 
                  values('{$book_ID}','{$book_Name}','{$book_Pub}','{$book_Date}','{$book_Author}',
                         '{$book_Mem}','{$book_Cnt}','{$book_Cnt}')"; 
            $result=odbc_exec($connid,$sql);
            if($result)
            {
            	echo "<div id='result' style='display:none'>0</div>成功";
            }	
    	}
        else
        {
            echo "<div id='result' style='display:none'>1</div>该书已存在";
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