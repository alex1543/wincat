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
				<div>Оконная система в браузере - Windows Alex. (с) 2023 г.</div>
			</div>
		</div>
		<div id="iMenuLoad">text.</div>
	</div>
	
	</body>
<script type="text/javascript">

// флаг для выхода из главного меню.
var bWinOpen = new Boolean(false); bWinOpen = false;
// флаг во время применения параметров, чтобы не выйти.
var bWinLoad = new Boolean(false); bWinLoad = false;

mSp = document.getElementsByClassName('WinSettingsSpace');
for (var i = 0; i < mSp.length; ++i) mSp[i].id = 'iWinSettingsSpace'+i;


function CreateWindow(iWin, sTitle) {
	iSubMenu.style.display = 'none';
	bWinOpen = true; bWinLoad = false;
	iMenuLoad.style.display = 'none';

iWindowMain = 'WindowMain'+iWin;
if (document.getElementById(iWindowMain) == undefined) {
	iSpaceWin = document.getElementById('iWinSettingsSpace'+iWin);
	// создание оболочки (окна) для iSpaceWin.
	newWin = document.createElement('div');
	newWin.classList.add('WindowMain');
	iSpaceWin.after(newWin);
	newWin.id = iWindowMain;
	newWin.innerHTML = '<div id="iWinSettingsHeader'+iWin+'"><canvas id="iWinSettingsCircle'+iWin+'">&nbsp;</canvas>'+sTitle+'<canvas id="iWinSettingsExit'+iWin+'">&nbsp;</canvas></div>';
	document.getElementById('iWinSettingsHeader'+iWin).after(iSpaceWin);
	iSpaceWin.style.display = 'flex';
	
	// кружок.
	var iWinSettingsCircle = document.getElementById('iWinSettingsCircle'+iWin);
	iWinSettingsCircle.classList.add('WinCircle');

	iWinSettingsCircle.title = "По центру";
	iWinSettingsCircle.width = 25;
	iWinSettingsCircle.height = 25;

	WinCircleMse(iWin, '#000');
	function WinCircleMse(iWin, sCircleColor) {
		var iWinSettingsCircle = document.getElementById('iWinSettingsCircle'+iWin);
		ctxCircle = iWinSettingsCircle.getContext("2d");
		ctxCircle.beginPath();
		ctxCircle.arc(iWinSettingsCircle.width / 2, iWinSettingsCircle.height / 2, 9, 0, 2 * Math.PI, false);
		ctxCircle.lineWidth = "2";
		ctxCircle.strokeStyle = sCircleColor;
		ctxCircle.stroke();
	}
		
	// крестик.
	var iWinSettingsExit = document.getElementById('iWinSettingsExit'+iWin);
	iWinSettingsExit.title = "Закрыть";
	iWinSettingsExit.width = 25;
	iWinSettingsExit.height = 25;

	WinExitMse(iWin, '#000');
	function WinExitMse(iWin, sExitColor) {
		var iWinSettingsExit = document.getElementById('iWinSettingsExit'+iWin);
		ctxExit = iWinSettingsExit.getContext("2d");
		ctxExit.beginPath();
		ctxExit.moveTo(5, 20);
		ctxExit.lineTo(20, 5);
		ctxExit.moveTo(5, 5);
		ctxExit.lineTo(20, 20);
		ctxExit.lineWidth = "2";
		ctxExit.strokeStyle = sExitColor;
		ctxExit.stroke();
	}

	// окно - на первый план.
	newWin.onmousedown = function(iWin){
		return function() {
			SetFirstWindow(iWin);
		}
	}(iWin);
	// обработчики окна.
	const iWinSettingsHeader = document.getElementById('iWinSettingsHeader'+iWin);
	iWinSettingsHeader.classList.add('WinHeader');
	iHoverCircle = -1; iHoverExit = -1;
	iWinSettingsHeader.onmousedown = function(iWin){
		return function() {
			// обработка центровки (кружочка - слева).
			if (iHoverCircle != -1) {
				document.addEventListener('mouseup', HoverCircleUp);
				function HoverCircleUp() {
					document.removeEventListener('mouseup', HoverCircleUp);

					var windowInnerWidth = document.documentElement.clientWidth-window.pageXOffset;
					var windowInnerHeight = document.documentElement.clientHeight-window.pageYOffset;

					iWindowMain = 'WindowMain'+iWin;
					iWinMv = document.getElementById(iWindowMain);

					iWinMv.style.left = windowInnerWidth/2 + 'px';
					iWinMv.style.top = windowInnerHeight/2 + 'px';

					iHoverCircle = -1;
				}
		
				console.log('iHoverCircle='+iHoverCircle);
				return;
			}
			
			// обработка крестика.
			if (iHoverExit != -1) {
				document.addEventListener('mouseup', HoverExitUp);
				function HoverExitUp() {
					document.removeEventListener('mouseup', HoverExitUp);
				//	console.log(iWin);
					CloseWindow(iWin);
					
					iHoverExit = -1;
				}
		
				console.log('iHoverExit='+iHoverExit);
				return;
			}
			
			iSubMenu.style.display = 'none';

			//	console.log(document.activeElement.id);

//	.addEventListener('mousedown', function () {
			e = event || window.event;
			oRectWin = iWinSettingsExit.getBoundingClientRect();
			
			iWinDifX = e.clientX - oRectWin.left;
			
			iWindowMain = 'WindowMain'+iWin;
			iWinMv = document.getElementById(iWindowMain);
			iWinMv.style.opacity = '0.8';

			iWinDifY = e.clientY - iWinSettingsHeader.getBoundingClientRect().top + (iWinSettingsHeader.getBoundingClientRect().height - iWinMv.getBoundingClientRect().height)/2;
			document.addEventListener('mousemove', WinStartMove);

			document.addEventListener('mouseup', function () {
				document.removeEventListener('mousemove', WinStartMove);

				iWinMv = document.getElementById(iWindowMain);
				iWinMv.style.opacity = '1.0';
				
			});
		//	SetFirstWindow(iWin);
		}
	}(iWin);


	const btWinSettingsCircle = document.getElementById('iWinSettingsCircle'+iWin);
	const btWinSettingsExit = document.getElementById('iWinSettingsExit'+iWin);

	btWinSettingsCircle.onmouseover = function(iWin){
		return function() {
			WinCircleMse(iWin, '#fff');
			iHoverCircle = iWin;
		}
	}(iWin);
	btWinSettingsCircle.onmouseout = function(iWin){
		return function() {
			WinCircleMse(iWin, '#000');
			iHoverCircle = -1;
		}
	}(iWin);

	btWinSettingsExit.onmouseover = function(iWin){
		return function() {
			WinExitMse(iWin, '#fff');
			iHoverExit = iWin;
		}
	}(iWin);
	btWinSettingsExit.onmouseout = function(iWin){
		return function() {
			WinExitMse(iWin, '#000');
			iHoverExit = -1;
		}
	}(iWin);
}
// конец - создание нового окна.
	document.getElementById(iWindowMain).style.display = 'block';
	SetFirstWindow(iWin);
}

