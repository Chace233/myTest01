<?php
include 'pdo.php';
try{
	$pdo->setAttribute(PDO::ATTR_AUTOCOMMIT,0);
	$pdo->beginTransaction();

	$sql = "update cash set money=money-50 where username='zhangsan'";
	$affect = $pdo->exec($sql);
	if(!$affect){
		throw new Exception("转出失败！", 1);
		
	} 
	$sql = "update cash set money=money+50 where username='lisi'";
	$affect = $pdo->exec($sql);
	if(!$affect){
		throw new Exception("转入失败！", 1);
		
	}

	$pdo->commit();
	echo "汇款成功！";
}catch(PDOException $e){
	echo $e->getMessage();
	$pdo->rollback();

}

$pdo->setAttribute(PDO::ATTR_AUTOCOMMIT,1);

?>