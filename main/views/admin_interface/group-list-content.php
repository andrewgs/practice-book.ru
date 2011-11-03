<div class="box">
	<div class="box-header">
		Список групп товаров:
		<div class="box-search">
			<?=anchor('admin/control-panel/'.$userinfo['uconfirmation'],'Вернуться назад',array('class'=>'lnk-submit'));?>
		</div>
	</div>
	<div class="box-content h960 w918">
		<table summary="Список групп">
			<thead>
				<tr class="odd">
					<th scope="col" abbr="ID">ID</th>
					<th scope="col" abbr="НАЗВАНИЕ ГРУППЫ">ГРУППА</th>	
					<th scope="col" abbr="ОТРАСЛЬ">ОТРАСЛЬ</th>
					<th scope="col" abbr="ДЕЙСТВИЯ"></th>
				</tr>	
			</thead>
		    <tfoot>	
			 	&nbsp;
			</tfoot>
			<tbody>
			<?php for($i=0;$i<count($list);$i++):?>
				<?php if($i%2!==0): ?>
					<tr rID="<?=$i?>"> 
				<?php else: ?>
					<tr class="odd" rID="<?=$i?>"> 
				<?php endif; ?>
					<td rID="<?=$i?>"><?=$list[$i]['prg_id'];?></td>
<td><input class="edit350-form-input" id="vName<?=$i?>" rID="<?=$i?> name="name" type="text" value="<?=$list[$i]['prg_title'];?>"></td>
					<td><?=$list[$i]['act_title'];?></td>
					<td>
						<div class="ButtonOperation">
			<input type="image" title="Сохранить" class="GrSave" id="s<?=$i;?>" rID="<?=$i;?>" src="<?=$baseurl;?>images/save.png" />
			<input type="image" title="Удалить" class="btnDel" id="dl<?=$i;?>" rID="<?=$i;?>" src="<?=$baseurl;?>images/delete.png" />
						</div>
					</td> 
				</tr>
				<?php endfor; ?>	
			</tbody>
		</table>
	</div>
</div>
<div class="clear"></div>