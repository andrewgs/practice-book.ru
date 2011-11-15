<?= form_open_multipart($this->uri->uri_string(),array('id'=>'formProduct','class'=>'formular')); ?>
	<div class="grid_12">
		<div class="box">
			<div class="box-header">&nbsp;
				<div class="box-search">
					<?=anchor($backpath,'Вернуться назад',array('class'=>'lnk-submit'));?>
				</div>
			</div>
			<div class="box-content h150 w918">
				<div id="diagramma"></div>
				<div class="clear"></div>
				<hr size="2"/>
				<div id="exp" class="grid_6">
				<?php for($i=0;$i<6;$i++):?>
					<div list="MonthLine">
						<?php if(isset($i)):?>
							<?php $month = $graph[$i]['snp_month'];?>
							<?php $title = $graph[$i]['snp_title'];?>
							<?php $percent = $graph[$i]['snp_percent'];?>
						<?php else:?>
							<?php $title = '';?>
							<?php $percent = '';?>
						<?php endif;?>
						<label class="label-input left w94">Месяц года</label>
						<label class="label-input left w204">Описание</label>
						<label class="label-input left w84">Стоимость, %</label>
						<div class="clear"></div>
						<input class="edit70-form-input" readonly="" name="exp[]" type="text" maxlength="20" value="<?=$month;?>"/>
						<input class="edit180-form-input" name="exp[]" type="text" maxlength="200" value="<?=$title;?>"/>
						<input class="edit60-form-input digital inpval" name="exp[]" type="text" maxlength="20" value="<?=$percent;?>"/>
						<div class="clear"></div>
					</div>
				<?php endfor;?>
				</div>
				<div id="exp" class="grid_5">
				<?php for($i=6;$i<12;$i++):?>
					<div list="MonthLine">
						<?php if(isset($i)):?>
							<?php $month = $graph[$i]['snp_month'];?>
							<?php $title = $graph[$i]['snp_title'];?>
							<?php $percent = $graph[$i]['snp_percent'];?>
						<?php else:?>
							<?php $title = '';?>
							<?php $percent = '';?>
						<?php endif;?>
						<label class="label-input left w94">Месяц года</label>
						<label class="label-input left w204">Описание</label>
						<label class="label-input left w84">Стоимость, %</label>
						<div class="clear"></div>
						<input class="edit70-form-input" readonly="" name="exp[]" type="text" maxlength="20" value="<?=$month;?>"/>
						<input class="edit180-form-input" name="exp[]" type="text" maxlength="200" value="<?=$title;?>"/>
						<input class="edit60-form-input digital inpval" name="exp[]" type="text" maxlength="20" value="<?=$percent;?>"/>
						<div class="clear"></div>
					</div>
				<?php endfor;?>
				</div>
				<div class="clear"></div>
				<div class="grid_11">
					<hr size="2"/>
					<label class="label-input">Комментарий</label>
					<textarea class="edit840-form-textarea inpval" name="comment" id="comment" cols="20" rows="5"><?=$comment;?></textarea>
					<div class="clear"></div>
					<hr size="2"/>
					<input class="btn-action" id="saveSeason" type="submit" name="submit" value="Сохранить"/>
				<?php if($userinfo['priority']): ?>
					<div class="chackForAll">
				<input type="checkbox" name="all" value="1" id="forAllRegion" title="Для всех регионов"> Для всех регионов
					</div>
					<div class="clear"></div>
					<div class="msgForAll fvalid_error" id="msgAllRegion">&nbsp;</div>
				<?php endif; ?>
				</div>
				<div class="clear"></div>
			</div>
		</div>
	</div>
	<div class="clear"></div>
<?= form_close(); ?>