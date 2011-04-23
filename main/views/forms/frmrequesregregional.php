<?= form_open($this->uri->uri_string(),array('id'=>'formAddPitFalls','class'=>'formular')); ?>
	<input type="hidden" name="actValue" value="<?=set_value('actValue');?>" id="activityValue" />
	<div class="grid_4">
		<label class="label-input">E-Mail <span class="necessarily" title="Поле не может быть пустым">*</span></label>
		<?= form_error('login'); ?>
		<input class="reg-form-input inputValid" id="email" name="login" type="text" maxlength="100" value="<?=set_value('login');?>"/>
		<label class="label-input">Фамилия <span class="necessarily" title="Поле не может быть пустым">*</span></label>
		<?= form_error('fname'); ?>
		<input class="reg-form-input inputValid" name="fname" type="text" maxlength="100" value="<?=set_value('fname');?>"/>
		<label class="label-input">Имя (полностью) <span class="necessarily" title="Поле не может быть пустым">*</span></label>
		<?= form_error('sname'); ?>
		<input class="reg-form-input inputValid" name="sname" maxlength="100" type="text" value="<?=set_value('sname');?>"/>
		<label class="label-input">Ваше Отчество <span class="necessarily" title="Поле не может быть пустым">*</span></label>
		<?= form_error('tname'); ?>
		<input class="reg-form-input inputValid" name="tname" type="text" maxlength="100" value="<?=set_value('tname');?>"/>
	</div>
	<div class="grid_4 prefix_2">
		<label class="label-input">Номер контактного телефона <span class="necessarily" title="Поле не может быть пустым">*</span></label>
		<?= form_error('phones'); ?>
		<input class="reg-form-input inputValid" name="phones" maxlength="100" type="text" value="<?=set_value('phones');?>"/>
		<label class="label-input">Семейное положение <span class="necessarily" title="Поле не может быть пустым">*</span></label>
		<?= form_error('status'); ?>
		<input class="reg-form-input inputValid" name="status" type="text" maxlength="45" value="<?=set_value('status');?>"/>
		<label class="label-input">Образование(научная степень) <span class="necessarily" title="Поле не может быть пустым">*</span></label>
		<?= form_error('education'); ?>
		<input class="reg-form-input inputValid" name="education" type="text" maxlength="45" value="<?=set_value('education');?>"/>
		<label class="label-input">Дата вашего рождения <span class="necessarily" title="Поле не может быть пустым">*</span></label>
		<?= form_error('birthday'); ?>
		<input class="reg-form-input inputValid" name="birthday" type="text" maxlength="100" value="<?=set_value('birthday');?>"/>
		
	</div>
	<div class="clear"></div>
	<div class="grid_12">
		<hr size="2px"/>
		<label class="label-input">Место проживания (область/край,город) <span class="necessarily" title="Поле не может быть пустым">*</span></label>
		<?= form_error('region'); ?>
		<input class="edit750-form-input inputValid" name="region" type="text" maxlength="200" value="<?=set_value('region');?>"/>
		<label class="label-input">Ваш опыт работы <span class="necessarily" title="Поле не может быть пустым">*</span></label>
		<?= form_error('experience'); ?>
		<textarea class="edit750-form-textarea inputValid" name="experience" cols="20" rows="10"><?=set_value('experience');?></textarea>
		<div class="clear"></div>
		<hr size="2px"/>
	</div>
	<div class="grid_12">
		<label class="label-input">Укажите вашу сферу деятельности <span class="necessarily" title="Поле не может быть пустым">*</span></label>
		<?= form_error('newactivity'); ?>
		<input class="edit450-form-input inputValid" name="newactivity" id="newactivity" type="text" maxlength="45" value="<?=set_value('newactivity');?>"/>
		<div class="clear"></div>
		<label class="label-input">или выбирите из списка</label>
		<div class="clear"></div>
		<input type="hidden" name="activity" value="" id="activityValue" />
		<div class="activityList" aSelect="1">
			<?php $this->load->view('users_interface/activity-box-select'); ?>
		</div>
		<div class="clear"></div>
		<input class="btn-action margin-1em" id="sentRequest" type="submit" name="submit" value="Отослать заявку"/>
	</div>
<?= form_close(); ?>
