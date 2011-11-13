<?= form_open('lost-password',array('class'=>'formular','id'=>'formLostPassword')); ?>
	<div class="box">
		<div class="box-header"><b>Забыли свой пароль?</b>
			<div class="box-search" id="error">&nbsp;</div>
		</div>
		<div class="box-content w575">
			<span>Введите адрес электронной почты,<br/>который Вы использовали при регистрации в Practice-book.</span>
			<hr style="width:420px;"/>
			<input class="reg-form-input" id="uemail" name="uemail" type="text" placeholder="Введите E-mail" value="" title="Введите Ваш E-mail для воостановления пароля"/>
			<input class="btn-action" id="getpassword" type="submit" name="submit" value="Получить пароль"/>
			<div class="clear"></div>
		</div>
		<div class="box-bottom-links h20">
			&nbsp;
			<div class="clear"></div>
		</div>
	</div>
<?= form_close(); ?>