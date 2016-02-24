-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Май 23 2015 г., 17:23
-- Версия сервера: 5.5.25
-- Версия PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `cr72344_clinics`
--

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_answers`
--

CREATE TABLE IF NOT EXISTS `tbl_answers` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `q_id` bigint(20) NOT NULL,
  `text` text COLLATE utf8_unicode_ci NOT NULL,
  `author_id` bigint(20) NOT NULL COMMENT '-1 for anonymus user',
  `helpful` int(32) DEFAULT '0',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=32 ;

--
-- Дамп данных таблицы `tbl_answers`
--

INSERT INTO `tbl_answers` (`id`, `q_id`, `text`, `author_id`, `helpful`, `create_at`) VALUES
(1, 3, 'here''s my answer to the third question', 1, 0, '2014-01-25 11:51:00'),
(2, 3, 'the second answer', 2, 1, '2014-01-21 11:51:16'),
(3, 2, 'to the 2!', 3, 0, '2014-01-21 11:51:16'),
(4, 3, 'the last', 3, 1, '2014-01-24 11:58:16'),
(5, 2, 'the last 2', 3, 0, '2014-01-24 15:51:16'),
(6, 3, 'the very new', 3, 2, '2014-01-14 13:58:16'),
(8, 5, 'something new as an answer', 5, 0, '2014-01-16 14:06:52'),
(10, 5, 'everybody wants something', 2, 0, '2014-01-16 14:33:10'),
(11, 15, 'Mads Mikkelsen kunne godt vinde sin anden pris i Cannes i træk for sit skuespil i ’Michael Kohlhaas’, men det er nok Michael Douglas’ flamboyante Liberace i ’Behind the Candelabra’, der er favorit til den pris. I morgen uddeles priserne på den sydfranske filmfestival', 2, 1, '2014-01-16 19:07:16'),
(12, 10, 'new answer on a private question', 19, 3, '2014-01-27 09:26:55'),
(13, 23, 'LETS SEE IF IT WORKS', 2, 1, '2014-01-29 02:21:03'),
(14, 3, 'THIS LOOKS LIKE IT WORKS', 2, 1, '2014-01-29 02:23:19'),
(15, 2, 'hhh', 2, 0, '2014-02-08 04:48:10'),
(16, 3, 'my new answer specially for Mandy', 2, 0, '2014-02-08 10:58:37'),
(17, 3, 'my new answer specially for Mandy', 2, 0, '2014-02-08 11:59:12'),
(18, 15, 'new answer about Mads', 2, 0, '2014-02-11 07:01:07'),
(24, 65, 'yummy', 2, 0, '2014-02-24 10:50:59'),
(26, 65, 'lalala', 2, 0, '2014-02-24 11:00:38'),
(27, 65, 'new test', 2, 0, '2014-02-24 11:01:08'),
(28, 65, 'once again', 2, 0, '2014-02-24 11:12:00'),
(29, 66, 'test answer to test question #66', 2, 0, '2014-02-24 11:16:04'),
(30, 67, 'answer to Head cancer''s question', 2, 0, '2014-02-24 12:17:13'),
(31, 68, 'tttt', 2, 0, '2014-02-28 01:26:16');

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_articles`
--

