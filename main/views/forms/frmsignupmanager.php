<?= form_open_multipart($this->uri->uri_string(),array('id'=>'formmanauth','class'=>'formular')); ?>
	<hr size="2px"/>
	<div class="grid_4">
		<div class="regLabel">Логин (E-Mail) <span class="necessarily" title="Обязательно нужно указать">*</span></div>
		<?= form_error('login'); ?>
		<input class="reg-form-input inputValid" id="email" name="login" type="text" value="<?=set_value('login');?>"/>
		<div class="regLabel">Пароль <span class="necessarily" title="Обязательно нужно указать">*</span></div>
		<?= form_error('password'); ?>
		<input class="reg-form-input inputValid" type="password" name="password" id="password" value="<?=set_value('password');?>"/>
		<div class="regLabel">Повторите пароль <span class="necessarily" title="Обязательно нужно указать">*</span></div>
		<?= form_error('confirmpass'); ?>
		<input class="reg-form-input inputValid" type="password" name="confirmpass" value="<?=set_value('confirmpass');?>"/>
		<div class="regLabel">Фото</div>
		<?= form_error('userfile'); ?>
		<input class="reg-form-input" type="file" name="userfile" accept="image/jpeg,png,gif" size="30"/>
		<div class="form-reqs">Поддерживаемые форматы: JPG, GIF, PNG.<br/>Изображение должно быть по пояс на белом фоне.</div>
	</div>
	<div class="grid_4 prefix_2">
		<div class="regLabel">Фамилия <span class="necessarily" title="Обязательно нужно указать">*</span></div>
		<?= form_error('fname'); ?>
		<input class="reg-form-input inputValid" name="fname" type="text" value="<?=set_value('fname');?>"/>
		<div class="regLabel">Имя (полностью) <span class="necessarily" title="Обязательно нужно указать">*</span></div>
		<?= form_error('sname'); ?>
		<input class="reg-form-input inputValid" name="sname" type="text" value="<?=set_value('sname');?>"/>
		<div class="regLabel">Отчество <span class="necessarily" title="Обязательно нужно указать">*</span></div>
		<?= form_error('tname'); ?>
		<input class="reg-form-input inputValid" name="tname" type="text" value="<?=set_value('tname');?>"/>
		<div class="regLabel">Номер контактного телефона <span class="necessarily" title="Обязательно нужно указать">*</span></div>
		<?= form_error('phones'); ?>
		<input class="reg-form-input inputValid" name="phones" type="text" value="<?=set_value('phones');?>"/>
		<div class="regLabel">Номер ICQ</div>
		<?= form_error('icq'); ?>
		<input class="reg-form-input" name="icq" type="text" size="45" maxlength="15" value="<?=set_value('icq');?>"/>
		<div class="regLabel">Логин Skype</div>
		<?= form_error('skype'); ?>
		<input class="reg-form-input" name="skype" type="text" size="45" maxlength="45" value="<?=set_value('skype');?>"/>
	</div>
	<div class="clear"></div>
	<hr size="2px"/>
	<h2>Опыт работы</h2>
	<div id="exp">
		<div list="jobLine">
			<?php $this->load->view('forms/frmnewjob'); ?>
		</div>
	</div>
	<input class="goog-button mt7 mb10" id="btnAddJobLine" type="button" value="Добавить место работы"/>
	<input class="goog-button mt7 mb10" id="btnDelJobLine" type="button" value="Удалить место работы"/>
	<hr size="2px"/>
	<div class="grid_12">
		<div class="grid_4">
			<div id="dregion">
				<h2>Регионы <span class="necessarily" title="Обязательно нужно указать">*</span></h2>
				<div class="box">
					<div class="box-header"><?=form_error('region[]');?>&nbsp;</div>
						<div class="box-content w280 h250">
							<select name="region[]" id="select-region" class="mixed-combo" size="16" multiple style="width: 280px;">
							<?php for($i = 0;$i < count($regions);$i++): ?>
								<optgroup label="<?=$regions[$i]['reg_district'];?>">
								<?php $j = $i;?>
								<?php while($regions[$j]['reg_district'] === $regions[$i]['reg_district']): ?>
									<option value="<?=$regions[$j]['reg_id'];?>"<?=set_select('region[]',$regions[$j]['reg_id']);?>>
										<?=$regions[$j]['reg_name'].' ('.$regions[$j]['reg_area'].')';?>
									</option>
									<?php $j++; ?>
								<?php endwhile; ?>
								<?php $i = $j-1;?>
								</optgroup>
							<?php endfor; ?>
							</select>
						</div>
					<div class="box-bottom-links h20">&nbsp;</div>
				</div>
			</div>
		</div>
		<div class="grid_4 prefix_2">
			<div id="activityList">
				<h2>Сфера деятельности <span class="necessarily" title="Обязательно нужно указать">*</span></h2>
				<div class="box">
					<div class="box-header"><?=form_error('activity');?>&nbsp;</div>
						<div class="box-content w280 h250">
							<select name="activity" id="select-activity" class="mixed-combo" size="16" style="width: 280px;">
							<?php for($i = 0;$i < count($activity);$i++): ?>
								<option value="<?=$activity[$i]['act_id'];?>"<?=set_select('activity',$activity[$i]['act_id']);?>>
									<?=$activity[$i]['act_title'];?>
								</option>
							<?php endfor; ?>
							</select>
						</div>
					<div class="box-bottom-links h20">&nbsp;</div>
				</div>
			</div>
		</div>
	</div>
	<div class="clear"></div>
	<hr size="2px"/>
	
	<div class="form-reqs" style="text-align: center">
		Нажав на кнопку <b>"Зарегистрировать"</b>, вы соглашаетесь с условиями <?= anchor($baseurl.'license','лицензионного соглашения')?>
	</div>
	<input class="btn-action margin-1em" type="submit" id="btnSubmit" name="submit" value="Зарегистрировать"/>
<?= form_close(); ?>
