<div class="s-bk-lf">
	<div class="acc-title">История пополнений</div>
</div>
<div class="silver-bk"><div class="clr"></div>	
<center><a href="/admin/story_insert">Список пополнений</a> || <a href="/admin/story_insert/day">По дням</a> || <a href="/admin/story_insert/month">График за 30 дней</a></center><BR />
<?PHP
# График
if(isset($_GET["month"])){
	$dlim = time() - 60*60*24*30;
	$db->Query("SELECT * FROM db_insert_money WHERE date_add > $dlim ORDER BY id DESC");
	$days_money = array();
	$days_insert = array();
	if($db->NumRows() > 0){
		while($data = $db->FetchArray()){
		$index = date("d.m.Y", $data["date_add"]);
			$days_money[$index] = (isset($days_money[$index])) ? $days_money[$index] + $data["money"] : $data["money"];
			$days_insert[$index] = (isset($days_insert[$index])) ? $days_insert[$index] + 1 : 1;
		}
	# Вывод
	if(count($days_money) > 0){
		$array_for_chart = array();
		$array_for_chart2 = array();
		$array_for_chart3 = array();
			foreach($days_money as $date => $sum){
				$array_for_chart[] = "['".$date."', ".round($sum)."]";
				$array_for_chart2[] = "['".$date."', ".$days_insert[$date]."]";
				$array_for_chart3[] = "['".$date."', ".round($sum / $days_insert[$date], 2)."]";
			}
			$retd = implode(", ", array_reverse($array_for_chart));
			$retd2 = implode(", ", array_reverse($array_for_chart2));
			$retd3 = implode(", ", array_reverse($array_for_chart3));
		?>
	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['День', 'Сумма'],
          <?=$retd; ?>
        ]);
        var options = {
          title: 'История пополнений (Сумма)',
          hAxis: {title: 'Last 30 Days',  titleTextStyle: {color: 'green'}}
        };
        var chart = new google.visualization.SteppedAreaChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
	<div id="chart_div" style="width: 100%; height: 500px;"></div>
	<script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart2);
      function drawChart2() {
        var data2 = google.visualization.arrayToDataTable([
          ['День', 'Кол-во'],
          <?=$retd2; ?>
        ]);
        var options2 = {
          title: 'История пополнений (Кол-во)',
          hAxis: {title: 'Last 30 Days',  titleTextStyle: {color: 'green'}}
        };
        var chart2 = new google.visualization.SteppedAreaChart(document.getElementById('chart_div2'));
        chart2.draw(data2, options2);
      }
    </script>
	<div id="chart_div2" style="width: 100%; height: 500px;"></div>
	<script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart3);
      function drawChart3() {
        var data3 = google.visualization.arrayToDataTable([
          ['День', 'Сумма'],
          <?=$retd3; ?>
        ]);
        var options3 = {
          title: 'AVG (Сумма / Кол-во)',
          hAxis: {title: 'Last 30 Days',  titleTextStyle: {color: 'green'}}
        };
        var chart3 = new google.visualization.SteppedAreaChart(document.getElementById('chart_div3'));
        chart3.draw(data3, options3);
      }
    </script>
	<div id="chart_div3" style="width: 100%; height: 500px;"></div>
		<?PHP
	}
	}else echo "<center><b>Записей нет</b></center><BR />";
?></div><div class="clr"></div>	<?PHP
return;
}
# Вывод статистики по дням
if(isset($_GET["day"])){
	$db->Query("SELECT * FROM db_insert_money ORDER BY id DESC");
	$days_money = array();
	$days_insert = array();
	
	if($db->NumRows() > 0){
		
		while($data = $db->FetchArray()){
		$index = date("d.m.Y", $data["date_add"]);
		
			$days_money[$index] = (isset($days_money[$index])) ? $days_money[$index] + $data["money"] : $data["money"];
			$days_insert[$index] = (isset($days_insert[$index])) ? $days_insert[$index] + 1 : 1;
			
		}
	
	# Вывод
	if(count($days_money) > 0){
	
		?>
		<table cellpadding='3' cellspacing='0' border='0' bordercolor='#336633' align='center' width="99%">
		  <tr bgcolor="#efefef">
			<td align="center" class="m-tb">Дата</td>
			<td align="center" class="m-tb">Пополнений</td>
			<td align="center" class="m-tb">На сумму</td>
			<td align="center" class="m-tb">AVG</td>
		  </tr>
		<?PHP
		
		$array_for_chart = array();
		
			foreach($days_money as $date => $sum){
			
				?>
				<tr class="htt">
					<td align="center"><b><?=$date; ?></b></td>
					<td align="center"><?=$days_insert[$date]; ?> шт.</td>
					<td align="center"><?=$sum; ?> <?=$config->VAL;?></td>
					<td align="center"><?=round($sum/$days_insert[$date],2); ?> <?=$config->VAL;?></td>
				</tr>
				<?PHP
				
			}
			
		?>
		</table>
		<?PHP
		
	}
	
	}else echo "<center><b>Записей нет</b></center><BR />";
	
	
	
?></div><div class="clr"></div>	<?PHP
return;
}

$tdadd = time() - 5*60;
	if(isset($_POST["clean"])){
	
		$db->Query("DELETE FROM db_insert_money WHERE date_add < '$tdadd'");
		echo "<center><font color = 'green'><b>Очищено</b></font></center><BR />";
	}

$db->Query("SELECT * FROM db_insert_money ORDER BY id DESC");

if($db->NumRows() > 0){

?>
<table cellpadding='3' cellspacing='0' border='0' bordercolor='#336633' align='center' width="99%">
  <tr bgcolor="#efefef">
    <td align="center" width="50" class="m-tb">ID</td>
    <td align="center" class="m-tb">Пользователь</td>
    <td align="center" width="75" class="m-tb"><?=$config->VAL; ?></td>
	<td align="center" width="75" class="m-tb">Серебро</td>
	<td align="center" width="150" class="m-tb">Дата операции</td>
  </tr>


<?PHP

	while($data = $db->FetchArray()){
	
	?>
	<tr class="htt">
    <td align="center" width="50"><?=$data["id"]; ?></td>
    <td align="center"><?=$data["user"]; ?></td>
    <td align="center" width="75"><?=$data["money"]; ?></td>
	<td align="center" width="75"><?=$data["serebro"]; ?></td>
	<td align="center" width="150"><?=date("d.m.Y в H:i:s",$data["date_add"]); ?></td>
  	</tr>
	<?PHP
	
	}

?>

</table>
<BR />
<form action="" method="post">
<center><input type="submit" name="clean" value="Очистить" /></center>
</form>
<?PHP

}else echo "<center><b>Записей нет</b></center><BR />";
?>
</div>
<div class="clr"></div>	