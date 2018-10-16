<!DOCTYPE html>
<html>
<head>
	<title>response page</title>
  	<meta charset="utf-8">
  	<style type="text/css">
		body {
			color: #fff;
	  		font-family: "Andale Mono", monospace;
		}
		#time {
			text-align: right;
		}
		span {
			font-size: 120%;
		}
		table {
			border: 5px inset green;
			width: 400px;
			text-align: center;
		}
		tr td {
			border: 2px green;
		}
	</style>
</head>
<body>
<?php
if (session_id() === "") {
   session_start();
}
$start = microtime(true);

date_default_timezone_set("UTC");
$time = time() + 3 * 3600; 
echo "<p id='time'>Текущее время: ".date("H:i:s", $time)."</p>";
$y=(float)$_POST['y'];
if($_POST['y'] == "-0.0" ||$_POST['y'] == "-0.00")$y = (int) 0;
$r=(int)$_POST['r'];
if (empty($_POST['x55'])&empty($_POST['x44'])&empty($_POST['x33'])&empty($_POST['x22'])&empty($_POST['x11'])&(strlen($_POST['x0']) == 0)&empty($_POST['x1'])&empty($_POST['x2'])&empty($_POST['x3'])) die ("Вы не выбрали переменную X");
if(!empty($_POST['x55']) & ($_POST['x55']<-5 or $_POST['x55']>3)) die ("Получены неверные данные X");
if(!empty($_POST['x44']) & ($_POST['x44']<-5 or $_POST['x44']>3)) die ("Получены неверные данные X");
if(!empty($_POST['x33']) & ($_POST['x33']<-5 or $_POST['x33']>3)) die ("Получены неверные данные X");
if(!empty($_POST['x22']) & ($_POST['x22']<-5 or $_POST['x22']>3)) die ("Получены неверные данные X");
if(!empty($_POST['x11']) & ($_POST['x11']<-5 or $_POST['x11']>3)) die ("Получены неверные данные X");
if(!empty($_POST['x0']) & ($_POST['x0']<-5 or $_POST['x0']>3)) die ("Получены неверные данные X");
if(!empty($_POST['x1']) & ($_POST['x1']<-5 or $_POST['x1']>3)) die ("Получены неверные данные X");
if(!empty($_POST['x2']) & ($_POST['x2']<-5 or $_POST['x2']>3)) die ("Получены неверные данные X");
if(!empty($_POST['x3']) & ($_POST['x3']<-5 or $_POST['x3']>3)) die ("Получены неверные данные X");
if(strlen($_POST['y']) == 0) die ("Вы не записали переменную Y");
if((strlen($_POST['y']) != 0) & ($_POST['y']<-5 or $_POST['y']>3)) die ("Получены неверные данные Y");
echo "Обработка данных: <br>";
if(!empty($_POST['r']) & ($_POST['r']<1 or $_POST['r']>5)) die ("Получены неверные данные R");
if(!empty($_POST['x55'])) fax($_POST['x55'], $y, $r);
if(!empty($_POST['x44'])) fax($_POST['x44'], $y, $r);
if(!empty($_POST['x33'])) fax($_POST['x33'], $y, $r);
if(!empty($_POST['x22'])) fax($_POST['x22'], $y, $r);
if(!empty($_POST['x11'])) fax($_POST['x11'], $y, $r);
if(!(strlen($_POST['x0'])==0)) fax($_POST['x0'], $y, $r);
if(!empty($_POST['x1'])) fax($_POST['x1'], $y, $r);
if(!empty($_POST['x2'])) fax($_POST['x2'], $y, $r);
if(!empty($_POST['x3'])) fax($_POST['x3'], $y, $r);
if(!isset($_SESSION['x'])){ 
$_SESSION['x'] = array(); 
} 
if(!isset($_SESSION['y'])){ 
$_SESSION['y'] = array(); 
} 
if(!isset($_SESSION['r'])){ 
$_SESSION['r'] = array(); 
} 
if(!isset($_SESSION['getit'])){ 
$_SESSION['getit'] = array(); 
} 
echo "<table>";
echo "<tr>";
echo "<td>X";
echo "</td>";
foreach($_SESSION['x'] as $i => $base_value) {
	echo "<td>$base_value";
	echo "</td>";
	}
echo "<tr>";
echo "</tr>";
echo "<td>Y";
echo "</td>";
foreach($_SESSION['y'] as $i => $base_value) {
	echo "<td>$base_value";
	echo "</td>";
	}
	echo "<tr>";
echo "</tr>";
echo "<td>R";
echo "</td>";
foreach($_SESSION['r'] as $i => $base_value) {
	echo "<td>$base_value";
	echo "</td>";
	}
	echo "<tr>";
echo "</tr>";
echo "<td>✓";
echo "</td>";
foreach($_SESSION['getit'] as $i => $base_value) {
	echo "<td>$base_value";
	echo "</td>";
	}
echo "</tr>";
echo "</table>";

$t=(float)round((microtime(true)-$start), 4);
if($t==0)$t="менее 0.0001";
echo "Время работы скрипта: ".$t." сек<br>";

function fax($x, $y, $r) {
	if (($y<=($r-$x)&$x>=0&$y>=0)||(y>=(-r/2)&y<=0&x>=0&x<=r)||((pow($x,2)+pow($y,2)<=(pow($r/2, 2)))&$y<=0&$x<=0))
	{
		echo "<p>Точка <span>(".$x.", ".$y.")</span> <b>входит</b> в закрашенную область графика с <span>R = ".$r."</span>!</p>";
		/*array_push($_SESSION, array($x, $y, $r, 1));*/
		array_push($_SESSION['x'], $x);
		array_push($_SESSION['y'], $y);
		array_push($_SESSION['r'], $r);
		array_push($_SESSION['getit'], 1);
	} else {
		echo "<p>Точка <span>(".$x.", ".$y.")</span> <b>не входит</b> в закрашенную область графика с радиусом <span>R = ".$r."</span>!</p>";
		/*array_push($_SESSION, array($x, $y, $r, 0));*/
		array_push($_SESSION['x'], $x);
		array_push($_SESSION['y'], $y);
		array_push($_SESSION['r'], $r);
		array_push($_SESSION['getit'], 0);
	}
	/*echo "y=$y and r=$r and x=$x";
	echo "<br>".pow($x,2)." + ".pow($y,2)." <= ".(pow($r/2, 2))."<br>";
	if(pow($x,2)+pow($y,2)<=(pow($r/2, 2))) echo "true";
	else echo "false";*/
}

?>
</body>
</html>
