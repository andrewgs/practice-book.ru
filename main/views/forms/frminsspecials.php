<?= form_open_multipart($this->uri->uri_string(),array('id'=>'formAddSpecials','class'=>'formular')); ?>
	<div id="formRep" style="border-top: 2px solid #D0D0D0; border-bottom: 2px solid #D0D0D0; margin-top:15px;">
		<div class="grid_8">
			<label class="label-input">Оглавление: <span class="necessarily" title="Поле не может быть пустым">*</span></label>
			<?= form_error('title'); ?>
			<input class="edit-form-input inpvalue" id="title" name="title" type="text" value="<?=set_value('title');?>"/>
			<label class="label-input">Источник:</label>
			<?= form_error('source'); ?>
			<input class="edit-form-input inpvalue" id="source" name="source" type="text" value="<?=set_value('source');?>"/>
			<label class="label-input">Фото: </label>
			<?= form_error('userfile'); ?>
			<input class="reg-form-input inpvalue" type="file" name="userfile" accept="image/jpeg,png,gif" size="30"/> 
			<div class="form-reqs w280">Поддерживаемые форматы: JPG, GIF, PNG</div>
		</div>
		<div class="grid_3">
			<label class="date-label-input" title="Новость будет опубликована с указанной даты">Дата публикации: <span class="necessarily" title="Поле не может быть пустым">*</span></label>
		<?= form_error('date'); ?>
		<input class="date-form-input inpvalue" id="nDate" name="date" type="text" readonly="readonly" value="<?=set_value('date');?>"/>
		</div>
		<div class="clear"></div>
		<label class="label-input">Содержание: <span class="necessarily" title="Поле не может быть пустым">*</span></label>
		<?= form_error('note'); ?>
	<textarea class="edit-form-textarea mbottom inpvalue" name="note" id="note" cols="50" rows="5"><?=set_value('note');?></textarea>
		<input class="btn-action margin-1em" id="addNews" type="submit" name="submit" value="Добавить"/>
	</div>
	<div class="clear"></div>
<?= form_close(); ?>