function CloseWindow(iWin) {
	iWindowMain = 'WindowMain'+iWin;
	document.getElementById(iWindowMain).style.display = 'none';

	// когда нет сообщения о сохр. настройках.
	if (iMenuLoad.style.display != 'block') {
		// только когда все окна закрыты, закрывается меню.
		var mWins = document.getElementsByClassName('WindowMain');
		for (var i = mWins.length-1; i >= 0; --i) {
			if (mWins[i].style.display == 'block') {
				nWinLast = Number(mWins[i].id.replace('WindowMain',''));
				SetFirstWindow(nWinLast);
				return;
			}
		}
		bWinOpen = false;
		
	}

}

var iWinLast = -1;
function SetFirstWindow(iWin) {
	if ((iWinLast != iWin) && (iWinLast != -1) && (iHoverExit != iWin)) {
		// текущее всегда последнее, на перед. план.
		oWin = document.getElementById('iWinSettingsSpace'+iWin).parentElement;
		iMenuLoad.before(oWin);

		if (iHoverExit != iWin) {
			document.getElementById('iWinSettingsHeader'+iWinLast).classList.add('WinHeaderNoAct');
			
			// послед. окно в списке будет окрашено.
			nWinLast = -1;
			var mWins = document.getElementsByClassName('WindowMain');
			for (var i = 0; i < mWins.length; ++i) {
				if (mWins[i].style.display == 'block') {
					nWinLast = Number(mWins[i].id.replace('WindowMain',''));
				}
			}
			if (nWinLast != -1) document.getElementById('iWinSettingsHeader'+nWinLast).classList.remove('WinHeaderNoAct');
		}
	}
	iWinLast = iWin;
}

