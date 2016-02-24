<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

	<meta name="language" content="en" />

    <!-- custom CSS -->
    <?php Yii::app()->bootstrap->register(); ?>
    <?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl.'/css/styles.css'); ?>
    <?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl.'/css/clinics.css'); ?>
    <?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl.'/css/jquery-ui.css'); ?>

    <?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl.'/js/functions.js'); ?>
    <?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl.'/js/common.js'); ?>
    <?php Yii::app()->getClientScript()->registerCoreScript('jquery.ui'); ?>

    <title><?php echo $this->pageTitle; ?></title>
</head>

<body>

    <?php Yii::app()->controller->renderPartial('//layouts/_top_banner'); ?>

    <?php Yii::app()->controller->renderPartial('/home/_top_menu'); ?>

    <div id="container" class="container-fluid">
        <?php echo $content; ?>

        <?php Yii::app()->controller->renderPartial('//layouts/_footer'); ?>

    </div> <!-- container -->
        
</body>
</html>
