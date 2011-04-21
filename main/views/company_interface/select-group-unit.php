<?php if(count($groups)): ?>
	<select name="groupslist" id="select-groups" class="mixed-combo" size="1" style="width: 250px;">
		<option value="0">Выберите группу</option>
	<?php for($i=0;$i<count($groups);$i++):?>
		<option value="<?=$groups[$i]['prg_id'];?>"><?=$groups[$i]['prg_title'];?></option>
	<?php endfor; ?>
	</select>
<?php else: ?>
	<font size="3" face="sans-serif">Группы товаров отсутствуют</font>
<?php endif; ?>