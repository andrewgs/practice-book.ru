<div class="box">
	<div class="box-header">
		Код для регистрации компании:
		<div class="box-search">
			<?=anchor('dealer/control-panel/'.$userinfo['uconfirmation'],'Вернуться назад',array('class'=>'lnk-submit'));?>
		</div>
	</div>
	<div class="box-content h960 w918">
		<div style="margin:30px 0 10px 30px;">
			<input class="reg-form-input" id="code" name="code" readonly="readonly" type="text">
			<button title="Получить код" id="generate" class="btn-action margin-1em">Получить код</button>
		</div>
		<div class="clear"></div>
		<div style="margin:10px 30px;">
			<button title="Дополнительно" id="advanced" class="margin-1em">Дополнительные параметры</button>
			<div style="display:none" id="Param">
				<div class="AdvansedParam">
					<input type="checkbox" id="check1" name="doctype" value="1">Известить компанию<Br/>
				<input class="reg-form-input" placeholder="Введите E-mail компании" id="email" name="email" type="text" style="display:none;">
					<div class="clear"></div>
					<hr size="2"/>
				</div>
				<div class="clear"></div>
			</div>
		</div>
	</div>
</div>
<div class="clear"></div>