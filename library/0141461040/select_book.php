<html>
<head><meta http-equiv="Content-Type" content="text-html;charset=gb2312"></head>
<body>
<?php
    include 'connect.php';
    include 'date.php';

	$book_ID=$_POST["bID"];
	$book_Name=$_POST["bName"];
	$book_Pub=$_POST["bPub"];
	$book_Date0=$_POST["bDate0"];
	$book_Date1=$_POST["bDate1"];
	$book_Author=$_POST["bAuthor"];
	$book_Mem=$_POST["bMem"];
     
    echo "<table border=1 id='result'>";
    $sql="select * from Book where 0=0";

    if($book_ID!="")
    {
    	$sql=$sql."and bookID like '%{$book_ID}%'";
    }
    if($book_Name!="")
    {
    	$sql=$sql."and bookName like '%{$book_Name}%'";
    }
    if($book_Pub!="")
    {
    	$sql=$sql."and bookPub like '%{$book_Pub}%'";
    }
    if($book_Author!="")
    {
    	$sql=$sql."and bookAuthor like '%{$book_Author}%'";
    }
    if($book_Mem!="")
    {
    	$sql=$sql."and bookMem like '%{$book_Mem}%'";
    }
	if($book_Date0!="" && $book_Date1!="")
	{
		$sql=$sql."and bookDate between #{$book_Date0}# and #{$book_Date1}#";
	}
    else if($book_Date0!="" && $book_Date1=="")
	{
		$sql=$sql."and bookDate > #{$book_Date0}#";
	}
	else if($book_Date0=="" && $book_Date1!="")
	{
		$sql=$sql."and bookDate < #{$book_Date1}#";
	}
	$result=odbc_exec($connid,$sql);
	while(odbc_fetch_row($result))
	{
	    $bookid=odbc_result($result, "bookID");
		$bookname=odbc_result($result, "bookName");
		$bookpub=odbc_result($result, "bookPub");
		$bookdate=date("Y-m-d",strtotime(odbc_result($result, "bookDate")));
		$bookauthor=odbc_result($result, "bookAuthor");
		$bookmem=odbc_result($result, "bookMem");
		$booktotalcnt=odbc_result($result, "bookTotalCnt");
	    $bookincnt=odbc_result($result, "bookInCnt");
	    
	?>
	<tr><td><?php echo $bookid; ?></td>
	    <td><?php echo $bookname; ?></td>
	    <td><?php echo $booktotalcnt;?></td>
		<td><?php echo $bookincnt;?></td>
	    <td><?php echo $bookpub; ?></td>
	    <td><?php echo $bookdate; ?></td> 
		<td><?php echo $bookauthor; ?></td>
		<td><?php echo $bookmem;?></td>	
<?php
	 }
?>
	</tr>
	</table>

<?php
	odbc_close($connid);
?>
</body>
</html>
