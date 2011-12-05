<div class="box">
	<div class="box-header">
		Список заявок на регистрацию:
		<div class="box-search">
			<?=anchor('dealer/control-panel/'.$userinfo['uconfirmation'],'Вернуться назад',array('class'=>'lnk-submit'));?>
		</div>
	</div>
	<div class="box-content h960 w960">
		<table summary="Список заявок">
			<thead>
				<tr class="odd">
					<th scope="col" abbr="ID">ID</th>
					<th scope="col" abbr="ДАТА">ДАТА</th>
					<th scope="col" abbr="КОМПАНИЯ">КОМПАНИЯ</th>	
					<th scope="col" abbr="E-MAIL">E-MAIL</th>
					<th scope="col" abbr="ТЕЛЕФОН">ТЕЛЕФОН</th>
					<th scope="col" abbr="РЕГИОН">РЕГИОН</th>
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
					<td rID="<?=$i?>"><?=$list[$i]['dlm_id'];?></td>
					<td><?=$list[$i]['dlm_date'];?></td>
					<td><?=$list[$i]['dlm_cname'];?></td>
					<td><?=$list[$i]['dlm_cemail'];?></td>
					<td><?=$list[$i]['dlm_cphone'];?></td>
					<td><?=$list[$i]['dlm_cregion'];?></td>
					<td style="text-align:justify;"><?=$list[$i]['dlm_cmessage'];?></td>
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