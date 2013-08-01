<?php

	class Kohana_SqlMon
	{
		public static function resToTable($x)
		{
			$html = '';
			if (!empty($x)) {
				$html = '<table class="debug" cellpadding="2" cellspacing="1"><thead><tr>';
				foreach ($x[0] as $key => $value) {
					$html .= '<th>' . HTML::chars($key) . '</th>';
				}

				$html .= '</tr></thead><tbody>';
				foreach ($x as $entry) {
					$html .= '<tr>';
					foreach ($entry as $value) {
						$html .= '<td>' . $value . '</td>';
					}

					$html .= '</tr>';
				}

				$html .= '</tbody></table>';
			}

			return $html;
		}

		protected function __construct() { }
	}

?>