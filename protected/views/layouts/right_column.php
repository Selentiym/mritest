                <div class="in_main_content_right">
                    <div class="icons">
                        <div class="diagnostik">
                            <a style = "line-height:30px; padding-left:70px;font-size:17px; width:70%; padding-top:10px;" href="<?php echo Yii::app() -> baseUrl; ?>/clinics/">
                                Диагностика МРТ, КТ, УЗИ и другие виды
                            </a>
                        </div>
                        <div class="clinik">
                            <a href="<?php echo Yii::app() -> baseUrl; ?>/clinics/">
                                Клиники
                            </a>
                        </div>
                        <div class="doctors">
                            <a href="<?php echo Yii::app() -> baseUrl; ?>/doctorsList">
                                Врачи
                            </a>
                        </div>
                        <img style="width:240px; display:block; margin:10px 0 0 5px;" src="<?php echo Yii::app() -> baseUrl; ?>/images/right_image.jpg" alt="algorythm"/>
						<?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl.'/js/map.js'); ?>
						<?php Yii::app()->getClientScript()->registerScriptFile("https://api-maps.yandex.ru/2.1/?lang=ru_RU"); ?>
						<?php 
							$toAdd = '';
							$clinics_to_map = clinics::model() -> findAll();
							foreach ($clinics_to_map as $clinic) {
								if ($clinic -> map_coordinates) {
									$toAdd .= "{$clinic -> verbiage} = new ymaps.Placemark( [{$clinic -> map_coordinates}] , {
											hintContent: '".prepareTextToJS ($clinic -> name).", ".htmlentities ($clinic -> address)."'
										});";
									$toAdd .= "allClinics.geoObjects.add({$clinic -> verbiage});";
								}
							}
							Yii::app()->getClientScript()->registerScript("map_init","
								ymaps.ready(function () {
									var allClinics = new ymaps.Map('map', {
										center: [59.939095, 30.315868],
										zoom: 10
									}, {
										searchControlProvider: 'yandex#search'
									});
									".$toAdd."
									
								});
							",CClientScript::POS_READY);
						?>
                        <div id="map" class="map" style="width:220px; height:200px; margin:10px auto;">
							
                        </div>
                    </div>
                </div>