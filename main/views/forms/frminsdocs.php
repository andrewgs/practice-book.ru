<?= form_open_multipart($this->uri->uri_string(),array('id'=>'formAddDocument','class'=>'formular')); ?>
	<div id="formRep" style="border-top: 2px solid #D0D0D0; border-bottom: 2px solid #D0D0D0; margin-top:15px;">
		<div class="grid_8" style="margin:0px">
			<label class="label-input">Название: <span class="necessarily" title="Поле не может быть пустым">*</span></label>
			<?= form_error('title'); ?>
			<input class="edit-form-input inpvalue" id="title" name="title" type="text" value="<?=set_value('title');?>"/>
			<label class="label-input">Документ:<span class="necessarily" title="Поле не может быть пустым">*</span></label>
			<?= form_error('userfile'); ?>
			<input class="reg-form-input inpvalue" type="file" id="userfile" name="userfile" size="30"/> 
		</div>
		<div class="grid_3">
			<label class="label-input">Тип документа: </label>
			<div class="DocType">
				<input type="radio" id="radio1" name="doctype" value="1" <?=set_radio('doctype','1',TRUE);?>>MS Word<Br/>
	  			<input type="radio" id="radio2" name="doctype" value="2" <?=set_radio('doctype','2');?>>MS Excel<Br/>
	   			<input type="radio" id="radio3" name="doctype" value="3" <?=set_radio('doctype','3');?>>TXT-документ<Br/>
	   			<input type="radio" id="radio4" name="doctype" value="4" <?=set_radio('doctype','4');?>>PDF-документ<Br/>
			</div>
		</div>
		<div class="clear"></div>
		<label class="label-input">Описание: <span class="necessarily" title="Поле не может быть пустым">*</span></label>
		<?= form_error('note'); ?>
	<textarea class="edit-form-textarea mbottom inpvalue" name="note" id="note" cols="50" rows="5"><?=set_value('note');?></textarea>
		<input class="btn-action margin-1em" id="addNews" type="submit" name="submit" value="Добавить"/>
	</div>
	<div class="clear"></div>
<?= form_close(); ?>