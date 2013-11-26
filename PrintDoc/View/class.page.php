<?php
	#---------------------------------
	#Class Page
    class Page{
    	private $pageContent;
		
    	public function __construct($pageContent){
    		$this->pageContent = $pageContent;	
    	}
		
		public function setMeta($metaText){
			$this->pageContent = str_replace("[%META%]", $metaText, $this->pageContent);
		}
		public function setContent($contentText){
			$this->pageContent = str_replace("[%CONTENT%]", $contentText, $this->pageContent);
		}
		public function setNav($navText){
			$this->pageContent = str_replace("[%NAV%]", $navText, $this->pageContent);
		}
		public function setWarning($warningText){
			$this->pageContent = str_replace("[%WARNING%]", $warningText, $this->pageContent);
		}
		public function setTitle($titleText){
			$this->pageContent = str_replace("[%TITLE%]", $titleText, $this->pageContent);
		}
		public function showPage(){
			return $this->pageContent;
		}
		
    }
?>