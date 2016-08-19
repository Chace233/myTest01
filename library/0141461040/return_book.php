<html>
<head><meta http-equiv="Content-Type" content="text-html;charset=gb2312"></head>
<body>
<?php
        include 'connect.php';

      $reader_ID=$_POST["rID"];
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
          $sql_testb="select bookID from Book where bookID='{$book_ID}'";
          $result_testb=odbc_exec($connid,$sql_testb);
          odbc_fetch_row($result_testb);
          $testb=odbc_result($result_testb, "bookID");
          if($testb=="")
             echo "<div id='result' style='display:none'>2</div>该书号不存在";
          else
          {
              $sql_testisborrow="select readerID,IsReturn from Record where readerID='{$reader_ID}' and bookID='{$book_ID}'";
              $result_testisborrow=odbc_exec($connid, $sql_testisborrow);
              odbc_fetch_row($result_testisborrow);
              $testis=odbc_result($result_testisborrow, "readerID");
              $testIsReturn=odbc_result($result_testisborrow, "IsReturn");
              if($testis=="")
              {
                  echo "<div id='result' style='display:none'>3</div>该读者并未借阅该书";
              }
              else if($testis!=""&&$testIsReturn==1)
              {
                 echo "<div id='result' style='display:none'>3</div>该读者并未借阅该书";
               }
              else
               {
                    $sql="delete from Record where readerID='{$reader_ID}' and bookID='{$book_ID}'";
                    $result=odbc_exec($connid,$sql);
                    $sql_update="update Book set bookInCnt=bookIncnt+1 where bookID='{$book_ID}'";
                    $result_update=odbc_exec($connid,$sql_update);
                    echo "<div id='result' style='display:none'>0</div>成功";

               }
                  
             }
          }
      
?>
</body>
</html>