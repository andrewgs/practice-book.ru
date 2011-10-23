<div class="container_12 framing">
	<div class="grid_12">
		<h1>Личные данные</h1>
		<hr size="2"/>
		<div class="grid_5">
			Логин: <div class="vRight" id="dlogin"><?=$dealer['dlr_email'];?></div><br>
			<input class="reg-form-input" id="vlogin" name='login' type='text'>
			<span class="btnsave" id="svlogin">
			<input type="image" title="Сменить логин" class="ajaxsave" id="login" src="<?=$baseurl;?>images/save.png" vspace="3" hspace="2" border="0" />
			</span>
			<div class="clear"></div>
			Пароль: <div class="vRight" id="dpass"></div><br>
			<input class="reg-form-input" id="vpass" name='password' type='password'>
			<span class="btnsave" id="svpassword">
			<input type="image" title="Сменить пароль" class="ajaxsave" id="pass" src="<?=$baseurl;?>images/save.png" vspace="3" hspace="2" />
			</span>
			<div class="clear"></div>
			Аватар:<br>
			<img src="<?=$baseurl;?>davatar/viewimage/<?=$dealer['dlr_id'];?>"class="floated" alt=""/>
			<div class="clear"></div>
			<div class="vRight" id="dsavatar"><?= form_error('userfile'); ?></div>
			<?= form_open_multipart($this->uri->uri_string(),array('id'=>'formAvatar','class'=>'formular')); ?>
				<input class="reg-form-input" type="file" id="vavatar" name="userfile">
				<?= form_hidden('fileupload',TRUE); ?>
			<?= form_close(); ?>
			<span class="btnsave" id="svavatar">
			<input type="image" title="Сменить аватар" class="ajaxSaveFile" id="savatar" src="<?=$baseurl;?>images/save.png" vspace="3" hspace="2" />
			</span>
			<div class="grid_4" style="margin:0px;width:75%;">
				<div class="form-reqs">Поддерживаемые форматы: JPG, GIF, PNG</div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="grid_5">
			Контактный телефон: <div class="vRight" id="dphones"><?=$dealer['dlr_phone'];?></div><br>
			<input class="reg-form-input" name="phones" id="vphones" type="text">
			<span class="btnsave" id="svphones">
				<input type="image" title="Сохранить н/тел." class="ajaxsave" id="phones" src="<?=$baseurl;?>images/save.png" vspace="3" hspace="2" />
			</span>
			<div class="clear"></div>
			ICQ: <div class="vRight" id="dicq"><?=$dealer['dlr_icq'];?></div><br>
			<input class="reg-form-input" name="icq" id="vicq" type="text">
			<span class="btnsave" id="svicq">
				<input type="image" title="Сохранить ICQ" class="ajaxsave" id="icq" src="<?=$baseurl;?>images/save.png" vspace="3" hspace="2" />
			</span>
			<div class="clear"></div>
			Skype: <div class="vRight" id="dskype"><?=$dealer['dlr_skype'];?></div><br>
			<input class="reg-form-input" name="skype" id="vskype" type="text">
			<span class="btnsave" id="svskype">
				<input type="image" title="Сохранить SKYPE" class="ajaxsave" id="skype" src="<?=$baseurl;?>images/save.png" vspace="3" hspace="2" />
			</span>
			<div class="clear"></div>
			Должность: <div class="vRight" id="dposition"><?=$dealer['dlr_position'];?></div><br>
			<input class="reg-form-input" name="sposition" id="vposition" type="text">
			<span class="btnsave" id="svposition">
				<input type="image" title="Сохранить" class="ajaxsave" id="position" src="<?=$baseurl;?>images/save.png" vspace="3" hspace="2" />
			</span>
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
		<hr size="2px"/>
		<input class="btn-action margin-1em" type="button" id="btnReturn" value="Отменить"/>
	</div>
	<div class="clear"></div>
</div>
<div class="push"></div>