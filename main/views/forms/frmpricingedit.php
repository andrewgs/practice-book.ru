<?= form_open_multipart($this->uri->uri_string(),array('id'=>'formProduct','class'=>'formular')); ?>
	<div class="grid_12">
		<div class="box">
			<div class="box-header">&nbsp;
				<div class="box-search">
					<?=anchor($backpath,'Вернуться назад',array('class'=>'lnk-submit'));?>
				</div>
			</div>
			<div class="box-content h150 w918">
				<div id="diagramma" class="grid_6"></div>
				<div id="exp" class="grid_5">
				<?php for($i=0;$i<count($graph);$i++):?>
					<div list="jobLine">
						<?php $this->load->view('forms/frmprnposition',array('i'=>$i)); ?>
					</div>
				<?php endfor;?>
					<input class="goog-button mt7 mb10" id="btnAddPosition" type="button" value="Добавить позицию"/>
					<input class="goog-button mt7 mb10" id="btnDelPosition" type="button" value="Удалить позицию"/>
					<div class="clear"></div>
					<hr size="2"/>
					<label class="label-input">Комментарий</label>
					<textarea class="edit360-form-textarea" name="comment" id="comment" cols="20" rows="5"><?=$comment;?></textarea>
					<div class="clear"></div>
					<hr size="2"/>
					<input class="btn-action" id="savePricing" type="submit" name="submit" value="Сохранить"/>
			<?php if($userinfo['priority']): ?>
				<div class="chackForAll">
			<input type="checkbox" name="all" value="1" id="forAllRegion" title="Для всех регионов"> Для всех регионов
				</div>
				<div class="msgForAll fvalid_error" id="msgAllRegion">&nbsp;</div>
			<?php endif; ?>
				</div>
				<div class="clear"></div>
			</div>
		</div>
	</div>
	<div class="clear"></div>
<?= form_close(); ?>