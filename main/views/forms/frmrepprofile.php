<div class="container_12 framing">
	<div class="grid_12">
		<h1>Личные данные</h1>
		<div class="grid_5">
			Логин: <div class="vRight" id="dlogin"><?=$representative['uemail'];?></div><br>
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
			<img src="<?=$baseurl;?>cravatar/viewimage/<?=$representative['uid'];?>"class="floated" alt=""/>
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
		</div>
		<div class="grid_5 prefix_1">
			
			Должность: <div class="vRight" id="dposition"><?=$representative['uposition'];?></div><br>
			<input class="reg-form-input" name="position" id="vposition" type="text">
			<span class="btnsave" id="svposition">
				<input type="image" title="Сохранить" class="ajaxsave" id="position" src="<?=$baseurl;?>images/save.png" vspace="3" hspace="2" />
			</span>
			<div class="clear"></div>
			Контактный телефон: <div class="vRight" id="dphones"><?=$representative['uphone'];?></div><br>
			<input class="reg-form-input" name="phones" id="vphones" type="text">
			<span class="btnsave" id="svphones">
				<input type="image" title="Сохранить н/тел." class="ajaxsave" id="phones" src="<?=$baseurl;?>images/save.png" vspace="3" hspace="2" />
			</span>
			<div class="clear"></div>
			Номер ICQ: <div class="vRight" id="dicq"><?=$representative['uicq'];?></div><br>
			<input class="reg-form-input" name="icq" id="vicq" type="text">
			<span class="btnsave" id="svicq">
				<input type="image" title="Сохранить ICQ" class="ajaxsave" id="icq" src="<?=$baseurl;?>images/save.png" vspace="3" hspace="2" />
			</span>
			<div class="clear"></div>
			Ваш Skype: <div class="vRight" id="dskype"><?=$representative['uskype'];?></div><br>
			<input class="reg-form-input" name="skype" id="vskype" type="text">
			<span class="btnsave" id="svskype">
				<input type="image" title="Сохранить SKYPE" class="ajaxsave" id="skype" src="<?=$baseurl;?>images/save.png" vspace="3" hspace="2" />
			</span>
			<div class="clear"></div>
			Достижения: <div class="vRight" id="dachi"></div><br>
			<span class="btnsave" id="svdachi">
				<input type="image" title="Сохранить" class="ajaxsave" id="achi" src="<?=$baseurl;?>images/save.png" vspace="3" hspace="2" />
			</span>
			<textarea class="edit270-form-textarea" name="achi" id="vachi" cols="20" rows="5"><?=$representative['uachievement'];?></textarea>
			<div class="clear"></div>
		</div>
	</div>
	<div class="clear"></div>
</div>	
<div class="push"></div>