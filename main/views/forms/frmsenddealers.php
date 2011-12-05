<?= form_open($this->uri->uri_string(),array('class'=>'formular','id'=>'frmSendDlr')); ?>
	<div class="box">
		<div class="box-header"><b>Укажите данные Вашей компании.</b>
			<div class="box-search" id="derror">&nbsp;</div>
		</div>
		<div class="box-content w575">
			<div class="grid_4">
				<label class="label-input">Название: <span class="necessarily" title="Поле не может быть пустым">*</span></label>
				<label class="label-input">E-mail: <span class="necessarily" title="Поле не может быть пустым">*</span></label>
				<label class="label-input">Телефон: <span class="necessarily" title="Поле не может быть пустым">*</span></label>
				<label class="label-input">Город регистрации: <span class="necessarily" title="Поле не может быть пустым">*</span></label>
				<label class="label-input">Сообщение:</label>
			</div>
			<div class="grid_3" id="formDlr">
				<input class="edit275-form-input inpvalue" id="dlrid" name="dlrid" type="text" value="" style="display:none;"/><br/>
				<input class="edit275-form-input inpvalue" id="dname" name="name" type="text" maxlength="100" value=""/><br/>
				<input class="edit275-form-input inpvalue" id="demail" name="email" type="text" maxlength="100" value=""/><br/>
				<input class="edit275-form-input inpvalue" id="dphone" name="phone" type="text" maxlength="100" value=""/><br/>
				<input class="edit275-form-input inpvalue" id="dregion" name="region" type="text" maxlength="100" value=""/><br/>
				<textarea class="edit360-form-textarea" name="message" id="dmessage" rows="4"></textarea>
			</div>
			<div class="clear"></div>
			<hr size="2"/>
			<font color="#ff0000">Внимание! </font>После прочтения заявки, дилер на указаный Вами E-mail вышлет письмо с кодом. Воспользуйтесь полученым кодом для регистрации Вашей компании у нас на проекте.
			<hr size="2"/>
			<div class="grid_2">
				<input class="btn-action" id="SendDealer" type="submit" name="dsubmit" value="Отправить"/>
			</div>
			<div class="clear"></div>
		</div>
		<div class="box-bottom-links h20">
			&nbsp;
			<div class="clear"></div>
		</div>
	</div>
<?= form_close(); ?>