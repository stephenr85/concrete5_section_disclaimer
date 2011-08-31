<?php


class SectionDisclaimer {
	
	const attrHandle = 'section_disclaimer';
	
	public function check(){
		
		$page = Page::getCurrentPage();
		
		$disclaimer = self::getDisclaimerPage();
		
		//if(is_object($disclaimer)) self::setSectionAgreed($disclaimer->getCollectionID(), FALSE);
		
		if(is_object($disclaimer) && !self::isSectionAgreed($disclaimer->getCollectionID())){
			$c = Loader::controller($page);
			$c->redirect($disclaimer->getCollectionPath().'?arcID='.$page->getCollectionID());
		}else if(isset($_REQUEST[self::attrHandle.$page->getCollectionID()])){
			$agree = $_REQUEST[self::attrHandle.$page->getCollectionID()];
			if($agree == '1'){
				//Store the agreement
				self::setSectionAgreed($page->getCollectionID());	
				//Redirect, if there's an agreement redirect collection ID (arcID)
				if(isset($_REQUEST['arcID'])){
					$land = Page::getByID($_REQUEST['arcID']);
					if(is_object($land)){
						$c = Loader::controller($page);
						$c->redirect($land->getCollectionPath());	
					}
				}
			}
		}
		
		
		
	}
	
	
	public function getDisclaimerRoot($page=NULL){
		
		if(!$page instanceof Page){
			$page = Page::getCurrentPage();
		}
		$cPage = $page;
		$count = 0;
		
		while(is_object($cPage) && $count < 50){
			$disclaimerID = $cPage->getAttribute(self::attrHandle);
			if(!empty($disclaimerID)){
				return $cPage;
			}
			$count++;
			//Crawl up the tree
			$cPage = Page::getByID($cPage->getCollectionParentID());
			
		}
		return NULL;
		
	}
	
	public function getDisclaimerPage($page=NULL){
		if(!$page instanceof Page){
			$page = Page::getCurrentPage();
		}
		$root = self::getDisclaimerRoot($page);
		if(is_object($root)){
			$disclaimer = Page::getByID($root->getAttribute(self::attrHandle));
			//Do not return the page passed as its own disclaimer				
			if(is_object($disclaimer) && $page->getCollectionID() != $disclaimer->getCollectionID()){					
				return $disclaimer;
			}
		}
		return NULL;
	}
	
	
	
	public function isSectionAgreed($pageID){
		if(!empty($pageID) && isset($_SESSION[self::attrHandle.$pageID]) && $_SESSION[self::attrHandle.$pageID] == '1'){
			return TRUE;
		}
		return FALSE;
	}
	
	
	public function setSectionAgreed($pageID, $isAgree=TRUE){
		//setcookie($this->cookiePrefix.$pageID, 'true', DIR_REL . '/');
		$_SESSION[self::attrHandle.$pageID] = $isAgree ? '1' : '0';
	}
	
}