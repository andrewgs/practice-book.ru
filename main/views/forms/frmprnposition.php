<?php if(isset($i)):?>
	<?php $title = $graph[$i]['prn_title'];?>
	<?php $percent = $graph[$i]['prn_percent'];?>
<?php else:?>
	<?php $title = '';?>
	<?php $percent = '';?>
<?php endif;?>
<label class="label-input left w300">Описание позиции ценообразования</label>
<label class="label-input left w80">Значение, %</label>
<div class="clear"></div>
<input class="edit275-form-input inpval" name="exp[]" type="text" maxlength="200" value="<?=$title;?>"/>
<input class="edit60-form-input percent inpval" name="exp[]" type="text" maxlength="20" value="<?=$percent;?>"/>
<div class="clear"></div>