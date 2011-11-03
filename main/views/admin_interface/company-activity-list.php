<table class="region-table">
	<thead>
		<tr>
			<th style="width: 50px">ID</th>
			<th style="width: 500px">НАЗВАНИЕ ОТРАСЛИ</th>
			<th style="width: 50px">СТАТУС</th>
			<th style="width: 50px">&nbsp;</th>
		</tr>
	</thead>
	<tbody>
	<?php for($i=0;$i<count($activity);$i++):?>
		<tr>
			<td><?=$activity[$i]['act_id'];?></td>
			<td style="text-align:left;"><?=$activity[$i]['act_fulltitle'];?></td>
			<td><?=$activity[$i]['cs_close']?'<span style="color:#FF0000">Закрыта</span>':'<span style="color:#00FF00">Открыта</span>';?></td>
			<td>&nbsp;</td>
		</tr>
	<?php endfor;?>
	</tbody>
</table>