CREATE TABLE IF NOT EXISTS `tbl_articles` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `verbiage` varchar(20) NOT NULL,
  `category` int(20) NOT NULL,
  `menu_sublevel` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `title` varchar(255) NOT NULL,
  `keywords` varchar(2000) NOT NULL,
  `description` varchar(2000) NOT NULL,
  `clinic_card` int(20) NOT NULL,
  `level` int(11) NOT NULL DEFAULT '0',
  `parent_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Дамп данных таблицы `tbl_articles`
--

INSERT INTO `tbl_articles` (`id`, `name`, `verbiage`, `category`, `menu_sublevel`, `text`, `title`, `keywords`, `description`, `clinic_card`, `level`, `parent_id`) VALUES
(2, 'Гемоглобин', 'gemoglobin', 13, '', '<p><strong>Гемоглобин (Hb)</strong> &ndash; это белок, содержащиатом железа, который способен присоединять и переносить кислород. Гемоглобин находится в эритроцитах. Измеряется количество гемоглобина в граммах/литр (г/л). Определение количества гемоглобина имеет очень большое &nbsp;значение, так как при снижении его уровня ткани и органы всего организма испытывают недостаток кислорода.</p>', '', '', '', 0, 1, 5),
(3, 'Узи брюшной полости', 'uzi-brushnoy', 13, '', '<h1>УЗИ брюшной полости</h1>\r\n<p>&nbsp;</p>\r\n<h2>Что такое УЗИ брюшной полости?</h2>\r\n<p>&nbsp;</p>\r\n<p>Ультразвуковое исследование живота &ndash; это один из самых простых, доступных и наиболее эффективных способов диагностировать состояние органов, расположенных в брюшной полости. Причиной высокой эффективности этой процедуры является достаточная плотность и размер каждого органа брюшной полости для проведения четкого и точного сканирования, который осуществляется с помощью ультразвука.</p>\r\n<p>&nbsp;</p>\r\n<h2>Зачем нужно УЗИ органов брюшной полости?</h2>\r\n<p>&nbsp;</p>\r\n<p>Эта процедура позволяет определить размер каждого органа живота, толщину стенок органов и структура их тканей. Следует отметить, что обследование является не только информативным и эффективным, но и полностью безопасным и абсолютно безболезненным.</p>\r\n<p>&nbsp;</p>\r\n<h2>Какие органы исследует УЗИ брюшной полости?</h2>\r\n<p>&nbsp;</p>\r\n<p>Существует множество причин <a href="http://www.raduga-clinic.ru/uslugi/uzi/">сделать УЗИ брюшной полости</a>, ведь эта процедура позволяет узнать состояние каждого органа живота. Так, с помощью УЗИ исследуются:</p>\r\n<p>&nbsp;</p>\r\n<ul class="art_ul">\r\n<li>Желудок;</li>\r\n<li>Печень;</li>\r\n<li><a href="http://www.raduga-clinic.ru/uslugi/uzi/uzi-molochnyh-zhelez/">Молочные железы</a>;</li>\r\n<li><a href="http://www.raduga-clinic.ru/uslugi/uzi/uzi-mochevogo-puzyria/">Мочевой пузырь</a>;</li>\r\n<li>Селезенка;</li>\r\n<li>Кишечник (позволяет выявить опухолевидные образования, лимфостаз, нарушения кровообращения и прочие органические патологии);</li>\r\n<li><a href="http://www.raduga-clinic.ru/uslugi/uzi/uzi-organov-malogo-taza/">Органы малого таза</a> (такие, как тело матки, яичники и маточные трубы, что позволяет установить наличие внематочной и маточной беременности, ранних изменений, опухолевидных образований и др.);</li>\r\n<li>Поджелудочная железа;</li>\r\n<li><a href="http://www.raduga-clinic.ru/uslugi/uzi/uzi-pochek/">Почки</a>;</li>\r\n<li>Желчный пузырь.</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<h2>Зачем и когда проводить обследование</h2>\r\n<p>&nbsp;</p>\r\n<p>Сделать УЗИ брюшной полости следует в следующих случаях:</p>\r\n<p>&nbsp;</p>\r\n<ul class="art_ul">\r\n<li>Подозрение на доброкачественные или злокачественные опухоли;</li>\r\n<li>Повышенное газообразование;</li>\r\n<li>Болевые ощущения в правом подреберье;</li>\r\n<li>Ощущение горечи во рту;</li>\r\n<li>Сахарный диабет;</li>\r\n<li>Наличие хронических заболеваний органов пищеварения;</li>\r\n<li>Ощущение тяжести в правом подреберье;</li>\r\n<li>Опоясывающие боли;</li>\r\n<li>Наличие травм брюшной полости;</li>\r\n<li>Подготовка к операции.</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<h2>Подготовка к УЗИ брюшной полости</h2>\r\n<p>&nbsp;</p>\r\n<p>Следует серьезно отнестись к подготовке к процедуре, так как от подготовительного периода зависит не только качество изображения, но и точность результатов обследования, а то есть и их эффективность.</p>\r\n<p>&nbsp;</p>\r\n<p>Перед проведением УЗИ рекомендуется воздерживаться от приема пищи в течение пяти-шести часов до процедуры. Также за несколько дней до обследования следует отказаться от различных продуктов, которые могут вызывать избыточное газообразование (сырые фрукты, овощи, соки, цельное молоко, газированные напитки, черный хлеб, бобовые, квашеная капуста и др.).</p>\r\n<p>&nbsp;</p>\r\n<p>В том случае, если пациент подвержен тому или иному заболеванию, требующему медикаментозной коррекции, не следует прекращать лечения, но необходимо предупредить специалиста, проводящего обследование, о принимаемых медицинских препаратах.</p>\r\n<p>&nbsp;</p>\r\n<h2>Самый эффективный способ диагностирования в Санкт-Петербурге!</h2>\r\n<p>Обратившись в клинику &laquo;Радуга&raquo;, вы сможете пройти ультразвуковое исследование живота на самом современном оборудовании. С помощью этой процедуры мы с точностью диагностируем практически любые заболевания органов, расположенных в брюшной полости.</p>', 'Узи Органов Брюшной полости', '', '', 2, 1, 5),
(4, 'Узи почек', 'uzi-pochek', 13, '', '<h1>УЗИ почек</h1>\r\n<p><img src="http://www.spbmz.ru/content/artikles/uzimalogotaza/002.jpg" alt="УЗИ почек" width="120" height="179" align="right" border="0" hspace="3" vspace="3" /><strong>УЗИ почек</strong> &ndash; это ультразвуковое исследование, позволяющее абсолютно безболезненно и максимально точно оценить состояние почек. Помимо точности и безболезненности, в <a href="http://www.spbmz.ru/?cat=med/urology">урологии</a> <strong>УЗИ почек</strong> широко используется и потому, что <a href="http://www.spbmz.ru/?cat=med/uzi">УЗИ</a> является наиболее безопасным методом диагностики. <strong>Почки</strong> &ndash; это важнейшие органы выделительной системы, которые отвечают не только за вывод ненужных и вредных веществ из организма, но и за поддержание водно-солевого равновесия и другие обменные процессы. Поэтому <strong>проблемы с почками</strong> имеют целый ряд симптомов, которые, на первый взгляд, не имеют прямого отношения к выделительной системе. <strong>Сделать УЗИ почек</strong> необходимо, если у Вас:</p>\r\n<ul>\r\n<li>Боли в пояснице, в боку или внизу живота</li>\r\n<li>Отеки на лице</li>\r\n<li>Частое мочеиспускание</li>\r\n<li>Неприятные ощущения при мочеиспускании</li>\r\n<li>Изменение цвета мочи (особенно помутнение)</li>\r\n</ul>\r\n<p><strong>Процедура УЗИ почек</strong> не требует специальной подготовки и занимает от 10 до 30 минут. Основная задача диагностики &ndash; это полномерное исследование, поэтому УЗИ почек проводится в продольных, параллельных, поперечных и косых срезах мышц. Т.е. УЗИ почек может производиться со стороны живота (<strong>трансабдоминальное УЗИ</strong>), со стороны спины (<strong>транслюмбальное УЗИ</strong>) и во фронтальной плоскости, когда пациент находится в положении на боку.</p>\r\n<p>С помощью <a href="http://www.spbmz.ru/?cat=med/uzi">УЗИ почек</a> можно детально рассмотреть, практически, всё. Но, в основном, <strong>УЗИ почек определяет</strong>:</p>\r\n<ul type="circle">\r\n<li>Структуру почек, их форму, контуры и расположение</li>\r\n<li>Аномалии в развитии почек</li>\r\n<li>Воспалительные заболевания</li>\r\n<li>Доброкачественные и злокачественные опухоли</li>\r\n<li>Кисты</li>\r\n<li><a href="http://www.spbmz.ru/?cat=database&amp;key=141">Мочекаменную болезнь</a></li>\r\n<li>При мочекаменной болезни &ndash; размер камня, их количество, расположение в почке, а также изменения структуры самой почки и наличие нарушения в оттоке мочи</li>\r\n</ul>\r\n<p><strong>Когда необходимо УЗИ почек:</strong></p>\r\n<ul>\r\n<li>Положительный результат лабораторных исследований, указывающий на поражение почек</li>\r\n<li>Малейшие подозрения на травму почек</li>\r\n<li>Подозрения на мочекаменную болезнь</li>\r\n<li>Наличие острых или хронических воспалительных заболеваний почек</li>\r\n<li>Необходимость контроля за ходом лечения заболевания почек</li>\r\n<li>Проведение лечебных процедур, требующих параллельного контроля ультразвуком</li>\r\n<li>Оценка состояния мочевыделительной системы после трансплантации почки<br /> &nbsp;</li>\r\n</ul>\r\n<p>Конечно, список показаний к УЗИ почек можно продолжить, добавив необходимое <strong>УЗИ почек при беременности</strong>, неосмотрительных диетах, <a href="http://www.spbmz.ru/?cat=database&amp;key=201">гипертонической болезни</a>, когда УЗИ почек следует проходить регулярно с целью исключения почечной гипертонии, и многое другое. Однако не лишним является и <strong>УЗИ почек в профилактических целях</strong>. Т.к. <strong>ультразвуковое исследование</strong> позволяет выявить даже самые незначительные отклонения, то многие заболевания почек можно заметить на самой ранней стадии развития, более того, своевременная УЗИ диагностика сегодня позволяет урологам предотвратить развитие заболевания как такового. <strong>Профилактика</strong> &ndash; это не только приём витаминов, но и отслеживания состояния Вашего организма хотя бы раз в год. И в этом ежегодном обследовании <strong>УЗИ почек</strong> обязательно должно присутствовать, даже если Вас ничего не беспокоит. Помните, многие заболевания на стадии развития проходят бессимптомно.</p>', 'Узи почек', 'узи почек, почки, узи', 'хороший метод для диагностики', 1, 1, 5),
(5, 'Узи', 'uzi', 13, '', '<p>УЗИ, или ультразвуковое исследование, позволяет врачам более точно, по сравнению с другими методами обследования, диагностировать большое количество заболеваний пищеварительной, сердечно-сосудистой, эндокринной (УЗИ щитовидной железы) и мочеполовой систем, в сфере гинекологии и акушерства (УЗИ органов малого таза), неврологии, онкологии и офтальмологии.</p>\r\n<p>&nbsp;</p>\r\n<p>Наш медицинский центр предоставляет услуги по проведению УЗИ следующих видов:</p>\r\n<p>&nbsp;</p>\r\n<ul>\r\n<li>мягких тканей;</li>\r\n<li>УЗИ железистой ткани (щитовидной железы, молочных желез, слюнных желез);</li>\r\n<li>мочеполовой системы как у мужчин, так и у женщин;</li>\r\n<li>УЗИ органов брюшной полости;</li>\r\n<li>мониторинг роста фолликулов у женщин;</li>\r\n<li>УЗИ органов малого таза;</li>\r\n<li>выявление беременности;</li>\r\n<li>акушерские УЗИ в течение беременности 3D и 4D (в последнем случае при процедуре можно сделать видео).</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<p>Кроме того, недавно у нас появилась новая услуга: Дуплексное Сканирование Сосудов!!!</p>\r\n<p>&nbsp;</p>\r\n<p>Сделать <a href="http://www.ramus-med.ru/uzi-shhitovidnoj-zhelezy">УЗИ щитовидной железы</a> или любого другого органа означает заглянуть внутрь организма без неприятных ощущений для пациента и негативного воздействия, свойственного прочим методам диагностирования. К тому же УЗИ брюшной полости или любого другого органа можно проводить много раз, потому что вредного воздействия ионизирующей радиации нет. Мы проводим УЗИ на современных аппаратах в самые короткие сроки. Наши высококвалифицированные врачи-диагносты сразу же делают подробную расшифровку полученных данных и, при необходимости, выдают направление к профильным специалистам.</p>\r\n<p>&nbsp;</p>\r\n<p>В нашем медицинском центре &laquo;Рамус&raquo;, расположенном в Санкт-Петербурге, для проведения УЗИ щитовидной железы и прочих видов УЗИ используется только качественное и современное оборудование, в частности, экспертная установка УЗИ-диагностики DC-7. Цены на <a href="http://www.ramus-med.ru/uzi-malogo-taza">УЗИ малого таза</a> и стоимость прочих услуг вы можете посмотреть в специальном разделе или позвонив по телефону +7(812)602-25-45.</p>\r\n<p><img title="Схема узи" src="http://www.ramus-med.ru/images/uzi1.jpg" alt="Узи схема" width="355" height="232" /></p>\r\n<p>&nbsp;</p>\r\n<h2>В каких случаях УЗИ подходит больше всего?</h2>\r\n<p>&nbsp;</p>\r\n<p>Существует целый перечень показаний для проведения ультразвукового &laquo;досмотра&raquo;. Например, всем женщинам назначается УЗИ при беременности, причем несколько раз на разных сроках. Такой метод обследования позволяет выявить на ранних стадиях беременности патологии, несовместимые с жизнью.</p>\r\n<p>&nbsp;</p>\r\n<p>В целом УЗИ малого таза в гинекологии применяется для диагностики заболеваний женских половых органов &ndash; матки и яичников. А если есть проблемы с зачатием детей, то с помощью УЗИ можно определить созревание фолликулов.</p>\r\n<p>&nbsp;</p>\r\n<p>УЗИ брюшной полости назначают сделать при любых заболеваниях желудочно-кишечного тракта: гастритах, холециститах, панкреатитах, воспалениях печени, селезенки и прочих органов. УЗИ позволяет выявить камни и спайки, сужения и расширения просвета кишечника, воспаления и перекруты кишечника, а также множество других патологий.</p>\r\n<p>&nbsp;</p>\r\n<p>УЗИ мочеполовой системы могут назначить мужчинам, чтобы определить проходимость протоков и скорость кровотока. Также УЗ-исследовнаие используется для выявления новообразований предстательной железы или яичек.</p>\r\n<p>&nbsp;</p>\r\n<p>Сделать УЗИ почек придется, если есть подозрение на камни в почках, а также при любых заболеваниях этого органа. В диагностике мочекаменной болезни УЗИ считается наиболее информативным методом, позволяющим увидеть не только расположение камней, но и их форму и размер, что необходимо для дробления камней ультразвуком или для проведения операции.</p>\r\n<p>&nbsp;</p>\r\n<p>Еще один вариант использования УЗИ &ndash; диагностика заболеваний сердца. Для обследования сонных артерий и артерий головного мозга (сосудов) можно использовать доплерографию.</p>\r\n<p><img title="Узи обследование" src="http://www.ramus-med.ru/images/uzi2.jpg" alt="Обследование узи" width="250" height="244" /></p>\r\n<p>&nbsp;</p>\r\n<h2>Как следует готовиться к УЗИ?</h2>\r\n<p>&nbsp;</p>\r\n<p>Если вам предстоит <a href="http://www.ramus-med.ru/uzi-brjushnoj-polosti">УЗИ брюшной полости</a> и других внутренних органов, то на процедуру следует приходить натощак. В идеале УЗИ брюшной полости следует делать в первой половине дня, либо во второй, но при условии 6-8 часового голода. Если у вас избыточный вес или вы страдаете повышенным газообразованием, вздутием или запорами, то за несколько дней до процедуры следует исключить из пищи соленую, жирную, копченую пищу и принимать кисломолочные продукты, бульоны и каши. Плюс можно пропить курс ферментных препаратов.</p>\r\n<p>&nbsp;</p>\r\n<p>Для того чтобы провести УЗИ молочных желез, нужно следить за своим циклом и появиться у врача в течение 10 дней от начала менструального цикла. А вот чтобы провести УЗИ щитовидной железы, подготовка не требуется. Для УЗИ мочевого пузыря рекомендуется заранее выпить 2 литра негазированной жидкости (за 2-3 часа до начала процедуры).</p>\r\n<p>&nbsp;</p>\r\n<h2>Действительно ли требуется проводить УЗИ во время ожидания ребенка?</h2>\r\n<p><img title="Узи прибор" src="http://www.ramus-med.ru/images/uzi3.jpg" alt="Прибор узи" width="292" height="219" /></p>\r\n<p>&nbsp;</p>\r\n<p>Что касается УЗИ при беременности, то в этом случае следует придерживаться принятых регламентов и рекомендаций ВОЗ. Сегодня будущим мамочкам, ожидающим малыша, принято проводить УЗИ 4 раза:</p>\r\n<p>&nbsp;</p>\r\n<ul>\r\n<li>буквально в первые дни беременности (до 7 недели);</li>\r\n<li>между 11 и 14 неделей беременности;</li>\r\n<li>примерно между 18 и 21 неделей беременности;</li>\r\n<li>между 30 и 34 неделей.</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<p>Самое первое, что уточняется во время УЗИ при беременности, &ndash; это положение эмбриона, что позволяет исключить такую патологию, как внематочная беременность, угрожающую, прежде всего, здоровью и жизни будущей матери.</p>\r\n<p>&nbsp;</p>\r\n<p>УЗИ при беременности необходимо для того, чтобы с высокой точностью определить местонахождение плодного яйца, определить его возраст с учетом размеров и особенностей строения. Уже в 5-6 недель беременности врачи регистрируют сердцебиение малыша, что позволяет убедиться в жизнеспособности плода и подтвердить его нормальное развитие.</p>\r\n<p>&nbsp;</p>\r\n<p>Благодаря скрининговым УЗИ, которые проводятся при беременности 3 раза (на сроках 11-14 недель, 18-21 и 30-34 недели), можно заранее исключить развитие патологий и убедиться в том, что ребенок развивается как положено. Уже в 18 недель плод считается практически сформировавшимся, а органы и структуры имеют достаточно большие размеры, благодаря чему их можно тщательно рассмотреть. Цель УЗИ заключается в том, чтобы комплексно оценить анатомическое строение плода, хотя данная процедура не дает 100%-го исключения пороков развития и ее желательно совместить с другими методами диагностики.</p>\r\n<p>Последнее скрининговое УЗИ, которое проводится на 28-32 неделе при беременности, позволяет определить параметры роста плода и дать детальную оценку внутренних органов и структур малыша.</p>', '', '', '', 0, 0, 0),
(8, 'Новая статья', 'new_article', 0, '', '<p>текст для новой статьи</p>', '', '', '', 0, 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_clinics`
--

