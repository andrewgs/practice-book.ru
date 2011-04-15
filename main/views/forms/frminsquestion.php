<?= form_open($this->uri->uri_string(),array('id'=>'formAddQuestion','class'=>'formular')); ?>
	<div id="formRep" style="border-top: 2px solid #D0D0D0; border-bottom: 2px solid #D0D0D0; margin-top:15px;">
		<label class="label-input">Вопрос <span class="necessarily" title="Поле не может быть пустым">*</span></label>
		<?= form_error('title'); ?>
		<input class="edit-form-input inpvalue" id="title" name="title" type="text" value="<?=set_value('title');?>"/>
		<div class="clear"></div>
		<label class="label-input">Ответ: <span class="necessarily" title="Поле не может быть пустым">*</span></label>
		<?= form_error('note'); ?>
		<textarea class="edit-form-textarea mbottom inpvalue" name="note" id="description" cols="50" rows="5"><?=set_value('note');?></textarea>
		<input class="btn-action margin-1em" id="addNews" type="submit" name="submit" value="Добавить"/>
	</div>
	<div class="clear"></div>
<?= form_close(); ?>