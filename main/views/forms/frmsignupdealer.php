<?= form_open_multipart($this->uri->uri_string(),array('id'=>'formmanauth','class'=>'formular')); ?>
	<hr size="2px"/>
	<div class="grid_4">
		<div class="regLabel">Логин (E-mail) <span class="necessarily" title="Обязательно нужно указать">*</span></div>
		<?= form_error('login'); ?>
		<input class="reg-form-input inputValid" id="email" name="login" type="text" value="<?=set_value('login');?>"/>
		<div class="regLabel">Пароль</div>
		<input class="reg-form-input" readonly="readonly" type="text" name="password" id="password" value="dealer"/>
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
	<div class="grid_12">
		<div class="grid_6">
			<div id="dregion">
				<h2>Регионы обслуживаемые дилером <span class="necessarily" title="Обязательно нужно указать">*</span></h2>
				<span style="font-size:12px;">Для выбора нескольких регионов пользуйтесь &lt;Ctrl&gt; или &lt;Shift&gt; </span>
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
	</div>
	<div class="clear"></div>
	<hr size="2px"/>
	<input class="btn-action margin-1em" type="submit" id="btnSubmit" name="submit" value="Зарегистрировать"/>
	<input class="btn-action margin-1em" type="button" id="btnReturn" value="Отменить"/>
<?= form_close(); ?>