// реализация формы 4
const iBtSetCopyCancel = document.getElementById('iBtSetCopyCancel');
	iBtSetCopyCancel.addEventListener('click', function () {
	CloseWindow(3);
});
const iBtSetCopyOk = document.getElementById('iBtSetCopyOk');
	iBtSetCopyOk.addEventListener('click', function () {
	iMenuLoad.innerHTML = 'Ждите применения настроек...';
	iMenuLoad.style.display = 'block';
	CloseWindow(3);
	
setTimeout(() => {
	// установки ...
	console.log('Применение настроек... форма 4');

	iMenuLoad.innerHTML = 'Настройки успешно применены.';
	bWinLoad = true;
	
}, 50);

});

// реализация формы 3
const iBtSetDepoCancel = document.getElementById('iBtSetDepoCancel');
	iBtSetDepoCancel.addEventListener('click', function () {
	CloseWindow(2);
});
const iBtSetDepoOk = document.getElementById('iBtSetDepoOk');
	iBtSetDepoOk.addEventListener('click', function () {
	iMenuLoad.innerHTML = 'Ждите применения настроек...';
	iMenuLoad.style.display = 'block';
	CloseWindow(2);
	
setTimeout(() => {
	// установки ...
	console.log('Применение настроек... форма 3');

	iMenuLoad.innerHTML = 'Настройки успешно применены.';
	bWinLoad = true;
	
}, 50);

});

// реализация формы 2
const iBtSetTypeGrafCancel = document.getElementById('iBtSetTypeGrafCancel');
	iBtSetTypeGrafCancel.addEventListener('click', function () {
	CloseWindow(1);
});
const iBtSetTypeGrafOk = document.getElementById('iBtSetTypeGrafOk');
	iBtSetTypeGrafOk.addEventListener('click', function () {
	iMenuLoad.innerHTML = 'Ждите применения настроек...';
	iMenuLoad.style.display = 'block';
	CloseWindow(1);
	
setTimeout(() => {
	// установки ...
	console.log('Применение настроек... форма 2');

	iMenuLoad.innerHTML = 'Настройки успешно применены.';
	bWinLoad = true;
	
}, 50);

});

// реализация формы 1
const iBtSettingsCancel = document.getElementById('iBtSettingsCancel');
	iBtSettingsCancel.addEventListener('click', function () {
	CloseWindow(0);
});
const iBtSettingsOK = document.getElementById('iBtSettingsOK');
	iBtSettingsOK.addEventListener('click', function () {
	iMenuLoad.innerHTML = 'Ждите применения настроек...';
	iMenuLoad.style.display = 'block';
	CloseWindow(0);
	
setTimeout(() => {
	console.log('Применение настроек... форма 1');

	iMenuLoad.innerHTML = 'Настройки успешно применены.';
	bWinLoad = true;

}, 50);

});

// Главное меню.

