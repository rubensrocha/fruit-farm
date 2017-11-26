<div class="s-bk-lf">
	<div class="acc-title">Контакты</div>
</div>
<div class="silver-bk"><div class="clr"></div>	
<script type="text/javascript" src="../js/nicEdit.js"></script>
<script type="text/javascript">
	bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
</script>
<?PHP
	if(isset($_POST["tx"])){
		$db->Query("UPDATE db_conabrul SET contacts = '".$_POST["tx"]."' WHERE id = '1'");
		echo "<center><font color = 'green'><b>Сохранено</b></font></center><BR />";
	}
$db->Query("SELECT * FROM db_conabrul WHERE id = '1'");
$data = $db->FetchArray();
?>
<form action="" method="post">
<textarea name="tx" cols="78" rows="25"><?=$data["contacts"]; ?></textarea>
<BR /><BR />
<center><input type="submit" value="Сохранить" /></center>
</form>
</div>
<div class="clr"></div>	