<?= form_open($this->uri->uri_string(),array('id'=>'formAddProductGroup','class'=>'formular')); ?>
<div id="formRep" style="margin-top:15px;">
	<div class="box">
		<div class="box-header"><h2 class="special">Добавление новой группы позиций:</h2>
			<div class="box-search">&nbsp;</div>
		</div>
		<div class="box-content h150 w918">
		<label class="label-input">Название новой группы позиций: <span class="necessarily" title="Поле не может быть пустым">*</span></label>
			<input class="edit-form-input inppgvalue" maxlength="8" id="pgtitle" name="title" type="text" value="<?=set_value('title');?>">
			<div class="clear"></div>
			<input class="btn-action margin-1em" id="addProductGroup" type="submit" name="sbmpg" value="Добавить группу"/>
		</div>
	</div>
</div>
<div class="clear"></div>
<?= form_close(); ?>		