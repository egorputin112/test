<?php require Kohana::find_file('views', 'header'); ?>
<div id="subcontainer">
	<div id="subimg">
		<p>
			<span>Lake Powell Jet Ski and Watercraft Rentals! H2O&ndash;Zone is Lake Powell&rsquo;s &#35;1 source for watercraft rentals and
			repairs offering great rates and friendly service. Locally owned and operated for over 10 years.<br/><br/>
			At H20-Zone, we always have a wide variety of equipment available for rent with rates to serve every lifestyle.
			Our equipment is carefully inspected and serviced to ensure they are ready for you! Our shop is located in Page,
			Arizona — only moments away from beautiful Lake Powell.<br/><br/>
			Drop by, give us a call or make your reservation online and you'll see why we remain
			the best personal watercraft rental service company in Northern Arizona!</span>
		</p>
	</div>
	<div id="subimgrotate"><?php echo HTML::image('images/img_subpage_03.jpg', array('width' => 949, 'height' => 195, 'alt' => '')); ?></div>
</div>
<div id="main-body">
	<div id="left">
			 <div class="iphorm-outer">
				<form class="iphorm" method="post" enctype="multipart/form-data">
					<div class="iphorm-wrapper">
					<h1>Contact Us</h1>
					<div class="iphorm-inner">
						<div class="form-title">Please get in touch</div>
						   <div class="iphorm-message"></div>
						   <div class="iphorm-container clearfix">
								<!-- Begin Name element -->
								<div class="element-wrapper name-element-wrapper clearfix">
									<label for="name">Name <span class="red">*</span></label>
									<div class="input-wrapper name-input-wrapper">
										<input class="name-element" id="name" type="text" name="name" />
									</div>
									<ul class="form-errors"></ul>
								</div>
								<!-- End Name element -->
								<!-- Begin Email element -->
								<div class="element-wrapper email-element-wrapper clearfix">
									<label for="email">Email <span class="red">*</span></label>
									<div class="input-wrapper email-input-wrapper">
										<input class="email-element iphorm-tooltip" id="email" type="text" name="email" title="We will never send you spam, we value your privacy as much as our own" />
									</div>
									<ul class="form-errors"></ul>
								</div>
								<!-- End Email element -->
								<!-- Begin Phone element -->
								<div class="element-wrapper phone-element-wrapper clearfix">
									<label for="phone">Phone</label>
									<div class="input-wrapper phone-input-wrapper">
										<input class="phone-element iphorm-tooltip" id="phone" type="text" name="phone" title="We will only use your phone number to contact you regarding your enquiry" />
									</div>
									<ul class="form-errors"></ul>
								</div>
								<!-- End Phone element -->
								<!-- Begin Subject element -->
								<div class="element-wrapper subject-element-wrapper clearfix">
									<label for="subject">Subject</label>
									<div class="input-wrapper subject-input-wrapper clearfix">
										<select id="subject" name="subject">
											<option value="General enquiry">General enquiry</option>
											<option value="Sales enquiry">Sales enquiry</option>
											<option value="Support enquiry">Support enquiry</option>
											<option value="Other">Other</option>
										</select>
									</div>
									<ul class="form-errors"></ul>
								</div>
								<!-- End Subject element -->
								<!-- Begin Message element -->
								<div class="element-wrapper message-element-wrapper clearfix">
									<label for="message">Message <span class="red">*</span></label>
									<div class="input-wrapper message-input-wrapper clearfix">
										<textarea class="message-element" id="message" name="message" rows="7" cols="45"></textarea>
									</div>
									<ul class="form-errors"></ul>
								</div>
								<!-- End Message element -->
								<!-- Begin Captcha element -->
								<div class="element-wrapper captcha-element-wrapper clearfix">
									<label for="type_the_word">Type the word <span class="red">*</span></label>
									<div class="input-wrapper captcha-input-wrapper clearfix">
										<div class="captcha-img">	
											<?php // echo HTML::image('index.php/contact/captcha');
																		echo $recaptcha; ?>
										</div>
									</div>
									<ul class="form-errors" id="captcha-error"></ul>
								</div>
								<!-- End Captcha element -->
								<!-- Begin Submit button -->
								<div class="button-wrapper submit-button-wrapper clearfix">
									<div class="loading-wrapper"><span class="loading">Please wait...</span></div>
									<div class="button-input-wrapper submit-button-input-wrapper">
										<input class="submit-element" type="button" name="contact" value="Send" />
									</div>
								</div>
								<!-- End Submit button -->
						   </div>
					   </div>
				   </div>
				</form>
			</div>
	</div>
	<br style="clear: both"/>
</div>
<script>
	var base_url = '<?php echo url::site(); ?>';
</script>
<?php require Kohana::find_file('views', 'footer'); ?>
