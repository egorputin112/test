<div class="delete-confirmation">
	<?php echo Form::open($form_uri); 
		  echo '<p>'.$confirmation.'</p>';
		  echo Form::submit('confirm','Confirm').' '.Form::submit('cancel','Cancel');
		  echo Form::close();
	?>
</div>
