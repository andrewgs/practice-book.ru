<?= form_open_multipart($this->uri->uri_string(),array('id'=>'formAddProductUnit','class'=>'formular')); ?>
<div id="formRep" style="margin-top:15px;">
	<div class="box">
		<div class="box-header"><h2 class="special">Добавление новой позиции</h2>
			<div class="box-search">&nbsp;</div>
		</div>
		<div class="box-content h150 w918">
			<table class="price-table table-dash">
				<thead>
					<tr>
						<th width="300px">Наименование</th>
						<th width="300px">Цены</th>
						<th width="250px">Описание</th>
						<th width="200px">Изображение (*.jpg, *.gif, *.png)</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>
							<label class="label-input">Название: <span class="necessarily" title="Поле не может быть пустым">*</span></label>
							<?= form_error('title'); ?>
			<input class="edit275-form-input inpvalue" id="title" name="title" type="text" value="<?=set_value('title');?>"/>
							<label class="label-input">Описание:</label>
			<textarea class="edit275-form-textarea inpvalue" name="note" id="note" cols="45" rows="5"><?=set_value('note');?></textarea>
						</td>
						<td>
							<label class="label-input">Низкая:</label>
<input class="edit60-form-input digital inpvalue" maxlength="8" id="lowprice" name="lowprice" type="text" value="<?=set_value('lowprice');?>">
							<select class="select-price" id="lowpricecode" name="lowpricecode">
								<option value="1">руб.</option>
								<option value="2">тыс.руб.</option>
								<option value="3">млн.руб.</option>
								<option value="4">%</option>
							</select> 
							<label class="label-input">Оптимальная:</label>
<input class="edit60-form-input digital inpvalue" maxlength="8" id="optimumprice" name="optimumprice" type="text" value="<?=set_value('optimumprice');?>">
							<select class="select-price" id="optimumpricecode" name="optimumpricecode">
								<option value="1">руб.</option>
								<option value="2">тыс.руб.</option>
								<option value="3">млн.руб.</option>
								<option value="4">%</option>
							</select> 
							<label class="label-input">Высокая:</label>								
<input class="edit60-form-input digital inpvalue" maxlength="8" id="topprice" name="topprice" type="text" value="<?=set_value('optimumprice');?>">
							<select class="select-price" id="toppricecode" name="toppricecode">
								<option value="1">руб.</option>
								<option value="2">тыс.руб.</option>
								<option value="3">млн.руб.</option>
								<option value="4">%</option>
							</select> 
							<label class="label-input">Единицы измерения:</label>	
							<select class="medium-select-price" id="unitscode" name="unitscode">
								<option value="1">&nbsp;</option>
								<option value="2">шт.</option>
								<option value="3">тыс.шт.</option>
								<option value="4">гр.</option>
								<option value="5">кг.</option>
								<option value="6">т.</option>
								<option value="7">м.</option>
								<option value="8">пог.м.</option>
								<option value="9">см.</option>
								<option value="10">кв.м.</option>
								<option value="11">кв.см.</option>
								<option value="12">куб.м.</option>
								<option value="13">куб.см.</option>
								<option value="14">л.</option>	
								<option value="15">час.</option>
								<option value="16">ед.мес.</option>
								<option value="17">ед.год.</option>
							</select> 
						</td>
						<td>
							<label class="label-input">Риски низкой цены:</label>
							<textarea class="edit200-form-textarea inpvalue" name="riskslowprice" id="riskslowprice" cols="30" rows="3"><?=set_value('riskslowprice');?></textarea>
							<label class="label-input">Преимущества высокой цены</label> 
							<textarea class="edit200-form-textarea inpvalue" name="advantages" id="advantages" cols="30" rows="3"><?=set_value('riskslowprice');?></textarea>
						</td>
						<td> 
							<label class="label-input">Изображение:</label>
							<input class="reg-form-input inpvalue" type="file" id="vavatar" name="userfile">
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