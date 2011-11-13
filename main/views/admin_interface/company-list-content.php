<div class="box">
	<div class="box-header">
		Список компаний:
		<div class="box-search">
			<?=anchor('admin/control-panel/'.$userinfo['uconfirmation'],'Вернуться назад',array('class'=>'lnk-submit'));?>
		</div>
	</div>
	<div class="box-content h960 w918">
		<table summary="Список компаний">
			<thead>
				<tr class="odd">
					<th scope="col" abbr="ID">ID</th>
					<th scope="col" abbr="НАЗВАНИЕ">НАЗВАНИЕ</th>	
					<th scope="col" abbr="E-MAIL">E-MAIL</th>
					<th scope="col" abbr="ТЕЛЕФОН">ТЕЛ.</th>
					<th scope="col" abbr="ЗАРЕГ.">ЗАРЕГ.</th>
					<th scope="col" abbr="ОТРАСЛИ">ОТРАСЛИ</th>
					<th scope="col" abbr="АВТОРИТЕТ">АВТОРИТЕТ</th>
					<th scope="col" abbr="ПРЕДЛОЖЕНИЕ КОНТРАГЕНТАМ">КА</th>
					<th scope="col" abbr="СТАТУС">СТАТУС</th>
					<th scope="col" abbr="ДЕЙСТВИЯ">&nbsp;</th>
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
					<td rID="<?=$i?>"><?=$list[$i]['cmp_id'];?></td>
					<?php if($list[$i]['cmp_name'] != ''):?>
						<td id="cn<?=$i?>"><?=anchor('company-info/'.$list[$i]['cmp_id'],$list[$i]['cmp_name'],array('target'=>'_blank'));?></td>
					<?php else:?>
						<td>Нет имени</td>
					<?php endif;?>
						<td><?=$list[$i]['cmp_email'];?></td>
						<td><?=$list[$i]['cmp_phone'];?></td>
						<td><?=$list[$i]['cmp_date'];?></td>
						<td>
	<input type="image" title="Список отраслей" class="btnActivity" id="act<?=$i?>" rID="<?=$i?>" src="<?=$baseurl;?>images/document-task.png" />
						</td>
						<td>
		<input class="reg-form-small parentid" id="vRating<?=$i?>" rID="<?=$i?> name="rating" type="text" value="<?=$list[$i]['cmp_rating'];?>">
						</td>
						<td>
		<input class="reg-form-small final" id="vOffers<?=$i?>" rID="<?=$i?> name="offers" type="text" value="<?=$list[$i]['cmp_offers'];?>">
						</td>
						<td>
		<input class="reg-form-small final" id="vStatus<?=$i?>" rID="<?=$i?> name="status" type="text" value="<?=$list[$i]['cmp_status'];?>">
						</td>
					<td>
						<div class="ButtonOperation">
						<input type="image" title="Сохранить" class="btnSave" id="s<?=$i?>" rID="<?=$i?>" src="<?=$baseurl;?>images/save.png" />
						<?php if($list[$i]['cmp_destroy'] == "3000-01-01"):?>
				<br/><input type="image" title="Закрыть" class="btnDel" id="dl<?=$i?>" rID="<?=$i;?>" src="<?=$baseurl;?>images/delete.png" />
						<?php endif; ?>
					<?php if($list[$i]['cmp_destroy'] != "3000-01-01"):?>
<br/><input type="image" title="Компания закрыта" id="at<?=$i?>" rID="<?=$i;?>" class="StatusOff" src="<?=$baseurl;?>images/exclamation.png" />
					<?php endif; ?>
						</div>
					</td> 
				</tr>
				<?php endfor; ?>	
			</tbody>
		</table>
	</div>
</div>
<div class="clear"></div>