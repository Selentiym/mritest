<?php

class ClinicsController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/clinic';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
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
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('*'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
   
    private function getClinicModel($verbiage, $id = NULL) {

        if ($id)
            $condition = array('id' => $id);
        else
            $condition = array('verbiage' => $verbiage);

        $clinic = clinics::model()->with(array('services', 'comments:approved'))->findByAttributes($condition);

        /* extended information*/
        $metros = ''; $districts = ''; $triggers = '';

        $metros_array = explode(';', $clinic->metro_station);
        $districts_array = explode(';', $clinic->district);
        $triggers_array = explode(';', $clinic->triggers);

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
        $criteria->together = true;

        $triggers_array = TriggerValues::model()->findAll($criteria);

        if (!empty($triggers_array)) {
            foreach ($triggers_array as $trigger) //var_dump($trigger->trigger->name); die();
                $triggers .= $trigger->trigger->name . ':&nbsp;&nbsp; ' .  $trigger->value . '<br/> ';
        }

        $clinic->metros_display = $metros;
        $clinic->districts_display = $districts;
        $clinic->triggers_display = $triggers_array;

        return $clinic;
    }


	public function actionView($verbiage)
	{      
        $clinic = $this->getClinicModel($verbiage);
        $pricelist = PriceList::model()->findAll(array('condition' => 'clinic_id = ' . $clinic->id));

        // meta tags
        Yii::app()->clientScript->registerMetaTag($clinic->keywords, 'keywords');
        Yii::app()->clientScript->registerMetaTag($clinic->description, 'description');

        if (!strpos($_SERVER['REQUEST_URI'], '/other')) {
            $this->render('view',array(
                'model' => $clinic,
                'pricelist' => $pricelist
            ));
        } else {
            $this->layout='main';
            $this->render('other',array(
                'model' => $clinic,
                'add_comment' => new Comments(),
                'isNew' => true
            ));
        }
	}

    public function actionOther($verbiage)
    {   
        $clinic = $this->getClinicModel($verbiage);
        $this->render('other',array(
            'model' => $clinic,
			'verb' => $verbiage
        ));
    }

    public function actionComment()
    {
        $model = new Comments;
        $clinic = $clinic = $this->getClinicModel($_POST['verbiage']);
        
        if(isset($_POST['Comments']))
        {
            
            $model->attributes=$_POST['Comments'];
            $model->user_first_name = trim($_POST['Comments']['user_first_name']);
            $model->user_last_name = trim($_POST['Comments']['user_last_name']);
            $model->clinic_id = $_POST['clinic_id'];

            if($model->save()) {
                Yii::app()->user->setFlash('commentSuccessfull', CHtml::encode('Спасибо, Ваш комментарий будет добавлен после проверки администратором.'));
                $this->redirect($this->createUrl('/clinics/'. $_POST['verbiage'] .'/other'));
            } else {
                $errors = $model->getErrors();
                $error_message = '<ul>';
                foreach ($errors as $error) {
                    $error_message .= '<li>' . implode('<br/>', $error) . '</li>';
                }
                $error_message .= '</ul>';

                Yii::app()->user->setFlash('commentFailed', CHtml::encode('Не удалось добавить комментарий') . '<br/>');
            } 
            
            $this->layout='main';
            $this->render('other', array('model' => $clinic, 'add_comment' => $model, 'isNew' => false));
        }

    }

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['clinics']))
		{
			$model->attributes=$_POST['clinics'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex($id)
	{
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new clinics('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['clinics']))
			$model->attributes=$_GET['clinics'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return clinics the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=clinics::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param clinics $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='clinics-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
