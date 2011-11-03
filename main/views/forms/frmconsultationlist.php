<?php if(count($consult)): ?>
	<?php for($i = 0;$i < count($consult); $i++): ?>
	<div class="box" id="cs<?=$i?>">
		<div class="box-header">
			&nbsp;
			<div class="box-search">
				<?php if($i == 0):?>
					<?=anchor('managers/control-panel/'.$userinfo['uconfirmation'],'Вернуться назад',array('class'=>'lnk-submit'));?>
				<?php endif; ?>
			</div>
		</div>
		<div class="box-content h150 w918">
			<div class="newsID" id="id<?=$i?>"><?=$consult[$i]['cnsl_id'];?></div>
			<div class="grid_8" style="margin:0px">
				<label class="label-input">Название:</label>
				<input class="edit-form-input" id="it<?=$i?>" name="title" type="text" value="<?=$consult[$i]['cnsl_title'];?>"/>
			</div>
			<div class="grid_2">
				<label class="label-input">Стоимость (руб.):</label>
				<input class="small100-form-input digital" id="pr<?=$i?>" name="title" type="text" value="<?=$consult[$i]['cnsl_price'];?>"/>
			</div>
			<div class="grid_1">
				<label class="label-input">Срок:</label>
				<select class="font140-select-period" id="pd<?=$i?>" name="period">
					<option value="1" <?php if($consult[$i]['cnsl_period']==1) echo 'selected="selected"';?>>3 часа</option>
					<option value="2" <?php if($consult[$i]['cnsl_period']==2) echo 'selected="selected"';?>>6 часов</option>
					<option value="3" <?php if($consult[$i]['cnsl_period']==3) echo 'selected="selected"';?>>12 часов</option>
					<option value="4" <?php if($consult[$i]['cnsl_period']==4) echo 'selected="selected"';?>>1 день</option>
					<option value="5" <?php if($consult[$i]['cnsl_period']==5) echo 'selected="selected"';?>>3 дня</option>
					<option value="6" <?php if($consult[$i]['cnsl_period']==6) echo 'selected="selected"';?>>7 дней</option>
				</select>
			</div>
			<div class="clear"></div>
			<label class="label-input">Описание:</label>
			<textarea class="edit-form-textarea" name="note" id="td<?=$i?>" cols="50" rows="5"><?=$consult[$i]['cnsl_note'];?></textarea>
			<div class="ButtonOperation">
				<input type="image" title="Удалить" class="NewsDel" id="dl<?=$i?>" nID="<?=$i;?>" src="<?=$baseurl;?>images/delete.png" />
				<input type="image" title="Сохранить" class="NewsSave" id="s<?=$i?>" nID="<?=$i?>" src="<?=$baseurl;?>images/save.png" />
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
				<?=anchor('managers/control-panel/'.$userinfo['uconfirmation'],'Вернуться назад',array('class'=>'lnk-submit'));?>
			</div>
		</div>
		<div class="box-content h150 w918">
			<span class="text">Данные отсутствуют</span>
		</div>
	</div>
	<div class="clear"></div>
<?endif; ?>