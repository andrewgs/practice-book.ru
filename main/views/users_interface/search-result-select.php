<?php $size=count($result)/3; ?>
<?php if($size<=3) $size=6; ?>
<select name="result" id="SearchAct" class="activity w280" size="<?=$size;?>">
<?php for($i=0;$i<count($result);$i++): ?>
	<option value="<?=$result[$i]['id'];?>" PR="<?=$result[$i]['product'];?>"><?=$result[$i]['title'];?></option>
<?php endfor; ?>
</select>
