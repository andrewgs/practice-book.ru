<div class="box">
	<div class="box-content h470 w918">
		<table summary="Список заявок">
			<thead>
				<tr class="odd">
					<th scope="col" abbr="ID">ID</th>
					<th scope="col" abbr="ДАТА">ДАТА</th>
					<th scope="col" abbr="ИМЯ">ИМЯ</th>	
					<th scope="col" abbr="E-MAIL">E-MAIL</th>
					<th scope="col" abbr="ТЕМА">ТЕМА</th>
					<th scope="col" abbr="СООБЩЕНИЕ">СООБЩЕНИЕ</th>
					<th scope="col" abbr="ОПЕРАЦИИ">&nbsp;</th>
				</tr>	
			</thead>
		    <tfoot>	
			 	&nbsp;
			</tfoot>
			<tbody>
			<?php for($i=0;$i<count($list);$i++):?>
				<?php if($i % 2 !== 0): ?>
					<tr rID="<?=$i?>"> 
				<?php else: ?>
					<tr class="odd" rID="<?=$i?>"> 
				<?php endif; ?>
					<td rID="<?=$i?>"><?=$list[$i]['spt_id'];?></td>
					<td><?=$list[$i]['spt_date'];?></td>
					<td><?=$list[$i]['spt_name'];?></td>
					<td><?=$list[$i]['spt_email'];?></td>
					<td style="text-align:left;"><?=$list[$i]['spt_theme'];?></td>
					<td style="text-align:justify;"><?=$list[$i]['spt_message'];?></td>
					<td>
						<div class="ButtonOperation">
			<input type="image" title="Удалить" class="btnDelete"rID="<?=$i?>" src="<?=$baseurl;?>images/delete.png" />
						</div>
					</td> 
				</tr>
				<?php endfor; ?>	
			</tbody>
		</table>
	</div>
</div>
<div class="clear"></div>