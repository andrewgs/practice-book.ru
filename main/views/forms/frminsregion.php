<?= form_open($this->uri->uri_string(),array('id'=>'formAddRegion','class'=>'formular')); ?>
	<div id="formRep" style="border-top: 2px solid #D0D0D0; border-bottom: 2px solid #D0D0D0; margin-top:15px;">
		<label class="label-input">Город <span class="necessarily" title="Поле не может быть пустым">*</span></label>
		<?= form_error('name'); ?>
		<input class="edit-form-input inpvalue" id="name" name="name" type="text" value="<?=set_value('name');?>"/>
		<div class="clear"></div>
		<label class="label-input">Область/Край <span class="necessarily" title="Поле не может быть пустым">*</span></label>
		<?= form_error('area'); ?>
		<input class="edit-form-input inpvalue" id="area" name="area" type="text" value="<?=set_value('area');?>"/>
		<div class="clear"></div>
		<label class="label-input">Регион/Округ <span class="necessarily" title="Поле не может быть пустым">*</span></label>
		<?= form_error('district'); ?>
		<input class="edit-form-input inpvalue" id="district" name="district" type="text" value="<?=set_value('district');?>"/>
		<div class="clear"></div>
		<input class="btn-action margin-1em" id="addItem" type="submit" name="submit" value="Добавить"/>
	</div>
	<div class="clear"></div>
<?= form_close(); ?>