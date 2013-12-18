<?php
    abstract class Template{
    	protected $url;
		public function getTemplate($state = null){
			
			if(file_exists($this->url)){
				return file_get_contents($this->url);
			}
		}
    }
?>