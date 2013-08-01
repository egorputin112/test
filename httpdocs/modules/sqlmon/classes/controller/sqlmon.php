<?php

	class Controller_SqlMon extends Controller
	{
		public function action_media()
		{
			$file = $this->request->param('file');
			$ext  = pathinfo($file, PATHINFO_EXTENSION);

			$file = substr($file, 0, -(strlen($ext) + 1));

			$file = Kohana::find_file('media', $file, $ext);
			if ($file) {
				$this->request->response = file_get_contents($file);
				$this->request->headers['Content-Type'] = File::mime_by_ext($ext);
				$this->request->check_cache();
			}
			else {
				$this->request->status = 404;
			}
		}
	}

?>