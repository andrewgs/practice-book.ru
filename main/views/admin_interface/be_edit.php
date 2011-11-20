<?=form_open('admin/manage-business-environment/'.$this->uri->segment(3),array('id'=>'formEditBE','class'=>'formular')); ?>
	<?=form_hidden('id',$information['belg_id']);?>
	<label class="label-input">Название</label>
<?php if($information['title']):?>
	<input class="edit-form-input inpvalue" id="title" name="title" type="text" value="<?=$information['title'];?>"/>
<?php else: ?>
	<input class="edit-form-input" id="title" name="title" type="text" value="" disabled=""/>
<?php endif;?>
	<div class="clear"></div>
	<label class="label-input">Содержание:</label>
<?php if($information['note']):?>
	<textarea class="edit-form-textarea mbottom inpvalue" name="note" id="note" cols="50" rows="12"><?=$information['note'];?></textarea>
<?php else: ?>
	<textarea class="edit-form-textarea mbottom" name="note" id="note" cols="50" rows="12" disabled=""></textarea>
<?php endif;?>
	<div class="clear"></div>
	<input class="btn-action margin-1em" id="SaveInfo" type="submit" name="subsave" value="Сохранить"/>
<?= form_close(); ?>