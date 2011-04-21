<?= form_open('support',array('class'=>'formular')); ?>
	<?=form_hidden('uri',$this->uri->uri_string());?>
	<div class="box">
		<div class="box-header"><b>Отправить нам сообщение</b>
			<div class="box-search" id="error">&nbsp;</div>
		</div>
		<div class="box-content w575">
			<div class="grid_2">
				<label class="label-input">Имя: <span class="necessarily" title="Поле не может быть пустым">*</span></label>
				<label class="label-input">E-mail: <span class="necessarily" title="Поле не может быть пустым">*</span></label>
				<label class="label-input">Тема: <span class="necessarily" title="Поле не может быть пустым">*</span></label>
				<label class="label-input">Сообщение: <span class="necessarily" title="Поле не может быть пустым">*</span></label>
			</div>
			<div class="grid_4" id="formRep">
				<input class="reg-form-input inpvalue" id="name" name="name" type="text" maxlength="100" value=""/><br/>
				<input class="reg-form-input inpvalue" id="email" name="email" type="text" maxlength="100" value=""/><br/>
				<input class="reg-form-input inpvalue" id="theme" name="theme" type="text" maxlength="100" value=""/><br/>
				<textarea class="small-form-textarea inpvalue" name="message" id="message" cols="25" rows="13"></textarea>
			</div>
			<div class="clear"></div>
			<div class="grid_2">
				<input class="btn-action" id="SendSupport" type="submit" name="submit" value="Отправить"/>
			</div>
			<div class="clear"></div>
		</div>
		<div class="box-bottom-links h20">
			&nbsp;
			<div class="clear"></div>
		</div>
	</div>
<?= form_close(); ?>