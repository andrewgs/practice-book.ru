<?php if(count($news)): ?>
	<?php for($i = 0;$i < count($news); $i++): ?>
	<div class="box" id="cs<?=$i?>">
		<div class="box-header">
			&nbsp;
			<div class="box-search">
				<?php if($i == 0):?>
					<?=anchor('manager/control-panel/'.$userinfo['uconfirmation'],'Вернуться назад',array('class'=>'lnk-submit'));?>
				<?php endif; ?>
			</div>
		</div>
		<div class="box-content h150 w918">
			<div class="newsID" id="id<?=$i?>"><?=$news[$i]['an_id'];?></div>
			<div class="content-separator">
				<div class="nshDate"><?=$news[$i]['an_date'];?></div>
				<img src="<?=$baseurl;?>activitynews/viewimage/<?=$news[$i]['an_id'];?>" class="floated" id="img<?=$i?>" alt=""/>
				<div class="nsh-title" id="t<?=$i?>"><?=$news[$i]['an_title'];?></div>
				<div class="nshNote" id="ds<?=$i?>"><?=$news[$i]['an_note'];?></div>
				<div id="src<?=$i?>">
					<span class="text">Источник: </span>
					<div class="nsh-title"><?=$news[$i]['an_source'];?></div>
				</div>
				<div class="ButtonOperation">
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
				<?=anchor('manager/control-panel/'.$userinfo['uconfirmation'],'Вернуться назад',array('class'=>'lnk-submit'));?>
			</div>
		</div>
		<div class="box-content h150 w918">
			<span class="text">Данные отсутствуют</span>
		</div>
	</div>
	<div class="clear"></div>
<?endif; ?>