<?php if($valid):
	$title 	= set_value('title');
	$note 	= set_value('note');
else:
	$title 	= $product['pr_title'];
	$note 	= $product['pr_note'];
endif; ?>
<?= form_open_multipart($this->uri->uri_string(),array('id'=>'formProduct','class'=>'formular')); ?>
	<div class="grid_12">
		<div class="box">
			<div class="box-header">
				<h2>Название продукта и его изображение</h2>
				<div class="box-search">
					<?=anchor('manager/control-panel/'.$userinfo['uconfirmation'],'Вернуться назад',array('class'=>'lnk-submit'));?>
				</div>
			</div>
			<div class="box-content h150 w918">
				<label class="label-input">Изображение:</label>
				<img src="<?=$baseurl;?>pravatar/viewimage/<?=$product['pr_id'];?>"class="floated" alt=""/>
				<div class="clear"></div>
				<?= form_error('userfile'); ?>
				<input class="edit-form-input" type="file" id="prAvatar" name="userfile">
				<div class="clear"></div>
				<div class="grid_4" style="margin:0px;width:30%;">
					<div class="form-reqs">Поддерживаемые форматы: JPG, GIF, PNG</div>
				</div>
				<div class="clear"></div>
				<label class="label-input">Название продукта: <span class="necessarily" title="Поле не может быть пустым">*</span></label>
				<?= form_error('title'); ?>
				<input class="edit-form-input" id="prTitle" name='title' type='text' value="<?=$title;?>">
				<div class="clear"></div>
			</div>
		</div>
	</div>
	<div class="clear"></div>
	<div class="grid_12">
		<div class="box">
			<div class="box-header">
				<h2>Описание продукта</h2>
				<div class="box-search">&nbsp;</div>
			</div>
			<div class="box-content h150 w918">
				<?= form_error('note'); ?>
				<textarea class="edit-form-textarea" name="note" id="prNote" cols="40" rows="18"><?=$note;?></textarea>
				<div class="clear"></div>
				<input class="btn-action" id="saveProduct" type="submit" name="submit" value="Сохранить"/>
			<?php if($userinfo['priority']): ?>
				<div class="chackForAll">
			<input type="checkbox" name="all" value="1" id="forAllRegion" title="Отметьте, если продукт не зависит от региона"> Для всех регионов
				</div>
				<div class="msgForAll fvalid_error" id="msgAllRegion">&nbsp;</div>
			<?php endif; ?>
			</div>
		</div>
	</div>
<?= form_close(); ?>