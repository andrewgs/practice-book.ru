<div class="container_12 framing">
	<div class="grid_12">
		<h1>Данные компании</h1>
		<div class="grid_5">
			Название компании  <span class="necessarily" title="Поле не может быть пустым">*</span>: <div class="vRight" id="dcname">&nbsp;</div><br/>
			<input class="reg-form-input mbottom" id="vcname" name="cname" type="text" value="<?=htmlspecialchars($company['cmp_name']);?>">
			<span class="btnsave" id="svcname">
			<input type="image" title="Сменить название" class="ajaxsave" id="cname" src="<?=$baseurl;?>images/save.png" vspace="3" hspace="2" border="0" />
			</span>
			<div class="clear"></div>
			Компания - производитель: <div class="vRight" id="dprod">&nbsp;</div><br/>
			Да <input type="radio" name="maker" id="v1prod" value="1" <?= ($company['cmp_producer'] == 1)? 'checked="checked"':'';?>/>
			Нет <input type="radio" name="maker" id="v2prod" value="0" <?= ($company['cmp_producer'] == 0)? 'checked="checked"':'';?>/>
			<span class="btnsave" id="svprod">
			<input type="image" title="Сохранить" class="ajaxsave" id="prod" src="<?=$baseurl;?>images/save.png" vspace="3" hspace="2" />
			</span>
			<div class="clear"></div>
			Логотип компании:<br>
			<img src="<?=$baseurl;?>companylogo/viewimage/<?=$company['cmp_id'];?>" vspace="10" border="0" class="floated" alt=""/>
			<div class="vRight" id="dscavatar"><?= form_error('userfile'); ?></div>
			<?= form_open_multipart($this->uri->uri_string(),array('id'=>'formAvatar','class'=>'formular')); ?>
				<input class="reg-form-input" type="file" id="vcavatar" name="userfile">
				<?= form_hidden('fileupload',TRUE); ?>
			<?= form_close(); ?>
			<span class="btnsave" id="svcavatar">
			<input type="image" title="Сменить логотип" class="ajaxSaveFile" id="scavatar" src="<?=$baseurl;?>images/save.png" vspace="3" hspace="2" />
			</span>
			<div class="grid_4" style="margin:0px;width:75%;">
				<div class="form-reqs">Поддерживаемые форматы: JPG, GIF, PNG</div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="grid_5">
			Корпоративный сайт: <div class="vRight" id="dsite">&nbsp;</div><br/>
			<input class="reg-form-input mbottom" id="vsite" name="site" type="text" value="<?=$company['cmp_site'];?>">
			<span class="btnsave" id="svsite">
			<input type="image" title="Сменить адрес" class="ajaxsave" id="site" src="<?=$baseurl;?>images/save.png" vspace="3" hspace="2" border="0" />
			</span>
			<div class="clear"></div>
			E-Mail компании <span class="necessarily" title="Поле не может быть пустым">*</span>: <div class="vRight" id="demail">&nbsp;</div><br/>
			<input class="reg-form-input mbottom" id="vemail" name="email" type="text" value="<?=$company['cmp_email'];?>">
			<span class="btnsave" id="svemail">
			<input type="image" title="Сменить E-mail" class="ajaxsave" id="email" src="<?=$baseurl;?>images/save.png" vspace="3" hspace="2" border="0" />
			</span>
			<div class="clear"></div>
			Телефон: <div class="vRight" id="dtel">&nbsp;</div><br/>
			<input class="reg-form-input mbottom" id="vtel" name="tel" type="text" value="<?=$company['cmp_phone'];?>">
			<span class="btnsave" id="svtel">
			<input type="image" title="Сменить телефон" class="ajaxsave" id="tel" src="<?=$baseurl;?>images/save.png" vspace="3" hspace="2" border="0" />
			</span>
			<div class="clear"></div>
			Телефон/Факс: <div class="vRight" id="dtelfax">&nbsp;</div><br/>
			<input class="reg-form-input mbottom" id="vtelfax" name="telfax" type="text" value="<?=$company['cmp_telfax'];?>">
			<span class="btnsave" id="svtelfax">
			<input type="image" title="Сохранить" class="ajaxsave" id="telfax" src="<?=$baseurl;?>images/save.png" vspace="3" hspace="2" border="0" />
			</span>
			<div class="clear"></div>
			Юридическое лицо: <div class="vRight" id="durface">&nbsp;</div><br/>
			<input class="reg-form-input mbottom" name="phones" id="vurface" type="text" value="<?=htmlspecialchars($company['cmp_urface']);?>">
			<span class="btnsave" id="svurface">
				<input type="image" title="Сохранить" class="ajaxsave" id="urface" src="<?=$baseurl;?>images/save.png" vspace="3" hspace="2" />
			</span>
			<div class="clear"></div>
			Юридический адрес: <div class="vRight" id="dadres">&nbsp;</div><br/>
			<input class="reg-form-input mbottom" id="vadres" name="adres" type="text" value="<?=htmlspecialchars($company['cmp_uraddress']);?>">
			<span class="btnsave" id="svadres">
			<input type="image" title="Сохранить" class="ajaxsave" id="adres" src="<?=$baseurl;?>images/save.png" vspace="3" hspace="2" border="0" />
			</span>
			Фактическеий адрес: <div class="vRight" id="dradres">&nbsp;</div><br/>
			<input class="reg-form-input mbottom" id="vradres" name="radres" type="text" value="<?=htmlspecialchars($company['cmp_realaddress']);?>">
			<span class="btnsave" id="svradres">
			<input type="image" title="Сохранить" class="ajaxsave" id="radres" src="<?=$baseurl;?>images/save.png" vspace="3" hspace="2" border="0" />
			</span>
		</div>
		<div class="clear"></div>
		<div class="grid_10">
			Деятельность компании: <div class="vRight" id="ddescription"></div><br/>
		<textarea class="reg-form-textarea mbottom" name="description" cols="50" rows="5" id="vdescription"><?=preg_replace('/<br>/',"\n\n",$company['cmp_description']);?></textarea>
			<span class="btnsave" id="svdescription">
			<input type="image" title="Сохранить" class="ajaxsave" id="description" src="<?=$baseurl;?>images/save.png" vspace="3" hspace="2" />
			</span>
			<div class="clear"></div>
			Реквизиты компании: <div class="vRight" id="ddetails"></div><br>
		<textarea class="reg-form-textarea mbottom" name="details" id="vdetails" cols="50" rows="4"><?=preg_replace('/<br>/',"\n\n",$company['cmp_details']);?></textarea>
			<span class="btnsave" id="svskype">
				<input type="image" title="Сохранить" class="ajaxsave" id="details" src="<?=$baseurl;?>images/save.png" vspace="3" hspace="2" />
			</span>
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
		<div class="grid_6">
			<div id="company-data">
				Регион: <strong><?= $cmpregion['reg_area']; ?>, <?= $cmpregion['reg_name']; ?></strong><br><br>
				Cферы деятельности: <br/>
					<?php for($i=0;$i<count($activity);$i++):?>
						<strong><?=($i+1).'. '.$activity[$i]['act_fulltitle'];?><br/></strong>
					<?php endfor; ?>
					<br>
				<button id="regman" style="height:3em; margin-top:15px;">
					<img src="<?=$baseurl;?>images/users.png"><font size="3"> Представители компании</font>
				</button>	
			</div>
		</div>
		<div class="clear"></div>
	</div>
	<div class="clear"></div>
</div>	
<div class="push"></div>