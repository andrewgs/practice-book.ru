<div class="grid_4">
	<div class="box">
		<div class="box-header">&nbsp;</div>
		<div class="box-content w280">
			<?php $size = count($activity)/3; ?>
			<?php if($size <= 3) $size = 10; ?>
			<select name="activity" class="activity w280" size="<?= $size; ?>">
			<?php if(count($activity) > 0): ?>
					<option value="0" selected="selected" disabled="disabled">Выберите отрасль</option>
				<?php for($i = 0;$i < count($activity);$i++): ?>
					<option value="<?= $activity[$i]['act_id'];?>"><?=$activity[$i]['act_title'];?></option>
				<?php endfor; ?>
			<?php else: ?>
				<option value="0" selected="selected" disabled="disabled">Отрасли отсутствуют</option>
			<?php endif; ?>
			</select>
		</div>
		<div class="box-bottom-links">&nbsp;</div>
	</div>
</div>