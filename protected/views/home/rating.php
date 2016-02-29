<?php
    /**
     * Created by PhpStorm.
     * User: user
     * Date: 29.02.2016
     * Time: 19:56
     */

Yii::app()->getClientScript()->registerScript("ready","
$('.zapis_na_priem').click(function(e) { e.preventDefault(); $('#exampleModal1').arcticmodal();});
",CClientScript::POS_READY);
?>
<div class="main_content">
	<div class="in_main_content">
		<div class="in_main_content_left">
			<div class="zagolovok">
				<h1>Самые популярные клиники</h1>
				<!--<form>
					<input type="button" id="sortByPrice" value="Сортировать по цене" style="cursor:pointer;">
				</form>-->
			</div>
			<div class="clear"></div>
			<?php
            /**
             * Obtain ten most popular clinics
             */
            $criteria = new CDbCriteria();
            $criteria -> order = 'rating DESC';
            $criteria -> limit = 10;
            $objects = clinics::model() -> findAll($criteria);
            $modelName = 'clinics';
            foreach($objects as $obj) {
                $this -> renderPartial('//home/_single_'.$modelName, array('model' => $obj));
            }
            ?>
            <?php if ($maxPage > 1) : ?>
                <div class="more_rezult">
                    <button id = "show_rez">Больше результатов</button>
                </div>
            <?php endif; ?>
            </div>

            <?php $this -> renderPartial('//layouts/right_column', true,false); ?>
        </div>
    </div>