<div class="container_12 framing">
	<div class="grid_12">
		<h1>Личные данные</h1>
		<div class="grid_5">
			Логин: <div class="vRight" id="dlogin"><?=$manager['uemail'];?></div><br>
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
		</div>
		<div class="grid_5">
			Контактный телефон: <div class="vRight" id="dphones"><?=$manager['uphone'];?></div><br>
			<input class="reg-form-input" name="phones" id="vphones" type="text">
			<span class="btnsave" id="svphones">
				<input type="image" title="Сохранить н/тел." class="ajaxsave" id="phones" src="<?=$baseurl;?>images/save.png" vspace="3" hspace="2" />
			</span>
			<div class="clear"></div>
			ICQ: <div class="vRight" id="dicq"><?=$manager['uicq'];?></div><br>
			<input class="reg-form-input" name="icq" id="vicq" type="text">
			<span class="btnsave" id="svicq">
				<input type="image" title="Сохранить ICQ" class="ajaxsave" id="icq" src="<?=$baseurl;?>images/save.png" vspace="3" hspace="2" />
			</span>
			<div class="clear"></div>
			Skype: <div class="vRight" id="dskype"><?=$manager['uskype'];?></div><br>
			<input class="reg-form-input" name="skype" id="vskype" type="text">
			<span class="btnsave" id="svskype">
				<input type="image" title="Сохранить SKYPE" class="ajaxsave" id="skype" src="<?=$baseurl;?>images/save.png" vspace="3" hspace="2" />
			</span>
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
		<hr size="2px"/>
		<input class="btn-action margin-1em" type="button" id="btnReturn" value="Готово"/>
	</div>
	<div class="clear"></div>
</div>
<div class="push"></div>