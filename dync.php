<?php

// динамическое заполнение таблицы.
if (isset($_GET['select'])) {

	// блок инициализации
	try {
		$pdoSet = new PDO('mysql:dbname=test;host=localhost', 'root', '');
		$pdoSet->query('SET NAMES utf8;USE test;');
	} catch (PDOException $e) {
		print "Error!: " . $e->getMessage() . "<br/>";
		die();
	}


	$sql = "SELECT * FROM myarttable WHERE id>14 ORDER BY id DESC";
	$stmt=$pdoSet->query($sql);
	$resultMF = $stmt->fetchAll();
//var_dump($resultMF);
	if (Count($resultMF) == 0) {
		?><!DOCTYPE html><html><head></head><body><div id='iTableGet'>none</div></body></html><?php
		
	} else {
		?><!DOCTYPE html><html><head></head><body><div id='iTableGet'><table>
		<?php 
		for ($i = 0; $i < Count($resultMF); ++$i) {
			echo '<tr>';
			$iCountLine = floor(Count($resultMF[$i])/2);
			for ($iCol = 0; $iCol < $iCountLine; ++$iCol)
				echo '<td>'.$resultMF[$i][$iCol].'</td>';
			echo '</tr>';
		}
		
		?>
		</table></div><div id='iListStatus'>good</div></body></html><?php
	}
}

?>