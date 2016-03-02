<?php
	class GoogleDocApiHelper extends BaseGoogleDocApiHelper {
		/**
		 * @var array yesNoTriggers - array that contains trigger verbiage as
		 * a key and googleDoc name as a value.
		 */
		/**
		 * format of a google doc entry

		'код' => string 'kirova' (length=6)
		'картинка' => string 'kirova' (length=6)

		'телефония' => string '(812) 490-75-73' (length=15)
		'online' => string '' (length=0)

		'дополнительно' => string '' (length=0)

		'примечания' => string '' (length=0)
		'прайсмрт' => string '
		http://www.vmeda.org/prices/~item/215' (length=38)
		'прайскт' => string '
		http://www.vmeda.org/prices/~item/215' (length=38)




		 */
		/*
		'название' => string 'Военно-Медицинская Академия им. С. М. Кирова' (length=79)
		'сайт' => string 'http://vmeda.org' (length=16)
		'адрес' => string 'ул. Академика Лебедева, д. 6' (length=48)
		'адресдополнительный' => string '' (length=0)
		'телефон' => string '(812) 248-32-86, (812) 292-33-47, (812) 292-32-94, (812) 291-45-47- прямой телефон записи' (length=108)
		'email' => string 'rentgen_vma@mail.ru' (length=19)
		'часыработы' => string 'Пн-Пт: 09.00-17:30' (length=22)
		'модельмрт' => string 'General Electric SIGNA 1.5T' (length=27)
		'моделькт' => string '' (length=1)

		*/
		public $staticFields = array(
			'name' => 'название',
			'site' => 'сайт',
			'address' => 'адрес',
			'address_extra' => 'адресдополнительный',
			'email' => 'email',
			'working_hours' => 'часыработы',
			'mrt' => 'модельмрт',
			'kt' => 'моделькт'
		);
		/*
		'мрт' => string 'да' (length=4)
		'кт' => string 'да' (length=4)
		'узи' => string 'да' (length=4)
		'маммография' => string 'нет' (length=6)
		'пэт' => string 'да' (length=4)
		'ангиография' => string 'да' (length=4)
		'частная' => string 'нет' (length=6)
		'дети' => string 'нет' (length=6)
		'круглосуточно' => string 'нет' (length=6)
		'ограниченияповесу' => string 'нет' (length=6)
		*/
		public $yesNoTriggers = array(
			'mrt' => 'мрт',
			'kt' => 'кт',
			'uzi' => 'узи',
			'mammografia' => 'маммография',
			'angiografia' => 'ангиография',
			'pet' => 'пэт',
			'kid' => 'дети',
			'allday' => 'круглосуточно',
			//'infinite_weight' => 'ограниченияповесу',
		);
		/**
		 * @var array $prices - an array containig price name and
         */
		/*
		 * 'ценамртголовногомозга' => string '4000' (length=4)
		'ценамртпоп' => string '4000' (length=4)
		'мртшоп' => string '4000' (length=4)
		'ценамртбрюшнойполости' => string '5000' (length=4)
		'ценамртколенногосустава' => string '4000' (length=4)
		'ценактголовногомозга' => string '2500' (length=4)
		'ценактгруднойполости' => string '2500' (length=4)
		'ценактпоп' => string '2500' (length=4)
		'ценактсосудовголовногомозга' => string '6000' (length=4)
		 */
		public $prices = array(
			'МРТ Головного Мозга'=>'ценамртголовногомозга',
			'КТ Головного Мозга'=>'ценактголовногомозга',
			'МРТ Поясничного отдела позвоночника'=>'ценамртпоп',
			'КТ Поясничного отдела позвоночника'=>'ценактпоп',
			'МРТ Брюшной полости'=>'ценамртбрюшнойполости',
			'МРТ Коленного Сустава'=>'ценамртколенногосустава',
			'КТ Грудной полости'=>'ценактгруднойполости',
			'МРТ Шейного отдела позвоночника'=>'мртшоп',
			'КТ Сосудов головного мозга'=>'ценактсосудовголовногомозга'
		);
		/**
		 * @var array $polyTrigs. Contains pairs <key> => <pTrig>
		 *
		 * <key> - the key to the $line array
		 * <pTrig> is an array that contains <googleDoc value> => <trigger's verbiage>
		 */
		public $polyTrigs = array(
				'количествосрезов' => array(
					'verbiage' => 'srezikt',
					'' => '16kt', //default
					'64' => '64kt',
					'128' => '128kt',
					'8' => 'less12kt',
					'256' => '256kt'
				)

		);
		/**
		 * @var array defaultWorkArea - array('spread' => , 'work' => ) to be used
		 * in the setDefaultWorkArea function. To be overridden in ancestors
		 */
		public $defaultWorkArea = array('spread' => 'catalog test','work'=>'Клиники');

		/**
		 * @param array $line - an array from googleDoc
		 * @return clinics - an initialized clinic instance
         */
		public function clinicFromLine($line){
			$line = array_filter(array_map('trim',$line));
			//Ищем, есть ли клиника уже в базе данных
			$clinic = clinics::model() -> findByAttributes(array('verbiage' => $line['код']));
			//Создаем, если нет
			if (!$clinic) {
				$clinic = new clinics();
				//echo "new";
				//echo '<br/>'.$line ['verbiage'].'<br/>';
				$clinic -> verbiage = $line['verbiage'];
			}
			//Задаем статические поля
			$attributes = array();
			foreach($this -> staticFields as $verb => $docName){
				$attributes[$verb] = $line[$docName];
			}
			$clinic -> attributes = $attributes;
			//выбираем вообще все триггеры, делаем массив verbiage => id
			$trigId = Html::listData(TriggerValues::model() -> findAll(),'verbiage','id');
			/**
			 * the triggers array of the clinic.
			 */
			$triggers = array();
			//Пробегаем по унарным триггерам
			foreach($this -> yesNoTriggers as $verb => $key){
				//echob ($key.' => '. $line[$key]);
				if ($line[$key] == 'да') {
					$triggers[] = $trigId[$verb];
				}
			}
			//Обрабатывается отдельно, тк инверсирована логика.
			if ($line['ограниченияповесу'] == 'нет') {
				$triggers[]=$trigId['infinite_weight'];
			}
			//Обрабатываем частная/гос
			if ($line['частная'] == 'да') {
				$triggers[] = $trigId['commercial'];
			} elseif ($line['частная'] == 'нет') {
				$triggers[] = $trigId['gosclinica'];
			}

			//Пробегаемся по полинарным триггерам.
			foreach ($this -> polyTrigs as $key => $pTrig){

				/*if (!$line[$key]) {
					$line[$key] = 'default';
				}*/
				//Оставляем возможность манипулировать триггером, если понадоюится.
				$tempVerb = $pTrig['verbiage'];
				//echo $line[$key];
				if ($tempVerb) {
					$triggers[$tempVerb] = $trigId[$pTrig[$line[$key]]];
				} else {
					$triggers[] = $trigId[$pTrig[$line[$key]]];
				}
			}
			/**
			 * Блок, посвященный нестандартной логике.
			 */
			//'район' => string 'Выборгский' (length=20)
			$distr_ids = $clinic -> giveDistrictIdsByNameString($line['район']);
			//var_dump($distr_ids);
			$clinic -> district = implode(';',$distr_ids);
			//Убираем количество срезов КТ, если нет КТ в клинике
			if (!in_array($trigId['kt'],$triggers)) {
				unset($triggers['srezikt']);
			}
			//Исследуем поля "тип магнита" и "магнитное поле"
			$triggers['field'] = $trigId['1_5tl'];
			$triggers['magnet_type'] = $trigId['close'];
			if ($line['магнитноеполе']=='ht'){
				$triggers['field'] = $trigId['3tl'];
				$triggers['magnet_type'] = $trigId['close'];
			} elseif($line['типмагнита']=='open'){
				$triggers['field'] = $trigId['weak'];
				$triggers['magnet_type'] = $trigId['open'];
			}
			//Разбираемся с типами исследований
			//'исключитьтипыисследований' => string '' (length=0)
			//Получили типы, которые нуно выкинуть.
			$excludeTypeNames = array_filter(array_map(function ($str) { return trim($str); },explode(', ', $line['исключитьтипыисследований'])));
			//var_dump($excludeTypeNames);
			$types = Triggers::model() -> findByAttributes(array('verbiage' => 'research')) -> trigger_values;
			foreach($types as $type) {
				//echo mb_strtolower($type -> value,'UTF-8').' - <br/>';
				if (!in_array(mb_strtolower(trim($type -> value),'UTF-8'),$excludeTypeNames)) {
					$triggers[] = $type -> id;
				} else {
					//echob("excluded {$type -> verbiage}");
				}
			}
			/**
			 * Конец блока нестандартной логики
			 */
			//temporerily
			$showP = function($price){
				echob($price -> name.' - '. $price -> price);
			};
			//Устанавливаем триггеры:
			$clinic -> triggers = implode(';', $triggers);
			//Добавляем цены. Для этого предварительно сохраняем изменения,
			//чтобы получить clinic -> id
			if (!$clinic -> save()) {
				new CustomFlash('error',get_class($clinic),'Save',$clinic -> verbiage.' не сохранена.',true);
				return false;
			}
			foreach($this -> prices as $priceName => $priceField){
				//Если строчка пустая, то пропускаем цену.
				if(!$line[$priceField]){
					continue;
				}
				//Пытаемся найти цену
				$price = PriceList::model() -> findByAttributes(array(
					'object_type' => Objects::model() -> getNumber(get_class($clinic)),
					'object_id' => $clinic -> id,
					'name' => $priceName
				));
				//Если стоит прочерк, удаляем цену.
				if ($line[$priceField] == '-') {
					if ($price) {
						$price -> delete();
					}
					continue;
				}
				//Если не нашлась, то создаем новую.
				if (!$price) {
					//echo 'new:';
					$price = new Pricelist;
					$price->object_type = Objects::model()->getNumber(get_class($clinic));
					$price->object_id = $clinic->id;
					$price->name = $priceName;
				}
				$price -> price = $line[$priceField];
				//$showP($price);
				//Пытаемся цену сохранить.
				if (!$price -> save()) {
					new CustomFlash('error','Pricelist','save',"Could not save the price for {$clinic -> verbiage} named '{$price -> name}'.",true);

				}
			}
			//var_dump($triggers);
			//Yii::app() -> end();
			return $clinic;
		}
	}

?>