<script>
	var weekly_data=eval_json('<?php echo ($weekly_data)?>');
	var monthly_data=eval_json('<?php echo ($monthly_data)?>');
	var last_call_data = new Array('<?php echo $monthly_call; ?>','<?php echo $weekly_call; ?>');
</script>
<div id="availability-tabs">
	<ul>
		<li><a href="#monthly">Monthly</a></li>
		<li><a href="#weekly">Weekly</a></li>
	</ul>
	<div id="monthly">
		<div class="ui-widget-header navigation-header">
			<a class="prev" href="#" title="Prev"><span class="ui-icon ui-icon-circle-triangle-w">Prev</span></a>
			<span class="title"></span>
			<a class="next" href="#" title="Next"><span class="ui-icon ui-icon-circle-triangle-e">Next</span></a>
			<?php echo HTML::anchor('#', 'Export',array('class'=>'export')); ?>
		</div>
		<div class="clear"></div>
		<table id="monthly-availability" class="browse">
			
		</table>
	</div>
	<div id="weekly">
		<div class="ui-widget-header navigation-header">
			<a class="prev" href="#" title="Prev"><span class="ui-icon ui-icon-circle-triangle-w">Prev</span></a>
			<span class="title"></span>
			<a class="next" href="#" title="Next"><span class="ui-icon ui-icon-circle-triangle-e">Next</span></a>
			<?php echo HTML::anchor('#', 'Export',array('class'=>'export')); ?>
		</div>
		<div class="clear"></div>
		<table id="weekly-availability" class="browse">
			
		</table>
	</div>
</div>