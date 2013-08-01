<div class="pickup-return">
	<p><span class="pickup"><?php echo HTML::image('images/green-orange.png', array('width' => 12, 'height' => 24, 'style' => '', 'alt' => '')); ?></span> Pickup: <span id="pickup-date">--/--/--</span></p>
	<p><span class="return"><?php echo HTML::image('images/green-orange.png', array('width' => 12, 'height' => 24, 'style' => 'margin-top: -12px', 'alt' => '')); ?></span> Return: <span id="return-date">--/--/--</span></p>
</div>
<div id="datepicker"></div>
<?php echo Form::open(Route::get('order')->uri(), array('class' => 'dpform')); ?>
	<?php echo Form::hidden('pickup', '', array('id' => 'pickup')); ?>
	<?php echo Form::hidden('return', '', array('id' => 'return')); ?>
	<a href="#" id="ResetButton">Reset</a>
	<?php echo Form::image(null, null, array('src' => 'images/check-availability.png', 'class' => 'submit', 'id' => 'submit-button')); ?>
<?php echo Form::close(); ?>
