<?= form_open($this->uri->uri_string(),array('class'=>'formular')); ?>
	<div class="box">
		<div class="box-header">
			Содержимое страници:
			<div class="box-search">
				<?=anchor('admin/control-panel/'.$userinfo['uconfirmation'],'Вернуться назад',array('class'=>'lnk-submit'));?>
			</div>
		</div>
		<div class="box-content h470 w918">
			<?php $case = $this->uri->segment(4);?>
			<label class="label-input">Справочная информация:</label>
			<textarea class="edit-form-textarea" name="help" cols="40" rows="9"><?=$text['help'];?></textarea>
			<?php if($case == "news"): ?>
				<label class="label-input">Новости отрасли:</label>
			<?php elseif($case == "specials"):?>
				<label class="label-input">Новинки:</label>
			<?php else: ?>
				<label class="label-input">Содержание блока:</label>
			<?php endif; ?>
			<textarea class="edit-form-textarea" name="note" cols="40" rows="9"><?=$text['note'];?></textarea>
			<?php $case = $this->uri->segment(4);?>
			<?php if($case == "news" || $case == "specials"): ?>
				<?php if($case == "news"): ?>
					<label class="label-input">Новости компаний:</label>
				<?php elseif($case == "specials"):?>
					<label class="label-input">Скидки и акции:</label>
				<?php endif; ?>
				<textarea class="edit-form-textarea" name="ext_note" cols="40" rows="9"><?=$text['ext_note'];?></textarea>
			<?php endif; ?>
			<input class="btn-action margin-1em" type="submit" name="submit" value="Сохранить"/>
		</div>
	</div>
	<div class="clear"></div>
<?= form_close(); ?>