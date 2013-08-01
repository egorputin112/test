<?php

	class Controller_Contact extends Controller
	{
				
		public function action_index()
		{
			if(count($_POST) > 0){
				require_once Kohana::find_file('classes','recaptchalib','php');
				$resp = recaptcha_check_answer ('6LeRScYSAAAAANEAkpRThgqjXeeY4Bl4LSyUD6Rl',
                                        		$_SERVER["REMOTE_ADDR"],
												$_POST["challenge"],
												$_POST["captcha"]);

				if ($resp->is_valid) {
					ORM::factory('contact_request')->values($_POST)->save();
									
					$mailer = new PHPMailer();
					$mailer->ClearAllRecipients();
					$mailer->Sender = Kohana::config('emails.from_name');
					$mailer->From   = Kohana::config('emails.from_address');
					$mailer->FromName = Kohana::config('emails.from_name');
					$mailer->Subject  = Kohana::config('emails.contact_request.subject');
					$mailer->CharSet  = 'utf-8';
					$html = "<html>
								<body>
									<table style='font-family:verdana;font-size:12px;'>
										<tr><td><b>Name</b></td><td>$_POST[name]</td></tr>
										<tr><td><b>Email</b></td><td>$_POST[email]</td></tr>
										<tr><td><b>Phone</b></td><td>$_POST[phone]</td></tr>
										<tr><td><b>Subject</b></td><td>$_POST[subject]</td></tr>
										<tr><td><b>Message</b></td><td>$_POST[message]</td></tr>
										<tr><td><b>Date</b></td><td>".date('Y-m-d H:i:s')."</td></tr>
									</table>
								</body>
							</html>";
					$mailer->Body     = $html;
					$mailer->IsHTML(true);
					$to = Kohana::config('emails.contact_request.to');
					$mailer->AddAddress($to,$to);
					$mailer->Send();
					
				}else
					echo $resp->error;
			}
		}
		
		public function action_captcha(){
			$session = Session::instance();
			header("Expires: Mon, 14 June 2010 02:30:00 GMT");  
			header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");  
			header("Cache-Control: no-store, no-cache, must-revalidate");  
			header("Cache-Control: post-check=0, pre-check=0", false); 
			header("Pragma: no-cache");  
			
			$random_str = md5(microtime());
			$result_str = substr($random_str,0,5);
			$new_image = imagecreatefrompng("images/captcha.png");
			$text_color = imagecolorallocate($new_image, 11, 159, 255);
			imagestring($new_image, 5, 10, 3, $result_str, $text_color);
			$session->set('captcha',$result_str); 
			header('Content-type:image/png');
			imagejpeg($new_image,NULL,100);
			ImageDestroy($new_image);
		}
		
		
	}

?>