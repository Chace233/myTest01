<html>
<head><meta http-equiv="Content-Type" content="text-html;charset=gb2312"></head>
<body>
<?php
        include 'connect.php';

      $reader_ID=$_POST["rID"];
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
          $sql_testb="select bookID from Book where bookID='{$book_ID}'";
          $result_testb=odbc_exec($connid,$sql_testb);
          odbc_fetch_row($result_testb);
          $testb=odbc_result($result_testb, "bookID");
          if($testb=="")
             echo "<div id='result' style='display:none'>2</div>����Ų�����";
          else
          {
              $sql_testisborrow="select readerID,IsReturn from Record where readerID='{$reader_ID}' and bookID='{$book_ID}'";
              $result_testisborrow=odbc_exec($connid, $sql_testisborrow);
              odbc_fetch_row($result_testisborrow);
              $testis=odbc_result($result_testisborrow, "readerID");
              $testIsReturn=odbc_result($result_testisborrow, "IsReturn");
              if($testis=="")
              {
                  echo "<div id='result' style='display:none'>3</div>�ö��߲�δ���ĸ���";
              }
              else if($testis!=""&&$testIsReturn==1)
              {
                 echo "<div id='result' style='display:none'>3</div>�ö��߲�δ���ĸ���";
               }
              else
               {
                    $sql="delete from Record where readerID='{$reader_ID}' and bookID='{$book_ID}'";
                    $result=odbc_exec($connid,$sql);
                    $sql_update="update Book set bookInCnt=bookIncnt+1 where bookID='{$book_ID}'";
                    $result_update=odbc_exec($connid,$sql_update);
                    echo "<div id='result' style='display:none'>0</div>�ɹ�";

               }
                  
             }
          }
      
?>
</body>
</html>