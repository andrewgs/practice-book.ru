<div class="box">
	<div class="box-content h470 w918">
		<h2 style="text-align:center;">Список зарегистрированных компаний</h2>
		<table summary="Список компаний">
			<thead>
				<tr class="odd">
					<th scope="col" abbr="№">№</th>
					<th scope="col" abbr="ДАТА РЕГИСТРАЦИИ">ДАТА РЕГ.</th>
					<th scope="col" abbr="ЛОГОТИП">ЛОГОТИП</th>	
					<th scope="col" abbr="НАЗВАНИЕ">НАЗВАНИЕ</th>	
					<th scope="col" abbr="E-MAIL">E-MAIL</th>
					<th scope="col" abbr="ТЕЛЕФОН">ТЕЛЕФОН</th>
					<th scope="col" abbr="РЕЙТИНГ">РЕЙТИНГ</th>
				</tr>	
			</thead>
		    <tfoot>	
			 	&nbsp;
			</tfoot>
			<tbody>
			<?php for($i=0;$i<count($list);$i++):?>
				<?php if($i % 2 !== 0): ?>
					<tr> 
				<?php else: ?>
					<tr class="odd"> 
				<?php endif; ?>
					<td><?=$i+1;?></td>
					<td><?=$list[$i]['cmp_date'];?></td>
					<td>
						<?=anchor('company-info/'.$list[$i]['cmp_id'],'<img src="'.$baseurl.'companythumb/viewimage/'.$list[$i]['cmp_id'].'" alt=""/>',array('target'=>'_blank'));?>
					</td>
					<td><?=$list[$i]['cmp_name'];?></td>
					<td><?=$list[$i]['cmp_email'];?></td>
					<td><?=$list[$i]['cmp_phone'];?></td>
					<td><?=$list[$i]['cmp_rating'];?></td>
				</tr>
				<?php endfor; ?>	
			</tbody>
		</table>
	</div>
</div>
<div class="clear"></div>