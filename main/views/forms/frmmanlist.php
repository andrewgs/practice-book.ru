<?= form_open('manager/set-manager-region/'.$userinfo['uconfirmation'],array('id'=>'formSetManager')); ?>
	<div class="grid_12">
	<label class="label-input">Список менеджеров текущей отросли: <span class="necessarily" title="Обязательно нужно указать">*</span></label> 
		<div class="box-content" >
		<?php for($i=0;$i<count($managers);$i++):?>
			<div class="rep-name">
				<input type="radio" name="manager" value="<?=$managers[$i]['uid']?>">
				<?php if($i < count($managers)-1): ?>
					<?=$managers[$i]['uname'].' '.$managers[$i]['usubname'].' '.$managers[$i]['uthname'];?>
				<?php else: ?>
					<font color="#ff0000"><?=$managers[$i]['uname'].' '.$managers[$i]['usubname'].' '.$managers[$i]['uthname'];?></font>
				<?php endif; ?>
			</div>
		<?php endfor; ?>
		</div>
	</div>
	<div class="clear"></div>
<?= form_close(); ?>
<input type="button" class="btn-action" style="margin: 10px 0 0 15px;" name="submit" title="Назначить менеджера на регион" id="btnSubmit" value="Назначить"/>