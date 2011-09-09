<div class="box">
	<div class="box-header">
		Список отделов:
		<div class="box-search">
			<?=anchor('admin/control-panel/'.$userinfo['uconfirmation'],'Вернуться назад',array('class'=>'lnk-submit'));?>
		</div>
	</div>
	<div class="box-content h960 w918">
		<table summary="Список регионов">
			<thead>
				<tr class="odd">
					<th scope="col" abbr="ID">ID</th>
					<th scope="col" abbr="НАЗВАНИЕ ОТДЕЛА">НАЗВАНИЕ ОТДЕЛА</th>	
					<th scope="col" abbr="ДЕЙСТВИЯ">&nbsp;</th>
				</tr>	
			</thead>
		    <tfoot>	
			 	&nbsp;
			</tfoot>
			<tbody>
			<?php for($i=0;$i<count($list);$i++):?>
				<?php if($i % 2 !== 0): ?>
					<tr dID="<?=$i?>"> 
				<?php else: ?>
					<tr class="odd" dID="<?=$i?>"> 
				<?php endif; ?>
					<td dID="<?=$i?>"><?=$list[$i]['dep_id'];?></td>
		<td><input class="edit750-form-input" id="vName<?=$i?>" dID="<?=$i?> name="name" type="text" value="<?=$list[$i]['dep_title'];?>"></td>
					<td>
						<div class="ButtonOperation">
			<input type="image" title="Сохранить" class="NewsSave btnHidden" id="s<?=$i?>" dID="<?=$i?>" src="<?=$baseurl;?>images/save.png" />
						</div>
					</td> 
				</tr>
				<?php endfor; ?>
			</tbody>
		</table>
	</div>
</div>
<div class="clear"></div>