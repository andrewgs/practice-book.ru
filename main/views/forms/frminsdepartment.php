<?= form_open($this->uri->uri_string(),array('id'=>'formAddRegion','class'=>'formular')); ?>
	<div id="formRep" style="border-bottom: 2px solid #D0D0D0; margin-top:15px;">
		<label class="label-input">Название отдела <span class="necessarily" title="Поле не может быть пустым">*</span></label>
		<?= form_error('name'); ?>
		<input class="edit-form-input inpvalue" id="name" name="name" type="text" value="<?=set_value('name');?>"/>
		<div class="clear"></div>
		<input class="btn-action margin-1em" id="addItem" type="submit" name="submit" value="Добавить"/>
	</div>
	<div class="clear"></div>
<?= form_close(); ?>