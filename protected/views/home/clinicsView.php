<?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl.'/js/map.js'); ?>
<?php Yii::app()->getClientScript()->registerScriptFile("https://api-maps.yandex.ru/2.1/?lang=ru_RU"); ?>
<?php
	$modelName = get_class($model);
	$cs = Yii::app()->getClientScript();
	$adress = $model -> address;
	$found = array();
	if (trim($adress)) {
		$adress1=urlencode($adress);
		$url="http://geocode-maps.yandex.ru/1.x/?geocode=".$adress1;//."&key=".$key;
		//echo $url;
		@$content=file_get_contents($url);
		//echo $content;
		preg_match('/<pos>(.*?)<\/pos>/',$content,$point);
		preg_match('/<found>(.*?)<\/found>/',$content,$found);
	}
	if (trim(next($found)) > 0) {
		$coordinaty=explode(' ',trim(strip_tags($point[1])));
		
		$cs -> registerScript('mapAct','
			addCoords(['.$coordinaty[1].', '.$coordinaty[0].'],"'.$model -> name.', '.$adress.'");
		',CClientScript::POS_READY);
	} else {
		$cs -> registerScript('mapAct','
			$("#map").html("Не удалось найти местоположение заправшиваемого объекта. Пожалуйста, сообщите о данной ошибке в техподдержку сайта. Адрес: '.$adress.'.");
		',CClientScript::POS_READY);
	}
?>
<div class="main_content">
		<div class="in_main_content h-card">
			<div class="in_main_content_left article_left ">
				<div class="hleb">
					<ul>
						<li><a rel="nofollow" href="<?php echo Yii::app() -> baseUrl.'/'; ?>">Главная</a></li>
						<!--<li><img src="<?php echo Yii::app() -> baseUrl.'/'; ?>img/strelka.png" alt="Strelka"></li>-->
						<li><a rel="nofollow" href="<?php echo Yii::app() -> baseUrl .'/'. $modelName.'?clear=';?>"><?php echo $modelName == "clinics" ? 'Клиники' : 'Врачи' ; ?></a></li>
						<!--<li><img src="<?php echo Yii::app() -> baseUrl.'/'; ?>img/strelka.png" alt="Strelka"></li>-->
						<li><a rel="nofollow" href="#"><?php echo $model -> name; ?></a></li>
					</ul>
				</div>
				<div class="zagolovok_clinick">
					<h1 class="p-name">
						<?php echo $model -> name; ?>
					</h1>
					<h2><?php echo $model -> checkTrigger(2); ?></h2>
					<div class="best_specialist">
						<?php
							$column_class = array('button_left', 'button_right');
							$column = -1;
							$no_disp = array(2, 13);
							foreach ($model -> giveTriggerValuesObjects($model -> triggers) as $tr) {
								if (!in_array($tr -> trigger -> id,$no_disp)){
									$column = ($column + 1) % 2;
									echo "<button class=".$column_class[$column].">".$tr -> value."</button>";
								}
							}
						?>
					</div>
				</div>
				<div class="clinick_content">

					<div class="in_clinick_content">
						<?php if ($distr = CHtml::giveStringFromIdString('Districts', $model -> district, 'name')): ?>
						<div class="rayon">
							<img src="<?php echo Yii::app() -> baseUrl.'/'; ?>img/rayon.png" alt="rayon">
							<p>Район : <?php echo $distr; ?></p>
						</div>
						<?php endif; ?>
						<div class="clear"></div>
						<?php if ($model -> address): ?>
						<div class="rayon">
							<img src="<?php echo Yii::app() -> baseUrl.'/'; ?>img/adress.png" alt="rayon">
							<p class="adres">Адрес : <span class="p-adr"><?php echo $model -> address; ?></span></p>
							<!--<p class="adres2">  ул. Аккуратова, д. 2a</p>-->
						</div>
						<?php endif; ?>
						<?php if ($model -> phone): ?>
						<div class="rayon">
							<img src="<?php echo Yii::app() -> baseUrl.'/'; ?>img/phone.png" alt="rayon">
							<p>Телефон: <span class="p-tel"><?php echo $model -> phone; ?></span> </p>
						</div>
						<?php endif; ?>
						<?php if ($metro = CHtml::giveStringFromIdString('Metro', $model -> metro_station, 'name')): ?>
						<div class="rayon">
							<img src="<?php echo Yii::app() -> baseUrl.'/'; ?>img/metro.png" alt="rayon">
							<p class="adres">Ближайшее метро: <?php echo $metro; ?></p>
							<!--<p class="adres2 near_metro">  Пионерская (1400 метров)</p>-->

						</div>
						<?php endif; ?>
						<div class="rayon">
							<img src="<?php echo Yii::app() -> baseUrl.'/'; ?>img/time.png" alt="rayon">
							<p class="adres" style = "display:inline-block; padding: 0;padding-left:20px; vertical-align:middle; text-align:left;">
								Время работы:
							</p>
							<p class="adres" style = "display:inline-block; padding:0; vertical-align:middle; text-align:left;">
								<?php echo $model -> working_hours; ?>
							</p>
							<!--<p class="adres">Время работы:  3 Тесла- ежедневно с 09:00 по 21:00,</p>
							<p class="adres2 time">  1.5 Тесла- Пн-Пт с 09:00 по 17:00</p>-->

						</div>

						<h2>Цены <br>на некоторые исследования:</h2>

					</div>


				<div class="clear"></div>
				</div>
				<!--<div class="razdel razdel_clinick">
					<div class=""><p>Локализация грыжи:</p></div>
				</div>-->
				<div class="clear"></div>
				<div class="mrt_text clinick_price">
					<ul>
					<?php 
						$obj = new clinics;
						//var_dump($pricelist);
						$prices = $obj -> preparePrices($pricelist);
						foreach(array_filter($prices) as $name => $price) {
							echo "<li><p>{$name}</p><p>{$price}</p></li>";
						}
					?>
					</ul>
					<!--<ul>
						<li>
							<p >МРТ Головного Мозга</p><p>3800</p>
						</li>
						<li>
							<p>МРТ Поясничного Отдела Позвоночного столба (ПОП)</p><p>3800</p>
						</li>
						<li>
							<p>МРТ Шейного Отдела Позвоночного столба (ШОП)</p><p>3800</p>
						</li>
						<li>
							<p>МРТ Брюшной полости</p><p>3800</p>
						</li>
						<li>
							<p>
								МРТ Коленного Сустава</p><p>3800</p>
						</li>
						<li>
							<p>КТ Головного Мозга</p><p>3800</p>
						</li>
						<li>
							<p>
								КТ грудной полости</p><p>3800</p>
						</li>
						<li>
							<p>КТ поясничного отдела позвоночника </p><p>3800</p>
						</li>
					</ul>-->
				</div>
				<div class="clear"></div>


				<!--<div class="razdel kt razdel_clinick">
					<div class=""><p>Мнение эксперта:</p></div>
				</div>-->
				<div class="clear"></div>
				<div class="clinick_text">
					<?php echo $model -> text; ?>
					<!--<div>
						<p>Будучи врачом (не ортопедической специализации), я оказался перед выбором места лечения.
						Асептический некроз головки бедренной кости практически не поддаётся консервативной терапии,
						поэтому речь могла идти только об эндопротезировании.
						</p>
						<p>О клинике «Ортон» я узнал от коллег. В процессе обследования консультировался в нескольких
						крупных ортопедических центрах в России, направлял свои данные в клиники Израиля и Германии.
						</p>
						<p>Окончательный выбор места лечения был обусловлен следующим:</p>
						<p>• больший опыт и лучшие условия и результаты лечения по сравнению с российскими клиниками;</p>
						<p>• относительная дешевизна и близость расположения по сравнению с другими </p>
					</div>


				   <div>
					   <p>
						зарубежными клиниками.
					   </p>
					   <p>В августе 2013 г. мне была выполнена операция в объёме тотального эндопротезирования левого тазобедренного сустава.
					   </p>
					   <p>В период пребывания в клинике «Ортон» я отметил высокий уровень организации
						   лечебного процесса, квалификации врачей и медсестёр. В клинике накоплен
						   более чем шестидесятилетний опыт ортопедической хирургии. Следование современным
						   рекомендациям международных ортопедических организаций позволяет врачам клиники не
						   только выполнять оперативные вмешательства на самом высоком уровне, но и избавляет их
						   от необходимости следовать устаревшим представлениям и догмам, что существенно усложняет
						   лечебный процесс в клиниках России.
					   </p>
				   </div>-->
				</div>

				
			</div>

			<div class="in_main_content_right">
				<div class="icons">
					<div class="diagnostik">
						<a href="#">
							Диагностика
						</a>
					</div>
					<div class="clinik">
						<a href="#">
							Клиника
						</a>
					</div>
					<div class="doctors">
						<a href="#">
							Врачи
						</a>
					</div>
					<div class = "map" id="map" style="width:230px;height:230px;"></div>
					<!--<div class="map">
						<a href="#">
							<img src="<?php echo Yii::app() -> baseUrl.'/'; ?>img/map.png" alt="">
						</a>
					</div>-->
					<div class="contects">
						<?php if ($model -> email) : ?>
						Email
						<div class="u-email"><?php echo $model -> email; ?></div>
						<? endif; ?>
						<?php if ($model -> site) : ?>
						Сайт
						<div><?php echo $model -> site; ?></div>
						<? endif; ?>
						<?php if ($model -> mrt) : ?>
						Модель МРТ
						<div><?php echo $model -> mrt; ?></div>
						<? endif; ?>
						<?php if ($model -> kt) : ?>
						Модель КТ
						<div><?php echo $model -> kt; ?></div>
						<? endif; ?>
						
					</div>
					<?php
						foreach ($model -> doctors as $doctor) {
							$this -> renderPartial('//home/_doctor_shortcut', array('doctor' => $doctor));
						}
					?>
				</div>
			</div>
		</div>
	</div>
	