<select name="result" id="SearchReg" class="activity w280" size="8">
<?php for($i=0;$i<count($result);$i++): ?>
	<option value="<?=$result[$i]['id'];?>"><?=$result[$i]['title'];?></option>
<?php endfor; ?>
</select>
