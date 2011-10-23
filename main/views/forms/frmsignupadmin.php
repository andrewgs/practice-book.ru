<?= form_open_multipart($this->uri->uri_string(),array('id'=>'formmanauth','class'=>'formular')); ?>
	<hr size="2px"/>
	<div class="grid_4">
		<div class="regLabel">Логин (E-mail) <span class="necessarily" title="Обязательно нужно указать">*</span></div>
		<?= form_error('login'); ?>
		<input class="reg-form-input inputValid" id="email" name="login" type="text" value="<?=set_value('login');?>"/>
		<div class="regLabel">Пароль</div>
		<input class="reg-form-input" readonly="readonly" type="text" name="password" id="password" value="administrator"/>
	</div>
	<div class="grid_4 prefix_2">
		<div class="regLabel">Фамилия <span class="necessarily" title="Обязательно нужно указать">*</span></div>
		<?= form_error('fname'); ?>
		<input class="reg-form-input inputValid" name="fname" type="text" value="<?=set_value('fname');?>"/>
		<div class="regLabel">Имя (полностью) <span class="necessarily" title="Обязательно нужно указать">*</span></div>
		<?= form_error('sname'); ?>
		<input class="reg-form-input inputValid" name="sname" type="text" value="<?=set_value('sname');?>"/>
		<div class="regLabel">Отчество <span class="necessarily" title="Обязательно нужно указать">*</span></div>
		<?= form_error('tname'); ?>
		<input class="reg-form-input inputValid" name="tname" type="text" value="<?=set_value('tname');?>"/>
		<div class="regLabel">Номер контактного телефона <span class="necessarily" title="Обязательно нужно указать">*</span></div>
		<?= form_error('phones'); ?>
		<input class="reg-form-input inputValid" name="phones" type="text" value="<?=set_value('phones');?>"/>
		<div class="regLabel">Номер ICQ</div>
		<?= form_error('icq'); ?>
		<input class="reg-form-input" name="icq" type="text" size="45" maxlength="15" value="<?=set_value('icq');?>"/>
		<div class="regLabel">Логин Skype</div>
		<?= form_error('skype'); ?>
		<input class="reg-form-input" name="skype" type="text" size="45" maxlength="45" value="<?=set_value('skype');?>"/>
	</div>
	<div class="clear"></div>
	<input class="btn-action margin-1em" type="submit" id="btnSubmit" name="submit" value="Зарегистрировать"/>
	<input class="btn-action margin-1em" type="button" id="btnReturn" value="Отменить"/>
<?= form_close(); ?>
