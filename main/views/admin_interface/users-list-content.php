<div class="box">
	<div class="box-header">
		Список пользователей:
		<div class="box-search">
			<?=anchor('admin/control-panel/'.$userinfo['uconfirmation'],'Вернуться назад',array('class'=>'lnk-submit'));?>
		</div>
	</div>
	<div class="box-content h470 w918">
	<?php for($i=0,$k=0;$i<4;$i++,$k++): ?>
		<table summary="Список администраторов">
			<caption><?=$list[$i]['caption'];?></caption>
			<thead>
				<tr class="odd">
					<th scope="col" abbr="ID">ID</th>
					<th scope="col" abbr="Ф.И.О.">Ф.И.О.</th>	
					<th scope="col" abbr="E-MAIL">E-MAIL</th>
					<th scope="col" abbr="ЗАРЕГИСТРИРОВАН">ЗАРЕГ.</th>
					<th scope="col" abbr="ЗАКРЫТЫЙ">ЗАКР.</th>
					<th scope="col" abbr="ПРИОРИТЕТ">ПРИОР.</th>
					<th scope="col" abbr="ID КОМПАНИИ">КОМП.</th>
					<th scope="col" abbr="ID ОТРОСЛИ">ОТРОСЛЬ</th>
					<th scope="col" abbr="ДЕЙСТВИЯ">&nbsp;</th>
				</tr>	
			</thead>
		    <tfoot>	
			 	&nbsp;
			</tfoot>
			<tbody>
			<?php for($j=0;$j<count($list[$i])-1;$j++,$k++):?>
				<?php if($j % 2 !== 0): ?>
					<tr rID="<?=$k?>"> 
				<?php else: ?>
					<tr class="odd" rID="<?=$k?>"> 
				<?php endif; ?>
					<td rID="<?=$k?>"><?=$list[$i][$j]['uid'];?></td>
						<td>
							<?=$list[$i][$j]['uname'].'<br/>'.$list[$i][$j]['usubname'].'<br/>'.$list[$i][$j]['uthname'];?>
							<?php if($list[$i][$j]['uactive']): ?>
								<br/><img src="<?=$baseurl;?>images/online.gif" border="0" title="Пользователь в сети" alt=""/>
							<?php endif; ?>
						</td>
						<td><?=$list[$i][$j]['uemail'];?></td>
						<td><?=$list[$i][$j]['usignupdate'];?></td>
					<?php if($i>0):?>
						<td><input class="date-form-input" id="vDate<?=$k?>" rID="<?=$k?> name="ddes" type="text" value="<?=$list[$i][$j]['udestroy'];?>"></td>
						<td><input class="reg-form-small final" id="vPriority<?=$k?>" rID="<?=$k?> name="priority" type="text" value="<?=$list[$i][$j]['upriority'];?>"></td>
					<?php else: ?>
						<td>&mdash;</td>
						<td>&mdash;</td>
					<?php endif;?>
					<?php if($i==3):?>
						<td><?=$list[$i][$j]['ucompany'];?></td>
					<?php else: ?>
						<td>&mdash;</td>
					<?php endif;?>
					<?php if($i==3):?>
						<td>&mdash;</td>
					<?php elseif($i>0): ?>
						<td><input class="reg-form-small parentid" id="vActivity<?=$k?>" rID="<?=$k?> name="activity" type="text" value="<?=$list[$i][$j]['uactivity'];?>"></td>
					<?php else: ?>
						<td>&mdash;</td>
					<?php endif;?>
					<td>
						<div class="ButtonOperation">
						<?php if($i>0):?>
							<input type="image" title="Сохранить" class="btnSave" btnHidden" id="s<?=$k?>" rID="<?=$k?>" src="<?=$baseurl;?>images/save.png" />
						<?php endif;?>
						<?php if($list[$i][$j]['ustatus'] == "disabled"):?>
				<br/><input type="image" title="Удалить" class="btnDel" id="dl<?=$k?>" rID="<?=$k;?>" src="<?=$baseurl;?>images/delete.png" />
				<br/><input type="image" title="Не активирован" src="<?= $baseurl; ?>images/exclamation.png" />
						<?php endif; ?>
						</div>
					</td> 
				</tr>
				<?php endfor; ?>	
			</tbody>
		</table>
	<?php endfor; ?>
	</div>
</div>
<div class="clear"></div>