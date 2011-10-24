<?= form_open_multipart($this->uri->uri_string(),array('id'=>'formSignup','class'=>'formular')); ?>
	<div class="grid_12">
		<hr size="2"/>
		<div class="grid_5">
			<label class="label-input">E-mail (логин) <span class="necessarily" title="Поле не может быть пустым">*</span></label>
			<?= form_error('login'); ?>
			<input class="reg-form-input inpval" id="email" name="login" type="text" value="<?=set_value('login');?>"/>
			<label class="label-input">Пароль <span class="necessarily" title="Поле не может быть пустым">*</span></label>
			<?= form_error('password'); ?>
			<input class="reg-form-input inpval pass" type="password" name="password" id="password" value="<?=set_value('password');?>"/>
			<label class="label-input">Подтвердите пароль <span class="necessarily" title="Поле не может быть пустым">*</span></label>
			<?= form_error('confirmpass'); ?>
			<input class="reg-form-input inpval pass" type="password" name="confirmpass" id="confirm" value="<?=set_value('confirmpass');?>"/>
			<label class="label-input">Фото представителя</label>
			<?= form_error('userfile'); ?>
			<input class="reg-form-input" type="file" name="userfile" accept="image/jpeg,png,gif" size="32"/>
			<div class="form-reqs" style="width:275px;">Поддерживаемые форматы: JPG, GIF, PNG</div>
		</div>
		<div class="grid_5 prefix_1">
			<label class="label-input">Фамилия <span class="necessarily" title="Поле не может быть пустым">*</span></label>
			<?= form_error('fname'); ?>
			<input class="reg-form-input inpval" name="fname" type="text" value="<?=set_value('fname');?>"/>
			<label class="label-input">Имя <span class="necessarily" title="Поле не может быть пустым">*</span></label>
			<?= form_error('sname'); ?>
			<input class="reg-form-input inpval" name="sname" type="text" value="<?=set_value('sname');?>"/>
			<label class="label-input">Отчество <span class="necessarily" title="Поле не может быть пустым">*</span></label>
			<?= form_error('tname'); ?>
			<input class="reg-form-input inpval" name="tname" type="text" value="<?=set_value('tname');?>"/>
			<label class="label-input">Отдел, служба <span class="necessarily" title="Нужно указать">*</span></label>
			<?= form_error('department'); ?>
			<select name="department" id="department" class="mixed-combo inpval" size="1" style="width:285px; padding: 5px;">
				<option value="0" disabled="disabled" selected="selected">Выберите отдел</option>
			<?php for($i=0;$i<count($departments);$i++):?>
				<option value="<?=$departments[$i]['dep_id'];?>" <?=set_select('department',$departments[$i]['dep_id']);?>>
					<?=$departments[$i]['dep_title'];?>
				</option>
			<?php endfor; ?>
			</select>
			<label class="label-input">Должность в компании <span class="necessarily" title="Поле не может быть пустым">*</span></label>
			<?= form_error('position'); ?>
			<input class="reg-form-input inpval" name="position" type="text" value="<?=set_value('position');?>"/>
			<label class="label-input">Номер телефона <span class="necessarily" title="Поле не может быть пустым">*</span></label>
			<?= form_error('phones'); ?>
			<input class="reg-form-input inpval number" name="phones" type="text" value="<?=set_value('phones');?>"/>
		</div>
		<div class="clear"></div>
		<hr size="2"/>
		<input class="btn-action margin-1em" id="next" type="submit" name="submit" value="Завершить регистрацию"/>
	</div>
	<div class="clear"></div>
<?= form_close(); ?>