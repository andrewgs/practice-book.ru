<?= form_open($this->uri->uri_string(),array('id'=>'formSignup')); ?>
	<div class="grid_12">
		<hr size="2"/>
		<label class="label-input">Отрасли: <span class="necessarily" title="Обязательно нужно указать">*</span></label> 
		<div class="box-content" style="max-height: 1024px;">
		<?php
			function build_tree($cats,$parent_id,$cnt){
				if(isset($cats[$parent_id])):
					if(!$cnt): $tree = '<ul id="tree">';
					else: $tree = '<ul>';
					endif;
					$cnt++;
					foreach($cats[$parent_id] as $cat):
						$tree .= '<li><label><input type="checkbox" name="servname[]" value="'.$cat['act_id'].'"/>'.
									$cat['act_title'].'</label>';
						$tree .=  build_tree($cats,$cat['act_id'],$cnt);
						$tree .= '</li>';
					endforeach;
					$tree .= '</ul>';
				else:
					 return null;
				endif;
				return $tree;
			}
			echo build_tree($list,0,0);
		?>
		</div>
	</div>
	<div class="clear"></div>
	<hr size="2"/>
	<input type="submit" class="btn-action margin-1em" name="submit" id="next" value="Следующий Шаг >> "/>
<?= form_close(); ?>