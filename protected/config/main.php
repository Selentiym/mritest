<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
Yii::setPathOfAlias('bootstrap', dirname(__FILE__).'/../extensions/bootstrap');
$webroot = dirname(__FILE__).DIRECTORY_SEPARATOR.'..';

require_once( dirname(__FILE__) . '/../components/Helpers.php');

return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Gosclinica.ru',
	'language'=>'ru',
	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.components.CHtml',
		'application.models.*',
		'application.components.*',
		'application.extensions.EchMultiSelect.*',
		'application.extensions.geo.*'
		//'application.modules.user.models.*',
		//'application.modules.user.components.*',
        //'application.modules.message.models.*',
        //'application.modules.message.components.*',
        //'application.extensions.solr.*',
    ),

	'modules'=>array(
        /*
		'user'=>array(
			'hash' => 'md5',
			'sendActivationMail' => false,
			'loginNotActiv' => false,
			'activeAfterRegister' => true,
			'autoLogin' => false,
			'registrationUrl' => array('/user/registration'),
			'recoveryUrl' => array('/user/recovery'),
			'loginUrl' => array('/user/login'),
			'returnUrl' => array('/home/index'),
			'returnLogoutUrl' => array('/user/login'),
            'defaultController' => 'User',
			),
        */
        'message' => array(
            'userModel' => 'User',
            'getNameMethod' => 'getFullName',
            'getSuggestMethod' => 'getSuggest',
        ),
		// uncomment the following to enable the Gii tool

		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'111',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),

        'comments'=>array(
            //you may override default config for all connecting models
            'defaultModelConfig' => array(
                //only registered users can post comments
                'registeredOnly' => false,
                'useCaptcha' => false,
                //allow comment tree
                'allowSubcommenting' => true,
                //display comments after moderation
                'premoderate' => false,
                //action for postig comment
                'postCommentAction' => 'comments/comment/postComment',
                //super user condition(display comment list in admin view and automoderate comments)
                'isSuperuser'=>'Yii::app()->user->checkAccess("moderate")',
                //order direction for comments
                'orderComments'=>'DESC',
            ),
            //the models for commenting
            'commentableModels'=>array(
                //model with individual settings
                'Citys'=>array(
                    'registeredOnly'=>true,
                    'useCaptcha'=>true,
                    'allowSubcommenting'=>false,
                    //config for create link to view model page(page with comments)
                    'pageUrl'=>array(
                        'route'=>'admin/citys/view',
                        'data'=>array('id'=>'city_id'),
                    ),
                ),
                //model with default settings
                'ImpressionSet',
            ),
            //config for user models, which is used in application
            'userConfig'=>array(
                'class'=>'User',
                'nameProperty'=>'username',
                'emailProperty'=>'email',
            ),
        ),
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>false,
            'loginUrl'=>array('admin/login'),
			'class' => 'CWebUser',
		),
		// uncomment the following to enable URLs in path-format

		'urlManager'=>array(
			'urlFormat'=>'path',
		    'showScriptName'=>false,
			'useStrictParsing' => false,
			'rules'=>array(
				'admin' => 'admin/index',
                'admin/<modelName:(clinics|doctors)>' => 'admin/Models',
                'admin/<modelName:(clinics|doctors)>Filters' => 'admin/Filters',
                'admin/<modelName:(clinics|doctors)>FilterCreate' => 'admin/FilterCreate',
                'admin/<modelName:(clinics|doctors)>Create' => 'admin/ObjectCreate',
				'admin/<modelName:(clinics|doctors)>ExportCsv' => 'admin/ExportCsv',
				'admin/<modelName:(clinics|doctors)>ImportCsv' => 'admin/ImportCsv',
                'admin/<modelName:(clinics|doctors)>FieldsGlobal' => 'admin/FieldsGlobal',
                'admin/<modelName:(clinics|doctors)>FieldCreateGlobal' => 'admin/FieldCreateGlobal',
                'admin/<modelName:(clinics|doctors)>FieldUpdateGlobal/<id:\d+>' => 'admin/FieldUpdateGlobal',
                'admin/<modelName:(clinics|doctors)>Delete/<id:\d+>' => 'admin/ObjectDelete',
				'<modelName:(clinics|doctors)>/comment' => 'home/Comment',
				//'<modelName:(clinics|doctors)>/<verbiage:[\w_\/-]+>/(o|O)ther' => 'home/ViewModelOther',
				//'<modelName:(clinics|doctors)>/<verbiage:[\w_\/-]+>' => 'home/ViewModel',
                
                'article/<verbiage:[\w_\/-]+>' => 'home/viewArticle',
				//'article/<trash:[\w_\/%2F]+>%2F<verbiage:[a-zA-Z\-_]+>' => 'home/viewArticle',
				'article/' => 'home/articles',
                'comments/<id:\d+>' => 'comments/index',
				'<modelName:(clinics|doctors)>' => 'home/ViewModelList',
				'<modelName:(clinics|doctors)>/<word:(main|info|prices|reviews)>/<verbiage:[\w_\/-]*>' => 'home/ViewModel',
				'<modelName:(clinics|doctors)>/<verbiage:[\w_\/-]*>' => 'home/ViewModel',
				'regCall/' => 'home/regCall',
                'search' => 'home/search',
                '' => 'home',
                '<action:\w+>' => 'home/<action>',
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),

		/*'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
			'tablePrefix' => 'tbl_',
            'charset' => 'cp-1251',
		),*/
		// uncomment the following to use a MySQL database
		/*
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=testdrive',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
		),
		*/
        'db'=>array(
            'connectionString' => 'mysql:host=localhost;dbname=cq97848_clinics',
            'tablePrefix' => 'tbl_',
            'emulatePrepare' => true,
            'username' => 'cq97848_clinics',
            'password' => 'kicker1995',
            'charset' => 'utf8',
        ),
		/*'db'=>array(
            'connectionString' => 'mysql:host=localhost;dbname=clinics',
            'tablePrefix' => 'tbl_',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ),*/
		/*'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),*/
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
			),
		),
        'bootstrap'=>array(
            'class'=>'bootstrap.components.Bootstrap'
        ),
		'session' => array(
			'cookieMode' => 'allow',
			'timeout' => 300
		),
		/*'session' => array (
			'sessionName' => 'Site Session',
			'class'=> 'CHttpSession',
			'autoCreateSessionTable '=> true,
			//'connectionID' => 'db',
			//'sessionTableName' => 'Sessions',
			//'useTransparentSessionID'   =>($_POST['PHPSESSID']) ? true : false,
			'autoStart' => 'true',
			//'cookieMode' => 'only',
			'timeout' => 300
		)*/
        /*
        'clientScript' => array(
            'defaultScriptPosition' => CClientScript::POS_END,
            'defaultScriptFilePosition' => CClientScript::POS_END,
            'coreScriptPosition' => CClientScript::POS_HEAD,
        ),
        */
	),
	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'admin@tinkasworkshop.com',
        'paths' => array(
                'data'=> Yii::app()->basePath.'/files/',
        ),

	),
    /*
    'behaviors' => array(
        'onBeginRequest' => array(
            'class' => 'application.components.RequireLogin'
        )
    ),
    */
);