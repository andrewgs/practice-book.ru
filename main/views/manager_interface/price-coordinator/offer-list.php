<table class="price-table">
	<thead>
		<tr>
			<th style="width: 100px">Логотип</th>
			<th style="width: 120px">Компания</th>
			<th style="width: 350px">Описание</th>
			<th style="width: 150px">Цена</th>
			<th style="width: 100px">Единицы</th>
		</tr>
	</thead>
	<tbody>
	<?php for($i=0;$i<count($products);$i++):?>
		<tr>
			<td>
		<?php $img='<img src="'.$baseurl.'companythumb/viewimage/'.$products[$i]['cmp_id'].'" alt=""/>';?>
		<?= anchor('company-info/'.$products[$i]['cmp_id'],$img,array('target'=>'_blank'));?>
			</td>
			<td><b><?=$products[$i]['cmp_name'];?></b></td>
			<td><p><?=$products[$i]['cu_note'];?></p></td>
			<td class="col-price-company"><?=$products[$i]['cu_price'];?></td>
			<td><strong><?=$products[$i]['cu_priceunit'];?></strong></td>
		</tr>
	<?php endfor;?>
	</tbody>
</table>