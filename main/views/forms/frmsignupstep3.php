<?= form_open_multipart($formaction,array('id'=>'formSignup','class'=>'formular')); ?>
	<h1>Данные представителя компании</h1>
	<div class="grid_12">
		<label class="label-input">Регистрация представителя компании на сайте:</label> 
		<div class="grid_4">
			<label class="label-input">E-Mail для авторизации на сайте <span class="necessarily" title="Поле не может быть пустым">*</span></label>
			<?= form_error('login'); ?>
			<input class="validate[required,custom[email]] reg-form-input" id="email" name="login" type="text" value="<?=set_value('login');?>"/>
			<label class="label-input">Ваш пароль <span class="necessarily" title="Поле не может быть пустым">*</span></label>
			<?= form_error('password'); ?>
			<input class="validate[required,length[6,20]] reg-form-input" type="password" name="password" id="password" value="<?=set_value('password');?>"/>
			<label class="label-input">Повторите пароль <span class="necessarily" title="Поле не может быть пустым">*</span></label>
			<?= form_error('confirmpass'); ?>
			<input class="validate[required,confirm[password]] reg-form-input" type="password" name="confirmpass" value="<?=set_value('confirmpass');?>"/>
			<label class="label-input">Фото представителя</label>
			<?= form_error('userfile'); ?>
			<input class="reg-form-input" type="file" name="userfile" accept="image/jpeg,png,gif" size="30"/> 
			<div class="form-reqs">Поддерживаемые форматы: JPG, GIF, PNG</div>
		</div>
		<div class="grid_4 prefix_2">
			<label class="label-input">Введите Фамилию <span class="necessarily" title="Поле не может быть пустым">*</span></label>
			<?= form_error('fname'); ?>
			<input class="validate[required,custom[onlyLetter],length[0,50]] reg-form-input" name="fname" type="text" value="<?=set_value('fname');?>"/>
			<label class="label-input">Введите Имя <span class="necessarily" title="Поле не может быть пустым">*</span></label>
			<?= form_error('sname'); ?>
			<input class="validate[required,custom[onlyLetter],length[0,50]] reg-form-input" name="sname" type="text" value="<?=set_value('sname');?>"/>
			<label class="label-input">Введите Отчество <span class="necessarily" title="Поле не может быть пустым">*</span></label>
			<?= form_error('tname'); ?>
			<input class="validate[required,custom[onlyLetter],length[0,50]] reg-form-input" name="tname" type="text" value="<?=set_value('tname');?>"/>
			<label class="label-input">Должность в компании <span class="necessarily" title="Поле не может быть пустым">*</span></label>
			<?= form_error('position'); ?>
			<input class="validate[required,length[0,30]] reg-form-input" name="position" type="text" value="<?=set_value('position');?>"/>
			<label class="label-input">Введите номер контактного телефона <span class="necessarily" title="Поле не может быть пустым">*</span></label>
			<?= form_error('phones'); ?>
			<input class="validate[required,custom[telephone]] reg-form-input" name="phones" type="text" value="<?=set_value('phones');?>"/>
		</div>
		<div class="clear"></div>
		<input class="btn-action margin-1em" type="submit" name="submit" value="Завершить регистрацию"/>
	</div>
	<div class="clear"></div>
<?= form_close(); ?>