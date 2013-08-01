<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Admin Panel</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="robots" content="noindex,noarchive,nofollow"/>
	<?php echo HTML::style('css/ui.css'); ?>
	<?php echo HTML::style('css/layout.css'); ?>
	<?php echo HTML::script('scripts/jquery-1.4.4.min.js'); ?>
	<?php if(isset($ext_files)):
	  			if(isset($ext_files['css'])){
					foreach($ext_files['css'] as $css)
						echo HTML::style('css/'.$css);
				}else{
					foreach($ext_files as $key=>$value){
						if(isset($value['css'])){
							foreach($value['css'] as $css)
								echo HTML::style('css/'.$css);
						}
					}
				}
				if(isset($ext_files['js'])){
					foreach($ext_files['js'] as $js)
						echo HTML::script('scripts/'.$js);
				}else{
					foreach($ext_files as $key=>$value){
						if(isset($value['js'])){
							foreach($value['js'] as $js)
								echo HTML::script('scripts/'.$js);
						}
					}
				}  
		endif;
	   ?>
	   <script>
	   		var base_url = '<?php echo url::site();?>';
	   </script>
</head>
<body>
	<?php if(!isset($no_menu)):?>
	<div id="tabs" class="ui-tabs ui-widget ui-widget-content ui-corner-all">
		<ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">
			<li class="ui-state-default ui-corner-top<?php echo Text::url_match('/^admin(\/reservations.*)?$/', ' ui-tabs-selected ui-state-active', ''); ?>"><a href="<?php echo HTML::chars(URL::site('admin/reservations')); ?>"><span class="pointer">Reservations</span></a></li>
			<li class="ui-state-default ui-corner-top<?php echo Text::url_match('!admin/models!', ' ui-tabs-selected ui-state-active', ''); ?>"><a href="<?php echo HTML::chars(URL::site('admin/models')); ?>"><span class="pointer">Models</span></a></li>
			<li class="ui-state-default ui-corner-top<?php echo Text::url_match('!admin/accessories!', ' ui-tabs-selected ui-state-active', ''); ?>"><a href="<?php echo HTML::chars(URL::site('admin/accessories')); ?>"><span class="pointer">Accessories</span></a></li>
			<li class="ui-state-default ui-corner-top<?php echo Text::url_match('/^admin\/requests.*/', ' ui-tabs-selected ui-state-active', ''); ?>"><a href="<?php echo HTML::chars(URL::site('admin/requests')); ?>"><span class="pointer">Requests</span></a></li>
			<li class="ui-state-default ui-corner-top<?php echo Text::url_match('/^admin\/availability.*/', ' ui-tabs-selected ui-state-active', ''); ?>"><a href="<?php echo HTML::chars(URL::site('admin/availability')); ?>"><span class="pointer">Availability</span></a></li>
		</ul>
	<?php else:?>
	<div class="ui-tabs ui-widget ui-widget-content ui-corner-all">
	<?php endif;?>
		<?php if(isset($errors)) : ?>
		<fieldset class="errors">
			<ul>
			<?php foreach($errors as $error): ?>
				<li><?php echo $error; ?></li>
			<?php endforeach; ?>
			</ul>
		</fieldset>
		<?php endif;  ?>
		<?php if(isset($message)) : ?>
			<p class="message"><?php echo $message; ?></p>
		<?php endif; ?>
		<div class="ui-tabs-panel ui-widget-content ui-corner-bottom">
			<?php echo empty($content) ? '' : $content; ?>
		</div>
	</div>
</body>
</html>