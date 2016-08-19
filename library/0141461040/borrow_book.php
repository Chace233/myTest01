<html>
<head><meta http-equiv="Content-Type" content="text-html;charset=gb2312"></head>
<body>
<?php
    include 'connect.php';

    $reader_ID= $_POST["rID"];
    $book_ID=$_POST["bID"];
    $time=date("Y-m-d");

    /*判断是否存在读者*/
    $sql_testr="select readerID from Reader where readerID='{$reader_ID}'";
    $result_testr=odbc_exec($connid, $sql_testr);
    odbc_fetch_row($result_testr);
    $testr=odbc_result($result_testr, "readerID");
    if($testr=="")
        echo "<div id='result' style='display:none'>1</div>该证号不存在";
    else
   {  
   /*判断是否存在图书*/
       $sql_testb="select bookID,bookInCnt from Book where bookID='{$book_ID}'";
       $result_testb=odbc_exec($connid,$sql_testb);
       odbc_fetch_row($result_testb);
       $testb=odbc_result($result_testb, "bookID");
       if($testb=="")
            echo "<div id='result' style='display:none'>2</div>该书号不存在";
       else
       {
          //$testTcnt=odbc_result($result_testb, "bookTotalCnt");
          $testIcnt=odbc_result($result_testb, "bookInCnt");
          if($testIcnt==0)
          {
            echo "<div id='result' style='display:none'>5</div>该书已经全部借出";
          }
          else{
            /*判断该读者是否已借该书未还*/
            $sql_haveborrowed="select Record.bookID,BorrowDate from Record where readerID='{$reader_ID}' and bookID='{$book_ID}' and IsReturn=0";
            $result_haveborrowed=odbc_exec($connid, $sql_haveborrowed);
            odbc_fetch_row($result_haveborrowed);
            $testhaveborrowed=odbc_result($result_haveborrowed, "bookID");
            if($testhaveborrowed!="")
            {
                echo "<div id='result' style='display:none'>4</div>该读者已经借阅该书，且未归还";
            }
            else
            {
            	/*获取今天的时间戳*/
                $todaydate_list=explode("-", $time);
                $todayd=mktime(0,0,0,$todaydate_list[1],$todaydate_list[2],$todaydate_list[0]);

                $sql_testovertime="select BorrowDate from Record where readerID='{$reader_ID}' and IsReturn=0";
                $result_testovertime=odbc_exec($connid, $sql_testovertime);
                while(odbc_fetch_row($result_testovertime))
                {
                	$testovertime=odbc_result($result_testovertime, "BorrowDate");
                	$testovertime_list=explode("-", $testovertime);
                    $overt=mktime(0,0,0,$testovertime_list[1],$testovertime_list[2],$testovertime_list[0]);
                    $days=round(($todayd-$overt)/3600/24);
                    if($days>30)
                    $tmp=$tmp+1;
                }
                  if($tmp!=0)
                  	echo "<div id='result' style='display:none'>3</div>该读者有超期书未还";
                  else
                  {
				                  	$sql="insert into Record(readerID,bookID,BorrowDate) values('{$reader_ID}','{$book_ID}','{$time}')";
					                  $result=odbc_exec($connid,$sql);
					                  $sql_update="update Book set bookInCnt=bookInCnt-1 where bookID='{$book_ID}'";
					                  $result_update=odbc_exec($connid,$sql_update);
					                  if($result && $result_update)
					                    echo "<div id='result' style='display:none'>0</div>成功";
					                  else
					                    echo "<div id='result' style='display:none'>6</div>借书失败"; 
                  }
            }
          }            
        }
   }
?>
</body>
</html>