<label class="label-input left w300">Организация</label>
<label class="label-input left w300">Должность</label>
<label class="label-input left w80">Период</label>
<label class="label-input left w80">работы</label>
<div class="clear"></div>
<input class="reg-form-input jobs" name="exp[]" type="text" maxlength="400" value=""/>
<input class="reg-form-input jobs" name="exp[]" type="text" maxlength="400" value=""/>
<select class="reg-form-input" style="width:70px" name="exp[]">
<?php for($i = date('Y');$i > 1970;$i--): ?>
	<option><?= $i; ?></option>
<?php endfor; ?>
</select>
<select class="reg-form-input" style="width:70px" name="exp[]">
	<option>н/в</option>
<?php for($i = date('Y');$i > 1970;$i--): ?>
	<option><?= $i; ?></option>
	<?php endfor; ?>
</select>
<div class="clear"></div>