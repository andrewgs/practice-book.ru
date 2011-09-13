<?= form_open($this->uri->uri_string(),array('id'=>'formAddRegion','class'=>'formular')); ?>
	<div id="formRep" style="border-top: 2px solid #D0D0D0; border-bottom: 2px solid #D0D0D0; margin-top:15px;">
		<label class="label-input">Название: <span class="necessarily" title="Поле не может быть пустым">*</span></label>
		<?= form_error('title'); ?>
		<input class="edit-form-input inpvalue" id="title" name="title" type="text" value="<?=set_value('title');?>"/>
		<div class="clear"></div>
		<label class="label-input">ID главной отрасли <span class="necessarily" title="Поле не может быть пустым">*</span></label>
		<?= form_error('parentid'); ?>
		<input class="reg-form-small inpvalue parentid" id="parentid" name="parentid" type="text" value="<?=set_value('parentid');?>"/>
		<div class="clear"></div>
		<label class="label-input">Полное название <span class="necessarily" title="Поле не может быть пустым">*</span></label>
		<?= form_error('full'); ?>
		<input class="edit-form-input inpvalue" id="full" name="full" type="text" value="<?=set_value('full');?>"/>
		<div class="clear"></div>
		<label class="label-input">Признак конца (0|1) <span class="necessarily" title="Поле не может быть пустым">*</span></label>
		<?= form_error('final'); ?>
		<input class="reg-form-small inpvalue final" id="final" name="final" type="text" value="<?=set_value('final');?>"/>
		<div class="clear"></div>
		<label class="label-input">Бизнес среда<span class="necessarily" title="Поле не может быть пустым">*</span></label>
		<?= form_error('environment'); ?>
		<select name="environment" id="environment" class="mixed-combo" size="1" style="width: 200px;">
			<option value="0" <?=set_select('environment','0',TRUE);?>>Общая среда</option>
			<option value="1" <?=set_select('environment','1');?>>Полноценная среда</option>
		</select>
		<div class="clear"></div>
		<input class="btn-action margin-1em" id="addItem" type="submit" name="submit" value="Добавить"/>
	</div>
	<div class="clear"></div>
<?= form_close(); ?>