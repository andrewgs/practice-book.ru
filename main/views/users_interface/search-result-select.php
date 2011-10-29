<select name="result" id="SearchAct" class="activity w460" size="8">
<?php for($i=0;$i<count($result);$i++): ?>
	<option value="<?=$result[$i]['id'];?>" PR="<?=$result[$i]['product'];?>" title="<?=$result[$i]['title'];?>"><?=$result[$i]['title'];?></option>
<?php endfor; ?>
</select>
