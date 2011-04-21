<?= form_open_multipart($this->uri->uri_string(),array('id'=>'formAddProductUnit','class'=>'formular')); ?>
<?=form_hidden('groupvalue',FALSE);?>
<?=form_hidden('activityvalue',FALSE);?>
<div id="formRep" style="margin-top:15px;">
	<div class="box">
		<div class="box-header"><h2 class="special">Добавление новой позиции</h2>
			<div class="box-search">&nbsp;</div>
		</div>
		<div class="box-content h150 w918">
			<table class="price-table table-dash">
				<thead>
					<tr>
						<th width="450px">Наименование</th>
						<th width="200px">Цены</th>
						<th width="400px">Изображение (*.jpg, *.gif, *.png)</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>
							<label class="label-input">Название: <span class="necessarily" title="Поле не может быть пустым">*</span></label>
							<?= form_error('title'); ?>
			<input class="edit350-form-input inpvalue" id="title" name="title" type="text" value="<?=set_value('title');?>"/>
							<label class="label-input">Описание:</label>
			<textarea class="edit350-form-textarea inpvalue" name="note" id="note" cols="20" rows="5"><?=set_value('note');?></textarea>
						</td>
						<td>
							<label class="label-input">Цена:</label>
<input class="edit60-form-input digital inpvalue" maxlength="8" id="lowprice" name="price" type="text" value="<?=set_value('price');?>">
							<select class="select-price" id="pricecode" name="pricecode">
								<option value="1" <?=set_select('pricecode','1',TRUE);?>>руб.</option>
								<option value="2" <?=set_select('pricecode','2');?>>тыс.руб.</option>
								<option value="3" <?=set_select('pricecode','3');?>>млн.руб.</option>
								<option value="4" <?=set_select('pricecode','4');?>>%</option>
							</select> 
							<label class="label-input">Единицы измерения:</label>	
							<select class="medium-select-price" id="unitscode" name="unitscode">
								<option value="1" <?=set_select('unitscode','1',TRUE);?>>&nbsp;</option>
								<option value="2" <?=set_select('unitscode','2');?>>шт.</option>
								<option value="3" <?=set_select('unitscode','3');?>>тыс.шт.</option>
								<option value="4" <?=set_select('unitscode','4');?>>гр.</option>
								<option value="5" <?=set_select('unitscode','5');?>>кг.</option>
								<option value="6" <?=set_select('unitscode','6');?>>т.</option>
								<option value="7" <?=set_select('unitscode','7');?>>м.</option>
								<option value="8" <?=set_select('unitscode','8');?>>пог.м.</option>
								<option value="9" <?=set_select('unitscode','9');?>>см.</option>
								<option value="10" <?=set_select('unitscode','10');?>>кв.м.</option>
								<option value="11" <?=set_select('unitscode','11');?>>кв.см.</option>
								<option value="12" <?=set_select('unitscode','12');?>>куб.м.</option>
								<option value="13" <?=set_select('unitscode','13');?>>куб.см.</option>
								<option value="14" <?=set_select('unitscode','14');?>>л.</option>	
								<option value="15" <?=set_select('unitscode','15');?>>час.</option>
								<option value="16" <?=set_select('unitscode','16');?>>ед.мес.</option>
								<option value="17" <?=set_select('unitscode','17');?>>ед.год.</option>
							</select> 
						</td>
						<td> 
							<label class="label-input">Изображение:</label>
							<input class="edit150-form-input inpvalue" type="file" id="vavatar" name="userfile">
						</td>
					</tr>	
				</tbody>
			</table>
			<input class="btn-action margin-1em" id="addProductUnit" type="submit" name="sbmpu" value="Добавить позицию"/>
		</div>
	</div>
</div>
<div class="clear"></div>
<?= form_close(); ?>		