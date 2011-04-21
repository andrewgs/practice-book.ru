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
				<input class="edit350-form-input" id="uptitle" name="title" type="text" value="<?=$unit['cu_title'];?>"/>
				<label class="label-input">Описание:</label>
				<textarea class="edit350-form-textarea" name="note" cols="20" rows="5"><?=strip_tags($unit['cu_note']);?></textarea>
			</td>
			<td>
				<label class="label-input">Цена:</label>
				<input class="edit60-form-input digital" maxlength="8" name="price" type="text" value="<?=$unit['cu_price'];?>">
				<select class="select-price" id="cupricecode" name="pricecode">
					<option value="1" <?php if($unit['cu_priceunit']==1) echo 'selected="selected"';?>>руб.</option>
					<option value="2" <?php if($unit['cu_priceunit']==2) echo 'selected="selected"';?>>тыс.руб.</option>
					<option value="3" <?php if($unit['cu_priceunit']==3) echo 'selected="selected"';?>>млн.руб.</option>
					<option value="4" <?php if($unit['cu_priceunit']==4) echo 'selected="selected"';?>>%</option>
				</select> 
				<label class="label-input">Единицы измерения:</label>	
				<select class="medium-select-price" name="unitscode">
					<option value="1" <?php if($unit['cu_unitscode']==1) echo 'selected="selected"';?>>&nbsp;</option>
					<option value="2" <?php if($unit['cu_unitscode']==2) echo 'selected="selected"';?>>шт.</option>
					<option value="3" <?php if($unit['cu_unitscode']==3) echo 'selected="selected"';?>>тыс.шт.</option>
					<option value="4" <?php if($unit['cu_unitscode']==4) echo 'selected="selected"';?>>гр.</option>
					<option value="5" <?php if($unit['cu_unitscode']==5) echo 'selected="selected"';?>>кг.</option>
					<option value="6" <?php if($unit['cu_unitscode']==6) echo 'selected="selected"';?>>т.</option>
					<option value="7" <?php if($unit['cu_unitscode']==7) echo 'selected="selected"';?>>м.</option>
					<option value="8" <?php if($unit['cu_unitscode']==8) echo 'selected="selected"';?>>пог.м.</option>
					<option value="9" <?php if($unit['cu_unitscode']==9) echo 'selected="selected"';?>>см.</option>
					<option value="10" <?php if($unit['cu_unitscode']==10) echo 'selected="selected"';?>>кв.м.</option>
					<option value="11" <?php if($unit['cu_unitscode']==11) echo 'selected="selected"';?>>кв.см.</option>
					<option value="12" <?php if($unit['cu_unitscode']==12) echo 'selected="selected"';?>>куб.м.</option>
					<option value="13" <?php if($unit['cu_unitscode']==13) echo 'selected="selected"';?>>куб.см.</option>
					<option value="14" <?php if($unit['cu_unitscode']==14) echo 'selected="selected"';?>>л.</option>	
					<option value="15" <?php if($unit['cu_unitscode']==15) echo 'selected="selected"';?>>час.</option>
					<option value="16" <?php if($unit['cu_unitscode']==16) echo 'selected="selected"';?>>ед.мес.</option>
					<option value="17" <?php if($unit['cu_unitscode']==17) echo 'selected="selected"';?>>ед.год.</option>
				</select> 
			</td>
			<td> 
				<label class="label-input">Изображение:</label><br/>
				<img src="<?=$baseurl;?>curavatar/viewimage/<?=$unit['cu_id'];?>" alt=""/><br/>
				<input class="edit150-form-input" type="file" name="userfile">
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>
				<div class="ButtonOperation">
					<button title="Удалить" class="NewsDel" name="subdel" id="UnitDel" value=" Удалить">
						<img src="<?=$baseurl;?>images/delete.png">
					</button>
					<button title="Сохранить" class="NewsSave" name="subsave" id="UnitSave"  value=" Сохранить">
						<img src="<?=$baseurl;?>images/save.png">
					</button>
				</div>
			</td>
		</tr>
	</tbody>
</table>
<div class="clear"></div>