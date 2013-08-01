<?php

	class HTML extends Kohana_HTML
	{
		public static function jstext($text, $strict = false)
		{
			$safe_text = $strict ? str_replace(array('"', '&', "'"), array('&quot;', '&amp;', '&apos;')) : $text;
			$safe_text = preg_replace('/&#(x)?0*(?(1)27|39);?/i', '&apos;', stripslashes($safe_text));
			$safe_text = str_replace("\r", '', $safe_text);
			$safe_text = str_replace("\n", '\\n', addslashes($safe_text));
			return $safe_text;
		}
	}

?>