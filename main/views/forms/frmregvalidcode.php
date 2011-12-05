<?= form_open('registering',array('class'=>'formular','id'=>'formValidCode')); ?>
	<div class="box">
		<div class="box-header"><b>Проверка кода регистрации компании</b>
			<div class="box-search">&nbsp;</div>
		</div>
		<div class="box-content w575">
			<input class="reg-form-input" id="code" name="code" type="text" placeholder="Введите код" value="" title="Введите полученный от дилера код"/>
			<input class="btn-action" id="next" type="submit" name="submit" value="Продолжить"/>
			<div class="clear"></div>
		</div>
		<div class="box-bottom-links h20">
			<?=anchor('dealers-list','У Вас нет кода?');?>
			<div class="clear"></div>
		</div>
	</div>
<?= form_close(); ?>