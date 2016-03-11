<?php
class HomeController extends Controller
{
	public $layout='//layouts/designLayout';
	public $defaultAction = 'ViewClinicsList';
	public $pageTitle = 'МРТ энциклопедия';
	//public $pageTitle;
	public function actions(){
		return array(
			'doctorsList'=>array(
				'class'=>'application.controllers.actions.FileViewAction',
				'access' => function () {return true;},
				'view' => '//static/doctorsWidget',
				'everyone' => true
			),
			'about'=>array(
				'class'=>'application.controllers.actions.FileViewAction',
				'access' => function () {return true;},
				'view' => '//static/about',
				'everyone' => true
			),
			'questions'=>array(
				'class'=>'application.controllers.actions.FileViewAction',
				'access' => function () {return true;},
				'view' => '//home/questions',
				'everyone' => true
			),
			'CallOrder'=>array(
				'class'=>'application.controllers.actions.FileViewAction',
				'access' => function () {return true;},
				'view' => '//home/CallForm',
				'everyone' => true
			),
			'rating'=>array(
				'class'=>'application.controllers.actions.FileViewAction',
				'access' => function () {return true;},
				'view' => '//home/rating',
				'everyone' => true
			),
			'discounts'=>array(
				'class'=>'application.controllers.actions.FileViewAction',
				'access' => function () {return true;},
				'view' => '//home/discounts',
				'everyone' => true
			)
		);
	}
	public function actionRegCall(){
		parse_str($_GET['serialized'], $form);
		print_r($form);
	}
	public function actionOrderCall(){
		$this -> render ('//home/CallForm');
	}
	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index', 'search','articles'),
				'users'=>array('*'),
			)
		);
	}
	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model = new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
	
	/**
	 * This is the action to handle external exceptions.
	 */
	/*public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->renderPartial('error', $error);
		}
	}*/
	
	/*
	* Displays a list of root articles.
	*/
	public function actionArticles()
	{
		//$this -> layout = 'mainLayout';
		$this->render('//articles/show_all', array(
			'articles' => Articles::GiveArticlesById(0, true)
		));
	}
	/**
	 * Displays the main page.
	 */
	/*public function actionIndex()
	{
		$criteria = new CDbCriteria;
		$criteria -> order = 'position ASC';
		$setting = Setting::model() -> find();
		
		$this -> renderPartial('index_new',array(), false, true);
		
		/*$this -> renderPartial('index', array(
			'articles' => Articles::GiveArticlesById(0, true),
			'RightTexts' => RightText::model() -> findAll($criteria),
			'HorizontalTexts' => HorizontalText::model() -> findAll($criteria),
			'main_text' => $setting -> main_text,
			'footerMenu' => MenuButtons::model() -> PrepareFooterMenu(),
			'footerText' => $setting -> footer_text
		),false, true);
	}//*/
	/**
	 * Displays th search result
	 */
	public function actionSearch()
	{
		$this -> render('search',array(
			
		));
	}
	/**
	 * creates a test model of the article and views it to the user.
	 */
	public function actionArticlePreview(){
		$model = new Articles;
        $menuLevel = 0;
        
        if(isset($_POST['Articles']))
        {   
            $model->attributes = $_POST['Articles'];
			if ((!isset($_POST["Articles"]["parent_id"]))&&($_POST["level"]==0))
			{
				$model -> parent_id = 0;
			}
			if (isset($_POST["triggers_array"]))
			{
				$model -> trigger_value_id = implode(';',$_POST["triggers_array"]);
			} else {
				$model -> trigger_value_id = 0;
			}
        }
		$this->render('//articles/view', array(
			'model' => $model,
			'children' => array(),
			'parentList' => $model -> GiveParentList($model),
			//'clinic' => $clinic,
			//'left' => $left,
			//'right' => $right,
			//'page' => $page
		));
	}
	/**
	 * Displays a particular.
	 */
	public function actionviewArticle($verbiage, $hash = null)
	{
		$verbiage = explode("/",$verbiage);
		//$article_array = Articles::model() -> giveArticleContent(trim(end($verbiage)));
		$article_array = Articles::model() -> giveArticleContent($verbiage);
		
		//meta tags
		Yii::app()->clientScript->registerMetaTag($article_array['article']->keywords, 'keywords');
		Yii::app()->clientScript->registerMetaTag($article_array['article']->description, 'description');
		$this -> pageTitle = $article_array['article']->title;
		//Набор клиник для показа под статьей.
		//$this->clinics = clinics::model()->findAll(array('with' => 'services', 'order' => 'rating DESC'));
		//print_r($article_array['article']['trigger_value_id']);
		//Если у статьи выключено отображение клиник под ней, то не пытаемся этого делать.
		if (($article_array['article'] -> show_objects)&&(Setting::model()->find()->show_objects)) {
			$clinics = clinics::model() -> filterByTriggerValuesIdString(clinics::model() -> findAll(array('order' => 'rating DESC')), $article_array['article']['trigger_value_id']);
		} else {
			$clinics = array();
		}
		if (!isset($_GET['page']))
		{
			$page = 0;
		} else {
			$page = ($_GET['page'] + 1 > count($clinics)) ? 0 : $_GET['page'];
		}
		$left = ($page > 0);
		$right = ($page + 1 < count($clinics));
		if (!empty($clinics))
		{
			$clinic = $clinics[$page];
			$clinic -> ReadData();
		} else {
			$clinic = '';
		}
		//Если это статья, которую следует отобразить текстом, то находим предыдущую и следующую.
		if (count(array_filter($article_array['children'])) == 0){
			$sisters = array_values($article_array['article'] -> GiveArticlesById($article_array['article'] -> parent_id));
			foreach($sisters as $key => $sister) {
				if ($sister['verbiage']==$article_array['article'] -> verbiage) {
					$found = $key;
					break;
				}
			}
			$prev = $sisters[($key > 0) ? $key - 1 : ''];
			$next = $sisters[$key < count($sisters) - 1 ? $key + 1 : ''];
		}
		//$this -> layout = 'mainLayout';
		$this->render('//articles/view', array(
			'model' => $article_array['article'],
			'children' => $article_array['children'],
			'parentList' => $article_array['parents'],
			'prev' => $prev,
			'next' => $next,
			'clinic' => $clinic,
			'left' => $left,
			'right' => $right,
			'page' => $page
		));
	}
	/**
	 * Displays a set of models with the filters
	 */
	public function actionViewClinicsList(){
		$_GET["clear"]=1;
		$this -> actionViewModelList('clinics');
	}
	public function actionViewModelList($modelName)
	{
		$pageSize = BaseModel::PAGE_SIZE;
		if ($_POST["sortBy"]) {
			$order = $_POST["sortBy"];
		}
		//echo $order;
		/*if (!$modelName) {
			
		}*/
		$sess_data = Yii::app()->session->get($modelName.'search');
		$searchId = $_GET["search_id"];
		$fromSearchId = TriggerValues::model() -> decodeSearchId($searchId);
		//print_r($fromSearchId);
		//echo "<br/>";
		if ($_POST["mrt"]) {
			$_POST[$modelName.'SearchForm']["МРТ"] = TriggerValues::model() -> findByAttributes(array('verbiage' => 'mrt')) -> id;
		}
		if ($_POST["kt"]) {
			$_POST[$modelName.'SearchForm']["КТ"] = TriggerValues::model() -> findByAttributes(array('verbiage' => 'kt')) -> id;
		}
		//print_r($_POST);
		//Если задан $_POST/GET с формы, то сливаем его с массивом из searchId с приоритетом у searchId
		if ($_POST[$modelName.'SearchForm']['submitted'])
		{
			$fromPage = array_merge($_POST[$modelName.'SearchForm'], $fromSearchId);
		} else {
			//Если же он не задан, то все данные берем из searchId
			$fromPage = $fromSearchId;
		}
		if ((!$fromPage)&&(!$sess_data))
		{
			//Если никаких критереев не задано, то выдаем все модели.
			$searched = $modelName::model() -> userSearch(array(),$order);
		} else {
			if ($_GET["clear"]==1)
			{
				//Если критерии заданы, но мы хотим их сбросить, то снова выдаем все и обнуляем нужную сессию
				Yii::app()->session->remove($modelName.'search');
				$page = 1;
				$searched = $modelName::model() -> userSearch(array(),$order);
			} else {
				//Если же заданы какие-то критерии, но не со страницы, то вместо них подаем данные из сессии
				if (!$fromPage)
				{
					$fromPage = $sess_data;
					//echo "from session";
				}
				//Адаптируем критерии под специализацию. Если для данной специализации нет какого-то критерия, а он где-то сохранен, то убираем его.
				$fromPage = Filters::model() -> FilterSearchCriteria($fromPage, $modelName);
				//Если критерии заданы и обнулять их не нужно, то запускаем поиск и сохраняем его критерии в сессию.
				Yii::app()->session->add($modelName.'search',$fromPage);
				$searched = $modelName::model() -> userSearch($fromPage,$order);
			}
		}
		Yii::app()->session->add($modelName.'searchRez',CHtml::giveAttributeArray($searched['objects'], 'id'));
		//делаем из массива объектов dataProvider
        $dataProvider = new CArrayDataProvider($searched['objects'],
            array(  'keyField' =>'id'
                ));
		$this -> layout = 'designLayout';
		//Определяем страницу.
		$maxPage = ceil(count($searched['objects'])/$pageSize);
		$page = $_POST["page"] ? $_POST["page"] : 1;
		$page = (($page >= 1)&&($page <= $maxPage)) ? $page : 1;
		$_POST[$modelName.'SearchForm'] = $fromPage;
		$this->render('show_list', array(
			'objects' => array_slice($searched['objects'],($page - 1) * $pageSize, $pageSize),
			'modelName' => $modelName,
			'filterForm' => $modelName::model() -> giveFilterForm($fromPage),
			'fromPage' => $fromPage,
			'description' => $searched['description'],
			'specialities' => Filters::model() -> giveSpecialities(),
			'page' => $page,
			'maxPage' => $maxPage,
			'total' => count($searched['objects'])
		));
		
	}
	/*
	 * Gives the html of BaseModel::PAGE_SIZE models from the searched ones.
	 */
	public function actionGiveMeMore(){
		if (($_GET["modelName"]=='clinics')||($_GET["modelName"]=='doctors')) {
			$modelName = $_GET["modelName"];
			$page = $_GET["page"] ? $_GET["page"] : 1;
			$pageSize = BaseModel::PAGE_SIZE;
			$ids = Yii::app()->session->get($modelName.'searchRez');
			$maxPage = ceil(count($ids)/$pageSize);
			
			$models = $modelName::model() -> findAllByPk(array_slice($ids,($page - 1) * $pageSize, $pageSize));
			foreach($models as $obj) {
				$this -> renderPartial('//home/_single_'.$modelName, array('model' => $obj));
			}
			/*if (!($page >= $maxPage)) {
				echo '<div class="more_rezult">';
				echo '<button id = "show_rez">Больше результатов</button>';
				echo '</div>';
			}*/
			//echo $page;
		}
	}
	/*
	* Функция для обработки ajax запроса о смене страницы от отображалки карточки клиники под статьей.
	*/
	public function actionListPage()
	{
		if(!Yii::app()->request->isAjaxRequest) throw new CHttpException('Url should be requested via ajax only');
		if (isset($_GET["verbiage"]))
		{
			$verbiage = $_GET["verbiage"];
			$article_array = Articles::model() -> giveArticleContent(trim($verbiage));
			$clinics = clinics::model() -> filterByTriggerValuesIdString(clinics::model() -> findAll(array('order' => 'rating DESC')), $article_array['article']['trigger_value_id']);
			if (!isset($_GET['page']))
			{
				$page = 0;
			} else {
				$page = ($_GET['page'] + 1 > count($clinics)) ? 0 : $_GET['page'];
			}
			$left = ($page > 0);
			$right = ($page + 1 < count($clinics));
			$clinic = $clinics[$page];
			$clinic -> ReadData();
			$this->renderPartial('//home/viewLister', array(
				'clinic' => $clinic,
				'left' => $left,
				'right' => $right,
				'page' => $page
			));
		}
	}
	public function actionSetVerbiage(){
		$values = TriggerValues::model() -> findAll();
		foreach ($values as $value)
		{
			if (strlen($value -> verbiage) == 0){
				echo str2url($value -> value)."<br/>";
				$value -> verbiage = str2url($value -> value);
				$value -> save();
			} else {
				echo "verbiage: ".str2url($value -> verbiage)."<br/>";
			}
		}
	}
	
	public function actionViewModel($modelName, $verbiage)
	{
		$word = $_GET["word"] ? $_GET["word"] : 'main' ;
		$this -> ViewSingleModel($modelName, $verbiage, $word);
	}
	/*public function actionViewModelOther($modelName, $verbiage)
	{
		$this -> ViewSingleModel($modelName, $verbiage, true);
	}*/
	/**
	 * Displays a model with a specified verbiage
	 */
	public function ViewSingleModel($modelName, $verbiage, $word)
	//public function actionViewModel($modelName, $verbiage)
	{
		//echo "model:";
		//echo $modelName.'<br/>';
		//echo $verbiage.'<br/>';
		//return;      
		if ($object = $modelName::model() -> find('verbiage=:verb', array(':verb' => $verbiage)))
		{
			$criteria = new CDbCriteria();
			//var_dump($object);
			$criteria -> compare('object_id', $object -> id);
			$criteria -> compare('object_type', $object -> type);
			$pricelist = PriceList::model()->findAll($criteria);
			//$pricelist = PriceList::model()->findAll(array('condition' => array ('object_id = ' . $object->id, 'object_type = '. $object -> type)));

			// meta tags
			Yii::app()->clientScript->registerMetaTag($object->keywords, 'keywords');
			Yii::app()->clientScript->registerMetaTag($object->description, 'description');
			//if (!strpos($_SERVER['REQUEST_URI'], '/other')) {
			//if (!$other) {
			$sess_data = Yii::app()->session->get($modelName.'search');
			if (empty($sess_data)) {
				$fromPage['speciality'] = key($object -> giveAllSpecialities());
				$fromPage['district']='';
				$fromPage['metro']=0;
			} else {
				$fromPage = $sess_data;
			}
			$similar = $object -> userSearch($fromPage,'rating', 4);
			
			$this->render($modelName.'View',array(
				'model' => $object,
				'pricelist' => $pricelist,
				'word' => $word,
				'similar' => $similar['objects'],
				'modelName' => $modelName
			));
			/*} else {
				//$this->layout='main';
				$this->render($modelName.'Other',array(
					'model' => $object,
					'add_comment' => new Comments(),
					'isNew' => true
				));
			}//*/
		} else {
			$this -> render('//site/error', array(
				'code' => '404',
				'message' => 'Не найден объект типа '.$modelName.' с адресом '. $verbiage.'.'
			));
		}
		//echo "in construct";
	}
	public function actionGenerateSId()
	{
		if(Yii::app()->request->isAjaxRequest) {
			echo TriggerValues::model() -> codeSearchId($_GET['data']);
		} else {
			echo "This page is only for ajax requests.";
		}
	}
	public function actionCheck()
	{
		$this -> render('//searchid/triggerForm', array(
			'id' => 'triggers'
		));
	}
	/**
	 * Saves an added comment.
	 */
	public function actionComment($modelName)
	{
		$model = new Comments;
		$object = $modelName::model() -> findByPk($_POST["object_id"]);
		
		$isNew = true;
		
		if(isset($_POST['Comments']))
		{
			
			$model->attributes=$_POST['Comments'];
			$model->user_first_name = trim($_POST['Comments']['user_first_name']);
			$model->object_id = $_POST['object_id'];
			$model->object_type = Objects::model() -> getNumber($modelName);
			
			//print_r($_POST);
			
			if($model->save()) {
				Yii::app()->user->setFlash('commentSuccessfull', CHtml::encode('Спасибо, Ваш комментарий будет добавлен после проверки администратором.'));
				//$this->redirect($this->createUrl('/'.$modelName.'/'. $_POST['verbiage'] .'/other'));
				$this -> redirect(Yii::app() -> baseUrl.'/'.$modelName.'/reviews/'.$object -> verbiage);
				$isNew = false;
			} else {
				$errors = $model->getErrors();
				$error_message = '';
				//$error_message = '<ul>';
				foreach ($errors as $error) {
					$error_message .= implode('<br/>', $error);
					//$error_message .= '<li>' . implode('<br/>', $error) . '</li>';
				}
				//$error_message .= '</ul>';

				Yii::app()->user->setFlash('commentFailed', CHtml::encode('Не удалось добавить комментарий') . '<br/>'.$error_message."<br/>");
			} 
			
			$this -> redirect(Yii::app() -> baseUrl.'/'.$modelName.'/reviews/'.$object -> verbiage);
			/*$this->layout='main';
			$this->render($modelName.'Other', array('model' => $object, 'add_comment' => $model, 'isNew' => $isNew));*/
		}
	}
	public function actionAssignCall() {
		$date=date("d.m.y"); // число.месяц.год 
		$time=date("H:i"); // часы:минуты:секунды 		
		$headers = "From: test@mail.ru\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html\r\n";
		$mail = "Дата: <strong>{$date}</strong><br/>";
		$mail .= "Время: <strong>{$time}</strong><br/>";
		$mail .= "Имя: <strong>{$_GET["name"]}</strong><br/>";
		$mail .= "Телефон: <strong>{$_GET["tel"]}</strong><br/>";
		 // Отправляем письмо админу  
		if (mail("shubinsa1@gmail.com", "Заказ на звонок с test.", $mail, $headers)) {
		//if (mail("nik_bondar@mail.ru", "Заказ на звонок с test.", $mail, $headers)) {
			echo "ok";
		} else {
			echo "bad";
		}
	}
	/**
	 * @arg string ip - ip address that is to be checked
	 */
	public function actionGeoInfo($ip = null){
		//echo "123";
		$geo = new Geo();
		echo $geo -> get_value('city');
	}
	/*public function actionPss() {
		echo md5('shubinsa7shubinsa'.'unique salt');
	}*/
	public function actionMetros(){
		list($shir, $dolg) = explode(', ','60.015377, 30.301594');
		giveMetroNamesArrayByAddress('Лиговский проспект, 4');
	}
}
?>