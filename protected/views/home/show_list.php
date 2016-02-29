<?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl.'/css/select2.min.css'); ?>
<?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl.'/js/select2.min.js'); ?>
<?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl.'/js/map_select.js'); ?>
<?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl.'/js/part_select.js'); ?>
<?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl.'/css/map_select.css'); ?>
<?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl.'/css/part_select.css'); ?>
<?php //Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl.'/js/chosen.jquery.min.js'); ?>
<?php //Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl.'/css/chosen.min.css'); ?>
<?php
//print_r($_POST);
//$modelName = get_class(current($objects));
$modelName = 'clinics';
Yii::app()->getClientScript()->registerScriptFile("https://api-maps.yandex.ru/2.1/?lang=ru_RU");
Yii::app()->getClientScript()->registerScript("myScripts","
	$('#sortByPrice').click(function(){
		$('#sortby').val('price');
		$('#searchForm').submit();
	});
",CClientScript::POS_READY);
$mrt_ids = array('magnField','tomograf');
$mrt_ids = array_map(function ($id){
	return '#'.$id.'Select';
},$mrt_ids);
$mrt_sel = implode(', ',$mrt_ids);


$kt_ids = array('slices');
if (!empty($kt_ids)) {
	$kt_ids = array_map(function ($id){
		return '#'.$id.'Select';
	},$kt_ids);
	$kt_sel = implode(', ',$kt_ids);
}
Yii::app()->getClientScript()->registerScript("ready","
mrtHideFunc($('#mrt_button'));
function mrtHideFunc(button) {
	$('".$mrt_sel."').each(function(){
		
		if ((button.hasClass('on'))) {
			
			$(this).removeAttr('disabled');
			$(this).parent().parent().show();
		} else {
			$(this).attr('disabled','disabled');
			$(this).parent().parent().hide();
		}
		
	});
}
ktHideFunc($('#kt_button'));
function ktHideFunc(button) {
	$('".$kt_sel."').each(function(){
		
		if ((button.hasClass('on'))) {
			
			$(this).removeAttr('disabled');
			$(this).parent().parent().show();
		} else {
			$(this).attr('disabled','disabled');
			$(this).parent().parent().hide();
		}
		
	});
}
$('.top_form input').click(function () {
	$(this).toggleClass('on');
	var trig = $(this).attr('data-trigger');
	if ((trig == 'mrt')||(trig == 'kt')) {
		var val = $('#'+trig).val();
		$('#'+trig).val((val*1+1) % 2);
	}
	if ($(this).attr('data-trigger') == 'mrt') {
		mrtHideFunc($(this));
	} else if ($(this).attr('data-trigger') == 'kt') {
		ktHideFunc($(this));
	}
}
);

$('.zapis_na_priem').click(function(e) { e.preventDefault(); $('#exampleModal1').arcticmodal();});
",CClientScript::POS_READY);


Yii::app()->getClientScript()->registerScript("end","
//function Zapis (event) { event.preventDefault(); $('#exampleModal1').arcticmodal();}
var pager = $('#searchForm #page');
var maxPage = ".$maxPage.";
pager.val(2);
var loading = $('<img/>',{
	'id':'loading',
	'src':'".Yii::app() -> baseUrl."/img/loading.gif',
	'alt':'loading'
});
$('#show_rez').click(function(){
	$('.more_rezult').before(loading);
	$(this).hide();
	//alert(pager.val());
	$.ajax({
		url:'".Yii::app() -> baseUrl."/home/GiveMeMore?modelName=".$modelName."&page='+pager.val(),
	}).done(function(data){
		$('#loading').replaceWith(data);
		if (pager.val() < maxPage) {
			$('#show_rez').show();
		}
		pager.val(pager.val()*1 + 1);
	});
});
$('#big_button').click(function(e) {
	e.preventDefault();
	$('.bottom_search').slideToggle(1000);
});",CClientScript::POS_END);
$mrt = (strlen(($fromPage['МРТ'])) > 0 );
$kt = (strlen(($fromPage['КТ'])) > 0 );
?>

<div class="search2">
	<div class="in_searchh2">
		<form id="searchForm" method = "post" action="<?php echo Yii::app() -> baseUrl; ?>/clinics">
			<input id="sortby" type="hidden" value="<?php echo $_POST["sortBy"]; ?>" name="sortBy"/>
			<input id="mrt" type="hidden" value="<?php if ($mrt) echo "1"; else echo '0'; ?>" name="mrt"/>
			<input id="kt" type="hidden" value="<?php if ($kt) echo "1"; else echo '0'; ?>" name="kt"/>
			<input id="page" type="hidden" value="0" name="page"/>
			<input id="" type="hidden" value="1" name="<?php echo $modelName; ?>SearchForm[submitted]"/>
			<div class="top_search2">
				
					<ul class="top_form">
					<li>
						<input class="input_mrt<?php if ($mrt) echo " on"; ?>" type="button" data-trigger='mrt' id="mrt_button" value="МРТ">

					</li>
					<li class="span"><span class="text">и/или</span></li>
					<li><input class = '<?php if ($kt) echo " on"; ?>' type="button"  data-trigger='kt' id="kt_button" value="КТ"></li>
					<li>
						<!--<select id="Select" class="dropdown issl_type" id="issl_type" tabindex="9" data-settings='{"wrapperClass":"flat"}'>-->
						<div class="beautiful-select part_select">
							<span>Тип исследования</span>
							<?php
								$val = $_POST["clinicsSearchForm"]["research"] ? $_POST["clinicsSearchForm"]["research"] : $_POST["doctorsSearchForm"]["research"];
								if (!is_array($val)) {
									$val = array();
								}
							?>
							<div class="select_list">
								<div>
								<span class="part_clear">Очистить</span>
								<span class="part_close">Применить</span>
								<span class="part_close closeX">X</span>
								<div class="clear"></div>
								</div>
								<div class="select_group_cont">
									<h4>Голова</h4>
									<ul>
										<?php $v = 23; ?><li><input name="clinicsSearchForm[research][]" type="checkbox" value="<? echo $v; ?>" <?php echo (in_array($v,$val)) ? 'checked="checked"' : ''; ?>/><span><?php echo TriggerValues::model() -> findByPk($v) -> value; ?></span></li>
										<?php $v = 24; ?><li><input name="clinicsSearchForm[research][]" type="checkbox" value="<? echo $v; ?>" <?php echo (in_array($v,$val)) ? 'checked="checked"' : ''; ?>/><span><?php echo TriggerValues::model() -> findByPk($v) -> value; ?></span></li>
										<?php $v = 25; ?><li><input name="clinicsSearchForm[research][]" type="checkbox" value="<? echo $v; ?>" <?php echo (in_array($v,$val)) ? 'checked="checked"' : ''; ?>/><span><?php echo TriggerValues::model() -> findByPk($v) -> value; ?></span></li>
										<?php $v = 26; ?><li><input name="clinicsSearchForm[research][]" type="checkbox" value="<? echo $v; ?>" <?php echo (in_array($v,$val)) ? 'checked="checked"' : ''; ?>/><span><?php echo TriggerValues::model() -> findByPk($v) -> value; ?></span></li>
										<?php $v = 27; ?><li><input name="clinicsSearchForm[research][]" type="checkbox" value="<? echo $v; ?>" <?php echo (in_array($v,$val)) ? 'checked="checked"' : ''; ?>/><span><?php echo TriggerValues::model() -> findByPk($v) -> value; ?></span></li>
									</ul>
								</div>
								<div class="select_group_cont">
									<h4>Позвоночник</h4>
									<ul>
										<?php $v = 30; ?><li><input name="clinicsSearchForm[research][]" type="checkbox" value="<? echo $v; ?>" <?php echo (in_array($v,$val)) ? 'checked="checked"' : ''; ?>/><span><?php echo TriggerValues::model() -> findByPk($v) -> value; ?></span></li>
										<?php $v = 31; ?><li><input name="clinicsSearchForm[research][]" type="checkbox" value="<? echo $v; ?>" <?php echo (in_array($v,$val)) ? 'checked="checked"' : ''; ?>/><span><?php echo TriggerValues::model() -> findByPk($v) -> value; ?></span></li>
										<?php $v = 32; ?><li><input name="clinicsSearchForm[research][]" type="checkbox" value="<? echo $v; ?>" <?php echo (in_array($v,$val)) ? 'checked="checked"' : ''; ?>/><span><?php echo TriggerValues::model() -> findByPk($v) -> value; ?></span></li>
									</ul>
								</div>
								<div class="select_group_cont">
									<h4>Шея</h4>
									<ul>
										<?php $v = 28; ?><li><input name="clinicsSearchForm[research][]" type="checkbox" value="<? echo $v; ?>" <?php echo (in_array($v,$val)) ? 'checked="checked"' : ''; ?>/><span><?php echo TriggerValues::model() -> findByPk($v) -> value; ?></span></li>
										<?php $v = 29; ?><li><input name="clinicsSearchForm[research][]" type="checkbox" value="<? echo $v; ?>" <?php echo (in_array($v,$val)) ? 'checked="checked"' : ''; ?>/><span><?php echo TriggerValues::model() -> findByPk($v) -> value; ?></span></li>
									</ul>
								</div>
								
								<div class="select_group_cont">
									<h4>Грудная клетка</h4>
									<ul>
										<?php $v = 33; ?><li><input name="clinicsSearchForm[research][]" type="checkbox" value="<? echo $v; ?>" <?php echo (in_array($v,$val)) ? 'checked="checked"' : ''; ?>/><span><?php echo TriggerValues::model() -> findByPk($v) -> value; ?></span></li>
										<?php $v = 34; ?><li><input name="clinicsSearchForm[research][]" type="checkbox" value="<? echo $v; ?>" <?php echo (in_array($v,$val)) ? 'checked="checked"' : ''; ?>/><span><?php echo TriggerValues::model() -> findByPk($v) -> value; ?></span></li>
									</ul>
								</div>
								<div class="select_group_cont">
									<h4>Брюшная полость и малый таз</h4>
									<ul>
										<?php $v = 35; ?><li><input name="clinicsSearchForm[research][]" type="checkbox" value="<? echo $v; ?>" <?php echo (in_array($v,$val)) ? 'checked="checked"' : ''; ?>/><span><?php echo TriggerValues::model() -> findByPk($v) -> value; ?></span></li>
										<?php $v = 36; ?><li><input name="clinicsSearchForm[research][]" type="checkbox" value="<? echo $v; ?>" <?php echo (in_array($v,$val)) ? 'checked="checked"' : ''; ?>/><span><?php echo TriggerValues::model() -> findByPk($v) -> value; ?></span></li>
										<?php $v = 37; ?><li><input name="clinicsSearchForm[research][]" type="checkbox" value="<? echo $v; ?>" <?php echo (in_array($v,$val)) ? 'checked="checked"' : ''; ?>/><span><?php echo TriggerValues::model() -> findByPk($v) -> value; ?></span></li>
										<?php $v = 38; ?><li><input name="clinicsSearchForm[research][]" type="checkbox" value="<? echo $v; ?>" <?php echo (in_array($v,$val)) ? 'checked="checked"' : ''; ?>/><span><?php echo TriggerValues::model() -> findByPk($v) -> value; ?></span></li>
										<?php $v = 39; ?><li><input name="clinicsSearchForm[research][]" type="checkbox" value="<? echo $v; ?>" <?php echo (in_array($v,$val)) ? 'checked="checked"' : ''; ?>/><span><?php echo TriggerValues::model() -> findByPk($v) -> value; ?></span></li>
										<?php $v = 40; ?><li><input name="clinicsSearchForm[research][]" type="checkbox" value="<? echo $v; ?>" <?php echo (in_array($v,$val)) ? 'checked="checked"' : ''; ?>/><span><?php echo TriggerValues::model() -> findByPk($v) -> value; ?></span></li>
										<?php $v = 41; ?><li><input name="clinicsSearchForm[research][]" type="checkbox" value="<? echo $v; ?>" <?php echo (in_array($v,$val)) ? 'checked="checked"' : ''; ?>/><span><?php echo TriggerValues::model() -> findByPk($v) -> value; ?></span></li>
										<?php $v = 42; ?><li><input name="clinicsSearchForm[research][]" type="checkbox" value="<? echo $v; ?>" <?php echo (in_array($v,$val)) ? 'checked="checked"' : ''; ?>/><span><?php echo TriggerValues::model() -> findByPk($v) -> value; ?></span></li>
										<?php $v = 43; ?><li><input name="clinicsSearchForm[research][]" type="checkbox" value="<? echo $v; ?>" <?php echo (in_array($v,$val)) ? 'checked="checked"' : ''; ?>/><span><?php echo TriggerValues::model() -> findByPk($v) -> value; ?></span></li>
										<?php $v = 44; ?><li><input name="clinicsSearchForm[research][]" type="checkbox" value="<? echo $v; ?>" <?php echo (in_array($v,$val)) ? 'checked="checked"' : ''; ?>/><span><?php echo TriggerValues::model() -> findByPk($v) -> value; ?></span></li>
										<?php $v = 45; ?><li><input name="clinicsSearchForm[research][]" type="checkbox" value="<? echo $v; ?>" <?php echo (in_array($v,$val)) ? 'checked="checked"' : ''; ?>/><span><?php echo TriggerValues::model() -> findByPk($v) -> value; ?></span></li>
										<?php $v = 46; ?><li><input name="clinicsSearchForm[research][]" type="checkbox" value="<? echo $v; ?>" <?php echo (in_array($v,$val)) ? 'checked="checked"' : ''; ?>/><span><?php echo TriggerValues::model() -> findByPk($v) -> value; ?></span></li>
										<?php $v = 47; ?><li><input name="clinicsSearchForm[research][]" type="checkbox" value="<? echo $v; ?>" <?php echo (in_array($v,$val)) ? 'checked="checked"' : ''; ?>/><span><?php echo TriggerValues::model() -> findByPk($v) -> value; ?></span></li>
										<?php $v = 48; ?><li><input name="clinicsSearchForm[research][]" type="checkbox" value="<? echo $v; ?>" <?php echo (in_array($v,$val)) ? 'checked="checked"' : ''; ?>/><span><?php echo TriggerValues::model() -> findByPk($v) -> value; ?></span></li>
									</ul>
								</div>
								<div class="select_group_cont">
									<h4>Суставы</h4>
									<ul>
										<?php $v = 49; ?><li><input name="clinicsSearchForm[research][]" type="checkbox" value="<? echo $v; ?>" <?php echo (in_array($v,$val)) ? 'checked="checked"' : ''; ?>/><span><?php echo TriggerValues::model() -> findByPk($v) -> value; ?></span></li>
										<?php $v = 50; ?><li><input name="clinicsSearchForm[research][]" type="checkbox" value="<? echo $v; ?>" <?php echo (in_array($v,$val)) ? 'checked="checked"' : ''; ?>/><span><?php echo TriggerValues::model() -> findByPk($v) -> value; ?></span></li>
										<?php $v = 51; ?><li><input name="clinicsSearchForm[research][]" type="checkbox" value="<? echo $v; ?>" <?php echo (in_array($v,$val)) ? 'checked="checked"' : ''; ?>/><span><?php echo TriggerValues::model() -> findByPk($v) -> value; ?></span></li>
										<?php $v = 52; ?><li><input name="clinicsSearchForm[research][]" type="checkbox" value="<? echo $v; ?>" <?php echo (in_array($v,$val)) ? 'checked="checked"' : ''; ?>/><span><?php echo TriggerValues::model() -> findByPk($v) -> value; ?></span></li>
										<?php $v = 53; ?><li><input name="clinicsSearchForm[research][]" type="checkbox" value="<? echo $v; ?>" <?php echo (in_array($v,$val)) ? 'checked="checked"' : ''; ?>/><span><?php echo TriggerValues::model() -> findByPk($v) -> value; ?></span></li>
										<?php $v = 54; ?><li><input name="clinicsSearchForm[research][]" type="checkbox" value="<? echo $v; ?>" <?php echo (in_array($v,$val)) ? 'checked="checked"' : ''; ?>/><span><?php echo TriggerValues::model() -> findByPk($v) -> value; ?></span></li>
										<?php $v = 55; ?><li><input name="clinicsSearchForm[research][]" type="checkbox" value="<? echo $v; ?>" <?php echo (in_array($v,$val)) ? 'checked="checked"' : ''; ?>/><span><?php echo TriggerValues::model() -> findByPk($v) -> value; ?></span></li>
										<?php $v = 56; ?><li><input name="clinicsSearchForm[research][]" type="checkbox" value="<? echo $v; ?>" <?php echo (in_array($v,$val)) ? 'checked="checked"' : ''; ?>/><span><?php echo TriggerValues::model() -> findByPk($v) -> value; ?></span></li>
										<?php $v = 57; ?><li><input name="clinicsSearchForm[research][]" type="checkbox" value="<? echo $v; ?>" <?php echo (in_array($v,$val)) ? 'checked="checked"' : ''; ?>/><span><?php echo TriggerValues::model() -> findByPk($v) -> value; ?></span></li>
									</ul>
								</div>
								<div class="select_group_cont">
									<h4>Сосуды</h4>
									<ul>
										<?php $v = 27; ?><li><input name="clinicsSearchForm[research][]" type="checkbox" value="<? echo $v; ?>" <?php echo (in_array($v,$val)) ? 'checked="checked"' : ''; ?>/><span><?php echo TriggerValues::model() -> findByPk($v) -> value; ?></span></li>
										<?php $v = 28; ?><li><input name="clinicsSearchForm[research][]" type="checkbox" value="<? echo $v; ?>" <?php echo (in_array($v,$val)) ? 'checked="checked"' : ''; ?>/><span><?php echo TriggerValues::model() -> findByPk($v) -> value; ?></span></li>
										<?php $v = 59; ?><li><input name="clinicsSearchForm[research][]" type="checkbox" value="<? echo $v; ?>" <?php echo (in_array($v,$val)) ? 'checked="checked"' : ''; ?>/><span><?php echo TriggerValues::model() -> findByPk($v) -> value; ?></span></li>
										<?php $v = 60; ?><li><input name="clinicsSearchForm[research][]" type="checkbox" value="<? echo $v; ?>" <?php echo (in_array($v,$val)) ? 'checked="checked"' : ''; ?>/><span><?php echo TriggerValues::model() -> findByPk($v) -> value; ?></span></li>
										<?php $v = 61; ?><li><input name="clinicsSearchForm[research][]" type="checkbox" value="<? echo $v; ?>" <?php echo (in_array($v,$val)) ? 'checked="checked"' : ''; ?>/><span><?php echo TriggerValues::model() -> findByPk($v) -> value; ?></span></li>
										<?php $v = 62; ?><li><input name="clinicsSearchForm[research][]" type="checkbox" value="<? echo $v; ?>" <?php echo (in_array($v,$val)) ? 'checked="checked"' : ''; ?>/><span><?php echo TriggerValues::model() -> findByPk($v) -> value; ?></span></li>
									</ul>
								</div>
								<div class="select_group_cont">
									
								</div>
							</div>
						</div>
						<?php 
						/*$trig = Triggers::model() -> findByAttributes(array('verbiage' => 'research'));
						$research_values = $trig -> trigger_values; 
						if (!$research_values) {
							$research_values = array();
						}
						$val = $_POST["clinicsSearchForm"]["research"] ? $_POST["clinicsSearchForm"]["research"] : $_POST["doctorsSearchForm"]["research"];
						if (!$val) {$val = array();}
						echo CHtml::DropDownListChosen2('clinicsSearchForm[research]','search_research', CHtml::listData($research_values, 'id', 'value'),array('multiple'=>'multiple','size' => '','class' => 'js-example-placeholder-single'),$val,$select2Options='{placeholder:"Выберите тип исследования"}'); */
						?>
						
						<!--<select id="Select" class="dropdown issl_type" tabindex="9" data-settings='{"wrapperClass":"flat"}'>
							<?php $trig = Triggers::model() -> findByAttributes(array('verbiage' => 'research')); if ($trig) { $trig -> showValues(true); } ?>
						</select>-->
					</li>
					<li>
						<div class="metro-select">
							<span>Станция метро</span>
							
								<div class="b-metro-map region-653240">
									<span class="metro-clear">Очистить</span>
									<span class="metro-close">Применить</span>
									<span class="metro-close closeX">X</span>
									<?php //$metro_obj = Metro::model()->findAll(array('order' => 'name ASC')); ?>
						<?php //$val = $_POST["clinicsSearchForm"]["metro"] ? $_POST["clinicsSearchForm"]["metro"] : $_POST["doctorsSearchForm"]["metro"]; ?>
						<?php //if (!$val) {$val = array();} ?>
									<?php
										$metro_obj = Metro::model()->findAll();
										$val = $_POST["clinicsSearchForm"]["metro"] ? $_POST["clinicsSearchForm"]["metro"] : $_POST["doctorsSearchForm"]["metro"];
										if (!is_array($val)) {
											$val = array();
										}
										foreach($metro_obj as $metro) {
											$checked = in_array($metro -> id, $val) ? ' checked = "checked" ' : '';
											$related = $metro -> data_related ? ' data-related="'.$metro -> data_related.'" ' : '';
											echo "<i class='st'><input type='checkbox' name='clinicsSearchForm[metro][]' {$checked} {$related} id='rf_metro_{$metro -> map_id}' value='{$metro -> id}'>{$metro -> name}<i class='mark'></i><i class='name'></i></i>";
										}
									?>
								</div>
							
						</div>
											
						<?php //$metro_obj = Metro::model()->findAll(array('order' => 'name ASC')); ?>
						<?php //$val = $_POST["clinicsSearchForm"]["metro"] ? $_POST["clinicsSearchForm"]["metro"] : $_POST["doctorsSearchForm"]["metro"]; ?>
						<?php //if (!$val) {$val = array();} ?>
						<?php //echo CHtml::DropDownListChosen2('clinicsSearchForm[metro]','search_metro', CHtml::listData($metro_obj, 'id', 'name'),array('multiple'=>'multiple','size' => '','class'=>'js-example-placeholder-single'),$val,$select2Options='{placeholder:"Выберите метро"}'); ?>
					</li>
					<!--<li>
						<select class="dropdown" tabindex="9" data-settings='{"wrapperClass":"flat"}'>
						
							<option value=''>Выберите метро</option>
							<?php
								$metros = Metro::model()->findAll(array('order' => 'name ASC'));
								foreach ($metros as $obj) {
									echo "<option value='{$obj -> id}'>";
									echo $obj -> name;
									echo "</option>";
								}
							?>
						</select>
					</li>-->
					<li class="reset">
						<button type="submit">Найти</button>
					</li>
					</ul>

					<?php
							//print_r($_POST);
							//$metros= CHtml::listData(Metro::model()->findAll(array('order' => 'name ASC')), 'id', 'name');
							//echo CHtml::activeDropDownList(Metro::model(),'id',$metros, array('name'=>$modelName.'searchForm[metro]','multiple' => 'multiple'));
						?>
				
			</div>
			<div class="clear"></div>
			<div class="big_search">
				<button id="big_button">Дополнительные параметры</button>
			</div>
			<div class="bottom_search">
				<div class="left_bottom_search">
					<ul style="text-align:left;">
						
						<li class="left_second">
							<?php Triggers::model() -> findByAttributes(array('verbiage' => 'weight')) -> showBinary($_POST[$modelName."SearchForm"]); ?>
						</li>
						<li class="left_second">
							<?php Triggers::model() -> findByAttributes(array('verbiage' => 'kids')) -> showBinary($_POST[$modelName."SearchForm"]); ?>
						</li>
						<li class="left_second">
							<?php Triggers::model() -> findByAttributes(array('verbiage' => 'time')) -> showBinary($_POST[$modelName."SearchForm"]); ?>
						</li>
						<!--<li class="left_second"> <select id="weightSelect" class="dropdown" name="clinicsSearchForm[weight]" tabindex="9" data-settings='{"wrapperClass":"flat"}'>
							<?php //Triggers::model() -> findByAttributes(array('verbiage' => 'weight')) -> showValues(true); ?>
						</select></li>-->
						<!--<li class="left_second second_select"> <select id="materialSelect" class="dropdown" name="clinicsSearchForm[material]" tabindex="9" data-settings='{"wrapperClass":"flat"}'>
							<?php //Triggers::model() -> findByAttributes(array('verbiage' => 'material')) -> showValues(true); ?>
						</select></li>
						
						<li class="left_second"> <select id="slicesSelect" class="dropdown" name="clinicsSearchForm[slices]" tabindex="9" data-settings='{"wrapperClass":"flat"}'>
							<?php //Triggers::model() -> findByAttributes(array('verbiage' => 'slices')) -> showValues(true); ?>
						</select></li>-->
					</ul>
				</div>
				<div class="right_bottom_search">
					<ul>
						<li class="left_second"><select id="magnFieldSelect" class="dropdown" name="clinicsSearchForm[field]" tabindex="9" data-settings='{"wrapperClass":"flat"}'>
							<?php Triggers::model() -> findByAttributes(array('verbiage' => 'field')) -> showValues(true, 'clinicsSearchForm', $_POST["clinicsSearchForm"]["field"]); ?>
						</select></li>
						<li class="left_second"> <select id="tomografSelect" class="dropdown" name="clinicsSearchForm[magnet]" tabindex="10" data-settings='{"wrapperClass":"flat"}'>
							<?php Triggers::model() -> findByAttributes(array('verbiage' => 'magnet')) -> showValues(true, 'clinicsSearchForm', $_POST["clinicsSearchForm"]["magnet"]); ?>
						</select></li>
						<li class="left_second"> <select id="slicesSelect" class="dropdown" name="clinicsSearchForm[slices]" tabindex="11" data-settings='{"wrapperClass":"flat"}'>
							<?php Triggers::model() -> findByAttributes(array('verbiage' => 'slices')) -> showValues(true, 'clinicsSearchForm', $_POST["clinicsSearchForm"]["slices"]); ?>
						</select></li>
						<!--<li class="left_second"><select id="childSelect" class="dropdown" name="clinicsSearchForm[child]" tabindex="9" data-settings='{"wrapperClass":"flat"}'>
							<?php //Triggers::model() -> findByAttributes(array('verbiage' => 'child')) -> showValues(true); ?>
						</select></li>
						<li class="left_second"><select id="timeSelect" class="dropdown" name="clinicsSearchForm[time]" tabindex="9" data-settings='{"wrapperClass":"flat"}'>
							<?php //Triggers::model() -> findByAttributes(array('verbiage' => 'time')) -> showValues(true); ?>
						</select></li>
						<li class="left_second">
							<button class="second_submit" type="submit">найти</button>
						</li>-->
					</ul>
				</div>
			</div>
		</form>
	</div>
</div>
<div class="main_content">
	<div class="in_main_content">
		<div class="in_main_content_left">
			<div class="zagolovok">
				<h1>ВСЕ КЛИНИКИ</h1>
				<form>
					<input type="button" id="sortByPrice" value="Сортировать по цене" style="cursor:pointer;">
				</form>
			</div>
			<div class="clear"></div>
			<?php foreach($objects as $obj) {
				$this -> renderPartial('//home/_single_'.$modelName, array('model' => $obj));
			} ?>
			<?php if ($maxPage > 1) : ?>
			<div class="more_rezult">
				<button id = "show_rez">Больше результатов</button>
			</div>
			<?php endif; ?>
		</div>

		<?php $this -> renderPartial('//layouts/right_column', true,false); ?>
	</div>
</div>
