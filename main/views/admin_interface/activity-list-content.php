<div class="box">
	<div class="box-header">
		Список отраслей:
		<div class="box-search">
			<?=anchor('admin/control-panel/'.$userinfo['uconfirmation'],'Вернуться назад',array('class'=>'lnk-submit'));?>
		</div>
	</div>
	<div class="box-content h960 w918">
		<table summary="Список отраслей">
			<thead>
				<tr class="odd">
					<th scope="col" abbr="ID">ID</th>
					<th scope="col" abbr="НАЗВАНИЕ">НАЗВАНИЕ</th>	
					<th scope="col" abbr="ID ГЛАВНОЙ ОТРАСЛИ">ГЛ.ОТРАСЛЬ</th>
					<th scope="col" abbr="ПОЛНОЕ НАЗВАНИЕ">ПОЛНОЕ НАЗВАНИЕ</th>
					<th scope="col" abbr="ПРИЗНАК КОНЦА">КОНЕЦ(0/1)</th>
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
					<td rID="<?=$i?>"><?=$list[$i]['act_id'];?></td>
<td><input class="small200-form-input" id="vTitle<?=$i?>" rID="<?=$i?> name="title" type="text" value="<?=$list[$i]['act_title'];?>"></td>
<td><input class="reg-form-small parentid" id="vParent<?=$i?>" rID="<?=$i?> name="parentid" type="text" value="<?=$list[$i]['act_parentid'];?>"></td>
<td><input class="small200-form-input" id="vFullTitle<?=$i?>" rID="<?=$i?> name="full" type="text" value="<?=$list[$i]['act_fulltitle'];?>"></td>
<td><input class="reg-form-small final" id="vFinall<?=$i?>" rID="<?=$i?> name="final" type="text" value="<?=$list[$i]['act_final'];?>"></td>
					<td>
						<div class="ButtonOperation">
			<input type="image" title="Сохранить" class="NewsSave" id="s<?=$i?>" rID="<?=$i?>" src="<?=$baseurl;?>images/save.png" />
						</div>
					</td> 
				</tr	>
				<?php endfor; ?>	
			</tbody>
		</table>
	</div>
</div>
<div class="clear"></div>