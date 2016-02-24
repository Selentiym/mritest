<?php
	Yii::app()->getClientScript()->registerScriptFile("https://api-maps.yandex.ru/2.1/?lang=ru_RU");
	$clinics = clinics::model() -> findAll();
	$rez = array();
	foreach ($clinics as $clinic) {
		//echo $clinic -> name.'-'.$clinic -> map_coordinates."<br/>";
		if ($clinic -> map_coordinates) {
			$coordy = array_filter(array_map('trim',explode(',',$clinic -> map_coordinates)));
			$rez[] = array($clinic -> name , $coordy[0], $coordy[1]);
			//echo $clinic -> name."<br/>";
		}
	}
	Yii::app() -> getClientScript() -> registerScript('map','
		ymaps.ready(function() {
			var clinics = JSON.parse(\''.json_encode($rez).'\');
			var clinicCollection = new ymaps.GeoObjectCollection;
			clinics.forEach(function(item,i,arr){
				clinicCollection.add(new ymaps.Placemark([item[1],item[2]],{hintContent:item[0]}));
			});
			var myMap = new ymaps.Map("map", {
				center: [59.939095, 30.315868],
				zoom: 14
			}, {
				searchControlProvider: "yandex#search"
			})
			myMap.geoObjects.add(clinicCollection);
			myMap.setBounds(clinicCollection.getBounds());
		});
	',CClientScript::POS_READY);
?>
<div id="map" style="width:700px; height:700px;"></div>