CREATE TABLE IF NOT EXISTS `tbl_clinics` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(500) NOT NULL,
  `verbiage` varchar(255) NOT NULL,
  `site` varchar(1000) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `phone_extra` varchar(50) NOT NULL,
  `fax` varchar(2000) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `city` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `address_extra` varchar(255) NOT NULL,
  `district` varchar(2000) DEFAULT NULL,
  `metro_station` varchar(2000) DEFAULT NULL,
  `working_days` varchar(255) DEFAULT NULL,
  `working_hours` varchar(255) DEFAULT NULL,
  `rating` float DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `triggers` varchar(2000) DEFAULT NULL,
  `pictures` varchar(2000) DEFAULT NULL,
  `map_coordinates` varchar(2000) DEFAULT NULL,
  `text` text,
  `audio` varchar(255) DEFAULT NULL,
  `video` varchar(255) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `keywords` varchar(2000) NOT NULL,
  `description` varchar(2000) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`(255))
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Дамп данных таблицы `tbl_clinics`
--

INSERT INTO `tbl_clinics` (`id`, `name`, `verbiage`, `site`, `phone`, `phone_extra`, `fax`, `email`, `city`, `address`, `address_extra`, `district`, `metro_station`, `working_days`, `working_hours`, `rating`, `logo`, `triggers`, `pictures`, `map_coordinates`, `text`, `audio`, `video`, `title`, `keywords`, `description`) VALUES
(1, 'СПб ГАУЗ «Городская поликлиника № 83»', 'poliklinika83', 'http://pol83.ru', '8(812) 233-67-72', '', NULL, '', '', 'Санкт-Петербург, Большой проспект П.С., д. 10.', '', '13', NULL, NULL, '8-20, 10-17', NULL, '.jpg', '', NULL, NULL, NULL, NULL, NULL, '', '', ''),
(2, 'Централизованная клинико-диагностическая лаборатория Невского района', 'analizspb', 'analizi', '98234243243', '', NULL, '', '', 'Ул. Дыбенко 21 к. 2', '', '12', NULL, NULL, '10-22', NULL, '7616f.jpg.jpg', '', NULL, NULL, NULL, NULL, NULL, '', '', ''),
(3, 'Санкт-Петербургское государственное бюджетное учреждение “Городская поликлиника № 112”', 'poliklinika112', 'http://p112.spb.ru', '8(812) 555-20-21', '', NULL, '', '', 'Санкт-Петербург, ул. Академика Байкова д.25/1', '', '4', NULL, NULL, '8-20, 9-12', NULL, '51bfc.png.jpg', '', NULL, NULL, NULL, NULL, NULL, '', '', ''),
(4, 'Государственное автономное учреждение здравоохранения "Городская поликлиника № 40"', 'poliklinika40', 'http://poli40.spb.ru', '8(812) 244-38-36', '', NULL, '', '', 'Санкт-Петербург, ул. Невский проспект 86', '', '18', NULL, NULL, '8-20', NULL, '9f7e7.gif.jpg', '', NULL, NULL, NULL, NULL, NULL, '', '', ''),
(5, 'СПб ГБУЗ «Городская поликлиника № 4»', 'poliklinika4', 'http://p4spb.3dn.ru', '8(812) 321-47-35', '', NULL, '', '', 'Санкт-Петербург, В. О., Большой пр., д. 59', '', '15', NULL, NULL, '8-20, 9-12', NULL, '1911e.PNG.jpg', '', NULL, NULL, NULL, NULL, NULL, '', '', ''),
(6, 'СПб ГБУЗ "Городская поликлиника №107"', 'poliklinika103', 'http://p107.spb.ru/', '8(812)777-92-82', '', NULL, '', '', 'г. Санкт-Петербург, ул. Коммуны, д.36', '', '', NULL, NULL, '8-20, 9-15', NULL, 'd5b7a.png.jpg.jpg', '', NULL, NULL, NULL, NULL, NULL, '', '', ''),
(7, 'СПб ГБУЗ "Городская поликлиника №71"', 'kolpino_poliklinika', 'http://p-71.spb.ru/', '8(812) 461-18-74', '', NULL, '', '', 'Павловская ул., 10 г. Колпино, г. Санкт-Петербург', '', '', NULL, NULL, '9-12', NULL, '.jpg.jpg', '', NULL, NULL, NULL, NULL, NULL, '', '', '');

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_clinics_fields`
--

