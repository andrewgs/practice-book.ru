<div class="box">
	<div class="box-header">
		Список регионов:
		<div class="box-search">
			<?=anchor('admin/control-panel/'.$userinfo['uconfirmation'],'Вернуться назад',array('class'=>'lnk-submit'));?>
		</div>
	</div>
	<div class="box-content h960 w918">
		<table summary="Список регионов">
			<thead>
				<tr class="odd">
					<th scope="col" abbr="ID">ID</th>
					<th scope="col" abbr="ГОРОД">ГОРОД</th>	
					<th scope="col" abbr="ОБЛАСТЬ">ОБЛАСТЬ/КРАЙ</th>
					<th scope="col" abbr="РЕГИОН">РЕГИОН/ОКРУГ</th>
					<th scope="col" abbr="ДЕЙСТВИЯ">&nbsp;</th>
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
					<td rID="<?=$i?>"><?=$list[$i]['reg_id'];?></td>
<td><input class="small200-form-input" id="vName<?=$i?>" rID="<?=$i?> name="name" type="text" value="<?=$list[$i]['reg_name'];?>"></td>
<td><input class="small200-form-input" id="vArea<?=$i?>" rID="<?=$i?> name="area" type="text" value="<?=$list[$i]['reg_area'];?>"></td>
<td><input class="small200-form-input" id="vDistrict<?=$i?>" rID="<?=$i?> name="district" type="text" value="<?=$list[$i]['reg_district'];?>"></td>
					<td>
						<div class="ButtonOperation">
			<input type="image" title="Сохранить" class="NewsSave btnHidden" id="s<?=$i?>" rID="<?=$i?>" src="<?=$baseurl;?>images/save.png" />
						</div>
					</td> 
				</tr>
				<?php endfor; ?>	
			</tbody>
		</table>
	</div>
</div>
<div class="clear"></div>