<html>
<head><meta http-equiv="Content-Type" content="text-html;charset=gb2312"></head>
<body>
<?php
        include 'connect.php';

		$sql="select Reader.readerID,readerName,readerSex,readerDept,readerGrade,BorrowDate,Isreturn
		      from Reader,Record
		      where Reader.readerID=Record.readerID and Isreturn=0";
		$result=odbc_exec($connid, $sql);

        $todaydate=date("Y-m-d");
        $todaydate_list=explode("-", $todaydate);
        $todayd=mktime(0,0,0,$todaydate_list[1],$todaydate_list[2],$todaydate_list[0]);
?>
	<table border=1 id='result'>
<?php

            while (odbc_fetch_row($result)) {
            $readerid=odbc_result($result, "readerID");
            $readername=odbc_result($result, "readerName");
            $readersex=odbc_result($result, "readerSex");
            $readerdept=odbc_result($result, "readerDept");
            $readergrade=odbc_result($result, "readerGrade");
            if($readerid=="")
                echo "";
            else
            {
           /* 是否超期*/
            $borrowdate=odbc_result($result, "BorrowDate");
            $returndate=date("Y-m-d",strtotime("+30 day",strtotime($borrowdate)));
            $borrowdate_list=explode("-", $borrowdate);
            $borrowd=mktime(0,0,0,$borrowdate_list[1],$borrowdate_list[2],$borrowdate_list[0]);
            $days=round(($todayd-$borrowd)/3600/24);
            if ($days>30) {
?> 
            <tr><td><?php echo $readerid; ?></td>
            <td><?php echo $readername; ?></td>
            <td><?php echo $readersex; ?></td>
            <td><?php echo $readerdept; ?></td>
            <td><?php echo $readergrade; ?></td>
<?

        }

        
	        }
	    }    
?>
</tr>
</table>
</body>
</html>

