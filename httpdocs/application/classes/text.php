<?php

	class Text extends Kohana_Text
	{
		public static function url_match($regexp, $match, $nomatch)
		{
			return preg_match($regexp, Request::current()->uri) ? $match : $nomatch;
		}
	}

?>