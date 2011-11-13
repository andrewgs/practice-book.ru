<?= form_open_multipart($this->uri->uri_string(),array('id'=>'formAddNews','class'=>'formular')); ?>
	<div id="formRep" style="border-top: 2px solid #D0D0D0; border-bottom: 2px solid #D0D0D0; margin-top:15px;">
		<div class="grid_8">
			<label class="label-input">Оглавление: <span class="necessarily" title="Поле не может быть пустым">*</span></label>
			<?= form_error('title'); ?>
			<input class="edit-form-input inpvalue" id="title" name="title" type="text" value="<?=set_value('title');?>"/>
			<label class="label-input">Фото: </label>
			<?= form_error('userfile'); ?>
			<input class="reg-form-input inpvalue" type="file" name="userfile" accept="image/jpeg,png,gif" size="30"/> 
			<div class="form-reqs w280">Поддерживаемые форматы: JPG, GIF, PNG</div>
		</div>
		<div class="grid_3 dateperiod">
			<div class="divdate">
				<label class="date-label-input" title="Будет опубликована с указанной даты">Начальная дата: <span class="necessarily" title="Поле не может быть пустым">*</span></label>
		<input class="date-form-input inpvalue" id="begin-date" name="pdatebegin" type="text" readonly="readonly" value="<?=set_value('pdatebegin');?>"/>
			</div>
			<div class="divdate">
				<?= form_error('pdateend'); ?>
				<label class="date-label-input" title="Если оставить пустым - срок неограничен!">Конечная дата: </label>
		<input class="date-form-input inpvalue" id="end-date" name="pdateend" type="text" readonly="readonly" value="<?=set_value('pdateend');?>"/>
			</div>
			<input type="image" title="Очистить rонечную дату" class="EraserInput btnHidden" src="<?=$baseurl;?>images/eraser.png" />
			<?= form_error('pdatebegin'); ?>
		</div>
		<div class="clear"></div>
		<label class="label-input">Содержание: <span class="necessarily" title="Поле не может быть пустым">*</span></label>
		<?= form_error('description'); ?>
	<textarea class="edit-form-textarea mbottom inpvalue" name="description" id="description" cols="50" rows="8"><?=set_value('description');?></textarea>
		<label class="label-input"">Отрасли компании: <span class="necessarily" title="Поле не может быть пустым">*</span></label>
		<select name="activity" id="activity" class="mixed-combo inpvalue" size="1" title="Укажите к какой отрасли относиться" style="width: 400px;">
			<option value="0">Выберите отрасль</option>
			<?php for($i = 0; $i < count($cmpactivity); $i++): ?>
				<option value="<?=$cmpactivity[$i]['act_id'];?>"><?=$cmpactivity[$i]['act_fulltitle'];?></option>
			<?php endfor; ?>
		</select>
		<div class="clear"></div>
	<?php if($offers):?>	
		<div style="margin: 15px 0px;">
			<input type="checkbox" name="offers" id="chOffers" value="1">Как предложение контрагентам
		</div>
		<div class="clear"></div>
		<div class="grid_12">
			<div class="btnHidden" id="dRegActOffers">
				<div class="grid_6">
					<h2>Выберите отрасль:</h2>
					<div class="box">
						<div class="box-header"><?=form_error('activity');?>&nbsp;</div>
							<div class="box-content w280 h250">
								<select name="actoffers" id="sActOffers" class="mixed-combo inpvalue" size="16" title="Укажите в какую отрасли отправить предложение" style="width: 280px;">
								<?php for($i=0;$i<count($activity);$i++): ?>
									<option value="<?=$activity[$i]['act_id'];?>"><?=$activity[$i]['act_title'];?></option>
								<?php endfor; ?>
								</select>
							</div>
						<div class="box-bottom-links h20">&nbsp;</div>
					</div>
				</div>
				<div class="grid_5">
				<h2>Выберите регионы: </h2>
					<div class="box">
						<div class="box-header"><?=form_error('region[]');?>&nbsp;</div>
							<div class="box-content w280 h250">
								<select name="regoffers[]" id="sRegOffers" class="mixed-combo inpvalue" size="16" multiple style="width: 280px;">
								<?php for($i=0;$i<count($regions);$i++): ?>
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
	<?php endif;?>
		<input class="btn-action margin-1em" id="addNews" type="submit" name="submit" value="Добавить"/>
	</div>
	<div class="clear"></div>
<?= form_close(); ?>