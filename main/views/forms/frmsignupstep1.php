<?= form_open_multipart($this->uri->uri_string(),array('id'=>'formSignup','class'=>'formular')); ?>
	<div class="grid_12">
		<hr size="2"/>
		<div class="grid_5">
			<label class="label-input">Название компании <span class="necessarily" title="Поле не может быть пустым">*</span></label>
			<?=form_error('title');?>
			<input class="reg-form-input inpval" name="title" type="text" value="<?=set_value('title');?>" />
			<label class="label-input">Город основной деятельности компании <span class="necessarily" title="Поле не может быть пустым">*</span></label>
			<?=form_error('city');?>
			<select id="regions" class="mixed-combo inpval" name="region" size="1" style="width:285px; padding: 5px;">
				<option value="0" disabled="disabled" selected="selected">Выберите город</option>
			<?php for($i=0;$i<count($regions);$i++):?>
			<option value="<?=$regions[$i]['reg_id'];?>"<?=set_select('region',$regions[$i]['reg_id']);?>><?=$regions[$i]['reg_name'];?></option>
			<?php endfor; ?>
			</select>
			<label class="label-input">Компания - производитель</label>
			Да <input type="radio" name="maker" value="1" <?=set_radio('maker','1');?> />
			Нет <input type="radio" name="maker" value="0" <?=set_radio('maker','0',TRUE);?>/> 
			<label class="label-input">Юридическое лицо <span class="necessarily" title="Поле не может быть пустым">*</span></label>
			<?=form_error('ur_face');?>
			<input class="reg-form-input inpval" name="ur_face" type="text" value="<?=set_value('ur_face'); ?>"/>
			<label class="label-input">Логотип компании</label>
			<?=form_error('userfile');?>
			<input class="reg-form-input" type="file" name="userfile" accept="image/jpeg,png,gif" size="32"/>
			<div class="form-reqs" style="width:275px;">Поддерживаемые форматы: JPG, GIF, PNG</div>
		</div>
		<div class="grid_5 prefix_1">
			<label class="label-input">Адрес корпоративного сайта</label>
			<input class="reg-form-input" name="site" type="text" size="50" value="<?=set_value('site');?>"/>
			<label class="label-input">E-mail Компании <span class="necessarily" title="Поле не может быть пустым">*</span></label>
			<?=form_error('email');?>
			<input class="reg-form-input inpval" id="email" name="email" type="text" size="50" value="<?=set_value('email');?>"/>
			<label class="label-input">Телефон <span class="necessarily" title="Поле не может быть пустым">*</span></label>
			<?=form_error('tel');?>
			<input class="reg-form-input inpval number" id="phone" name="tel" type="text" value="<?=set_value('tel');?>"/>
			<label class="label-input">Телефон/Факс </label>
			<?=form_error('telfax');?>
			<input class="reg-form-input number" id="fax" name="telfax" type="text" size="50" value="<?=set_value('telfax');?>"/>
			<label class="label-input">Юридический адрес компании <span class="necessarily" title="Поле не может быть пустым">*</span></label>
			<?=form_error('adres');?>
			<input class="reg-form-input inpval" name="uradres" type="text" value="<?=set_value('uradres');?>"/>
			<label class="label-input">Фактический адрес компании <span class="necessarily" title="Поле не может быть пустым">*</span></label>
			<?= form_error('adres'); ?>
			<input class="reg-form-input inpval" name="realadres" type="text" value="<?=set_value('realadres');?>"/>
		</div>
		<div class="clear"></div>
		<div class="grid_10">
			<label class="label-input">Описание деятельности компании <span class="necessarily" title="Поле не может быть пустым">*</span></label>
			<?= form_error('comment'); ?>
			<textarea class="edit750-form-textarea inpval" name="comment" cols="120" rows="5"><?=set_value('comment');?></textarea>
			<label class="label-input">Реквизиты компании <span class="necessarily" title="Поле не может быть пустым">*</span></label>
			<?= form_error('recvizit'); ?>
			<textarea class="edit750-form-textarea inpval" name="recvizit" cols="120" rows="4"><?=set_value('recvizit');?></textarea>
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
		<hr size="2"/>
		<input class="btn-action margin-1em" id="next" type="submit" name="submit" value="Следующий Шаг >> "/>
		<input class="btn-action margin-1em" type="button" id="btnReturn" value="Отменить"/>
	</div>
	<div class="clear"></div>
<?= form_close(); ?>