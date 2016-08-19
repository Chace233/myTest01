<html>
<head><meta http-equiv="Content-Type" content="text-html;charset=gb2312"></head>
<body>
<?php
    include 'connect.php';

	$reader_ID=$_POST["rID"];
	$reader_Name=$_POST["rName"];
	$reader_Sex=$_POST["rSex"];
	$reader_Dept=$_POST["rDept"];
	$reader_Grade0=$_POST["rGrade0"];
	$reader_Grade1=$_POST["rGrade1"];
	$sex_w="女";
	$sex_m="男";

	$sql="select * from Reader where 1=1";
	if($reader_ID!="")
	{
		$sql=$sql."and readerID like '%{$reader_ID}%'";
	}
	if($reader_Name!="")
	{
		$sql=$sql."and readerName like '%{$reader_Name}%'";
	}
	if($reader_Sex!="")
	{
		$sql=$sql."and readerSex='{$reader_Sex}'";
	}
	if($reader_Dept!="")
	{
		$sql=$sql."and readerDept like '%{$reader_Dept}%'";
	}
	if($reader_Grade0!=""&&$reader_Grade1!="")
	{
		$sql=$sql."and readerGrade >= $reader_Grade0 and readerGrade <= $reader_Grade1";
	}
    if($reader_Grade0==""&&$reader_Grade1!="")
    {
    	$sql=$sql."and readerGrade <= $reader_Grade1";
    }
    if($reader_Grade0!=""&&$reader_Grade1=="")
    {
    	$sql=$sql."and readerGrade >= $reader_Grade0";
    }
	echo "<table border=1 id='result'>";	
	$result=odbc_exec($connid,$sql);
	while(odbc_fetch_row($result))
	{
		$readerid=odbc_result($result, "readerID");
		$readername=odbc_result($result, "readerName");
		$readersex=odbc_result($result, "readerSex");
		$readerdept=odbc_result($result, "readerDept");
		$readergrade=odbc_result($result, "readerGrade");
	?>
	<tr><td><?php echo $readerid; ?></td>
	    <td><?php echo $readername; ?></td>
	    <td><?php echo $readersex;?></td>
	    <td><?php echo $readerdept; ?></td>
		<td><?php echo $readergrade; ?></td>
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
