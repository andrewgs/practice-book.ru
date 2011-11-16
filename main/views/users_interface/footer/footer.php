<footer class="footer-wrap" role="contentinfo">
	<nav>
		<div class="centerizer w520">
			<ul class="bottom-nav">
				<li><?= anchor('','Главная'); ?></li>
				<li><div id="contact-form"><?= anchor('#','Техподдержка',array('id'=>'Support')); ?></div></li>
				<li><?= anchor('job','Работа'); ?></li>
				<li><?= anchor('conditions-cooperation','Условия сотрудничества'); ?></li>
				<li><?= anchor('contacts','Контакты'); ?></li>
			</ul>
		</div>
	</nav>
	<div class="copyright">
		<div class="centerizer w940">
			<p>© 2011 PRACTICE BOOK  Все права защищены. Полное или частичное копирование материалов запрещено.
			<?= anchor('license','Пользовательское соглашение',array('id'=>'lnk-license')); ?></p>
		</div>
	</div>
</footer>