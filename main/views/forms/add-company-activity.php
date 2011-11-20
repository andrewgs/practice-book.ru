<div id="formRep" style="border-top: 2px solid #D0D0D0; border-bottom: 2px solid #D0D0D0; margin:15px;">
	<label class="label-input">Выбирите отрасль для добавления</label>
	<select id="AddActivity" class="mixed-combo inpval" name="addact" size="1" style="width:350px; padding: 5px;">
	<?php for($i=0;$i<count($actlist);$i++):?>
		<option value="<?=$actlist[$i]['act_id'];?>"><?=$actlist[$i]['act_title'];?></option>
	<?php endfor; ?>
	</select>
	<input class="btn-action margin-1em" id="addActivity" type="button" name="actsubmit" value="Добавить"/>
</div>
<div class="clear"></div>