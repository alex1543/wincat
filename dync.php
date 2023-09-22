<?php

// динамическое заполнение таблицы.
if (isset($_GET['select'])) {

	// формирование и выдача HTML.
	function GetHTML($text, $status) {
		$sHTMLout="<!DOCTYPE html><html><head></head><body><div id='iTableGet'>";
		$sHTMLout.=$text."</div><div id='iListStatus'>".$status."</div></body></html>";
		echo $sHTMLout;
	}
	
	// блок инициализации
	try {
		$pdoSet = new PDO('mysql:dbname=test;host=localhost', 'root', '');
		$pdoSet->query('SET NAMES utf8;USE test;');
	} catch (PDOException $e) {
		GetHTML($e->getMessage(), 'error');
		die();
	}


	$sql = "SELECT * FROM myarttable WHERE id>14 ORDER BY id DESC";
	$stmt=$pdoSet->query($sql);
	$resultMF = $stmt->fetchAll(PDO::FETCH_NUM); // PDO::FETCH_NUM - только числовые индексы: [0][0]
//var_dump($resultMF);
	if (Count($resultMF) == 0) {
		?><!DOCTYPE html><html><head></head><body><div id='iTableGet'>none</div></body></html><?php
		
	} else {

		$sHTML='<table>';
		for ($i = 0; $i < Count($resultMF); ++$i) {
			$sHTML.='<tr>';
			for ($iCol = 0; $iCol < Count($resultMF[$i]); ++$iCol)
				$sHTML.='<td>'.$resultMF[$i][$iCol].'</td>';
			$sHTML.='</tr>';
		}
		$sHTML.='</table>';
		
		GetHTML($sHTML, 'good');
	}
}

?>