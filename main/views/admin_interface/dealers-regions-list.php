<table class="region-table">
	<thead>
		<tr>
			<th style="width: 100px">№ п/п</th>
			<th style="width: 300px">Город</th>
			<th style="width: 350px">Область/край</th>
		</tr>
	</thead>
	<tbody>
	<?php for($i=0;$i<count($regions);$i++):?>
		<tr>
			<td><b><?=$i+1;?></b></td>
			<td><b><?=$regions[$i]['reg_name'];?></b></td>
			<td><b><?=$regions[$i]['reg_area'];?></b></td>
		</tr>
	<?php endfor;?>
	</tbody>
</table>