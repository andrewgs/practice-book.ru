<?php if(count($news)): ?>
<div class="box wide">
	<div class="box-header"><?=$name;?>
		<div class="box-search">
			<?=anchor('company/control-panel/'.$userinfo['uconfirmation'],'Вернуться назад',array('class'=>'lnk-submit'));?>
		</div>
	</div>
	<div class="box-content">
	<?php for($i = 0;$i < count($news); $i++): ?>
		<div class="newsID" id="id<?=$i?>"><?=$news[$i]['id'];?></div>
		<div class="content-separator" id="cs<?=$i?>">
			<div class="nshDate"><span class="text" title="Дата начала публикации">Начальная дата:</span>
				<?=$news[$i]['pdatebegin'];?>
			</div>
			<div class="nshDate" id="nsh<?=$i?>"><span class="text" title="Дата окончания публикации">Конечная дата:</span>
				<?php if($news[$i]['pdateend'] != "01-01-3000"):?>
					<span id="sped<?=$i?>"><?=$news[$i]['pdateend'];?></span>
				<?php else: ?>
					Не указана
				<?php endif; ?>
			</div>
			<img src="<?=$baseurl.$typeavatar;?>/viewimage/<?=$news[$i]['id'];?>" class="floated" id="img<?=$i?>" alt=""/>
			<div class="nsh-title" id="t<?=$i?>"><?=$news[$i]['title'];?></div>
			<div class="nshNote" id="ds<?=$i?>"><?=$news[$i]['note'];?></div>
			<?php if($news[$i]['pdateend'] != "01-01-3000"):?>
				Продлить на <input class="reg-form-small" type="text" name="extend" id="vex<?=$i?>" value="" nID="<?=$i?>" maxlength="3"/> дней
				<input type="image" title="Продлить" class="ExtendDay" id="ex<?=$i?>" nID="<?=$i?>" src="<?=$baseurl;?>images/plus2.png" />
			<?php endif; ?>
			<div class="ButtonOperation">
				<input type="image" title="Удалить" class="NewsDel" id="dl<?=$i?>" nID="<?=$i;?>" src="<?=$baseurl;?>images/delete.png" />
				<input type="image" title="Редактировать" class="NewsEdit" id="e<?=$i?>" nID="<?=$i?>" src="<?=$baseurl;?>images/edit.png" />
		<input type="image" title="Отменить" class="NewsCancel btnHidden" id="c<?=$i?>" nID="<?=$i?>" src="<?=$baseurl;?>images/overedit.png" />
		<input type="image" title="Сохранить" class="NewsSave btnHidden" id="s<?=$i?>" nID="<?=$i?>" src="<?=$baseurl;?>images/save.png" />
				<?php if($news[$i]['pdateend'] != "01-01-3000"):?>
					<?php if(strtotime($news[$i]['dend']) < strtotime(date("Y-m-d"))):?>
						<input type="image" title="Закончилось время публикации" class="NewsExc" src="<?= $baseurl; ?>images/exclamation.png" />
					<?php endif; ?>
				<?php endif; ?>
			</div>	
			<div class="clear"></div>
		</div> 
	<?php endfor; ?>
	</div>
	<div class="clear"></div>
</div>
<?php else: ?>
	<span class="text">Данные отсутствуют</span>
	<div class="clear"></div>
<?endif; ?>