<div class="box">
	<div class="box-header">
		Список регионов:
		<div class="box-search">
			<?=anchor('admin/control-panel/'.$userinfo['uconfirmation'],'Вернуться назад',array('class'=>'lnk-submit'));?>
		</div>
	</div>
	<div class="box-content h470 w918">
		<table summary="Список регионов">
			<thead>
				<tr class="odd">
					<th scope="col" abbr="ID">ID</th>
					<th scope="col" abbr="НАЗВАНИЕ">НАЗВАНИЕ</th>	
					<th scope="col" abbr="E-MAIL">E-MAIL</th>
					<th scope="col" abbr="ТЕЛЕФОН">ТЕЛЕФОН</th>
					<th scope="col" abbr="ЗАРЕГ.">ЗАРЕГ.</th>
					<th scope="col" abbr="РЕЙТИНГ">РЕЙТИНГ</th>
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
						<td><?=$list[$i]['cmp_name'];?></td>
						<td><?=$list[$i]['cmp_email'];?></td>
						<td><?=$list[$i]['cmp_phone'];?></td>
						<td><?=$list[$i]['cmp_date'];?></td>
						<td>
		<input class="reg-form-small parentid" id="vRating<?=$i?>" rID="<?=$i?> name="rating" type="text" value="<?=$list[$i]['cmp_rating'];?>">
						</td>
					<td>
						<div class="ButtonOperation">
						<input type="image" title="Сохранить" class="btnSave" id="s<?=$i?>" rID="<?=$i?>" src="<?=$baseurl;?>images/save.png" />
						</div>
					</td> 
				</tr	>
				<?php endfor; ?>	
			</tbody>
		</table>
	</div>
</div>
<div class="clear"></div>