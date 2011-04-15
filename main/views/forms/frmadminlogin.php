<?= form_open($this->uri->uri_string(),array('id'=>'formauth','class'=>'formular')); ?>
	<div class="grid_12">
		<div class="box">
			<div class="box-header">
				<h2>Введите логин и пароль</h2>
			</div>
			<div class="box-content h150 w918">
				<b>E-mail:</b> <span class="necessarily" title="Поле не может быть пустым">*</span><br/>
				<input class="reg-form-input" id="loginName" type="text" name="login-name" value="" />
				<div class="clear"></div>
				<b>Пароль:</b> <span class="necessarily" title="Поле не может быть пустым">*</span><br/>
				<input class="reg-form-input" id="loginPass" type="password" name="login-pass" value="" />
				<div class="clear"></div><br/>
				<input type="submit" class="lnk-submit" name="submit" id="lnk-login" value="Авторизоваться"/>
			</div>
		</div>
	</div>
	<div class="clear"></div>
<?= form_close(); ?>