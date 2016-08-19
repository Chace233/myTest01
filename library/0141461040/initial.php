<html>
<head><meta http-equiv="Content-Type" content="text-html;charset=gb2312"></head>
<body>
    <?php
        include 'connect.php';

	    //创建表
		$sql_book="create table Book
		        (
		         bookID varchar(30) primary key not null,
		         bookName varchar(30)not null,
		         bookPub varchar(30),
		         bookDate date,
		         bookAuthor varchar(20),
		         bookMem varchar(30),
		         bookTotalCnt smallint not null,
		         bookInCnt smallint not null
		         );";
	    $result_book=odbc_exec($connid,$sql_book);
		$sql_reader="create table Reader
		         (
		          readerID varchar(8) primary key not null,
		          readerName varchar(20)not null,
		          readerSex char(2),
		          readerDept varchar(20),
		          readerGrade smallint
		          );";
        $result_reader=odbc_exec($connid,$sql_reader);
		$sql_record="create table Record
		          (
		          	readerID varchar(8) not null,
		          	bookID varchar(30)not null,
		          	BorrowDate date not null,
		            IsReturn bit not null,
		          	primary key(readerID,bookID),
		          	foreign key(readerID) references Reader(readerID),
		          	foreign key(bookID) references Book(bookID)
		          	);";
	 	$result_record=odbc_exec($connid,$sql_record);


	 	//检测创建的表是否存在
	 	$book=0;
	 	$reader=0;
	 	$record=0;
	 	$result_istable=odbc_tables($connid);
	 	while(odbc_fetch_row($result_istable))
	 	{
	 		if(odbc_result($result_istable, "table_name")=="Book")
	 			$book=1;
	 		else if(odbc_result($result_istable, "table_name")=="Reader")
	 			$reader=1;
	 		else if(odbc_result($result_istable, "table_name")=="Record")
	 			$record=1;
	 	}


	 	//检测表是否为空
	 	$flag=0;
	 	$isnull_book="select * from Book";
	 	$isnull_reader="select * from Reader";
	 	$isnull_record="select * from Record";
	 	$result_isnull_book=odbc_exec($connid, $isnull_book);
	 	while(odbc_fetch_row($result_isnull_book)){
	 		$flag=1;
	 	}
	 	$result_isnull_reader=odbc_exec($connid,$isnull_reader);
	 	while(odbc_fetch_row($result_isnull_reader)){
	 		$flag=1;
	 	}
	 	$result_isnull_record=odbc_exec($connid, $isnull_record);
        while(odbc_fetch_row($result_isnull_record)){
	 		$flag=1;
	 	}



	 if($book && $reader&&$record&&!$flag) 
	 {
	 	echo "<div id='result' style='display:none'>0</div>成功";
	  }
	 else
	 {
	   echo "<div id='result' style='display:none'>1</div>失败";
	 }
	 odbc_close($connid);
 ?>
</body>
</html>