CREATE TABLE IF NOT EXISTS `tbl_clinics_fields` (
  `id` int(22) NOT NULL AUTO_INCREMENT,
  `clinic_id` int(22) NOT NULL,
  `field_id` int(22) NOT NULL,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `tbl_clinics_fields`
--

INSERT INTO `tbl_clinics_fields` (`id`, `clinic_id`, `field_id`, `value`) VALUES
(2, 2, 2, 'Лучшие врачи!'),
(3, 3, 3, 'высокий');

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_comments`
--

CREATE TABLE IF NOT EXISTS `tbl_comments` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `clinic_id` int(20) NOT NULL,
  `text` text COLLATE utf8_unicode_ci NOT NULL,
  `user_first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `approved` bit(1) NOT NULL DEFAULT b'0',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=17 ;

--
-- Дамп данных таблицы `tbl_comments`
--

INSERT INTO `tbl_comments` (`id`, `clinic_id`, `text`, `user_first_name`, `user_last_name`, `approved`, `create_at`) VALUES
(2, 1, 'хорошая клиника\r\n', '', '', b'1', '2015-01-24 12:36:27'),
(3, 1, 'spasibo za analizi', '', '', b'1', '2015-01-24 12:36:39'),
(4, 1, 'Замечательно!\r\n\r\n·      Общеклинические\r\n\r\n·      Гематологические\r\n\r\n·      Биохимические\r\n\r\n·      Исследование показателей системы гемостаза\r\n\r\n·      Определение уровня гормонов\r\n\r\n·      Маркеры остеопороза\r\n\r\n·      Маркеры опухолевого роста\r\n\r\n·      Маркеры анемии.', '', '', b'1', '2015-01-24 12:37:27'),
(5, 1, 'хорошо\r\nзамечательно\r\nсупер\r\nвосхитительно', '', '', b'1', '2015-01-24 12:40:38'),
(7, 1, '<p><span style="color: #333333; font-family: Ubuntu, Tahoma, sans-serif; font-size: medium; line-height: 18px; background-color: #eeeeee;">Привет!</span></p>\r\n<p><span style="color: #333333; font-family: Ubuntu, Tahoma, sans-serif; font-size: medium; line-height: 18px; background-color: #eeeeee;">Спешу поделиться впечатлениями:</span></p>\r\n<ul>\r\n<li><span style="text-decoration: underline; font-size: medium;"><span style="color: #333333; font-family: Ubuntu, Tahoma, sans-serif; line-height: 18px; text-decoration: underline; background-color: #eeeeee;">качественно</span></span></li>\r\n<li><span style="font-size: medium;"><em><span style="color: #333333; font-family: Ubuntu, Tahoma, sans-serif; line-height: 18px; background-color: #eeeeee;">быстро</span></em></span></li>\r\n<li><span style="font-size: medium;"><strong><span style="color: #333333; font-family: Ubuntu, Tahoma, sans-serif; line-height: 18px; background-color: #eeeeee;">недорого</span></strong></span></li>\r\n</ul>', '', '', b'1', '2015-02-05 11:34:17'),
(9, 2, '<p>хорошо сделали анализы в срок и недорого йдцовл</p>\r\n<p>длводлйцвл</p>\r\n<p>длцйодлв</p>', 'Петя', 'Федоров', b'1', '2015-02-06 13:59:37'),
(11, 2, '<p><span style="font-size: medium;">неплохо</span></p>\r\n<p><span style="font-size: medium;">очень неплохо</span></p>\r\n<p><span style="font-size: medium;">спасибо за работу</span></p>\r\n<p><span style="font-size: medium;">хорошо сделали и оперативно</span></p>', 'руслан', 'мамедов', b'1', '2015-02-06 14:05:46'),
(14, 2, '<p>широкий спектр услуг</p>', 'Денис', 'Шефрон', b'1', '2015-02-08 09:40:34'),
(15, 6, '<p>Удачное расположение поликлиники. Грамотный хирург.</p>\r\n<p>&nbsp;</p>\r\n<p>Спасибо!</p>', 'Виктор', 'Демьянченков', b'0', '2015-03-06 13:43:25'),
(16, 5, '<p>Текст комментария</p>', 'Илья', 'Васильев', b'0', '2015-03-13 12:36:16');

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_districts`
--

CREATE TABLE IF NOT EXISTS `tbl_districts` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Дамп данных таблицы `tbl_districts`
--

INSERT INTO `tbl_districts` (`id`, `name`) VALUES
(1, 'Адмиралтейский'),
(2, 'Василеостровский'),
(3, 'Выборгский'),
(4, 'Калининский'),
(5, 'Кировский'),
(6, 'Колпинский'),
(7, 'Красногвардейский'),
(8, 'Красносельский'),
(9, 'Кронштадский'),
(10, 'Курортный'),
(11, 'Московский'),
(12, 'Невский'),
(13, 'Петроградский'),
(14, 'Петродворцовый'),
(15, 'Приморский'),
(16, 'Пушкинский'),
(17, 'Фрунзенский'),
(18, 'Центральный');

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_fields`
--

CREATE TABLE IF NOT EXISTS `tbl_fields` (
  `id` int(22) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `tbl_fields`
--

INSERT INTO `tbl_fields` (`id`, `name`, `title`) VALUES
(2, 'qwe', 'eqoi'),
(3, 'level', 'Уровень удобства');

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_filters`
--

CREATE TABLE IF NOT EXISTS `tbl_filters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `speciality_id` int(20) NOT NULL,
  `fields` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Дамп данных таблицы `tbl_filters`
--

INSERT INTO `tbl_filters` (`id`, `speciality_id`, `fields`) VALUES
(3, 27, '1;5;7;9;10;11'),
(10, 28, '7;9'),
(11, 29, '13'),
(12, 54, '5;6'),
(13, 27, ''),
(14, 55, '11'),
(15, 56, '2;14;16');

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_follow_people`
--

CREATE TABLE IF NOT EXISTS `tbl_follow_people` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `follow_user_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=66 ;

--
-- Дамп данных таблицы `tbl_follow_people`
--

INSERT INTO `tbl_follow_people` (`id`, `user_id`, `follow_user_id`) VALUES
(14, 19, 3),
(15, 15, 2),
(16, 1, 19),
(18, 3, 2),
(20, 8, 2),
(22, 19, 10),
(23, 19, 13),
(24, 19, 9),
(29, 2, 18),
(30, 2, 9),
(31, 2, 5),
(35, 19, 8),
(41, 19, 19),
(42, 19, 2),
(56, 2, 15),
(57, 3, 16),
(58, 3, 8),
(59, 2, 7),
(62, 2, 19),
(65, 2, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_follow_question`
--

CREATE TABLE IF NOT EXISTS `tbl_follow_question` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `q_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Дамп данных таблицы `tbl_follow_question`
--

INSERT INTO `tbl_follow_question` (`id`, `user_id`, `q_id`) VALUES
(3, 2, 2),
(4, 19, 3),
(5, 19, 24),
(9, 2, 15),
(13, 2, 24),
(14, 2, 3),
(15, 2, 13),
(16, 2, 23);

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_follow_topic`
--

CREATE TABLE IF NOT EXISTS `tbl_follow_topic` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `topic_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `tbl_follow_topic`
--

INSERT INTO `tbl_follow_topic` (`id`, `user_id`, `topic_id`) VALUES
(5, 2, 7),
(6, 2, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_institutions`
--

CREATE TABLE IF NOT EXISTS `tbl_institutions` (
  `id` int(255) NOT NULL,
  `name` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_invite_people`
--

CREATE TABLE IF NOT EXISTS `tbl_invite_people` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `invite_user_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_jobs`
--

CREATE TABLE IF NOT EXISTS `tbl_jobs` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `name` varchar(500) NOT NULL,
  `location` varchar(1000) NOT NULL,
  `from` year(4) NOT NULL,
  `to` year(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Дамп данных таблицы `tbl_jobs`
--

INSERT INTO `tbl_jobs` (`id`, `user_id`, `name`, `location`, `from`, `to`) VALUES
(1, 2, 'Nurse', 'Medical University of Washington', 2000, 2005),
(2, 2, 'Doctor', 'Home', 2005, 0000),
(3, 11, 'Something', '', 2014, 0000),
(4, 15, 'here and there', '', 2014, 0000),
(5, 17, 'dunno where', '', 2014, 2014),
(6, 18, '', 'Brand New Uni', 2014, 0000),
(7, 19, '', 'Home', 2014, 0000),
(8, 5, '', 'Medical School of Ohio', 2014, 0000),
(9, 1, '', 'Maryland State Uni', 2000, 0000),
(10, 20, '', 'Not available', 2014, 2014),
(11, 21, '', 'Not available', 2014, 2014);

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_menu`
--

CREATE TABLE IF NOT EXISTS `tbl_menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lft` int(10) unsigned NOT NULL,
  `rgt` int(10) unsigned NOT NULL,
  `level` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `lft` (`lft`),
  KEY `rgt` (`rgt`),
  KEY `level` (`level`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_menus`
--

CREATE TABLE IF NOT EXISTS `tbl_menus` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `verbiage` varchar(255) NOT NULL,
  `level` smallint(5) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `level` (`level`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Дамп данных таблицы `tbl_menus`
--

INSERT INTO `tbl_menus` (`id`, `name`, `verbiage`, `level`) VALUES
(11, 'МРТ', 'mrt-articles', 0),
(12, 'КТ', 'kt-articles', 0),
(13, 'Узи диагностика', 'uzi', 0),
(14, 'Лабораторные исследования', 'labs', 0),
(15, 'Рентген', 'rentgen', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_messages`
--

CREATE TABLE IF NOT EXISTS `tbl_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `subject` varchar(256) NOT NULL DEFAULT '',
  `is_invitation` enum('0','1') NOT NULL DEFAULT '0',
  `body` text,
  `is_read` enum('0','1') NOT NULL DEFAULT '0',
  `deleted_by` enum('sender','receiver') DEFAULT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sender` (`sender_id`),
  KEY `reciever` (`receiver_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=72 ;

--
-- Дамп данных таблицы `tbl_messages`
--

INSERT INTO `tbl_messages` (`id`, `sender_id`, `receiver_id`, `subject`, `is_invitation`, `body`, `is_read`, `deleted_by`, `created_at`) VALUES
(1, 2, 11, 'new subject', '0', 'test', '0', 'sender', '2014-01-26 19:15:46'),
(7, 2, 6, 'You are invited!', '1', NULL, '0', NULL, '2014-02-05 15:37:10'),
(3, 2, 3, 'You are invited!', '1', NULL, '0', NULL, '2014-02-05 11:03:21'),
(4, 2, 13, 'You are invited!', '1', NULL, '0', NULL, '2014-02-05 15:20:33'),
(5, 2, 14, 'You are invited!', '1', NULL, '0', NULL, '2014-02-05 15:32:06'),
(6, 2, 1, 'You are invited!', '1', NULL, '0', NULL, '2014-02-05 15:32:53'),
(8, 2, 18, 'You are invited!', '1', NULL, '0', NULL, '2014-02-05 15:42:03'),
(9, 2, 7, 'You are invited!', '1', NULL, '0', NULL, '2014-02-05 15:43:04'),
(11, 19, 9, 'You are invited!', '1', NULL, '0', NULL, '2014-02-06 10:16:55'),
(16, 2, 8, 'You are invited!', '1', 'You are invited to follow <a class="namecard" target="_blank" href="/mednet/user/user/view/id/2">Tasty ToAst</a>', '0', NULL, '2014-02-07 20:30:57'),
(15, 2, 19, 'You are invited!', '1', 'You are invited to follow <a class="question-headline" target="_blank" href="/mednet/user/user/view/id/2">Tasty ToAst</a>', '1', NULL, '2014-02-06 11:01:52'),
(17, 2, 8, 'You are invited!', '1', 'You are invited to follow <a class="namecard" target="_blank" href="/mednet/user/user/view/id/2">Tasty ToAst</a>', '0', NULL, '2014-02-07 20:32:11'),
(18, 2, 12, 'You are invited!', '1', 'You are invited to follow <a class="namecard" target="_blank" href="/mednet/user/user/view/id/2">Tasty ToAst</a>', '0', NULL, '2014-02-07 20:38:59'),
(19, 2, 12, 'You are invited!', '1', 'You are invited to follow <a class="namecard" target="_blank" href="/mednet/user/user/view/id/2">Tasty ToAst</a>', '0', NULL, '2014-02-07 20:40:19'),
(20, 2, 2, 'Your answer has been voted!', '0', 'Your <a class="namecard" target="_blank" href="/mednet/question/view/id/23"> answer</a> has been marked as Helpful.', '1', NULL, '2014-02-07 21:55:40'),
(21, 2, 19, 'You are followed!', '0', 'You are now being followed by <a target="_blank" href="/mednet/user/user/view/id/2">Tasty ToAst</a>', '1', NULL, '2014-02-08 10:53:03'),
(22, 19, 19, 'You are followed!', '0', 'You are now being followed by <a target="_blank" href="/mednet/user/user/view/id/19">Mandy Moore</a>', '1', NULL, '2014-02-08 10:58:08'),
(23, 19, 19, 'You are followed!', '0', 'You are now being followed by <a target="_blank" href="/mednet/user/user/view/id/19">Mandy Moore</a>', '1', NULL, '2014-02-08 10:58:17'),
(24, 19, 2, 'You are followed!', '0', 'You are now being followed by &lt;a target=&quot;_blank&quot; href=&quot;/mednet/mednet/user/user/view/id/19&quot;&gt;Mandy Moore&lt;/a&gt;', '1', NULL, '2014-02-08 11:05:12'),
(25, 2, 19, 'tssss', '0', 'real private message ', '0', NULL, '2014-02-08 21:10:20'),
(26, 2, 19, 'tsss', '0', 'real private message', '1', NULL, '2014-02-08 22:11:05'),
(27, 2, 19, 'test of full name', '0', 'nothing special', '1', NULL, '2014-02-11 12:36:22'),
(28, 2, 3, 'test test', '0', 'пропропр', '1', NULL, '2014-02-11 12:45:12'),
(29, 2, 3, 'You have got new question', '0', 'You are invited to take a look at this &lt;a target=&quot;_blank&quot; href=&quot;/mednet/mednet/question/view/id/3&quot;&gt;question&lt;/a&gt;', '1', NULL, '2014-02-11 13:14:13'),
(30, 3, 2, 'You have got new question', '0', 'You are invited to take a look at this &lt;a target=&quot;_blank&quot; href=&quot;/mednet/mednet/question/view/id/27&quot;&gt;question&lt;/a&gt;', '1', NULL, '2014-02-11 13:16:06'),
(31, 2, 3, 'You have got new question', '0', 'You are invited to take a look at this &lt;a target=&quot;_blank&quot; href=&quot;/mednet/question/view/id/28&quot;&gt;question&lt;/a&gt;', '1', NULL, '2014-02-11 13:18:23'),
(32, 3, 2, 'You are recommended an answer!', '0', 'I suggest you taking a look at this &lt;a href=&quot;/question/view/id/15#answer_11&quot;&gt;answer&lt;/a&gt;', '0', NULL, '2014-02-11 16:04:07'),
(33, 3, 2, 'You are recommended an answer!', '0', 'I suggest you taking a look at this &lt;a href=&quot;/question/view/id/15#answer_11&quot;&gt;answer&lt;/a&gt;', '0', NULL, '2014-02-11 16:04:14'),
(34, 3, 2, 'You are recommended an answer!', '0', 'I suggest you taking a look at this &lt;a href=&quot;/question/view/id/15#answer_11&quot;&gt;answer&lt;/a&gt;', '0', NULL, '2014-02-11 16:04:15'),
(35, 3, 2, 'You are recommended an answer!', '0', 'I suggest you taking a look at this &lt;a href=&quot;/question/view/id/15#answer_11&quot;&gt;answer&lt;/a&gt;', '0', NULL, '2014-02-11 16:04:18'),
(36, 3, 2, 'You are recommended an answer!', '0', 'I suggest you taking a look at this &lt;a href=&quot;/question/view/id/15#answer_11&quot;&gt;answer&lt;/a&gt;', '1', NULL, '2014-02-11 16:04:19'),
(37, 2, 6, 'You are recommended an answer!', '0', 'I suggest you taking a look at this &lt;a href=&quot;/mednet/question/view/id/15#answer_11&quot;&gt;answer&lt;/a&gt;', '0', NULL, '2014-02-11 16:08:25'),
(38, 2, 5, 'You are recommended an answer!', '0', 'I suggest you taking a look at this &lt;a href=&quot;/mednet/question/view/id/15#answer_11&quot;&gt;answer&lt;/a&gt;', '0', NULL, '2014-02-11 16:09:51'),
(39, 2, 5, 'You are recommended an answer!', '0', 'I suggest you taking a look at this &lt;a href=&quot;/mednet/question/view/id/15#answer_11&quot;&gt;answer&lt;/a&gt;', '0', NULL, '2014-02-11 16:10:04'),
(40, 2, 18, 'You are recommended an answer!', '0', 'I suggest you taking a look at this &lt;a href=&quot;/mednet/question/view/id/15#answer_11&quot;&gt;answer&lt;/a&gt;', '0', NULL, '2014-02-11 16:10:49'),
(41, 2, 18, 'You are recommended an answer!', '0', 'I suggest you taking a look at this &lt;a href=&quot;/mednet/question/view/id/15#answer_11&quot;&gt;answer&lt;/a&gt;', '0', NULL, '2014-02-11 16:10:56'),
(42, 2, 1, 'You are recommended an answer!', '0', 'I suggest you taking a look at this &lt;a href=&quot;/mednet/question/view/id/15#answer_11&quot;&gt;answer&lt;/a&gt;', '0', NULL, '2014-02-11 16:11:29'),
(43, 2, 18, 'You are recommended an answer!', '0', 'I suggest you taking a look at this &lt;a href=&quot;/mednet/question/view/id/15#answer_11&quot;&gt;answer&lt;/a&gt;', '0', NULL, '2014-02-11 16:15:17'),
(44, 2, 18, 'You are recommended an answer!', '0', 'I suggest you taking a look at this &lt;a href=&quot;/mednet/question/view/id/15#answer_11&quot;&gt;answer&lt;/a&gt;', '0', NULL, '2014-02-11 16:17:18'),
(45, 2, 18, 'You are recommended an answer!', '0', 'I suggest you taking a look at this &lt;a href=&quot;/mednet/question/view/id/15#answer_11&quot;&gt;answer&lt;/a&gt;', '0', NULL, '2014-02-11 16:18:08'),
(46, 2, 9, 'You are recommended an answer!', '0', 'I suggest you taking a look at this &lt;a href=&quot;/mednet/question/view/id/3#answer_6&quot;&gt;answer&lt;/a&gt;', '0', NULL, '2014-02-11 16:18:26'),
(47, 2, 18, 'You are recommended an answer!', '0', 'I suggest you taking a look at this &lt;a href=&quot;/mednet/question/view/id/3#answer_6&quot;&gt;answer&lt;/a&gt;', '0', NULL, '2014-02-11 16:18:30'),
(48, 2, 18, 'You are recommended an answer!', '0', 'I suggest you taking a look at this &lt;a href=&quot;/mednet/question/view/id/3#answer_6&quot;&gt;answer&lt;/a&gt;', '0', NULL, '2014-02-11 16:18:39'),
(49, 2, 18, 'You are recommended an answer!', '0', 'I suggest you taking a look at this &lt;a href=&quot;/mednet/question/view/id/3#answer_6&quot;&gt;answer&lt;/a&gt;', '0', NULL, '2014-02-11 16:19:07'),
(50, 2, 18, 'You are recommended an answer!', '0', 'I suggest you taking a look at this &lt;a href=&quot;/mednet/question/view/id/3#answer_6&quot;&gt;answer&lt;/a&gt;', '0', NULL, '2014-02-11 16:19:08'),
(51, 2, 5, 'You are recommended an answer!', '0', 'I suggest you taking a look at this &lt;a href=&quot;/mednet/question/view/id/3#answer_6&quot;&gt;answer&lt;/a&gt;', '0', NULL, '2014-02-11 16:19:46'),
(52, 2, 18, 'You are recommended an answer!', '0', 'I suggest you taking a look at this &lt;a href=&quot;/mednet/question/view/id/3#answer_6&quot;&gt;answer&lt;/a&gt;', '0', NULL, '2014-02-11 16:19:49'),
(53, 2, 1, 'You are recommended an answer!', '0', 'I suggest you taking a look at this &lt;a href=&quot;/mednet/question/view/id/3#answer_6&quot;&gt;answer&lt;/a&gt;', '0', NULL, '2014-02-11 16:19:54'),
(54, 2, 9, 'You are recommended an answer!', '0', 'I suggest you taking a look at this &lt;a href=&quot;/mednet/question/view/id/3#answer_6&quot;&gt;answer&lt;/a&gt;', '0', NULL, '2014-02-11 16:20:06'),
(55, 2, 18, 'You are recommended an answer!', '0', 'I suggest you taking a look at this &lt;a href=&quot;/mednet/question/view/id/15#answer_11&quot;&gt;answer&lt;/a&gt;', '0', NULL, '2014-02-11 16:20:15'),
(56, 2, 1, 'You are recommended an answer!', '0', 'I suggest you taking a look at this &lt;a href=&quot;/mednet/question/view/id/15#answer_11&quot;&gt;answer&lt;/a&gt;', '0', NULL, '2014-02-11 16:21:40'),
(57, 2, 18, 'You are recommended an answer!', '0', 'I suggest you taking a look at this &lt;a href=&quot;/mednet/question/view/id/15#answer_11&quot;&gt;answer&lt;/a&gt;', '0', NULL, '2014-02-11 16:21:53'),
(58, 2, 9, 'You are recommended an answer!', '0', 'I suggest you taking a look at this &lt;a href=&quot;/mednet/question/view/id/15#answer_11&quot;&gt;answer&lt;/a&gt;', '0', NULL, '2014-02-11 16:23:01'),
(59, 2, 1, 'You are recommended an answer!', '0', 'I suggest you taking a look at this &lt;a href=&quot;/mednet/question/view/id/23#answer_13&quot;&gt;answer&lt;/a&gt;', '0', NULL, '2014-02-11 16:23:36'),
(60, 2, 15, 'You are recommended an answer!', '0', 'I suggest you taking a look at this &lt;a href=&quot;/mednet/question/view/id/23#answer_13&quot;&gt;answer&lt;/a&gt;', '0', NULL, '2014-02-11 16:23:45'),
(61, 2, 13, 'You are recommended an answer!', '0', 'I suggest you taking a look at this &lt;a href=&quot;/question/view/id/15#answer_11&quot;&gt;answer&lt;/a&gt;', '0', NULL, '2014-02-11 18:12:47'),
(62, 2, 15, 'You are invited!', '1', 'You are invited to follow &lt;a target=&quot;_blank&quot; href=&quot;/user/user/view/id/2&quot;&gt;Tasty ToAst&lt;/a&gt;', '0', NULL, '2014-02-13 04:03:36'),
(63, 2, 1, 'You are recommended an answer!', '0', 'I suggest you taking a look at this &lt;a href=&quot;/question/view/id/23#answer_13&quot;&gt;answer&lt;/a&gt;', '0', NULL, '2014-02-13 04:04:48'),
(64, 2, 18, 'You are recommended an answer!', '0', 'I suggest you taking a look at this &lt;a href=&quot;/question/view/id/23#answer_13&quot;&gt;answer&lt;/a&gt;', '0', NULL, '2014-02-13 04:04:49'),
(65, 2, 19, 'You are recommended an answer!', '0', 'I suggest you taking a look at this &lt;a href=&quot;/question/view/id/23#answer_13&quot;&gt;answer&lt;/a&gt;', '0', NULL, '2014-02-13 04:04:54'),
(66, 2, 19, 'You are recommended an answer!', '0', 'I suggest you taking a look at this &lt;a href=&quot;/question/view/id/23#answer_13&quot;&gt;answer&lt;/a&gt;', '0', NULL, '2014-02-13 04:04:58'),
(67, 2, 19, 'You are recommended an answer!', '0', 'I suggest you taking a look at this &lt;a href=&quot;/mednet/question/view/id/3#answer_6&quot;&gt;answer&lt;/a&gt;', '0', NULL, '2014-02-20 14:12:04'),
(68, 2, 17, 'You are recommended an answer!', '0', 'I suggest you taking a look at this &lt;a href=&quot;/mednet/question/view/id/3#answer_6&quot;&gt;answer&lt;/a&gt;', '0', NULL, '2014-02-20 14:12:06'),
(69, 2, 14, 'You are recommended an answer!', '0', 'I suggest you taking a look at this &lt;a href=&quot;/question/view/id/3#answer_6&quot;&gt;answer&lt;/a&gt;', '0', NULL, '2014-02-22 21:08:34'),
(70, 2, 16, 'You are recommended an answer!', '0', 'I suggest you taking a look at this &lt;a href=&quot;/question/view/id/3#answer_6&quot;&gt;answer&lt;/a&gt;', '0', NULL, '2014-02-22 21:08:35'),
(71, 2, 15, 'You are recommended an answer!', '0', 'I suggest you taking a look at this &lt;a href=&quot;/question/view/id/65#answer_24&quot;&gt;answer&lt;/a&gt;', '0', NULL, '2014-02-24 13:51:20');

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_metro`
--

CREATE TABLE IF NOT EXISTS `tbl_metro` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=68 ;

--
-- Дамп данных таблицы `tbl_metro`
--

INSERT INTO `tbl_metro` (`id`, `name`) VALUES
(1, 'Автово'),
(2, 'Адмиралтейская'),
(3, 'Академическая'),
(4, 'Балтийская'),
(5, 'Бухарестская'),
(6, 'Василеостровская'),
(7, 'Владимирская'),
(8, 'Волковская'),
(9, 'Выборгская'),
(10, 'Горьковская'),
(11, 'Гостиный двор'),
(12, 'Гражданский проспект'),
(13, 'Девяткино'),
(14, 'Достоевская'),
(15, 'Елизаровская'),
(16, 'Звёздная'),
(17, 'Звенигородская'),
(18, 'Кировский завод'),
(19, 'Комендантский проспект'),
(20, 'Крестовский остров'),
(21, 'Купчино'),
(22, 'Ладожская'),
(23, 'Ленинский проспект'),
(24, 'Лесная'),
(25, 'Лиговский проспект'),
(26, 'Ломоносовская'),
(27, 'Маяковская'),
(28, 'Международная'),
(29, 'Московская'),
(30, 'Московские ворота'),
(31, 'Нарвская'),
(32, 'Невский проспект'),
(33, 'Новочеркасская'),
(34, 'Обводный канал'),
(35, 'Обухово'),
(36, 'Озерки'),
(37, 'Парк Победы'),
(38, 'Парнас'),
(39, 'Петроградская'),
(40, 'Пионерская'),
(41, 'Площадь Александра Невского'),
(42, 'Площадь Александра Невского'),
(43, 'Площадь Восстания'),
(44, 'Площадь Ленина'),
(45, 'Площадь Мужества'),
(46, 'Политехническая'),
(47, 'Приморская'),
(48, 'Пролетарская'),
(49, 'Проспект Большевиков'),
(50, 'Проспект Ветеранов'),
(51, 'Проспект Просвещения'),
(52, 'Пушкинская'),
(53, 'Рыбацкое'),
(54, 'Садовая'),
(55, 'Сенная площадь'),
(56, 'Спасская'),
(57, 'Спортивная'),
(58, 'Старая Деревня'),
(59, 'Технологический институт'),
(60, 'Технологический институт'),
(61, 'Удельная'),
(62, 'Улица Дыбенко'),
(63, 'Фрунзенская'),
(64, 'Чёрная речка'),
(65, 'Чернышевская'),
(66, 'Чкаловская'),
(67, 'Электросила');

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_options`
--

CREATE TABLE IF NOT EXISTS `tbl_options` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(2000) NOT NULL,
  `verbiage` varchar(255) NOT NULL,
  `value` varchar(2000) NOT NULL,
  `subvalue` varchar(2000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `tbl_options`
--

INSERT INTO `tbl_options` (`id`, `name`, `verbiage`, `value`, `subvalue`) VALUES
(1, 'top_menu', 'Верхнее меню', 'Рейтинг клиник=rating; Акции=actions; Второе мнение=anotheropinion ', ''),
(2, 'leftside_menu', 'Боковое меню', 'МРТ; КТ', 'МРТ головы=mrt_head; МРТ позвоночника=mrt_spine & КТ головы=kt_head; КТ позвоночника=kt_spine '),
(3, 'top_banner', 'Верхний баннер', 'new.jpg', ''),
(4, 'side_banner', 'Боковой баннер', 'right.jpg', '');

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_pricelist`
--

CREATE TABLE IF NOT EXISTS `tbl_pricelist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `clinic_id` int(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Прайлисты на услуги клиник' AUTO_INCREMENT=65 ;

--
-- Дамп данных таблицы `tbl_pricelist`
--

INSERT INTO `tbl_pricelist` (`id`, `clinic_id`, `name`, `price`) VALUES
(2, 1, 'Общий (клинический) анализ крови развернутый', 550),
(4, 2, 'мрт', 1200),
(5, 2, 'кт', 1500),
(6, 2, 'анализы крови', 600),
(7, 4, 'Флюрография', 190),
(8, 4, 'Консультация специалиста', 600),
(9, 4, 'Ректороманоскопия', 900),
(10, 4, 'Эзофагогастродуоденоскопия', 1300),
(11, 4, 'Кольпоскопия', 630),
(12, 4, 'Массаж шеи', 180),
(13, 4, 'Рентгенография', 380),
(14, 4, 'Маммография', 1080),
(15, 5, 'Регистрация электрической активности проводящей системы сердца с расшифровкой', 380),
(16, 5, 'Электроэнцефалография', 900),
(17, 5, ' 	Ультразвуковая допплерография артерий', 800),
(18, 5, 'Прием (осмотр, консультация) врача-акушера-гинеколога первичный', 495),
(19, 5, 'Общий (клинический) анализ крови', 265),
(20, 5, ' 	Исследование уровня глюкозы в крови', 180),
(21, 5, 'Анализ мочи общий', 180),
(22, 5, 'Рентгенография', 450),
(23, 5, 'Массаж', 300),
(24, 5, ' 	Прием (осмотр, консультация) врача-уролога первичный', 390),
(25, 6, 'Ультразвуковое исследование ', 250),
(26, 6, 'Прием (осмотр, консультация) врача', 550),
(27, 6, 'Исследование уровня глюкозы в крови', 170),
(28, 6, 'Исследование уровня общего белка в крови', 200),
(29, 6, 'Общий (клинический) анализ крови', 400),
(30, 6, 'Анализ мочи общий', 230),
(31, 6, 'Рентгенография', 400),
(32, 6, 'Внутривенное введение лекарственных средств', 180),
(33, 6, 'Наложение перевязки при нарушении целостности кожных покровов (после операции, снятие швов, снятие гипсовой повязки)', 400),
(34, 6, 'Биопсия желудка с помощью эндоскопии', 150),
(35, 3, 'Прием (осмотр, консультация) врача-хирурга ', 550),
(36, 1, 'Анализ мочи общий ', 320),
(37, 1, 'Ультразвуковое исследование мягких тканей (1 анатомическая единица)', 600),
(38, 1, 'Ультразвуковое исследование плода', 600),
(39, 1, 'Прием (осмотр, консультация) врача', 550),
(40, 1, 'Удаление доброкачественных новообразований кожи (до1см)', 2400),
(41, 1, 'Прием (осмотр, консультация) врача-стоматолога', 500),
(42, 1, 'Ларингоскопия видеоэндоскопическая ', 1650),
(43, 1, 'Аборт (медикаментозный) ', 8000),
(44, 1, 'Кольпоскопия (с помощью сканера TruScreen)', 1500),
(45, 3, 'Прием (осмотр, консультация) врача', 550),
(46, 3, 'азовое занятие с инструктором ЛФК в бассейне', 220),
(47, 3, 'Массаж предстательной железы', 500),
(48, 3, 'Внутримышечное, подкожное введение лекарств', 120),
(49, 3, ' Соляно-хвойные, йод-бромные, минеральные', 180),
(50, 3, 'Ультразвуковое исследование желчного пузыря', 300),
(51, 3, 'Ультразвуковое исследование молочных желез', 600),
(52, 3, 'Санитарные книжки', 1200),
(53, 3, 'Флюорография легких (грудной клетки) в 1 проекции', 350),
(54, 3, 'Промывание серных пробок (удаление ушной серы) ', 350),
(55, 7, 'Комплексное ультразвуковое иследование внутренних органов', 800),
(56, 7, 'Рентгенография  шейного отдела позвоночника', 350),
(57, 7, 'Осмотр (консультация) врача', 800),
(58, 7, 'Осмотр органа слуха (отоскопия) с введением лекарственных препаратов', 300),
(59, 7, 'Регистрация электрокардиограммы (с расшифровкой)', 600),
(60, 7, 'Внутримышечное введение лекарственных средств', 150),
(61, 7, 'Введение внутриматочной спирали', 750),
(62, 7, 'Получение секрета простаты', 300),
(63, 7, 'Дарсонвааль кожи', 400),
(64, 7, 'Постановка пиявок (гирудотерапия) - 1шт. (без стоимости пиявки', 200);

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_profiles`
--

CREATE TABLE IF NOT EXISTS `tbl_profiles` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `lastname` varchar(50) NOT NULL DEFAULT '',
  `middlename` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL DEFAULT '',
  `specialty` varchar(100) NOT NULL,
  `invite_code` varchar(60) NOT NULL,
  `degrees` varchar(255) NOT NULL,
  `subspecialties` varchar(1000) NOT NULL,
  `interests` varchar(5000) NOT NULL,
  `zipcode` varchar(5) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `tbl_profiles`
--

INSERT INTO `tbl_profiles` (`user_id`, `lastname`, `middlename`, `firstname`, `specialty`, `invite_code`, `degrees`, `subspecialties`, `interests`, `zipcode`) VALUES
(1, 'Admin', '', 'Administrator', '', '', '', '', '', '0'),
(2, 'ToAst', '', 'Tasty', 'Radiation Oncology', '', 'MD;PO;JD;MS', 'Breast Cancer;Gastrointestinal Cancers;Lymphomas and Leukemias;Melanoma/Skin;Radiation Biology;Stereotactic Radiosurgery', '<p style="text-align: justify; font-size: 11px; line-height: 14px; margin: 0px 0px 14px; padding: 0px; font-family: Arial, Helvetica, sans;"><em>Sed aliquet, nunc id tincidunt commodo, risus massa tincidunt purus, id dictum turpis diam in neque. Curabitur hendrerit mollis lectus, ac pretium enim blandit congue. In sagittis est et orci rutrum aliquet. Fusce sit amet viverra lectus. Duis vitae dolor feugiat, ultricies urna sit amet, auctor ipsum. Proin turpis erat, molestie sed posuere adipiscing, fermentum vel ligula. Vivamus ac ipsum pellentesque, scelerisque erat eu, sodales tellus. Pellentesque ultricies elit sit amet sem fermentum, ut sodales massa elementum. Donec porttitor vulputate neque. Donec porttitor quam nec semper luctus. Praesent nisl magna, viverra in lorem ut, molestie hendrerit nunc. Vivamus lorem nibh, sagittis id sem id, malesuada iaculis mi. Proin id neque ac est auctor facilisis.</em></p>\r\n<p style="text-align: justify; font-size: 11px; line-height: 14px; margin: 0px 0px 14px; padding: 0px; font-family: Arial, Helvetica, sans;"><strong>Nulla euismod nibh dolor, bibendum porttitor nunc volutpat dignissim. Vestibulum venenatis lacus eget aliquet ultrices. Vivamus eget dolor dictum, pulvinar turpis nec, posuere mauris. Quisque nec urna sit amet leo congue gravida et a lorem. Donec a tellus sit amet metus condimentum mollis consequat vitae lectus. Etiam tellus tellus, molestie nec commodo sit amet, vulputate a odio. Suspendisse eleifend, mi sed fermentum bibendum, est mauris commodo orci, in venenatis libero elit vitae tellus. Duis pharetra faucibus dui vel placerat. Morbi quis mauris tincidunt, sodales velit quis, ultricies purus. Ut pretium, quam quis fermentum iaculis, odio diam lacinia neque, in porttitor erat justo vitae orci.</strong></p>', '01566');

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_profiles_fields`
--

CREATE TABLE IF NOT EXISTS `tbl_profiles_fields` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `varname` varchar(50) NOT NULL,
  `title` varchar(255) NOT NULL,
  `field_type` varchar(50) NOT NULL,
  `field_size` varchar(15) NOT NULL DEFAULT '0',
  `field_size_min` varchar(15) NOT NULL DEFAULT '0',
  `required` int(1) NOT NULL DEFAULT '0',
  `match` varchar(255) NOT NULL DEFAULT '',
  `range` varchar(255) NOT NULL DEFAULT '',
  `error_message` varchar(255) NOT NULL DEFAULT '',
  `other_validator` varchar(5000) NOT NULL DEFAULT '',
  `default` varchar(255) NOT NULL DEFAULT '',
  `widget` varchar(255) NOT NULL DEFAULT '',
  `widgetparams` varchar(5000) NOT NULL DEFAULT '',
  `position` int(3) NOT NULL DEFAULT '0',
  `visible` int(1) NOT NULL DEFAULT '0',
  `class` varchar(50) NOT NULL,
  `list` varchar(500) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `varname` (`varname`,`widget`,`visible`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Дамп данных таблицы `tbl_profiles_fields`
--

INSERT INTO `tbl_profiles_fields` (`id`, `varname`, `title`, `field_type`, `field_size`, `field_size_min`, `required`, `match`, `range`, `error_message`, `other_validator`, `default`, `widget`, `widgetparams`, `position`, `visible`, `class`, `list`) VALUES
(1, 'lastname', 'Last Name', 'VARCHAR', '50', '3', 1, '', '', 'Incorrect Last Name (length between 3 and 50 characters).', '', '', '', '', 2, 3, '', ''),
(2, 'firstname', 'First Name', 'VARCHAR', '50', '3', 1, '', '', 'Incorrect First Name (length between 3 and 50 characters).', '', '', '', '', 0, 3, '', ''),
(3, 'middlename', 'Middle Name', 'VARCHAR', '50', '3', 2, '', '', 'Incorrect Middle Name (length between 3 and 50 characters).', '', '', '', '', 1, 3, '', ''),
(4, 'specialty', 'Specialty', 'VARCHAR', '50', '3', 1, '', 'Radiation Oncology', 'Incorrect Specialty (length between 3 and 50 characters).', '', 'Radiation Oncology', '', '', 4, 3, '', ''),
(5, 'invite_code', 'Invite Code', 'VARCHAR', '60', '3', 2, '', '', 'Incorrect Specialty (length between 3 and 60 characters).', '', '', '', '', 6, 3, '', ''),
(7, 'degrees', 'Degrees', 'VARCHAR', '', '', 0, '', '', '', '', '', '', '', 3, 1, '', 'MD;PO;PhD;MBA;MPH;JD;MS'),
(8, 'subspecialties', 'Subspecialties', 'VARCHAR', '', '', 0, '', '', '', '', '', '', '', 5, 1, '', 'Breast Cancer;Central Nervous System Tumors;Gastrointestinal Cancers;Genitourinary Cancers;Gynecological Cancers;Head and Neck Cancers;Lymphomas and Leukemias;Melanoma/Skin;Non-malignant desease;Palliation;Pediatric Cancers;Radiation Biology;Radiation Physics;Sarcomas - Cutaneous Tumor;Thoracic Malignancies;Brachytherapy;General Radiation Oncology;Stereotactic Body Radiotherapy;Stereotactic Radiosurgery'),
(9, 'interests', 'Interests and Specialization', 'TEXT', '', '', 0, '', '', '', '', '', '', '', 6, 1, '', ''),
(10, 'zipcode', 'Zip Code', 'VARCHAR', '5', '', 0, '', '', '', '', '', '', '', 7, 1, '', '');

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_questions`
--

CREATE TABLE IF NOT EXISTS `tbl_questions` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `text` text COLLATE utf8_unicode_ci NOT NULL,
  `detail` text COLLATE utf8_unicode_ci,
  `images` text COLLATE utf8_unicode_ci COMMENT 'serialized data',
  `author_id` bigint(20) NOT NULL COMMENT '-1 for anonymus user',
  `topics` int(32) DEFAULT NULL,
  `viewed` int(32) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=69 ;

--
-- Дамп данных таблицы `tbl_questions`
--

INSERT INTO `tbl_questions` (`id`, `text`, `detail`, `images`, `author_id`, `topics`, `viewed`, `create_at`) VALUES
(-1, 'one more test', '', '', 3, 1, 0, '2014-02-11 12:48:37'),
(1, 'k,kljkljk', '', NULL, 2, 10, 118, '2014-01-14 09:31:50'),
(2, 'new question goes here', '', NULL, 2, 11, 174, '2014-01-14 09:35:50'),
(3, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla ipsum justo, vestibulum et viverra eu, pellentesque bibendum urna? ', 'Aenean volutpat placerat tortor, vel varius dui lacinia quis. Interdum et malesuada fames ac ante ipsum primis in faucibus. ', NULL, 2, 13, 76, '2014-01-14 09:36:58'),
(4, 'iouio', '<p>ui</p>', NULL, 2, 5, 4, '2014-01-14 10:03:39'),
(5, 'hello world', '<p>details</p>', NULL, -1, 5, 27, '2014-01-14 10:09:23'),
(6, 'gfghfghfgh', 'gfhfghfghfgh', NULL, 2, NULL, 7, '2014-01-14 10:13:36'),
(7, 'yuyuyutyuyu', 'yutyutyutyutyutyutyu', NULL, 2, NULL, 1, '2014-01-14 10:13:46'),
(8, 'uyiuyiyuiuyioi', 'iouiouiouiouiou', NULL, -1, NULL, 2, '2014-01-14 10:14:06'),
(9, 'uiyuiuyiuyiuioiopopopp[', '', NULL, 2, NULL, 0, '2014-01-14 10:14:22'),
(10, 'private question', '', NULL, -1, 7, 39, '2014-01-14 19:45:26'),
(11, 'kjhkjhljkljkljk', '', NULL, 2, 0, 0, '2014-01-14 19:48:24'),
(12, 'kjhkjhljkljkljk', '', NULL, 2, 0, 0, '2014-01-14 19:49:35'),
(13, 'The first and formost question about anything, m?', '', NULL, -1, 10, 44, '2014-01-14 19:51:42'),
(14, 'nenenene', '', NULL, 2, 0, 0, '2014-01-14 19:52:11'),
(15, 'My question is about Sarcoma', 'nothing to add here', NULL, 19, 13, 53, '2014-01-27 09:38:57'),
(16, 'My first question', '', NULL, 19, 0, 1, '2014-01-27 13:13:31'),
(17, 'second question of Mandy', '', NULL, -1, 1, 0, '2014-01-27 12:15:59'),
(18, 'something', 'details here', NULL, -1, 0, 0, '2014-01-27 13:15:53'),
(19, 'kuiyuiy', 'iyuiouuio', NULL, -1, 0, 0, '2014-01-27 13:18:00'),
(20, 'долдолд', 'лдолдолд', NULL, -1, 14, 0, '2014-01-27 12:25:23'),
(21, 'hahahah', '', NULL, 19, 0, 0, '2014-01-27 14:08:02'),
(22, 'FAQ question', '', NULL, 19, 20, 0, '2014-01-27 13:09:30'),
(23, 'THIS IS A TEST QUESTION...', 'I WANT TO SEE IF THIS WILL WORK', NULL, 2, 2, 22, '2014-01-29 02:19:59'),
(24, 'ANOTHER QUESTION', 'NONE', NULL, 2, 2, 5, '2014-01-29 02:25:04'),
(25, 'my special question to Alina Maline', '', NULL, 2, 8, 0, '2014-02-11 10:57:00'),
(26, 'my particular question to Alina', '', NULL, 2, 1, 0, '2014-02-11 11:14:13'),
(27, 'to Tasty', '', NULL, 3, 1, 1, '2014-02-11 11:16:06'),
(28, 'to Alina', '', NULL, 2, 1, 1, '2014-02-11 11:18:23'),
(29, 'jkhjkjh', '', NULL, 3, 1, 0, '2014-02-11 11:53:38'),
(30, 'new with pics', '', NULL, 3, 1, 0, '2014-02-11 12:17:41'),
(31, 'new with pics', '', NULL, 3, 1, 0, '2014-02-11 12:20:27'),
(32, 'with pics', '', NULL, 3, 1, 0, '2014-02-11 12:30:13'),
(33, 'with pics', '', NULL, 3, 1, 0, '2014-02-11 12:30:34'),
(34, 'with pics', '', 'party.jpg;bear.jpg;', 3, 1, 0, '2014-02-11 12:30:50'),
(35, 'hjhk', '', 'party.jpg;cheers.jpg;', 3, 1, 0, '2014-02-11 12:34:09'),
(36, 'hjhk', '', 'party.jpg;cheers.jpg;', 3, 1, 0, '2014-02-11 12:34:43'),
(37, 'hjhk', '', 'party.jpg;cheers.jpg;', 3, 1, 0, '2014-02-11 12:37:01'),
(38, 'hjhk', '', NULL, 3, 1, 0, '2014-02-11 12:40:02'),
(39, 'hjhk', '', NULL, 3, 1, 0, '2014-02-11 12:40:14'),
(40, 'hjhk', '', 'party.jpg;cheers.jpg;', 3, 1, 0, '2014-02-11 12:40:30'),
(41, 'hjhk', '', 'party.jpg;cheers.jpg;', 3, 1, 0, '2014-02-11 12:41:12'),
(42, 'with incorrect picture', '', '', 3, 1, 0, '2014-02-11 12:42:44'),
(44, 'some', '', 'лися.jpg;', 3, 1, 0, '2014-02-11 12:46:29'),
(46, 'one more test', '', 'cute-kids.jpg;', 3, 1, 1, '2014-02-11 12:48:45'),
(48, 'ропрорп', '', 'oligrisochi2014.jpg;', 3, 1, 0, '2014-02-11 12:51:04'),
(50, 'олрол', '', 'cute-kids.jpg;', 3, 1, 0, '2014-02-11 12:52:59'),
(53, 'test', '', 'cute-kids.jpg;', 3, 1, 4, '2014-02-11 13:12:42'),
(60, 'test with incorrect pics', '', '', 3, 1, 0, '2014-02-11 13:23:52'),
(61, 'test test test', '', '', 3, 1, 0, '2014-02-11 13:24:25'),
(62, 'fghghgfjhhj', 'details', 'лися.jpg;cute-kids.jpg;', 3, 1, 9, '2014-02-11 13:24:52'),
(63, 'My next question with pictures', 'detail also goes here as always', 'Shanghai.jpg;sun_skiing.jpg;', 2, 1, 1, '2014-02-12 12:59:39'),
(64, 'One more new question with description, ok?', 'details for this question go here', 'маяк.jpg;Голуби на Приморском.jpg;забор.jpg;', 2, 1, 2, '2014-02-12 13:03:28'),
(65, 'Heres a good question', '', '', 21, 2, 17, '2014-02-22 21:06:09'),
(66, 'New question to test answers', 'some detail can go here', '', 2, 1, 3, '2014-02-24 12:14:07'),
(67, 'Test question of Head cancer', 'some new details go here', '', 2, 6, 2, '2014-02-24 12:16:58'),
(68, 'lklklkkl', 'lklkklklkkllklk', '', 2, 10, 1, '2014-02-28 01:26:01');

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_question_viewed`
--

CREATE TABLE IF NOT EXISTS `tbl_question_viewed` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `q_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=37 ;

--
-- Дамп данных таблицы `tbl_question_viewed`
--

INSERT INTO `tbl_question_viewed` (`id`, `user_id`, `q_id`) VALUES
(2, 2, 3),
(3, 18, 10),
(4, 18, 2),
(5, 19, 23),
(6, 18, 23),
(7, 5, 23),
(8, 1, 23),
(9, 2, 23),
(10, 2, 10),
(11, 2, 2),
(12, 19, 3),
(13, 19, 24),
(14, 2, 24),
(15, 2, 15),
(16, 19, 2),
(17, 2, 1),
(18, 2, 27),
(19, 3, 28),
(20, 3, 62),
(21, 3, 53),
(22, 3, 3),
(23, 3, 15),
(24, 2, 7),
(25, 2, 62),
(26, 2, 13),
(27, 2, 46),
(28, 0, 1),
(29, 2, 5),
(30, 2, 63),
(31, 2, 64),
(32, 21, 65),
(33, 2, 65),
(34, 2, 66),
(35, 2, 67),
(36, 2, 68);

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_services`
--

CREATE TABLE IF NOT EXISTS `tbl_services` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `clinic_id` int(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price_from` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Виды услуг' AUTO_INCREMENT=25 ;

--
-- Дамп данных таблицы `tbl_services`
--

INSERT INTO `tbl_services` (`id`, `clinic_id`, `name`, `price_from`) VALUES
(1, 1, 'Общий (клинический) анализ крови развернутый', '550'),
(2, 2, 'анализы крови', '600 руб.'),
(3, 4, 'ЭКГ', '190'),
(4, 5, 'Общий анализ крови', '180'),
(8, 1, 'Прием (осмотр, консультация) врача', '1200'),
(13, 1, 'Кольпоскопия (с помощью сканера TruScreen)', '1500'),
(14, 3, 'Прием (осмотр, консультация) врача', '550'),
(21, 3, 'Санитарные книжки', '1200'),
(22, 3, 'Флюорография легких (грудной клетки) в 1 проекции', '350'),
(23, 3, 'Промывание серных пробок (удаление ушной серы)', '350'),
(24, 7, '	Комплексное ультразвуковое иследование внутренних', '800');

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_topics`
--

CREATE TABLE IF NOT EXISTS `tbl_topics` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `text` text COLLATE utf8_unicode_ci NOT NULL,
  `author_id` bigint(20) DEFAULT NULL COMMENT '-1 for anonymus user',
  `viewed` int(32) DEFAULT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=21 ;

--
-- Дамп данных таблицы `tbl_topics`
--

INSERT INTO `tbl_topics` (`id`, `text`, `author_id`, `viewed`, `create_at`) VALUES
(1, 'Breast Cancer', NULL, 0, '2014-01-15 21:17:11'),
(2, 'Central Nervous System Tumors', NULL, 0, '2014-01-15 21:17:11'),
(3, 'Gastrointestinal Cancers', NULL, 0, '2014-01-15 21:17:11'),
(4, 'Genitourinary Cancers', NULL, 0, '2014-01-15 21:17:11'),
(5, 'Gynecological Cancers', NULL, 0, '2014-01-15 21:17:11'),
(6, 'Head and Neck Cancers', NULL, 0, '2014-01-15 21:17:11'),
(7, 'Lymphomas and Leukemias', NULL, 0, '2014-01-15 21:17:11'),
(8, 'Melanoma/Skin', NULL, 0, '2014-01-15 21:17:11'),
(9, 'Non-malignant desease', NULL, 0, '2014-01-15 21:17:11'),
(10, 'Palliation', NULL, 0, '2014-01-15 21:17:11'),
(11, 'Pediatric Cancers', NULL, 0, '2014-01-15 21:17:11'),
(12, 'Radiation Biology', NULL, 0, '2014-01-15 21:17:11'),
(13, 'Radiation Physics', NULL, 0, '2014-01-15 21:17:11'),
(14, 'Sarcomas - Cutaneous Tumor', NULL, 0, '2014-01-15 21:17:11'),
(15, 'Thoracic Malignancies', NULL, 0, '2014-01-15 21:17:11'),
(16, 'Brachytherapy', NULL, 0, '2014-01-15 21:17:11'),
(17, 'General Radiation Oncology', NULL, 0, '2014-01-15 21:17:11'),
(18, 'Stereotactic Body Radiotherapy', NULL, 0, '2014-01-15 21:17:11'),
(19, 'Stereotactic Radiosurgery', NULL, 0, '2014-01-15 21:17:11'),
(20, 'FAQ', NULL, 0, '2014-01-15 21:17:11');

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_triggers`
--

CREATE TABLE IF NOT EXISTS `tbl_triggers` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `verbiage` varchar(20) NOT NULL,
  `logo` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Дамп данных таблицы `tbl_triggers`
--

INSERT INTO `tbl_triggers` (`id`, `name`, `verbiage`, `logo`) VALUES
(1, 'Виды услуг', 'service', 'ab6b6.jpg'),
(2, 'Вид клиники', 'type', 'clinic_type.jpg'),
(3, 'Поле магнита', 'field', 'ab743.jpg'),
(4, 'Тип магнита', 'type_magnet', 'magnet_type.jpg'),
(5, 'Цена', 'price', '41931.jpg'),
(6, 'До 6 лет', 'kid', '1ab0d.jpg'),
(7, 'Без ограничения по весу', 'weight', '942bf.png'),
(8, 'Профиль клиники', 'speciality', 'clinic_profile.jpg'),
(9, 'Консультация врача', 'consult', 'consult.jpg'),
(10, 'Круглосуточно', 'all_time', '76e90.jpg'),
(11, 'Уровень врачей', 'profy', 'prof.jpg'),
(12, 'Количество срезов', 'slice', 'slice.jpg'),
(13, 'Специализированные исследования', 'not_routine', 'special.jpg'),
(14, 'уровень', 'uroven', 'd788f.jpg'),
(16, 'new', '', ''),
(17, 'new', '', '');

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_trigger_values`
--

CREATE TABLE IF NOT EXISTS `tbl_trigger_values` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `trigger_id` int(20) NOT NULL,
  `value` varchar(255) NOT NULL,
  `verbiage` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=57 ;

--
-- Дамп данных таблицы `tbl_trigger_values`
--

INSERT INTO `tbl_trigger_values` (`id`, `trigger_id`, `value`, `verbiage`) VALUES
(1, 1, 'МРТ', 'mrt'),
(2, 1, 'КТ', 'kt'),
(3, 1, 'Маммография', ''),
(4, 1, 'УЗИ!', ''),
(5, 1, 'ПЭТ', ''),
(6, 1, 'ОФЭКТ', ''),
(7, 1, 'Гамма нож', ''),
(8, 2, 'Частная клиника', ''),
(9, 2, 'Государственная клиника', ''),
(10, 3, '0.2 Тл', ''),
(11, 3, '0.35 Тл', ''),
(12, 3, '0.4 Тл', ''),
(13, 3, '0.5 Тл', ''),
(14, 3, '1 Тл', ''),
(15, 3, '1.5 Тл', ''),
(16, 3, '3 Тл', ''),
(17, 4, 'Открытый магнит', ''),
(18, 4, 'Закрытый магнит', ''),
(19, 5, 'Высокая цена', ''),
(20, 5, 'Средняя цена', ''),
(21, 5, 'Низкая цена', ''),
(22, 6, 'До 6 лет', ''),
(23, 6, '6 лет и старше', ''),
(24, 7, 'Вес до 100 кг', ''),
(25, 7, 'Вес до 150 кг', ''),
(26, 7, 'Вес до 200 кг', ''),
(27, 8, 'Онкология', 'onko'),
(28, 8, 'Травматология', 'traumatology'),
(29, 8, 'Урология', 'urol'),
(30, 9, 'Консультация врача', ''),
(31, 9, 'Без консультации врача', ''),
(32, 10, 'Круглосуточно', ''),
(33, 10, 'Не круглосуточно', ''),
(34, 12, '2', ''),
(35, 12, '4', ''),
(36, 12, '16', ''),
(37, 12, '32', ''),
(38, 12, '64', ''),
(39, 12, '128', ''),
(40, 12, '256', ''),
(41, 12, '320', ''),
(42, 11, 'Низкий', ''),
(43, 11, 'Средний', ''),
(44, 11, 'Высокий', ''),
(45, 11, 'Профи', ''),
(46, 13, 'МРТ сердца', ''),
(47, 13, 'Виртуальная колоноскопия', ''),
(48, 14, 'Уровень', 'uroven'),
(49, 15, 'Хорошие', ''),
(50, 15, 'Лучшие', ''),
(51, 15, 'супер профи', ''),
(52, 2, 'по ОМС', ''),
(53, 4, 'средний', ''),
(54, 8, 'Терапия', 'therapy'),
(55, 8, 'Гинекология', 'gineologiya'),
(56, 8, 'Стоматология', 'stomatologiya');

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_users`
--

CREATE TABLE IF NOT EXISTS `tbl_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `clinic_id` int(22) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `superuser` int(1) NOT NULL DEFAULT '0',
  `active` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `status` (`active`),
  KEY `superuser` (`superuser`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Дамп данных таблицы `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `username`, `password`, `email`, `clinic_id`, `create_at`, `superuser`, `active`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'webmaster@example.com', 0, '2014-01-03 10:12:08', 1, 1),
(2, 'demo', '2f7b52aacfbf6f44e13d27656ecb1f59', 'demo@example.com', 14, '2014-01-03 10:12:08', 0, 1),
(11, 'Ivan', '76d80224611fc919a5d54f0ff9fba446', '', 3, '2015-02-20 19:16:10', 0, 1),
(12, 'Victor', '76d80224611fc919a5d54f0ff9fba446', '', 3, '2015-02-20 19:38:36', 0, 1),
(13, 'new123', '202cb962ac59075b964b07152d234b70', '', 5, '2015-03-10 21:57:29', 0, 1),
(14, 'Olga123', '200820e3227815ed1756a6b531e7e0d2', '', 7, '2015-03-16 18:29:52', 0, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_users_`
--

CREATE TABLE IF NOT EXISTS `tbl_users_` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `profile_picture` varchar(500) NOT NULL,
  `activkey` varchar(128) NOT NULL DEFAULT '',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lastvisit_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `superuser` int(1) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `status` (`status`),
  KEY `superuser` (`superuser`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `tbl_users_`
--

INSERT INTO `tbl_users_` (`id`, `username`, `password`, `email`, `profile_picture`, `activkey`, `create_at`, `lastvisit_at`, `superuser`, `status`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'webmaster@example.com', '', '9a24eff8c15a6a141ece27eb6947da0f', '2014-01-03 10:12:08', '2014-01-24 12:42:08', 1, 1),
(2, 'demo', 'b59c67bf196a4758191e42f76670ceba', 'demo@example.com', '2.jpg', '70ff2edacc41a5df39ef345531ccf5b0', '2014-01-03 10:12:08', '2014-02-28 09:26:53', 0, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_user_notifications`
--

CREATE TABLE IF NOT EXISTS `tbl_user_notifications` (
  `user_id` int(255) NOT NULL,
  `follow_me` int(1) NOT NULL DEFAULT '0',
  `comment_on_question` int(1) NOT NULL DEFAULT '0',
  `answer_to_question` int(1) NOT NULL DEFAULT '0',
  `vote_on_answer` int(1) NOT NULL DEFAULT '0',
  `private_message` int(1) NOT NULL DEFAULT '0',
  `newsletter_sent` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tbl_user_notifications`
--

INSERT INTO `tbl_user_notifications` (`user_id`, `follow_me`, `comment_on_question`, `answer_to_question`, `vote_on_answer`, `private_message`, `newsletter_sent`) VALUES
(0, 0, 0, 0, 0, 0, 0),
(2, 0, 0, 0, 0, 0, 0),
(19, 0, 0, 0, 0, 0, 0);

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `tbl_profiles`
--
ALTER TABLE `tbl_profiles`
  ADD CONSTRAINT `user_profile_id` FOREIGN KEY (`user_id`) REFERENCES `tbl_users_` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
