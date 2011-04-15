<h2>Опыт работы:</h2><br/>
<?php for($i = 0; $i <count($manager['jobs']); $i++):?>
	<div class="jodData" id="vjob<?=$i;?>" jobID="<?=$manager['jobs'][$i]['job_id'];?>">
		<?php if($manager['jobs'][$i]['job_dbegin']): ?>
			<b><?=$manager['jobs'][$i]['job_dbegin'];?> - 
		<?php else: ?>
			<b>н/у -
		<?php endif; ?>
		<?php if($manager['jobs'][$i]['job_dend']): ?>
			<?=$manager['jobs'][$i]['job_dend'];?> гг.</b>
		<?php else: ?>
			н/в</b>
		<?php endif; ?>
		<?= $manager['jobs'][$i]['job_cname']; ?>
		<span class="btndelete" id="dljob1">
			<input type="image" title="Удалить" class="ajaxdel" id="job<?=$i;?>" src="<?= $baseurl; ?>images/delete.png" />
		</span>
		<div class="jobPosiotion" id="">
			&rarr;&nbsp;<?= $manager['jobs'][$i]['job_position']; ?>
		</div>
	</div>
	<div class="clear"></div>
<?php endfor; ?>