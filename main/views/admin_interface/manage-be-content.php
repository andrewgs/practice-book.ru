<div class="box">
	<div class="box-header">
		Список событий в бизнес среде
	</div>
	<div class="box-content h960 w918">
		<table summary="Список событий в бизнес среде">
			<thead>
				<tr class="odd">
					<th scope="col" abbr="ID">ID</th>
					<th scope="col" abbr="ТЕМА" style="width:160px;">ТЕМА</th>	
					<th scope="col" abbr="СРЕДА" style="width:40px;">СРЕДА</th>
					<th scope="col" abbr="ОТДЕЛ">ОТДЕЛ</th>
					<th scope="col" abbr="ОТРАСЛЬ">ОТРАСЛЬ</th>
					<th scope="col" abbr="ДЕЙСТВИЯ">&nbsp;</th>
					<th scope="col" abbr="ДЕЙСТВИЯ">&nbsp;</th>
				</tr>	
			</thead>
		    <tfoot>	
			 	&nbsp;
			</tfoot>
			<tbody>
			<?php for($i=0;$i<count($log);$i++):?>
				<?php if($i % 2 !== 0): ?>
					<tr rID="<?=$i?>"> 
				<?php else: ?>
					<tr class="odd" rID="<?=$i?>"> 
				<?php endif; ?>
					<td rID="<?=$i?>"><?=$log[$i]['belg_id'];?></td>
						<td style="text-align:left;"><?=$log[$i]['theme'];?></td>
						<td><?=$log[$i]['envir'];?></td>
						<td><?=$log[$i]['dep_title'];?></td>
						<td><?=$log[$i]['act_title'];?></td>
					<td>
						<div class="ButtonOperation">
			<input type="image" title="Просмотреть" class="RecView" id="v<?=$i?>" rID="<?=$i?>" src="<?=$baseurl;?>images/icon_search.png" />
		<?php if($log[$i]['belg_edit']):?>
			<input type="image" title="Редактировать" class="RecEdit" id="e<?=$i?>" rID="<?=$i;?>" src="<?=$baseurl;?>images/edit.png" />
		<?php endif;?>
		<?php if($log[$i]['belg_delete']):?>
			<input type="image" title="Удалить" class="RecDel" id="e<?=$i?>" rID="<?=$i;?>" src="<?=$baseurl;?>images/delete.png" />
		<?php endif;?>
						</div>
					</td>
					<td>
						<div class="ButtonOperation">
			<input type="image" title="Удалить лог" class="LogDel" id="e<?=$i?>" rID="<?=$i;?>" src="<?=$baseurl;?>images/delete.png" />
						</div>
					</td>
				</tr>
				<?php endfor; ?>	
			</tbody>
		</table>
	</div>
</div>
<div class="clear"></div>