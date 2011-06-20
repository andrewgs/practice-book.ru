<?= form_open($this->uri->uri_string(),array('id'=>'formAddConsult','class'=>'formular')); ?>
	<div id="formRep" style="border-top: 2px solid #D0D0D0; border-bottom: 2px solid #D0D0D0; margin-top:15px;">
		<div class="grid_8" style="margin:0px">
			<label class="label-input">Название: <span class="necessarily" title="Поле не может быть пустым">*</span></label>
			<?= form_error('title'); ?>
			<input class="edit-form-input inpvalue" id="title" name="title" type="text" value="<?=set_value('title');?>"/>
		</div>
		<div class="grid_2">
		<label class="label-input">Стоимость (руб.): <span class="necessarily" title="Поле не может быть пустым">*</span></label>
		<input class="small100-form-input digital inpvalue" maxlength="12" id="price" name="price" type="text" value="<?=set_value('price');?>">
		</div>
		<div class="grid_2">
			<label class="label-input">Срок: <span class="necessarily" title="Поле не может быть пустым">*</span></label>
			<select class="medium-select-period" id="period" name="period">
				<option value="1" <?=set_select('period','1',TRUE);?>>3 часа</option>
				<option value="2" <?=set_select('period','2');?>>6 часов</option>
				<option value="3" <?=set_select('period','3');?>>12 часов</option>
				<option value="4" <?=set_select('period','4');?>>1 день</option>
				<option value="5" <?=set_select('period','5');?>>3 дня</option>
				<option value="6" <?=set_select('period','6');?>>7 дней</option>
			</select>
		</div>
		<div class="clear"></div>
		<label class="label-input">Описание: <span class="necessarily" title="Поле не может быть пустым">*</span></label>
		<?= form_error('note'); ?>
		<textarea class="edit-form-textarea inpvalue" name="note" id="note" cols="50" rows="5"><?=set_value('note');?></textarea>
		<input class="btn-action margin-1em" id="addConsult" type="submit" name="submit" value="Добавить"/>
	</div>
	<div class="clear"></div>
<?= form_close(); ?>