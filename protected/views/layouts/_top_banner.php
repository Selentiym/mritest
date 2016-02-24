    <?php 
        $top_banner = Options::model()->findByAttributes(array('name' => 'top_banner'));
    ?>   
   
    <div class="page-header">
       <!-- <div class="row-fluid top-banner" style="background: url('<?php echo Yii::app()->baseUrl; ?>/images/banners/<?php echo $top_banner->value; ?>');"> 
        </div> -->
        <div>
            <?php $top_banner_img = Yii::app()->baseUrl.'/images/banners/' . $top_banner->value;
                echo CHtml::image($top_banner_img, $top_banner->value, array('style' => 'width: 100%; max-width: 100%; max-height: 300px;'));?>   
        </div>
    </div>
