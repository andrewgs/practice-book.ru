<?=form_open_multipart($this->uri->uri_string(),array('id'=>'formEditProductUnit','class'=>'formular')); ?>
	<div class="rep-container">
		<div class="box">
			<div class="box-header">
				<h2>Выберите отрасль, группу и товарную позицию</h2>
				<div class="box-search">
					<?=anchor('company/control-panel/'.$userinfo['uconfirmation'],'Вернуться назад',array('class'=>'lnk-submit'));?>
				</div>
			</div>
			<div class="box-content h150 w918">
				<div id="lists">
					<select name="activity" id="select-activity" class="mixed-combo" size="1" style="width: 350px;">
						<option value="0">Выберите отрасль</option>
					<?php for($i=0;$i<count($cmpactivity);$i++): ?>
						<option value="<?=$cmpactivity[$i]['act_id'];?>"><?=$cmpactivity[$i]['act_fulltitle'];?></option>
					<?php endfor; ?>
					</select>
					<div class="clear"></div>
					<div id="gulist"></div>
					<div id="pulist"></div>
				</div>
				<div id="formUnit"></div>
			</div>
		</div>
		<div class="clear"></div>
	</div>
<?=form_close();?>