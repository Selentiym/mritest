<?
class ElfinderController extends CController
{
    public function actions()
    {
        return array(
            'connector' => array(
                'class' => 'application.extensions.elfinder.ElFinderConnectorAction',
                'settings' => array(
                    //'root' => Yii::getPathOfAlias('webroot') . '/uploads/',
                    'root' => '/files/uploads/',
                    'URL' => Yii::app()->baseUrl . '/files/uploads/',
                    'rootAlias' => 'Home',
                    'mimeDetect' => 'none'
                )
            ),
        );
    }
}
?>