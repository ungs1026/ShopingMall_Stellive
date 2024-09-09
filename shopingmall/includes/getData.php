<?php

function getData($pdo, $id)
{ // id와 val = db의 id에 해당하는 val의 내용 가져오기
	$query = "select * from goods where id=$id";
	try {
		$stmt = $pdo->prepare($query);
		$stmt->execute();
		$rs = $stmt->fetch(PDO::FETCH_ASSOC);
	} catch (PDOException $e) {
		echo 'Failed : ' . $e->getMessage();
		$rs = 'null object';
	}

	return $rs;
}
