<?php

class HomeController extends Controller
{
    public $layout='//layouts/main';
    public $defaultAction = 'index';
    public $pageTitle;

    protected $clinics, $districts, $metros, $triggers;

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

    public function init()
    { 
        parent::init();
        $this->clinics = clinics::model()->findAll(array('with' => 'services', 'order' => 'rating DESC'));
        $this->metros = Metro::model()->findAll();
        $this->districts = Districts::model()->findAll();
        $this->triggers = TriggerValues::model()->with('trigger')->findAll();
        
        return;
    }

    public function actionSearch()
    {
        // search among clinics
        $clinics = $this->clinics;
        $clinics_filtered = array();
        
        $filter = array();
        $metro_filter = array();
        $district_filter = array();

        //if (isset($_GET['SearchForm'])) {
		$sess_data = Yii::app()->session->get('search');
		//echo "sess:".$sess_data."<br/>";
		//print_r($sess_data);
        if ((isset($_GET['SearchForm']))||($sess_data)) {
            if (!isset($_GET["SearchForm"])) {
				$_GET["SearchForm"] = $sess_data;
				//print_r($sess_data);
				//echo "state";
			} else {
				//print_r($_GET["SearchForm"]);
				//echo "123";
				Yii::app()->session->add('search',$_GET["SearchForm"]);
				//$_SESSION['search'] = $_GET["SearchForm"];
			}
            if (isset($_GET['SearchForm']['speciality']))
                $filterForm = self::getClinicsBySpeciality($_GET['SearchForm']['speciality']);
            else
                $filterForm = null;    
                
            foreach ($_GET['SearchForm'] as $key => $option) {
                if ($key == 'speciality') {
                    $specialityId = TriggerValues::model()->findByAttributes(array('verbiage' => $option)); //print $specialityId->id; die();    
                    $filter[] = $specialityId->id; 
                } else {
                    if (trim($option) != "" and (!in_array($key, array('metro', 'district'))))
                        $filter[] = $option;
                }        
            }

            /* common filter fields */
            $metro_filter = $_GET['SearchForm']['metro'];
            $district_filter = $_GET['SearchForm']['district'];
            foreach ($clinics as $clinic) {

                $metros = ''; $districts = ''; $triggers = '';
                $metros_array = array_map('trim', explode(';', $clinic->metro_station));
                $districts_array = array_map('trim', explode(';', $clinic->district));
                $triggers_array = array_map('trim', explode(';', $clinic->triggers));
                
                if (empty($filter) && $metro_filter == '' && $district_filter == '') {
                    $clinics_filtered[] = $clinic;
                    continue;
                } 
                //    break;
                    
                /* metro filter */

                if ($metro_filter != '') {
                    if (!in_array($metro_filter, $metros_array))
                        continue;
                }

                /* district filter */
                if ($district_filter != '') {
                    if (!in_array($district_filter, $districts_array))
                        continue;
                }

                /* other filters */
                if (!empty($filter)) {
                    $common = array_intersect($filter, $triggers_array);
                    if (count($common) != count($filter))
                        continue;                           
                }

                /* metro stations */
                $criteria = new CDbCriteria();
                $criteria->addInCondition("id", $metros_array);
                $metros_array = Metro::model()->findAll($criteria);

                if (!empty($metros_array)) {
                    foreach ($metros_array as $metro)
                        $metros .= $metro->name . ', ';
                }
                $metros = substr($metros, 0, strrpos($metros, ','));

                /* districts */
                $criteria = new CDbCriteria();
                $criteria->addInCondition("id", $districts_array);
                $districts_array = Districts::model()->findAll($criteria);

                if (!empty($districts_array)) {
                    foreach ($districts_array as $district)
                        $districts .= $district->name . ', ';
                }
                $districts = substr($districts, 0, strrpos($districts, ','));

                /* triggers */
                $criteria = new CDbCriteria();
                $criteria->addInCondition("t.id", $triggers_array);
                $criteria->with = array('trigger');
                $criteria->limit = 5;
                $criteria->together = true;

                $triggers_array = TriggerValues::model()->findAll($criteria);

                if (!empty($triggers_array)) {
                    foreach ($triggers_array as $trigger)
                        $triggers .= $trigger->trigger->name . ':&nbsp;&nbsp; ' .  $trigger->value . '<br/> ';
                }

                $clinic->metros_display = $metros;
                $clinic->districts_display = $districts;
                $clinic->triggers_display = $triggers_array;
                $clinics_filtered[] = $clinic;
            }
//var_dump($clinics_filtered); die();
        } else {
            foreach ($clinics as $clinic) {
                $clinics_filtered[] = $clinic;
            }   
            $filterForm = null; 
        } 
        
        //var_dump($clinics_filtered); die();
        
        $dataProvider =  new CArrayDataProvider($clinics_filtered,
            array(  'keyField' =>'id',
                    'pagination' => array(
                    'pageSize' => 10,
                )));
       
//var_dump($dataProvider); die();
        $this->render('index_all', array(
            'clinics' => $dataProvider,
            'filterForm' => $filterForm
        ));
    }

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{

            $clinics = $this->clinics;

            if (isset($_GET['SearchForm']))
                unset($_GET['SearchForm']);
			//Yii::app() -> session -> destroy();
			Yii::app() -> session -> remove('search');
                
            $clinics_display = array();

            foreach ($clinics as $clinic) {

                $metros = ''; $districts = ''; $triggers = '';

                $metros_array = array_map('trim', explode(';', $clinic->metro_station));
                $districts_array = array_map('trim', explode(';', $clinic->district));
                $triggers_array = array_map('trim', explode(';', $clinic->triggers));

                /* metro stations */
                $criteria = new CDbCriteria();
                $criteria->addInCondition("id", $metros_array);
                $metros_array = Metro::model()->findAll($criteria);

                if (!empty($metros_array)) {
                    foreach ($metros_array as $metro)
                        $metros .= $metro->name . ', ';
                }
                $metros = substr($metros, 0, strrpos($metros, ','));

                /* districts */
                $criteria = new CDbCriteria();
                $criteria->addInCondition("id", $districts_array);
                $districts_array = Districts::model()->findAll($criteria);

                if (!empty($districts_array)) {
                    foreach ($districts_array as $district)
                        $districts .= $district->name . ', ';
                }
                $districts = substr($districts, 0, strrpos($districts, ','));

                /* triggers */
                $criteria = new CDbCriteria();
                $criteria->addInCondition("t.id", $triggers_array);
                $criteria->with = array('trigger');
                $criteria->limit = 5;
                $criteria->together = true;

                $triggers_array = TriggerValues::model()->findAll($criteria);

                if (!empty($triggers_array)) {
                    foreach ($triggers_array as $trigger)
                        $triggers .= $trigger->trigger->name . ':&nbsp;&nbsp; ' .  $trigger->value . '<br/> ';
                }

                $clinic->metros_display = $metros;
                $clinic->districts_display = $districts;
                $clinic->triggers_display = $triggers_array;

                $clinics_display[] = $clinic;

            }
       
            $dataProvider =  new CArrayDataProvider($clinics_display,
                array(  'keyField' =>'id',
                        'pagination' => array(
                        'pageSize' => 10,
                    )));

            $this->render('index_all', array(
                'clinics' => $dataProvider,
                'filterForm' => null
                
            ));
	}


	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
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
	/*
	* Displays a list of root articles.
	*/
	public function actionArticles()
	{
		$this->render('//articles/show_all', array(
			'articles' => Articles::GiveArticlesById(0, true)
		));
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
    /**
     * Displays a particular model.
     */
   public function actionviewArticle($verbiage, $hash = null)
    {
        $verbiage = explode("/",$verbiage);
		$article_array = Articles::model() -> giveArticleContent(trim(end($verbiage)));
        /*if (!$article) { // FIXME: create more deteiled detection of this is not just unexisting article, but exatcly a category title
            $category = Menus::model()->findByAttributes(array('verbiage' => trim($verbiage)));
            if ($category) {           
                //$articles = Articles::model()->findAllByAttributes(array('category' => $category->id)); //new Articles('search');        
                $dataProvider =  new CActiveDataProvider('Articles',
                    array(
                        'criteria' => array(
                            'condition' => "category = ".$category->id
                        ),
                        'pagination' => array(
                            'pageSize' => 10,
                        )));

                $this->render('articles_all', array(
                    'articles' => $dataProvider
                ));
                Yii::app()->end();
            }
        }*/
        //meta tags
        Yii::app()->clientScript->registerMetaTag($article_array['article']->keywords, 'keywords');
        Yii::app()->clientScript->registerMetaTag($article_array['article']->description, 'description');
        //Набор клиник для показа под статьей.
		//$this->clinics = clinics::model()->findAll(array('with' => 'services', 'order' => 'rating DESC'));
		$clinics = clinics::model() -> filterByTriggerValuesIdString(clinics::model() -> findAll(array('with' => 'services', 'order' => 'rating DESC')), $article_array['article']['trigger_value_id']);
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
        $this->render('//articles/view', array(
            'model' => $article_array['article'],
			'children' => $article_array['children'],
			'parentList' => $article_array['parents'],
			'clinic' => $clinic,
			'left' => $left,
			'right' => $right,
			'page' => $page
        ));
    }
	/*public function actionviewArticle($verbiage, $hash = null)
    {
        $article = Articles::model()->findByAttributes(array('verbiage' => trim($verbiage)));
        
        if (!$article) { // FIXME: create more deteiled detection of this is not just unexisting article, but exatcly a category title
            $category = Menus::model()->findByAttributes(array('verbiage' => trim($verbiage)));
            if ($category) {           
                //$articles = Articles::model()->findAllByAttributes(array('category' => $category->id)); //new Articles('search');        
                $dataProvider =  new CActiveDataProvider('Articles',
                    array(
                        'criteria' => array(
                            'condition' => "category = ".$category->id
                        ),
                        'pagination' => array(
                            'pageSize' => 10,
                        )));

                $this->render('articles_all', array(
                    'articles' => $dataProvider
                ));
                Yii::app()->end();
            }
        }
        //meta tags
        Yii::app()->clientScript->registerMetaTag($article->keywords, 'keywords');
        Yii::app()->clientScript->registerMetaTag($article->description, 'description');
                
        $this->render('//articles/view', array(
            'model'=>$article,
        ));
    }*/
    
    public function actionshowFilter($speciality = null)
    {
        if(Yii::app()->request->isAjaxRequest){
            $speciality = Yii::app()->request->getPost('speciality');
            
            echo self::getClinicsBySpeciality($speciality);
            
            //echo $filterForm;    
            Yii::app()->end();     
        }      
    }

    public static function getClinicsBySpeciality($speciality = null) {
        
            if ($speciality) {
                $filter = Filters::model()->with(array('speciality'=>array('condition' => 'verbiage = :verbiage', 'params' => array(':verbiage' => $speciality))))->find();

                $filterFields = array_map('trim', explode(';', $filter->fields));
                
                $triggers_obj = Triggers::model()->with('trigger_values')->findAll();
                $triggers = array();
                foreach ($triggers_obj as $trigger) {
                    if (in_array($trigger->id, $filterFields))
                        $triggers[$trigger->verbiage][$trigger->name] = $trigger->trigger_values;
                }
                
               if(Yii::app()->request->isAjaxRequest)
                   $filterForm = CJSON::encode($triggers); //$metros_array = array_map('trim', explode(';', $clinic->metro_station));
               else
                   $filterForm = $triggers;  
            } else 
               $filterForm = null;
                         
       return $filterForm; 
    }
}