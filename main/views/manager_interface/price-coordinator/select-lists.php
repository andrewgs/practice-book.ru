<?=form_open_multipart($this->uri->uri_string(),array('id'=>'formEditProductUnit','class'=>'formular')); ?>
	<div class="rep-container">
		<div class="box">
			<div class="box-header">
				<h2>Выберите группу и товарную позицию</h2>
				<div class="box-search">
					<?=anchor('manager/control-panel/'.$userinfo['uconfirmation'],'Вернуться назад',array('class'=>'lnk-submit'));?>
				</div>
			</div>
			<div class="box-content h150 w918">
				<div id="lists">
					<select name="grouplist" id="select-group" class="mixed-combo" size="1" style="width: 250px;">
						<option value="0">Выберите группу</option>
					<?php for($i=0;$i<count($group);$i++):?>
						<option value="<?=$group[$i]['prg_id'];?>"><?=$group[$i]['prg_title'];?></option>
					<?php endfor; ?>
					</select>
					<div id="pulist"></div>
				</div>
				<div id="formUnit"></div>
			</div>
		</div>
		<div class="clear"></div>
	</div>
<?=form_close();?>