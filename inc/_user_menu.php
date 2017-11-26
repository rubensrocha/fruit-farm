<div class="acc-title"><?=$_SESSION["user"]; ?></div>
<div class="field-gr"><a href="/account">Мой профиль</a></div>
<?
if(isset($_SESSION["admin"])){
	echo '<div class="field-rd"><a href="/admin">Админка</a></div>';
}
?>
<div class="field-gr"><a href="/account/farm">Фруктовая ферма</a></div>
<div class="field-gr"><a href="/account/store">Фруктовый склад</a></div>
<div class="field-gr"><a href="/account/market">Торговая лавка</a></div>
<div class="field-gr"><a href="/account/bonus">Ежедневный бонус</a></div>
<div class="field-gr"><a href="/account/lottery">Лотерея</a></div>
<div class="field-gr"><a href="/account/swap">Обменник</a></div>
<div class="field-gr"><a href="/account/referals">Ваши рефералы</a></div>
<div class="field-gr"><a href="/account/insert">Пополнить баланс</a></div>
<div class="field-gr"><a href="/account/payment">Заказать выплату</a></div>
<div class="field-gr"><a href="/account/config">Настройки</a></div>
<div class="field-rd"><a href="/account/exit">Выход из профиля</a></div>
<div style="margin-top:20px;">
	<div class="acc-title">Состояние счета</div>
	<div class="field-ar"><a href="/account/insert">{!BALANCE_B!}</a>  <span style="margin:3px 10px 0px 0px;">[для покупок]</span></div>
	<div class="field-ars"><a href="/account/payment">{!BALANCE_P!}</a> <span style="margin:3px 10px 0px 0px;">[на вывод]</span></div>
</div>
