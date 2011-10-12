<div class="box">
	<div class="box-header">
		Список укционов:
		<div class="box-search">
<?=anchor('admin/manage-whomain/'.$userinfo['uconfirmation'].'/start-auction','Начать аукционы',array('id'=>'bauc','class'=>'lnk-submit'));?>
<?=anchor('admin/manage-whomain/'.$userinfo['uconfirmation'].'/finish-auction','Завершить аукционы',array('id'=>'eauc','class'=>'lnk-submit'));?>
			<?=anchor('admin/control-panel/'.$userinfo['uconfirmation'],'Вернуться назад',array('class'=>'lnk-submit'));?>
		</div>
	</div>
	<div class="box-content h960 w918">
		<table summary="Список регионов">
			<thead>
				<tr class="odd">
					<th scope="col" abbr="ID">ID</th>
					<th scope="col" abbr="ДАТА ОКОНЧАНИЯ">ДАТА ОКОНЧАНИЯ</th>	
					<th scope="col" abbr="ОТРАСЛЬ">ОТРАСЛЬ</th>	
					<th scope="col" abbr="РЕГИОН">РЕГИОН</th>	
					<th scope="col" abbr="ID КОМПАНИИ">ID КОМПАНИИ</th>
					<th scope="col" abbr="КОМПАНИЯ">КОМПАНИЯ</th>
					<th scope="col" abbr="СУММА">СУММА</th>
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