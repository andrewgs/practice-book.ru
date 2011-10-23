<table class="region-table">
	<thead>
		<tr>
			<th style="width: 50px">№</th>
			<th style="width: 50px">Лого</th>
			<th style="width: 200px">Название</th>
			<th style="width: 150px">E-mail</th>
			<th style="width: 150px">Телефон</th>
			<th style="width: 50px">Дата</th>
		</tr>
	</thead>
	<tbody>
	<?php for($i=0;$i<count($company);$i++):?>
		<tr>
			<td><?=$i+1;?></td>
			<td>
			<?=anchor('company-info/'.$company[$i]['cmp_id'],'<img src="'.$baseurl.'companythumb/viewimage/'.$company[$i]['cmp_id'].'" alt=""/>',array('target'=>'_blank'));?>
			</td>
			<td><?=$company[$i]['cmp_name'];?></td>
			<td><?=$company[$i]['cmp_email'];?></td>
			<td><?=$company[$i]['cmp_phone'];?></td>
			<td><?=$company[$i]['cmp_date'];?></td>
		</tr>
	<?php endfor;?>
	</tbody>
</table>