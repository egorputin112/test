$(document).ready(function(){
		var email_pattern = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})$/;
		$(".submit-element").click(function(){ 
			$(".form-errors").hide().html('');
			var name = $.trim($('#name').val());	
			var email = $.trim($('#email').val());	
			var phone = $.trim($('#phone').val());
			var subject = $.trim($('#subject').val());
			var message = $.trim($('#message').val());
			var captcha = $.trim($('#recaptcha_response_field').val());
			var challenge = $('#recaptcha_challenge_field').val();
			var error = 0;
			if(name == ''){
				$('#name').parent().next().fadeIn(1000).html('<li>Name is a required field!</li>'); 
				error = 1;
			}
			if(email == ''){
				$('#email').parent().next().fadeIn(1000).html('<li>Email is a required field!</li>'); 
				error = 1;
			}
			if(email != '' && !email_pattern.test(email)){
				$('#email').parent().next().fadeIn(1000).html('<li>Email is invalid!</li>'); 
				error = 1;
			}
			if(message == ''){
				$('#message').parent().next().fadeIn(1000).html('<li>Message is a required field!</li>'); 
				error = 1;
			}
			if(captcha == ''){
				$('#captcha-error').fadeIn(1000).html('<li>Captcha is a required field!</li>'); 
				error = 1;
			}
			if(error == 1)
				return false;
			else{
				var data = 'name='+name+'&email='+email+'&phone='+phone+'&subject='+subject+'&message='+message+'&captcha='+captcha+'&challenge='+challenge; 
				$(".loading").show();
				$.ajax({
						url: base_url + "contact",	
						type: "POST",
						data: data,		
						cache: false,
						success: function (html) { 
							if(html == ''){
								$('.iphorm-container').remove();
								$('.iphorm-message').html('<div class="success-message">Your message has been sent, thank you.</div>').fadeIn('slow');
							}else{
								$(".loading").hide();
								$('#captcha-error').fadeIn(1000).html('<li>Captcha verification failed!</li>'); 
							}
						}
				});
			}
		});
});