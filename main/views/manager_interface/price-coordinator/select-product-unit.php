<?php if(count($products)): ?>
	<select name="productlist" id="select-products" class="mixed-combo" size="1" style="width: 250px;">
		<option value="0">Выберите позицию</option>
	<?php for($i=0;$i<count($products);$i++):?>
		<option value="<?=$products[$i]['pri_id'];?>"><?=$products[$i]['pri_title'];?></option>
	<?php endfor; ?>
	</select>
<?php else: ?>
	<font size="3" face="sans-serif">Позиции в группе отсутствуют</font>
<?php endif; ?>