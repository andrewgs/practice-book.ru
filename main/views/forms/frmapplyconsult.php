<?= form_open($this->uri->uri_string(),array('class'=>'formular')); ?>
	<?=form_hidden('uri',$this->uri->uri_string());?>
	<div class="box">
		<div class="box-header"><b>Заявка на получение консультации</b>
			<div class="box-search" id="error">&nbsp;</div>
		</div>
		<div class="box-content w575 h365">
			<div class="grid_2">
				<div class="btnHidden" id="userPeriod"></div>
				<div class="btnHidden" id="userPrice"></div>
				<label class="label-input">Имя: <span class="necessarily" title="Поле не может быть пустым">*</span></label>
				<label class="label-input">E-mail: <span class="necessarily" title="Поле не может быть пустым">*</span></label>
				<label class="label-input">Номер телефона: <span class="necessarily" title="Поле не может быть пустым">*</span></label>
				<label class="label-input">Стоимость (руб.):</label>
				<label class="label-input">Срок: </label>
				<label class="label-input">Сообщение: <span class="necessarily" title="Поле не может быть пустым">*</span></label>
			</div>
			<div class="grid_3" id="formRep">
				<input class="reg-form-input inpvalue" id="name" name="name" type="text" maxlength="100" value=""/><br/>
				<input class="reg-form-input inpvalue" id="email" name="email" type="text" maxlength="100" value=""/><br/>
				<input class="reg-form-input inpvalue" id="phone" name="phone" type="text" maxlength="100" value=""/><br/>
				<input class="date-form-input inpvalue FontRed" id="PriceVal" name="price" type="text" readonly="readonly" value=""/><br/>
				<select class="font140-select-period" id="period" name="period">
					<option value="1" id="op1">3 часа</option>
					<option value="2" id="op2">6 часов</option>
					<option value="3" id="op3">12 часов</option>
					<option value="4" id="op4">1 день</option>
					<option value="5" id="op5">3 дня</option>
					<option value="6" id="op6">7 дней</option>
				</select>
				<div class="clear"></div>
				<textarea class="edit350-form-textarea inpvalue" name="message" id="message" cols="25" rows="8"></textarea>
			</div>
			<div class="clear"></div>
			<div class="grid_2">
				<input class="btn-action" id="SendApply" type="submit" name="submit" value="Отправить"/>
			</div>
			<div class="clear"></div>
		</div>
		<div class="box-bottom-links h20">
			&nbsp;
			<div class="clear"></div>
		</div>
	</div>
<?= form_close(); ?>