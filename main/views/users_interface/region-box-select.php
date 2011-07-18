<div class="grid_4">
	<div class="box">
		<div class="box-header"><h2><?=$boxtitle?></h2></div>
		<div class="box-content w280 h190">
			<select name="region" class="region w280" size="10">
				<option value="0" selected="selected" disabled="disabled">Выберите регион</option>
			<?php for($i=0;$i<count($region);$i++): ?>
				<option value="<?=$region[$i]['id'];?>"><?=$region[$i]['title'];?></option>
			<?php endfor; ?>
			</select>
		</div>
		<div class="box-bottom-links">&nbsp;</div>
	</div>
</div>