for (var i = 1; document.getElementById('iMenuN'+i) != undefined; ++i) {
	var cMenu = document.getElementById('iMenuN'+i);
	cMenu.onmouseover = function(i){
	return function() {
		var iSubMenu = document.getElementById('iSubMenu');

		function SetPosSubMenu() {
			var iMenuOne = document.getElementById('iMenuN'+i);
			iSubMenu.style.left = (iMenuOne.getBoundingClientRect().left + iSubMenu.getBoundingClientRect().width/2) + 'px';
				
			iMenuWindow = document.getElementById('iMenuWindow');
			iSubMenu.style.top = (iMenuWindow.getBoundingClientRect().height + iSubMenu.getBoundingClientRect().height/2) + 'px';
		}
		
		// реализация меню из выпадающего списка "Файл".
		if (i == 1) {
			iSubMenu.innerHTML = '<div id="iMenP1pp1">Пустой</div>';
			iSubMenu.innerHTML += '<div id="iMenP1pp2">Новый</div>';
			iSubMenu.innerHTML += '<div id="iMenP1pp3">Последний</div>';
			iSubMenu.innerHTML += '<div id="iMenP1pp4">Выбрать</div>';
			iSubMenu.innerHTML += '<div id="iMenP1pp5">Сохранить</div>';
			iSubMenu.innerHTML += '<div id="iMenP1pp6">Сохранить как...</div>';
			iSubMenu.innerHTML += '<div id="iMenP1pp7">Информация</div>';
			iSubMenu.innerHTML += '<div id="iMenP1pp8">Выход</div>';
			iSubMenu.style.display = 'block';	
			SetPosSubMenu();

			// обработчики каждой кнопки меню "Файл".
			iMenP1pp1.addEventListener('click', function () {
				document.getElementById('iMenuHidden').style.display = 'none';

				alert('Пункт меню не реализован.');
			});			
			iMenP1pp2.addEventListener('click', function () {
				document.location.href = '.';
			});			
			iMenP1pp3.addEventListener('click', function () {
				document.getElementById('iMenuHidden').style.display = 'none';

				alert('Пункт меню не реализован.');
			});			
			iMenP1pp4.addEventListener('click', function () {
				document.getElementById('iMenuHidden').style.display = 'none';

				alert('Пункт меню не реализован.');
			});			
			iMenP1pp5.addEventListener('click', function () {
				document.getElementById('iMenuHidden').style.display = 'none';

				alert('Пункт меню не реализован.');
			});			
			iMenP1pp6.addEventListener('click', function () {
				document.getElementById('iMenuHidden').style.display = 'none';

				alert('Пункт меню не реализован.');
			});			
			iMenP1pp7.addEventListener('click', function () {
				document.getElementById('iMenuHidden').style.display = 'none';

				alert('Пункт меню не реализован.');
			});		
			iMenP1pp8.addEventListener('click', function () {
				document.getElementById('iMenuHidden').style.display = 'none';
				
				alert('Пункт меню не реализован.');
			});
		}

		// реализация меню из выпадающего списка "Вид".
		if (i == 2) {
			
			function FillMenu2() {
				iSubMenu.innerHTML = '<div id="iMenP2pp1">Увеличить масштаб</div>';
				iSubMenu.innerHTML += '<div id="iMenP2pp2">Уменьшить масштаб</div>';
				iSubMenu.innerHTML += '<div id="iMenP2pp3">Свернуть все окна</div>';
				iSubMenu.innerHTML += '<div id="iMenP2pp4">Во весь экран</div>';
				
				for (var iMpp = 1; iMpp <= 12; ++iMpp) {
					if (iMpp == 5) {
						iSubMenu.innerHTML += '<div id="iMenP2pp'+(iMpp+4)+'" style="background: #87bbe6;" title="Выбран.">Окно '+iMpp+'</div>';
					} else {
						iSubMenu.innerHTML += '<div id="iMenP2pp'+(iMpp+4)+'">Окно '+iMpp+'</div>';
					}
				}
			}
			FillMenu2();
			
			iSubMenu.style.display = 'block';
			SetPosSubMenu();

			const iMenP2pp1 = document.getElementById('iMenP2pp1');
			iMenP2pp1.addEventListener('click', function () {
				document.getElementById('iMenuHidden').style.display = 'none';

				alert('Пункт меню не реализован.');
			});	
			const iMenP2pp2 = document.getElementById('iMenP2pp2');
			iMenP2pp2.addEventListener('click', function () {
				document.getElementById('iMenuHidden').style.display = 'none';

				alert('Пункт меню не реализован.');
			});	
			const iMenP2pp3 = document.getElementById('iMenP2pp3');
			iMenP2pp3.addEventListener('click', function () {
				document.getElementById('iMenuHidden').style.display = 'none';

				alert('Пункт меню не реализован.');
			});				
			const iMenP2pp4 = document.getElementById('iMenP2pp4');
			iMenP2pp4.addEventListener('click', function () {
				document.getElementById('iMenuHidden').style.display = 'none';

				alert('Пункт меню не реализован.');
			});			
			const iMenP2pp5 = document.getElementById('iMenP2pp5');
			iMenP2pp5.addEventListener('click', function () {
				document.getElementById('iMenuHidden').style.display = 'none';

				alert('Пункт меню не реализован.');
			});			
			const iMenP2pp6 = document.getElementById('iMenP2pp6');
			iMenP2pp6.addEventListener('click', function () {
				document.getElementById('iMenuHidden').style.display = 'none';

				alert('Пункт меню не реализован.');
			});				
			const iMenP2pp7 = document.getElementById('iMenP2pp7');
			iMenP2pp7.addEventListener('click', function () {
				document.getElementById('iMenuHidden').style.display = 'none';

				alert('Пункт меню не реализован.');
			});				
			const iMenP2pp8 = document.getElementById('iMenP2pp8');
			iMenP2pp8.addEventListener('click', function () {
				document.getElementById('iMenuHidden').style.display = 'none';

				alert('Пункт меню не реализован.');
			});				
			const iMenP2pp9 = document.getElementById('iMenP2pp9');
			iMenP2pp9.addEventListener('click', function () {
				document.getElementById('iMenuHidden').style.display = 'none';

				alert('Пункт меню не реализован.');
			});				
			const iMenP2pp10 = document.getElementById('iMenP2pp10');
			iMenP2pp10.addEventListener('click', function () {
				document.getElementById('iMenuHidden').style.display = 'none';

				alert('Пункт меню не реализован.');
			});				
			const iMenP2pp11 = document.getElementById('iMenP2pp11');
			iMenP2pp11.addEventListener('click', function () {
				document.getElementById('iMenuHidden').style.display = 'none';

				alert('Пункт меню не реализован.');
			});	
	
	
		}

		// реализация меню из выпадающего списка "Edit".
		if (i == 3) {
			iSubMenu.innerHTML = '<div id="iMenP3pp1">Удалить</div>';
			iSubMenu.innerHTML += '<div id="iMenP3pp2">Изменить</div>';
			iSubMenu.style.display = 'block';
			SetPosSubMenu();			

			// обработчики каждой кнопки меню "Правка".
			iMenP3pp1.addEventListener('click', function () {
				CreateWindow(3, 'Параметры удаления');

			//	alert('Пока не реализовано.');
			});			
			iMenP3pp2.addEventListener('click', function () {
				document.getElementById('iMenuHidden').style.display = 'none';

				alert('Пункт меню не реализован.');
			});	
			
		}

		// реализация меню из выпадающего списка "Настройки".
		if (i == 4) {
			iSubMenu.innerHTML = '<div id="iMenP4pp1">Основные параметры</div>';
			iSubMenu.innerHTML += '<div id="iMenP4pp2">Параметры 1</div>';
			iSubMenu.innerHTML += '<div id="iMenP4pp3">Параметры 2</div>';
			iSubMenu.style.display = 'block';
			SetPosSubMenu();
			
			const iMenP4pp1 = document.getElementById('iMenP4pp1');
			iMenP4pp1.addEventListener('click', function () {
				CreateWindow(0, 'Основные параметры');
					
			});


			iMenP4pp2.addEventListener('click', function () {
				CreateWindow(1, 'Настройка параметров 1');

			});	

			iMenP4pp3.addEventListener('click', function () {
				CreateWindow(2, 'Настройка параметров 2');

			});	
			
		}
			
		if (i > 4)
			iSubMenu.style.display = 'none';
	}
	}(i);

/*	
	cMenu.onmouseout = function(){
	return function() {
	//	document.getElementById('iSubMenu').style.display = 'none';
	}
	}();*/
}
	
