<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title><?php echo $this -> pageTitle; ?></title>
	
	<?php $cs = Yii::app()->getClientScript(); ?>
	<?php $cs -> registerCoreScript('jquery'); ?>
	<?php $cs -> registerCssFile(Yii::app()->baseUrl.'/css/style.css'); ?>
    <!--<link rel="stylesheet" href="css/style.css">-->


    <!--<script src="js/jquery-1.11.2.min.js"></script>-->
	<?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl.'/js/jquery.easydropdown.js'); ?>
    <!--<script src="js/jquery.easydropdown.js"></script>-->
	<?php $cs -> registerCssFile(Yii::app()->baseUrl.'/css/demo.css'); ?>
    <!--<link rel="stylesheet" type="text/css" href="css/demo.css"/>-->
    <!-- ArcticModal-->
	<?php $cs -> registerCssFile(Yii::app()->baseUrl.'/css/styles2.css'); ?>
    <!--<link rel="stylesheet" href="css/styles2.css">-->
    <!-- jQuery -->
	<?php $cs -> registerCssFile(Yii::app()->baseUrl.'/css/style.css'); ?>
    <!--<link rel="stylesheet" href="css/style.css">-->
	<?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl.'/js/jquery.arcticmodal-0.2.min.js'); ?>
    <!--<script src="js/jquery.arcticmodal-0.2.min.js"></script>-->
    <?php $cs -> registerCssFile(Yii::app()->baseUrl.'/css/jquery.arcticmodal-0.2.css'); ?>
	<!--<link rel="stylesheet" href="css/jquery.arcticmodal-0.2.css">-->
    <!-- END ArcticModal-->
	<?php $cs -> registerScript("assign_call","
		$('.assign_submit').click(function(event){
			event.preventDefault();
			var form = $(this).parent();
			$.ajax({
				url:'".Yii::app() -> baseUrl."/assignCall',
				data:{
					'tel':form.children('.input_men').children('.input_men_in').val(),
					'name':form.children('.input_phone').children('.input_phone_in').val()
				}
			}).done(function(reply){
				$('.arcticmodal-close').click();
				if (reply=='ok') {
					alert('Ваша заявка принята!');
				} else {
					alert('Возникла ошибка, попробуйте еще раз.');
				}
			});
		});
	",CClientScript::POS_READY); ?>
	<link rel="icon" href="http://mritest.ru/favicon.ico" type="image/x-icon">
	<link rel="shortcut icon" href="http://mritest.ru/favicon.ico" type="image/x-icon">
	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
		
		ga('create', 'UA-71549996-1', 'auto');
		ga('send', 'pageview');

	</script>
	<!-- Yandex.Metrika counter -->
	<script type="text/javascript">
	(function (d, w, c) {
		(w[c] = w[c] || []).push(function() {
			try {
				w.yaCounter34319460 = new Ya.Metrika({id:34319460,
						webvisor:true,
						clickmap:true,
						trackLinks:true,
						accurateTrackBounce:true});
			} catch(e) { }
		});

		var n = d.getElementsByTagName("script")[0],
			s = d.createElement("script"),
			f = function () { n.parentNode.insertBefore(s, n); };
		s.type = "text/javascript";
		s.async = true;
		s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

		if (w.opera == "[object Opera]") {
			d.addEventListener("DOMContentLoaded", f, false);
		} else { f(); }
	})(document, window, "yandex_metrika_callbacks");
	</script>
	<noscript><div><img src="//mc.yandex.ru/watch/34319460" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
	<style>
		.info div{
			cursor:pointer;
		}
		.info div h3 {
			margin:0px auto;
			padding:5px 0 0 0;
		}
	</style>
	<!-- /Yandex.Metrika counter -->
</head>
<body>
    <div class="wrapper">
        <div class="l-container">
            <ul>

                <li>

                    <div class="g-hidden">
                        <div class="box-modal" id="exampleModal1">
                            <div class="box-modal_close arcticmodal-close">x</div>
                            <div class="zakazat_zv"></div>
                            <div class="form">

                                <form method="POST">

                                    <div class="input_phone"><input class="input_phone_in" type="text" name="name" required placeholder="Ваше ФИО"></div><span ></span><br>
                                    <div class="input_men"><input class="input_men_in" type="text" name="name2" required placeholder="Ваш телефон"></div><br>
                                    <button type="button" class="submit assign_submit">Заказать звонок</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </li>

            </ul>
        </div>
        <div class="topMenu">
            <div class="logo">
                <a href="<?php echo Yii::app() -> baseUrl.'/'; ?>">
                    <img src="<?php echo Yii::app() -> baseUrl.'/'; ?>img/logo.png" alt="Клиника">
                </a>
                <h1>МРТ ЭНЦИКЛОПЕДИЯ</h1>
                <p>ИНФОРМАЦИОННЫЙ ПОРТАЛ
                    МЕДИЦИНСКИХ УСЛУГ</p>
            </div>
            <ul class="menu">
                <li class="glavnay">
                    <a href="<?php echo Yii::app() -> baseUrl.'/'; ?>" >Главная</a>
                </li>
                <li class="library">
                    <a href="<?php echo Yii::app() -> baseUrl.'/article'; ?>">Библиотека</a>
                </li>
                <li class="zakaz">
                    <a href="#" id="#example1" onclick="$('#exampleModal1').arcticmodal()">Заказать звонок</a>
                </li>
            </ul>
        </div>
        <div class="clear"></div>
        <div class="info">
            <div>
                <h3>КАТАЛОГ</h3>
                <p>Врачи, Клиники, Диагностические центры – поиск по параметрам
                </p>
            </div>
            <div>
                <h3>РЕЙТИНГ</h3>
                <p>Медицинские центры, отсортированные по рейтингу на основе отзывов лечащих врачей и пациентов
                </p>
            </div>
            <div>
                <h3>АКЦИИ И СКИДКИ</h3>
                <p>Информация о действующих Акциях и Скидках в некоторых Клиниках и Диагностических центрах</p>
            </div>
            <div onClick="location.href='<?php echo Yii::app() -> baseUrl;?>/about'">
                <h3>О НАС</h3>
                <p>
                </p>
            </div>
            <div onclick="$('#exampleModal1').arcticmodal()">
                <h3>МРТ И КТ</h3>
                <p style="font-size:10px;">Для получения консультации специалиста по вопросам МРТ и КТ диагностики оставьте свой номер телефона и ФИО и Вам перезвонят.</p>
            </div>
        </div>
        <div class="clear"></div>

        <div class="main_content">
            <?php echo $content; ?>
        </div>
        <div class="clear"></div>
        <div class="bottom_menu">
            <ul>
                <li><a href="#">Каталог</a></li>
                <li><a href="#">Рейтинг</a></li>
                <li><a href="#">Акции и скидки</a></li>
                <li><a href="#">О нас</a></li>
                <li><a href="#">Мрт и КТ</a></li>
            </ul>
        </div>
    </div>


</body>
</html>