<?php if(count($questions)): ?>
	<?php for($i = 0;$i < count($questions); $i++): ?>
	<div class="box" id="cs<?=$i?>">
		<div class="box-header">
			&nbsp;
			<div class="box-search">
				<?php if($i == 0):?>
					<?=anchor($backpath,'Вернуться назад',array('class'=>'lnk-submit'));?>
				<?php endif; ?>
			</div>
		</div>
		<div class="box-content h150 w918">
			<div class="newsID" id="id<?=$i?>"><?=$questions[$i]['mraq_id'];?></div>
			<div class="content-separator">
				<?php if(!$questions[$i]['mraq_status']):?>
					<input type="image" title="Не прошла модерацию" id="ex<?=$i?>" class="NewsExc" src="<?=$baseurl;?>images/exclamation.png"/>
				<?php endif; ?>
				<span class="text">Вопрос: </span>
				<div class="nsh-title" id="t<?=$i?>"><?=$questions[$i]['mraq_title'];?></div>
				<span class="text">Ответ: </span>
				<div class="nshNote" id="ds<?=$i?>"><?=$questions[$i]['mraq_note'];?></div>
				<div class="ButtonOperation">
				<?php if($questions[$i]['mraq_priority']): ?>
	<input type="checkbox" name="priority" value="1" checked disabled id="pr<?=$i?>" title="Отметьте, если вопрос важный">Показывать в списке
				<?php else: ?>
	<input type="checkbox" name="priority" value="1" disabled id="pr<?=$i?>" title="Отметьте, если вопрос важный">Показывать в списке
				<?php endif; ?>
		<input type="image" title="Удалить" class="NewsDel" id="dl<?=$i?>" nID="<?=$i;?>" src="<?=$baseurl;?>images/delete.png" />
		<input type="image" title="Редактировать" class="NewsEdit" id="e<?=$i?>" nID="<?=$i?>" src="<?=$baseurl;?>images/edit.png" />
		<input type="image" title="Отменить" class="NewsCancel btnHidden" id="c<?=$i?>" nID="<?=$i?>" src="<?=$baseurl;?>images/overedit.png" />
		<input type="image" title="Сохранить" class="NewsSave btnHidden" id="s<?=$i?>" nID="<?=$i?>" src="<?=$baseurl;?>images/save.png" />
				</div>
			</div> 
		</div>
	</div>
	<div class="clear"></div>
	<?php endfor; ?>
<?php else: ?>
	<div class="box">
		<div class="box-header">
			&nbsp;
			<div class="box-search">
				<?=anchor($backpath,'Вернуться назад',array('class'=>'lnk-submit'));?>
			</div>
		</div>
		<div class="box-content h150 w918">
			<span class="text">Данные отсутствуют</span>
		</div>
	</div>
	<div class="clear"></div>
<?endif; ?>