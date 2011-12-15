<?= form_open($this->uri->uri_string(),array('id'=>'formAddPitFalls','class'=>'formular')); ?>
	<input type="hidden" name="actValue" value="<?=set_value('actValue');?>" id="activityValue" />
	<div class="grid_4">
		<label class="label-input">E-Mail <span class="necessarily" title="Поле не может быть пустым">*</span></label>
		<?= form_error('login'); ?>
		<input class="reg-form-input inputValid" id="email" name="login" type="text" maxlength="100" value="<?=set_value('login');?>"/>
		<label class="label-input">Имя (полностью) <span class="necessarily" title="Поле не может быть пустым">*</span></label>
		<?= form_error('name'); ?>
		<input class="reg-form-input inputValid" name="name" type="text" maxlength="100" value="<?=set_value('name');?>"/>
	</div>
	<div class="grid_4 prefix_2">
		<label class="label-input">Номер контактного телефона <span class="necessarily" title="Поле не может быть пустым">*</span></label>
		<?= form_error('phones'); ?>
		<input class="reg-form-input inputValid number" name="phones" maxlength="100" type="text" value="<?=set_value('phones');?>"/>
		<label class="label-input">Название компании (если есть)</label>
		<?= form_error('company'); ?>
		<input class="reg-form-input" name="company" maxlength="100" type="text" value="<?=set_value('company');?>"/>
		<label class="label-input">Количество человек в отделе продаж</label>
		<?= form_error('count'); ?>
		<input class="reg-form-input" name="count" maxlength="100" type="text" value="<?=set_value('count');?>"/>
	</div>
	<div class="clear"></div>
	<div class="grid_12">
		<hr size="2px"/>
		<label class="label-input">Город Вашей деятельности</label>
		<?=form_error('city');?>
		<select id="regions" class="mixed-combo" name="region" size="1" style="width:285px; padding: 5px;">
		<?php for($i=0;$i<count($regions);$i++):?>
		<option value="<?=$regions[$i]['reg_id'];?>"<?=set_select('region',$regions[$i]['reg_id']);?>><?=$regions[$i]['reg_name'];?></option>
		<?php endfor; ?>
		</select>
		<div class="clear"></div>
		<label class="label-input">Комментарий</label>
		<?= form_error('note'); ?>
		<textarea class="edit750-form-textarea" name="note" cols="20" rows="10"><?=set_value('note');?></textarea>
		<div class="clear"></div>
		<hr size="2px"/>
	</div>
	<div class="grid_12">
		<div class="clear"></div>
		<input class="btn-action margin-1em" id="sentRequest" type="submit" name="submit" value="Отослать заявку"/>
	</div>
<?= form_close(); ?>
