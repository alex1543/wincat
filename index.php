<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Windows Cat</title>
		<meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="wincat.css" />
	</head>
	<body>
	
	<div class="centrLable">Windows <div>Cat</div></div>

	<div id="iMenuHidden">
		<div id="iMenuWindow">
			<div id="iMenuN1">File</div><div id="iMenuN2">View</div><div id="iMenuN3">Edit</div><div id="iMenuN4">Settings</div><div id="iMenuN5">About</div>

			<canvas id="iStar1" width="25" height="25"></canvas>
			<canvas id="iStar2" width="25" height="25"></canvas>
			<canvas id="iStar3" width="25" height="25"></canvas>
			<canvas id="iStar4" width="25" height="25"></canvas>
			<canvas id="iStar5" width="25" height="25"></canvas>

			<div id="iSubMenu">none.</div>
		</div>


		<div class="WinSettingsSpace">
			<div>
				<div>Блок реализации 0 - здесь (главные настройки).</div>	
				<div class="cSettingsOkCancel">
					<input id="iBtSettingsOK" class="btOk" type="button" value="Сохранить" />
					<input id="iBtSettingsCancel" class="btCancel" type="button" value="Отменить" />		
				</div>
			</div>
		</div>

		<div class="WinSettingsSpace">
			<div>
				<div>Блок реализации 1 - здесь (настройки 1).</div>	
				<div class="cSettingsOkCancel">
					<input id="iBtSetTypeGrafOk" class="btOk" type="button" value="ОК" />
					<input id="iBtSetTypeGrafCancel" class="btCancel" type="button" value="Отмена" />		
				</div>						
			</div>
		</div>

		<div class="WinSettingsSpace">
			<div>
				<div>Блок реализации 2 - здесь (настройки 2).</div>	
				<div class="cSettingsOkCancel">
					<input id="iBtSetDepoOk" class="btOk" type="button" value="ОК" />
					<input id="iBtSetDepoCancel" class="btCancel" type="button" value="Отмена" />		
				</div>
			</div>					
		</div>

		<div class="WinSettingsSpace">
			<div>
				<div>Блок реализации 3 - здесь.</div>
				<div class="cSettingsOkCancel">
					<input id="iBtSetCopyOk" class="btOk" type="button" value="ОК" />
					<input id="iBtSetCopyCancel" class="btCancel" type="button" value="Отмена" />	
				</div>
			</div>
		</div>
		
		<div class="WinSettingsSpace">
			<div>
				<div>Оконная система в браузере - Windows Cat. (с) 2023 г.</div>
			</div>
		</div>

		<div class="WinSettingsSpace">
			<div>
				<iframe>test</iframe>
				<div id="iTableAuto">
				
				test
				</div>
				<div id="iLoadStat">error</div>
			</div>
		</div>

		<div id="iMenuLoad">text.</div>
	</div>
	
	</body>

	<!-- HTML5 -->
	<script src="win.js"></script>
	<footer>&nbsp;</footer>

</html>