const iMenuN5 = document.getElementById('iMenuN5');
iMenuN5.addEventListener('click', function () {
		CreateWindow(4, 'О сайте');

});

const cMenuHidden = document.getElementById('iMenuHidden');
cMenuHidden.addEventListener('mousemove', function () {
	e = event || window.event;
	iMenuWindow = document.getElementById('iMenuWindow');
	iMinShow = e.clientY - iMenuWindow.getBoundingClientRect().height;
	iMaxShow = iSubMenu.getBoundingClientRect().height + 10;

	if ((iMinShow > iMaxShow) && (!bWinOpen)) {
		document.getElementById('iMenuHidden').style.display = 'none';
	}
});
cMenuHidden.addEventListener('click', function () {
	if (bWinLoad && bWinOpen) {
		iMenuLoad.style.display = 'none';
		bWinOpen = false; bWinLoad = false;
	}
});

function WinStartMove() {
	iPlusMenuTop = 0;
	
	// если открыто меню сверху.
	iMenuHidden = document.getElementById('iMenuHidden');
	if (iMenuHidden.style.display != 'none') iPlusMenuTop = document.getElementById('iMenuWindow').getBoundingClientRect().height;
	
	e = event || window.event;
	
	// все расстояния от центра формы.
	iWinXnew = e.clientX -iWinDifX - (iWinMv.getBoundingClientRect().width/2) +30;
	iWinYnew = e.clientY - iWinDifY +20;

	var windowInnerWidth = document.documentElement.clientWidth-window.pageXOffset;
	var windowInnerHeight = document.documentElement.clientHeight-window.pageYOffset;

	iWinMv.style.left = iWinXnew + 'px';
	iWinMv.style.top = iWinYnew + 'px';
	
	iMinEdge = 25;
	iMinZalip = 25;

	if (iWinXnew - (iWinMv.getBoundingClientRect().width/2) < iMinEdge + iMinZalip)
		iWinMv.style.left = (iWinMv.getBoundingClientRect().width/2) + iMinEdge + 'px';
	
	if (windowInnerWidth - (iWinMv.getBoundingClientRect().width/2) - iWinXnew < iMinEdge + iMinZalip)
		iWinMv.style.left = windowInnerWidth - (iWinMv.getBoundingClientRect().width/2) -iMinEdge + 'px';

	if (iWinYnew - (iWinMv.getBoundingClientRect().height/2) < iMinEdge + iPlusMenuTop + iMinZalip)
		iWinMv.style.top = (iWinMv.getBoundingClientRect().height/2) + iMinEdge + iPlusMenuTop + 'px';		

	if (windowInnerHeight - (iWinMv.getBoundingClientRect().height/2) - iWinYnew < iMinEdge + iMinZalip)
		iWinMv.style.top = windowInnerHeight - (iWinMv.getBoundingClientRect().height/2) -iMinEdge + 'px';		
}

// появление Alex Windows.
const sTagAct = 'body';

const cTag = document.getElementsByTagName(sTagAct)[0];
cTag.addEventListener('mousemove', function () {
	
	e = event || window.event;
	oTag = document.getElementsByTagName(sTagAct)[0];
	iMinShow = e.clientY-oTag.getBoundingClientRect().top;

	if (iMinShow < 5) {
		document.getElementById('iMenuHidden').style.display = 'block';
	}
			
});

</script>


</html>