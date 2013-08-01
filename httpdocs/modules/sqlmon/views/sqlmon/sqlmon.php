<style type="text/css">
<?php include Kohana::find_file('media', 'sqlmon', 'css') ?>
</style>

<div id="sqlmon">
	<table class="debug">
		<thead>
			<tr>
				<th>#</th>
				<th>Query</th>
				<th>Err</th>
				<th>Results</th>
				<th>Time</th>
			</tr>
		</thead>
		<tbody>
<?php $i = 0; ?>
<?php foreach ((array)Database_Logger::instance()->getLog() as $entry): ?>
			<tr>
				<td><?php echo ++$i; ?></td>
				<td>
					<span class="query<?php if ($entry->err_code) : ?> error<?php endif; ?>"><?php echo nl2br(HTML::chars($entry->query)); ?></span><br/>
					/* <?php echo HTML::chars($entry->instance); ?> */
<?php if ($entry->err_code) : ?>
					<br/><strong class="error"><?php echo HTML::chars($entry->err_msg); ?></strong>
<?php elseif ($entry->explain) : ?>
					<?php echo SqlMon::resToTable($entry->doExplain()); ?>
<?php endif; ?>
<?php if ($entry->trace) : ?>
					<div class="bt"><?php echo nl2br(HTML::chars($entry->trace)); ?></div>
<?php endif; ?>
				</td>
				<td><?php if ($entry->err_code) : ?><strong class="error"><?php echo $entry->err_code; ?></strong><?php else : ?>&nbsp;<?php endif; ?></td>
				<td><?php if (null === $entry->rows) : ?>—<?php else : ?><?php echo $entry->rows; ?><?php endif; ?></td>
				<td><?php echo round($entry->time, 5); ?></td>
			</tr>
<?php endforeach; ?>
		</tbody>
	</table>
</div>