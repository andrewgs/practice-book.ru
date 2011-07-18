<div class="grid_4">
	<div class="box">
		<div class="box-header">&nbsp;</div>
		<div class="box-content w280 h190">
			<select name="activity" class="activity w280" size="10">
				<option value="0" selected="selected" disabled="disabled">Выберите отрасль</option>
			<?php for($i=0;$i<count($activity);$i++): ?>
				<?php if($activity[$i]['act_final']): ?>
				<option value="<?=$activity[$i]['act_id'];?>" final="<?=$activity[$i]['act_final'];?>"><?=$activity[$i]['act_title'];?></option>
				<?php else: ?>
					<option value="<?=$activity[$i]['act_id'];?>" final="<?=$activity[$i]['act_final'];?>">&larr;&nbsp;<?=$activity[$i]['act_title'];?></option>
				<?php endif; ?>
			<?php endfor; ?>
			</select>
		</div>
		<div class="box-bottom-links">&nbsp;</div>
	</div>
</div>