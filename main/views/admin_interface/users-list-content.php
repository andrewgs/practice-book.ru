<div class="box">
	<div class="box-header">
		Список пользователей: <strong><?=$list['caption'];?></strong>
		<div class="box-search">
			<?=anchor('admin/control-panel/'.$userinfo['uconfirmation'],'Вернуться назад',array('class'=>'lnk-submit'));?>
		</div>
	</div>
	<div class="box-content h960 w960">
		<table summary="Список пользователей">
			<thead>
				<tr class="odd">
					<th scope="col" abbr="ID">ID</th>
					<th scope="col" abbr="Ф.И.О.">Ф.И.О.</th>	
					<th scope="col" abbr="E-MAIL">E-MAIL</th>
					<th scope="col" abbr="ЗАРЕГИСТРИРОВАН">ЗАРЕГ.</th>
					<th scope="col" abbr="ЗАКРЫТЫЙ">ЗАКР.</th>
					<th scope="col" abbr="ПРИОРИТЕТ">ПРИОР.</th>
					<th scope="col" abbr="ID КОМПАНИИ">КОМП.</th>
					<th scope="col" abbr="ID ОТРАСЛИ">ОТРАСЛЬ</th>
					<th scope="col" abbr="КОЛИЧЕСТВО КОНСУЛЬТАЦИЯ">КОНСУЛ.</th>
					<th scope="col" abbr="ДЕЙСТВИЯ">&nbsp;</th>
				</tr>	
			</thead>
		    <tfoot>	
			 	&nbsp;
			</tfoot>
			<tbody>
			<?php for($i=0,$k=0;$i<count($list)-2;$i++,$k++):?>
				<?php if($i%2!==0):?>
					<tr rID="<?=$k?>"> 
				<?php else: ?>
					<tr class="odd" rID="<?=$k?>"> 
				<?php endif; ?>
					<td rID="<?=$k?>"><?=$list[$i]['uid'];?></td>
						<td>
						<?php if($list[$i]['udestroy'] == '3000-01-01'):?>
							<?=$list[$i]['uname'].'<br/>'.$list[$i]['usubname'].'<br/>'.$list[$i]['uthname'];?>
							<?php if($list[$i]['uactive']): ?>
								<br/><img src="<?=$baseurl;?>images/online.gif" border="0" title="Пользователь в сети" alt=""/>
							<?php endif; ?>
						<?php else:?>
							<font style="color:#ff0000">Пользователь закрыт</font>
						<?php endif; ?>
						</td>
						<td><?=$list[$i]['uemail'];?></td>
						<td><?=$list[$i]['usignupdate'];?></td>
					<?php if($list['group']>0):?>
						<td><input class="date-form-input" maxlength="10" id="vDate<?=$k?>" rID="<?=$k?> name="ddes" type="text" value="<?=$list[$i]['udestroy'];?>"></td>
						<td><input class="reg-form-small final" id="vPriority<?=$k?>" rID="<?=$k?> name="priority" type="text" value="<?=$list[$i]['upriority'];?>"></td>
					<?php else: ?>
						<td>&mdash;</td>
						<td>&mdash;</td>
					<?php endif;?>
					<?php if($list['group']==3):?>
						<td><?=$list[$i]['ucompany'];?></td>
					<?php else: ?>
						<td>&mdash;</td>
					<?php endif;?>
					<?php if($list['group']==3):?>
						<td>&mdash;</td>
					<?php elseif($list['group']>0): ?>
						<td><input class="reg-form-small parentid" id="vActivity<?=$k?>" rID="<?=$k?> name="activity" type="text" value="<?=$list[$i]['uactivity'];?>"></td>
					<?php else: ?>
						<td>&mdash;</td>
					<?php endif;?>
					
					<?php if($list['group']==3):?>
						<td>&mdash;</td>
					<?php elseif($list['group']>0): ?>
						<td>
						<?php if($list[$i]['consult']): ?>
							<?=$list[$i]['consult'];?>
						<?php else: ?>
							&mdash;
						<?php endif; ?>
						</td>
					<?php else: ?>
						<td>&mdash;</td>
					<?php endif;?>
					
					
					<td>
						<div class="ButtonOperation">
						<?php if($list['group']>0):?>
							<input type="image" title="Сохранить" class="btnSave" id="s<?=$k?>" rID="<?=$k?>" src="<?=$baseurl;?>images/save.png" />
						<?php endif;?>
						<br/><input type="image" title="Удалить" class="btnDel" id="dl<?=$k?>" rID="<?=$k;?>" src="<?=$baseurl;?>images/delete.png" />
						<?php if($list[$i]['ustatus'] == "disabled"):?>
				<br/><input type="image" title="Не активирован" class="StatusOff" id="act<?=$k?>" rID="<?=$k?>" src="<?=$baseurl;?>images/exclamation.png" />
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