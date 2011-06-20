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
			Аватар:<br>
			<img src="<?=$baseurl;?>mavatar/viewimage/<?=$manager['uid'];?>"class="floated" alt=""/>
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
			Контактный телефон: <div class="vRight" id="dphones"><?=$manager['uphone'];?></div><br>
			<input class="reg-form-input" name="phones" id="vphones" type="text">
			<span class="btnsave" id="svphones">
				<input type="image" title="Сохранить н/тел." class="ajaxsave" id="phones" src="<?=$baseurl;?>images/save.png" vspace="3" hspace="2" />
			</span>
			<div class="clear"></div>
			Номер ICQ: <div class="vRight" id="dicq"><?=$manager['uicq'];?></div><br>
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
			Достижения: <div class="vRight" id="dachi"></div><br>
			<span class="btnsave" id="svdachi">
		<input type="image" title="Сохранить" class="ajaxsave" id="achi" src="<?=$baseurl;?>images/save.png" vspace="3" hspace="2" />
			</span>
			<textarea class="edit270-form-textarea" name="achi" id="vachi" cols="20" rows="5"><?=$manager['uachievement'];?></textarea>
			<div class="clear"></div>
		</div>
		<div class="grid_6">
			<div id="jobList">
				<?php $this->load->view('manager_interface/joblist'); ?>
			</div>
			<hr size="2">
			<div class="job-sections">
				<div class="clear"></div>
				<h3>Организация: </h3>
				<input class="reg-form-input jobs" id="organValue" name="organization" type="text" size="30" >
				<div class="clear"></div>
				<h3>Должность: </h3>
				<input class="reg-form-input jobs" id="posValue" name="position" type="text" size="30">
				<div class="clear"></div>
				<h3>Период работы:</h3>  
				<div id="period-jobs">
					<select class="reg-form-input" id="yBegin" style="width:70px" name="start">
					<?php for($i = date('Y');$i > 1970;$i--): ?>
						<option><?= $i; ?></option>
					<?php endfor; ?>
					</select> - 
					<select class="reg-form-input" id="yEnd" style="width:70px" name="finish">
						<option>н/в</option>
					<?php for($i = date('Y');$i > 1970;$i--): ?>
						<option><?= $i; ?></option>
					<?php endfor; ?>
					</select>
				</div>
				<div class="clear"></div>
			</div>
			<div class="clear"></div>
			<button id="instjob" style="height:2.5em">
				<img src="<?=$baseurl;?>images/plus.png"><font size="3"> Добавить место работы</font>
			</button>
			<hr size="2">
			<div id="menager-data">
				<?php if($manager['upriority'] == 0): ?>
				Регионы:<br>
					<? for($i=0;$i<count($regions);$i++): ?>
						<strong><?= $regions[$i]['reg_name']; ?> (<?= $regions[$i]['reg_area']; ?>)</strong><br/>
					<?php endfor; ?>		
					<br/>
				<? else: ?>
				Регионы:<br><strong>Вы как федеральный менеджер обслуживаете все регионы.</strong><br><br>
				<?php endif; ?>
				Отрасль (подотрасль): <strong><?= $manager['activity']; ?></strong><br><br>
				<?php if($manager['upriority']): ?>
					<div class="form-reqs" style="padding: 15px 10px">
						<span title="Добавить менеджера к Вашей отрасли или подотрасли" class="box-controls ask">?</span>
						<button id="regman" style="height:2.5em">
							<img src="<?=$baseurl;?>images/user-plus.png"><font size="3"> Зарегистрировать менеджера</font>
						</button>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<div class="clear"></div>
</div>	
<div class="push"></div>