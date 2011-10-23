<?php if($valid):
	$title 	= set_value('title');
	$source = set_value('source');
	$note 	= set_value('note');
else:
	$title 	= $persona['prs_title'];
	$source = $persona['prs_source'];
	$note 	= $persona['prs_note'];
endif; ?>
<?= form_open_multipart($this->uri->uri_string(),array('id'=>'formPersona','class'=>'formular')); ?>
	<div class="grid_12">
		<div class="box">
			<div class="box-header">
				<h2>Персона и его изображение</h2>
				<div class="box-search">
					<?=anchor($backpath,'Вернуться назад',array('class'=>'lnk-submit'));?>
				</div>
			</div>
			<div class="box-content h150 w918">
				<label class="label-input">Заголовок:</label>
				<?= form_error('title'); ?>
				<input class="edit-form-input" id="prTitle" name='title' type='text' value="<?=$title;?>">
				<label class="label-input">Источник:</label>
				<?= form_error('source'); ?>
				<input class="edit-form-input inpvalue" id="source" name="source" type="text" value="<?=$source;?>"/>
				<div class="clear"></div><br/>
				<img src="<?=$baseurl;?>prsavatar/viewimage/<?=$persona['prs_id'];?>"class="floated" alt=""/>
				<div class="clear"></div>
				<?= form_error('userfile'); ?>
				<input class="edit-form-input" type="file" id="prAvatar" name="userfile">
				<div class="clear"></div>
				<div class="grid_4" style="margin:0px;width:30%;">
					<div class="form-reqs">Поддерживаемые форматы: JPG, GIF, PNG</div>
				</div>
				<div class="clear"></div>
			</div>
		</div>
	</div>
	<div class="clear"></div>
	<div class="grid_12">
		<div class="box">
			<div class="box-header">
				<h2>Описание</h2>
				<div class="box-search">&nbsp;</div>
			</div>
			<div class="box-content h150 w918">
				<?= form_error('note'); ?>
				<h4 style="margin: 0 0 10px 0"><span style="color:#ff0000">Внимание: </span>Если необходимо вставить скопированный текст с внешнего источника воспользуйтесь кнопкой в верхней панели редактора "Вставить только текст" и отформатируйте его вручную. В противном случае вставка текст может привести в нарушению HTML-разметке документа, что приведет к неправильному отображению страницы.</h4>
				<textarea class="edit-form-textarea" name="note" id="prNote" cols="40" rows="18"><?=$note;?></textarea>
				<div class="clear"></div>
				<input class="btn-action" id="saveProduct" type="submit" name="submit" value="Сохранить"/>
				<?php if($userinfo['priority']): ?>
					<div class="chackForAll">
				<input type="checkbox" name="all" value="1" id="forAllRegion" title="Отметьте, если нужно показывать персону на все регионы"> Для всех регионов
					</div>
					<div class="msgForAll fvalid_error" id="msgAllRegion">&nbsp;</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
<?= form_close(); ?>