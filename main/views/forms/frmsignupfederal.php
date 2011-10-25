<?= form_open_multipart($this->uri->uri_string(),array('id'=>'formmanauth','class'=>'formular')); ?>
	<hr size="2px"/>
	<div class="grid_4">
		<div class="regLabel">Логин (E-mail) <span class="necessarily" title="Обязательно нужно указать">*</span></div>
		<?= form_error('login'); ?>
		<input class="reg-form-input inputValid" id="email" name="login" type="text" value="<?=set_value('login');?>"/>
		<div class="regLabel">Пароль </div>
		<input class="reg-form-input" readonly="readonly" type="text" name="password" value="federal"/>
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
		<input class="reg-form-input inputValid number" name="phones" type="text" value="<?=set_value('phones');?>"/>
	</div>
	<div class="clear"></div>
	<hr size="2px"/>
	<div class="grid_12">
		<div class="grid_4">
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
	<input class="btn-action margin-1em" type="submit" id="btnSubmit" name="submit" value="Зарегистрировать"/>
	<input class="btn-action margin-1em" type="button" id="btnReturn" value="Отменить"/>
<?= form_close(); ?>
