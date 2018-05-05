<?php
$_OPTIMIZATION["title"] = "Welcome";
?>
    <section class="no-padding-bottom">
        <div class="col-lg-12 text-center">
            <div class="card">
                <div class="card-body">
                    <label class="form-control-label">Добро пожаловать! Предлагаем вам сыграть в нашу увлекательную игру для поднятия своего бюджета!</label><br>
                    <label class="form-control-label">У нас нет никаких ограничений на выплату. Заработанные и выигранные деньги можно сразу выводить на свой кошелёк <span class="text-info">PAYEER</span>.</label><br>
                    <div class="row">
                        <div class="col-md-4"><img class="pull-right" src="/img/logo.png" style="width: 230px;margin-top: 15px;">
                        </div>
                        <div class="col-md-8">
                            <div class="media">
                                <div class="pull-left" style="margin-right: 30px;">
                                    <span class="grow"><img class="media-object" src="/img/game.png" alt="1" style="width: 70px;margin-top: 15px;margin-left: 15px;"></span>
                                </div>
                                <div class="media-body">
                                    <h3 class="media-heading text-info" style="margin: 10px 0;">Как начать играть?</h3>
                                    Покупайте авто и получайте стабильный заработок!
                                </div>
                            </div>

                            <div class="media">
                                <div class="pull-left" style="margin-right: 30px;">
                                    <span class="grow"><img class="media-object" src="/img/aff.png" alt="2" style="width: 70px;margin-top: 15px;margin-left: 15px;"></span>
                                </div>
                                <div class="media-body">
                                    <h3 class="media-heading text-info" style="margin: 10px 0;">Партнерская программа</h3>
                                    1-уровневая партнерская программа до 15% на вывод!
                                </div>
                            </div>

                            <div class="media">
                                <div class="pull-left" style="margin-right: 30px;">
                                    <span class="grow"><img class="media-object" src="/img/favicon.ico" alt="3" style="width: 70px;margin-top: 15px;margin-left: 15px;"></span>
                                </div>
                                <div class="media-body">
                                    <h3 class="media-heading text-info" style="margin: 10px 0;">Игры</h3>
                                    Играйте в наши увлекательные игры и получайте деньги!
                                </div>
                            </div>

                        </div>
                    </div>
                    <br>
                    <a href="/signup" class="btn btn-primary">Зарегистрироваться и получить бонус!</a>
                </div>
            </div>
        </div>
    </section>
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h3 class="h4">Последние выплаты</h3>
                    </div>
                    <div class="card-body">
                        <?PHP

                        $dt = time() - 60*60*48;

                        $db->Query("SELECT * FROM db_payment WHERE status = '3' AND date_add > '$dt' ORDER BY id DESC LIMIT 20");



                        if($db->NumRows() > 0){

                        $all_pay = 0;
                        $all_pay_sum = 0;

                        ?>
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Логин</th>
                                <th>Сумма</th>
                                <th>Статус</th>
                                <th>Дата</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?PHP

                            while($data = $db->FetchArray()){
                            $all_pay ++;
                            $all_pay_sum += $data["sum"];
                            ?>
                            <tr>
                                <th scope="row"><a href="/userAleycei"><?=$data["user"]; ?></a></th>
                                <td><?=sprintf("%.2f",$data["sum"]); ?> RUB</td>
                                <td><span class="text-success">Успешно</span></td>
                                <td><?=date("d.m.Y H:i:s",$data["date_add"]); ?></td>
                            </tr></tbody>
                            <?PHP

                            }

                            ?><?PHP


                            }else echo "<center>Пока что пусто :(</center><BR />";


                            ?></table>
                    </div>
                </div>
            </div>
        </div>
    </div>