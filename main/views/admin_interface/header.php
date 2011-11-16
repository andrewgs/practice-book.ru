<header role="contentinfo">
	<div class="container_12">
		<div id="company-logo">	</div>
		<div class="clear"></div>
		<ul id="admin-navigation">
			<li>
				<a href="javascript:void(0);">Управление</a>
				<ul>
					<li><?=anchor('admin/edit-activity/'.$userinfo['uconfirmation'],'Управление отраслью');?></li>
					<li><?=anchor('admin/manage-whomain/'.$userinfo['uconfirmation'],'Управление аукционами "Кто главный?"');?></li>
				</ul>
			</li>
			<li>
				<a href="javascript:void(0);">Содержание страниц</a>
				<ul>
					<li><?=anchor('admin/page-content/'.$userinfo['uconfirmation'].'/main','Страница "Главная"');?></li>
					<li><?=anchor('admin/page-content/'.$userinfo['uconfirmation'].'/information','Страница "Партнерам"');?></li>
					<li><?=anchor('admin/page-content/'.$userinfo['uconfirmation'].'/dilers','Страница "Дилерам"');?></li>
					<li><?=anchor('admin/page-content/'.$userinfo['uconfirmation'].'/jobs','Страница "Работа"');?></li>
					<li><?=anchor('admin/page-content/'.$userinfo['uconfirmation'].'/about','Страница "О проекте"');?></li>
					<li><?=anchor('admin/page-content/'.$userinfo['uconfirmation'].'/license','Страница "Пользовательское соглашение"');?></li>
			<li><?=anchor('admin/page-content/'.$userinfo['uconfirmation'].'/conditions-cooperation','Страница "Условия сотрудничества"');?></li>
					<li><?=anchor('admin/page-content/'.$userinfo['uconfirmation'].'/no-activity','Страница "Отсутствие услуги"');?></li>
				</ul>
			</li>
			<li>
				<a href="javascript:void(0);">Страница отрасли</a>
				<ul>
					<li><?=anchor('admin/activity-content/'.$userinfo['uconfirmation'].'/product','Продукт отрасли');?></li>
					<li><?=anchor('admin/activity-content/'.$userinfo['uconfirmation'].'/pitfalls','Подводные камни');?></li>
					<li><?=anchor('admin/activity-content/'.$userinfo['uconfirmation'].'/questions','Вопросы по отрасли');?></li>
					<li><?=anchor('admin/activity-content/'.$userinfo['uconfirmation'].'/tips','Советы по отрасли');?></li>
					<li><?=anchor('admin/activity-content/'.$userinfo['uconfirmation'].'/price','Прайс-координатор');?></li>
					<li><?=anchor('admin/activity-content/'.$userinfo['uconfirmation'].'/tender','Тендер');?></li>
					<li><?=anchor('admin/activity-content/'.$userinfo['uconfirmation'].'/company','Компании отрасли');?></li>
					<li><?=anchor('admin/activity-content/'.$userinfo['uconfirmation'].'/news','Новости');?></li>
					<li><?=anchor('admin/activity-content/'.$userinfo['uconfirmation'].'/manager','Прайс-менеджер');?></li>
					<li><?=anchor('admin/activity-content/'.$userinfo['uconfirmation'].'/consultation','Консультации');?></li>
					<li><?=anchor('admin/activity-content/'.$userinfo['uconfirmation'].'/persona','Персона');?></li>
					<li><?=anchor('admin/activity-content/'.$userinfo['uconfirmation'].'/whomain','Кто главный?');?></li>
					<li><?=anchor('admin/activity-content/'.$userinfo['uconfirmation'].'/documents','Документооборот');?></li>
					<li><?=anchor('admin/activity-content/'.$userinfo['uconfirmation'].'/specials','Новинки и скидки');?></li>
				</ul>
			</li>
			<li>
				<a href="javascript:void(0);">Информационные списки</a>
				<ul>
					<li><?=anchor('admin/information-list/'.$userinfo['uconfirmation'].'/regions','Список регионов');?></li>
					<li><?=anchor('admin/information-list/'.$userinfo['uconfirmation'].'/activity','Список отраслей');?></li>
					<li><?=anchor('admin/information-list/'.$userinfo['uconfirmation'].'/department','Список отделов');?></li>
					<li><?=anchor('admin/information-list/'.$userinfo['uconfirmation'].'/company','Список компаний');?></li>
					<li><?=anchor('admin/information-list/'.$userinfo['uconfirmation'].'/groups','Список групп продуктов');?></li>
					<li><?=anchor('admin/information-list/'.$userinfo['uconfirmation'].'/dielers','Список дилеров');?></li>
					<li><?=anchor('admin/information-list/'.$userinfo['uconfirmation'].'/users/admins','Список администраторов');?></li>
					<li><?=anchor('admin/information-list/'.$userinfo['uconfirmation'].'/users/federals','Список фед.менеджеров');?></li>
					<li><?=anchor('admin/information-list/'.$userinfo['uconfirmation'].'/users/regionals','Список рег.менеджеров');?></li>
					<li><?=anchor('admin/information-list/'.$userinfo['uconfirmation'].'/users/representatives','Список предc.компаний');?></li>
				</ul>
			</li>
			<li>
				<a href="javascript:void(0);">Администрирование</a>
				<ul>
					<li><?=anchor('admin/registration/'.$userinfo['uconfirmation'].'/federal','Добавление федерального менеджера');?></li>
					<li><?=anchor('admin/registration/'.$userinfo['uconfirmation'].'/regional','Добавление регионального менеджера');?></li>
					<li><?=anchor('admin/registration/'.$userinfo['uconfirmation'].'/administrator','Добавление администратора');?></li>
					<li><?=anchor('admin/registration/'.$userinfo['uconfirmation'].'/dealer','Добавление дилера');?></li>
					<li><?=anchor('admin/cabinet/'.$userinfo['uconfirmation'],'Личный кабинет');?></li>
					<li><?=anchor('admin/shutdown/'.$userinfo['uconfirmation'],'Завершить сеанс');?></li>
				</ul>
			</li>
		</ul>
	</div>
</header>