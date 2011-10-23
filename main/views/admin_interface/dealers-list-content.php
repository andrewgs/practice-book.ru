<div class="box">
	<div class="box-header">
		Список дилеров:
		<div class="box-search">
			<?=anchor('admin/control-panel/'.$userinfo['uconfirmation'],'Вернуться назад',array('class'=>'lnk-submit'));?>
		</div>
	</div>
	<div class="box-content h960 w960">
		<table summary="Список дилеров">
			<thead>
				<tr class="odd">
					<th scope="col" abbr="ID">ID</th>
					<th scope="col" abbr="Ф.И.О.">Ф.И.О.</th>	
					<th scope="col" abbr="E-MAIL">E-MAIL</th>
					<th scope="col" abbr="ЗАРЕГИСТРИРОВАН">ЗАРЕГ.</th>
					<th scope="col" abbr="ЗАКРЫТЫЙ">ЗАКР.</th>
					<th scope="col" abbr="КОМПАНИЙ">КОМПАНИЙ</th>
					<th scope="col" abbr="РЕГИОНЫ">РЕГИОНЫ</th>
					<th scope="col" abbr="ДЕЙСТВИЯ">&nbsp;</th>
				</tr>	
			</thead>
		    <tfoot>	
			 	&nbsp;
			</tfoot>
			<tbody>
			<?php for($i=0,$k=0;$i<count($list);$i++,$k++):?>
				<?php if($i%2!==0):?>
					<tr rID="<?=$k?>"> 
				<?php else: ?>
					<tr class="odd" rID="<?=$k?>"> 
				<?php endif; ?>
					<td rID="<?=$k?>"><?=$list[$i]['dlr_id'];?></td>
						<td>
					<span id="sp<?=$k?>"><?=$list[$i]['dlr_name'].' <br/>'.$list[$i]['dlr_subname'].' <br/>'.$list[$i]['dlr_thname'];?></span>
							<?php if($list[$i]['dlr_active']): ?>
								<br/><img src="<?=$baseurl;?>images/online.gif" border="0" title="Пользователь в сети" alt=""/>
							<?php endif; ?>
						</td>
						<td><?=$list[$i]['dlr_email'];?></td>
						<td><?=$list[$i]['dlr_signupdate'];?></td>
						<td><input class="date-form-input" maxlength="10" id="vDate<?=$k?>" rID="<?=$k?> name="ddes" type="text" value="<?=$list[$i]['dlr_destroy'];?>"></td>
						<td>
							Количество - <?=$list[$i]['dlr_company'];?><br/>
							<?php if($list[$i]['dlr_company']):?>
			<input type="image" title="Список компаний" class="btnCompany" id="s<?=$k?>" rID="<?=$k?>" src="<?=$baseurl;?>images/document-task.png" />
							<?php endif;?>
						</td>
						<td>
			<input type="image" title="Список регионов" class="btnRegion" id="s<?=$k?>" rID="<?=$k?>" src="<?=$baseurl;?>images/document-task.png" />
						</td>
						<td>
							<div class="ButtonOperation">
			<input type="image" title="Сохранить" class="btnSave" id="s<?=$k?>" rID="<?=$k?>" src="<?=$baseurl;?>images/save.png" />
			<br/><input type="image" title="Удалить" class="btnDel" id="dl<?=$k?>" rID="<?=$k;?>" src="<?=$baseurl;?>images/delete.png" />
						<?php if($list[$i]['dlr_status'] == "disabled"):?>
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