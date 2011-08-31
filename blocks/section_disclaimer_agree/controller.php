<?php
	class SectionDisclaimerAgreeBlockController extends BlockController {
		
		protected $btDescription = "Creates a agreement form for a section disclaimer.";
		protected $btName = "Section Disclaimer Agreement";
		protected $btTable = 'btSectionDisclaimerAgree';
		protected $btInterfaceWidth = "400";
		protected $btInterfaceHeight = "300";
			
		
		
		public function getDisclaimerPage(){
			if(!empty($this->dcID) && $this->dcID != '0'){
				$p = Page::getByID($this->dcID);
				if(is_object($p)){
					return $p;	
				}
			}
			return Page::getCurrentPage();
		}
		
		
		function save($data){
			
			
			
			parent::save($data);
		}
		
	}
	
?>