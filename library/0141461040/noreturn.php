<html>
<head><meta http-equiv="Content-Type" content="text-html;charset=gb2312"></head>
<body>
<?php
    include 'connect.php';
    $reader_Id=$_POST["rID"];
    
    /*判断是否存在读者*/
    $sql_testr="select readerID from Reader where readerID='{$reader_Id}'";
    $result_testr=odbc_exec($connid, $sql_testr);
    odbc_fetch_row($result_testr);
    $testr=odbc_result($result_testr, "readerID");
    if($testr=="")
        echo "<div id='result' style='display:none'>1</div>弥ず挪淮嬖�";
    else
   { 

        $sql="select bookName,Book.bookID,BorrowDate
               from Book,Record
               where Book.bookID=Record.bookID and readerID='{$reader_Id}' and Isreturn=0";
        $result=odbc_exec($connid,$sql);

        /*今天的日期*/
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
            $borrowdate=date("Y-m-d",strtotime(odbc_result($result, "BorrowDate")));/*将时间转换为规定格式*/
            $returndate=date("Y-m-d",strtotime("+30 day",strtotime($borrowdate)));/*应当归还时间*/ 
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
            /*计算已经借书多长时间*/
            $borrowdate_list=explode("-", $borrowdate);
            $borrowd=mktime(0,0,0,$borrowdate_list[1],$borrowdate_list[2],$borrowdate_list[0]);
            $days=round(($todayd-$borrowd)/3600/24);
            if ($days>30) {
    ?>
            <td><?php echo "是"; ?></td>
    <?          
            }
            else
            {
    ?>
            <td><?php echo "否"; ?></td>  
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


 




