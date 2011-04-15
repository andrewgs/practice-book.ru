<?= form_open($this->uri->uri_string(),array('class'=>'formular')); ?>
	<div class="box">
		<div class="box-header">
			Содержимое страници: <span class="necessarily" title="Поле не может быть пустым">*</span>
			<div class="box-search">
				<?=anchor('admin/control-panel/'.$userinfo['uconfirmation'],'Вернуться назад',array('class'=>'lnk-submit'));?>
			</div>
		</div>
		<div class="box-content h470 w918">
			<textarea class="edit-form-textarea" name="note" id="pageContent" cols="50" rows="20"><?=$text;?></textarea>
			<input class="btn-action margin-1em" id="addNews" type="submit" name="submit" value="Сохранить"/>
		</div>
	</div>
	<div class="clear"></div>
<?= form_close(); ?>