<html>
<head><meta http-equiv="Content-Type" content="text-html;charset=gb2312"></head>
<body>
<?php
    include 'connect.php';

    $reader_ID= $_POST["rID"];
    $book_ID=$_POST["bID"];
    $time=date("Y-m-d");

    /*�ж��Ƿ���ڶ���*/
    $sql_testr="select readerID from Reader where readerID='{$reader_ID}'";
    $result_testr=odbc_exec($connid, $sql_testr);
    odbc_fetch_row($result_testr);
    $testr=odbc_result($result_testr, "readerID");
    if($testr=="")
        echo "<div id='result' style='display:none'>1</div>��֤�Ų�����";
    else
   {  
   /*�ж��Ƿ����ͼ��*/
       $sql_testb="select bookID,bookInCnt from Book where bookID='{$book_ID}'";
       $result_testb=odbc_exec($connid,$sql_testb);
       odbc_fetch_row($result_testb);
       $testb=odbc_result($result_testb, "bookID");
       if($testb=="")
            echo "<div id='result' style='display:none'>2</div>����Ų�����";
       else
       {
          //$testTcnt=odbc_result($result_testb, "bookTotalCnt");
          $testIcnt=odbc_result($result_testb, "bookInCnt");
          if($testIcnt==0)
          {
            echo "<div id='result' style='display:none'>5</div>�����Ѿ�ȫ�����";
          }
          else{
            /*�жϸö����Ƿ��ѽ����δ��*/
            $sql_haveborrowed="select Record.bookID,BorrowDate from Record where readerID='{$reader_ID}' and bookID='{$book_ID}' and IsReturn=0";
            $result_haveborrowed=odbc_exec($connid, $sql_haveborrowed);
            odbc_fetch_row($result_haveborrowed);
            $testhaveborrowed=odbc_result($result_haveborrowed, "bookID");
            if($testhaveborrowed!="")
            {
                echo "<div id='result' style='display:none'>4</div>�ö����Ѿ����ĸ��飬��δ�黹";
            }
            else
            {
            	/*��ȡ�����ʱ���*/
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
                  	echo "<div id='result' style='display:none'>3</div>�ö����г�����δ��";
                  else
                  {
				                  	$sql="insert into Record(readerID,bookID,BorrowDate) values('{$reader_ID}','{$book_ID}','{$time}')";
					                  $result=odbc_exec($connid,$sql);
					                  $sql_update="update Book set bookInCnt=bookInCnt-1 where bookID='{$book_ID}'";
					                  $result_update=odbc_exec($connid,$sql_update);
					                  if($result && $result_update)
					                    echo "<div id='result' style='display:none'>0</div>�ɹ�";
					                  else
					                    echo "<div id='result' style='display:none'>6</div>����ʧ��"; 
                  }
            }
          }            
        }
   }
?>
</body>
</html>