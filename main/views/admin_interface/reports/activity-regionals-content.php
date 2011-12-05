<div class="box">
	<div class="box-header">
		<?=$boxtitile;?>
	</div>
	<div class="box-content h960 w918">
		<table summary="Список регионов">
			<thead>
				<tr class="odd">
					<th scope="col" abbr="№"><nobr>№ п/п</nobr></th>
					<th scope="col" abbr="РЕГИОН">РЕГИОН</th>	
					<th scope="col" abbr="МЕНЕДЖЕР">МЕНЕДЖЕР</th>
					<th scope="col" abbr="E-MAIL"><nobr>E-MAIL</nobr></th>
					<th scope="col" abbr="ДАТА РЕГ."><nobr>ЗАРЕГИСТРИРОВАН</nobr></th>
					<th scope="col" abbr="ДАТА ЗАКР."><nobr>ЗАКРЫТ</nobr></th>	
					<th scope="col" abbr="ПОСЛ.АВТОР."<nobr>АВТОРИЗАЦИЯ</nobr></th>	
				</tr>	
			</thead>
		    <tfoot>	
			 	&nbsp;
			</tfoot>
			<tbody>
			<?php for($i=0;$i<count($managers);$i++):?>
				<tr> 
					<td><?=$i+1;?></td>
					<td><?=$managers[$i]['reg_name'];?></td>
					<td><?=$managers[$i]['name'];?></td>
					<td><?=$managers[$i]['uemail'];?></td>
					<td><?=$managers[$i]['usignupdate'];?></td>
				<?php if($managers[$i]['udestroy'] != '3000-01-01'):?>
					<td><font color="#ff0000"><?=$managers[$i]['udestroy'];?></font></td>
				<?php else:?>
					<td><font color="#00ff00">Действующий</font></td>
				<?php endif;?>
				<?php if($managers[$i]['ulastlogindate'] != '2000-01-01'):?>
					<td><?=$managers[$i]['ulastlogindate'];?></td>
				<?php else:?>
					<td><font color="#ff0000">Ни разу не авторизировался</font></td>
				<?php endif;?>
				</tr>
				<?php endfor; ?>	
			</tbody>
		</table>
	</div>
</div>
<div class="clear"></div>