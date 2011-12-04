<div class="box">
	<div class="box-header">
		<?=$boxtitile;?>
	</div>
	<div class="box-content h960 w918">
		<table summary="Список регионов">
			<thead>
				<tr class="odd">
					<th scope="col" abbr="ID">ID</th>
					<th scope="col" abbr="РЕГИОН">РЕГИОН</th>	
					<th scope="col" abbr="КОМПАНИЯ">КОМПАНИЯ</th>
					<th scope="col" abbr="СУММА">СУММА</th>
					<th scope="col" abbr="ДАТА ОКОНЧАНИЯ">ДАТА И ВРЕМЯ ОКОНЧАНИЯ</th>	
					<th scope="col" abbr="ДЕЙСТВИЯ">&nbsp;</th>
				</tr>	
			</thead>
		    <tfoot>	
			 	&nbsp;
			</tfoot>
			<tbody>
			<?php for($i=0;$i<count($auctions);$i++):?>
				<?php if($i % 2 !== 0): ?>
					<tr rID="<?=$i?>"> 
				<?php else: ?>
					<tr class="odd" rID="<?=$i?>"> 
				<?php endif; ?>
					<td rID="<?=$i?>"><?=$auctions[$i]['wmn_id'];?></td>
						<td><?=$auctions[$i]['reg_name'];?></td>
					<?php if($auctions[$i]['wmn_cmpid']):?>
						<td id="c<?=$i?>"><?=anchor('company-info/'.$auctions[$i]['wmn_cmpid'],$auctions[$i]['wmn_cmpname'],array('target'=>'_blank'));?></td>
					<?php else:?>
						<td id="c<?=$i?>"><?=$auctions[$i]['wmn_cmpname'];?></td>
					<?php endif;?>
						<td id="p<?=$i?>"><?=$auctions[$i]['wmn_price'];?></td>
<td><input class="small150-form-input" id="vDate<?=$i?>" rID="<?=$i?> name="name" type="text" value="<?=$auctions[$i]['wmn_edate'];?>"></td>
					<td>
						<div class="ButtonOperation">
			<input type="image" title="Начать" class="AucBegin" id="b<?=$i?>" rID="<?=$i?>" src="<?=$baseurl;?>images/tick.png" />
			<input type="image" title="Закончить" class="AucEnd" id="e<?=$i?>" rID="<?=$i;?>" src="<?=$baseurl;?>images/tick-red.png" />
						</div>
					</td> 
				</tr>
				<?php endfor; ?>	
			</tbody>
		</table>
	</div>
</div>
<div class="clear"></div>