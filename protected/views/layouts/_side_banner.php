    <?php $side_banner = Options::model()->findByAttributes(array('name' => 'side_banner')); ?>
    <?php if ($side_banner->value != '') { ?>
        <div class="span2">
            <?php $side_banner_img = Yii::app()->baseUrl.'/images/banners/' . $side_banner->value;
                  echo CHtml::image($side_banner_img, $side_banner->value);?>          
        </div>
    <?php } ?>