<html>
<head><meta http-equiv="Content-Type" content="text-html;charset=gb2312"></head>
<body>
<?php
    include 'connect.php';
    $reader_Id=$_POST["rID"];
    
    /*�ж��Ƿ���ڶ���*/
    $sql_testr="select readerID from Reader where readerID='{$reader_Id}'";
    $result_testr=odbc_exec($connid, $sql_testr);
    odbc_fetch_row($result_testr);
    $testr=odbc_result($result_testr, "readerID");
    if($testr=="")
        echo "<div id='result' style='display:none'>1</div>�֤�Ų�����";
    else
   { 

        $sql="select bookName,Book.bookID,BorrowDate
               from Book,Record
               where Book.bookID=Record.bookID and readerID='{$reader_Id}' and Isreturn=0";
        $result=odbc_exec($connid,$sql);

        /*���������*/
        $todaydate=date("Y-m-d");
        $todaydate_list=explode("-", $todaydate);
        $todayd=mktime(0,0,0,$todaydate_list[1],$todaydate_list[2],$todaydate_list[0]);

       ?>
    <table border=1 id='result'>
    <?php
       while(odbc_fetch_row($result))
        {
            $bookid=odbc_result($result, "bookID");
            $bookname=odbc_result($result, "bookName");
            $borrowdate=date("Y-m-d",strtotime(odbc_result($result, "BorrowDate")));/*��ʱ��ת��Ϊ�涨��ʽ*/
            $returndate=date("Y-m-d",strtotime("+30 day",strtotime($borrowdate)));/*Ӧ���黹ʱ��*/ 
            if($bookid=="")
              echo "";  
            else
            {
    ?>
            <tr><td><?php echo $bookid; ?></td>
            <td><?php echo $bookname; ?></td>
            <td><?php echo $borrowdate; ?></td>
            <td><?php echo $returndate; ?></td>
       
    <?      
            /*�����Ѿ�����೤ʱ��*/
            $borrowdate_list=explode("-", $borrowdate);
            $borrowd=mktime(0,0,0,$borrowdate_list[1],$borrowdate_list[2],$borrowdate_list[0]);
            $days=round(($todayd-$borrowd)/3600/24);
            if ($days>30) {
    ?>
            <td><?php echo "��"; ?></td>
    <?          
            }
            else
            {
    ?>
            <td><?php echo "��"; ?></td>  
    <?  
            }
        }

      }
    ?>
    </tr>
    </table>
    <?
    }
    ?>
</body>
</html>


 




