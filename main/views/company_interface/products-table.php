<table class="price-table">
	<thead>
		<tr>
			<th style="width: 100px">Фото</th>
			<th style="width: 400px">Позиция</th>
			<th style="width: 150px">Цена</th>
			<th style="width: 120px">Единицы</th>
		</tr>
	</thead>
	<tbody>
	<?php for($i=0;$i<count($units);$i++):?>
		<tr>
			<td><img src="<?=$baseurl;?>curavatar/viewimage/<?=$units[$i]['cu_id'];?>"class="floated" alt=""/></td>
			<td><p><strong><?=$units[$i]['cu_title'];?></strong></p><p><?=$units[$i]['cu_note'];?></p></td>
			<td class="col-price-company"><?=$units[$i]['cu_price'];?></td>
			<td class=""><strong><?=$units[$i]['cu_priceunit'];?></strong></td>
		</tr>
	<?php endfor;?>
	</tbody>
</table>