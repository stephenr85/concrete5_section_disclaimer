<?php  defined('C5_EXECUTE') or die(_("Access Denied."));

/**
 * Allows a section disclaimer to be set that will prevent users from viewing section pages until the disclaimer has been agreed to.
 * @package Section Disclaimer
 * @author Stephen Rushing
 * @category Packages
 * @copyright  Copyright (c) 2011 Stephen Rushing. (http://www.esiteful.com)
 */
class SectionDisclaimerPackage extends Package {

	protected $pkgHandle = 'section_disclaimer';
	protected $appVersionRequired = '5.4.0';
	protected $pkgVersion = '1.0';
	
	public function getPackageDescription() {
		return t("Adds a \"section_disclaimer\" page attribute that allows you to specify a page as a disclaimer for a particular section.");
	}
	
	public function getPackageName() {
		return t("Section Disclaimer");
	}
	
	public function install() {
		$pkg = parent::install();
		Loader::model('collection_attributes');		 
		$PageAttrType = AttributeType::getByHandle('page_selector');
		if(!is_object($PageAttrType) || !intval($PageAttrType->getAttributeTypeID())){ 
			throw new exception(t('Please install %s before installing this addon.', '<a href="http://www.concrete5.org/marketplace/addons/page-selector-attribute/">Page Selector Attribute</a>'));
			exit;
		}
		CollectionAttributeKey::add($this->attrHandle, array('akHandle' => 'section_disclaimer', 'akName' => t('Section Disclaimer Page'), 'akIsSearchable' => FALSE), $pkg);
		
		BlockType::installBlockTypeFromPackage('section_disclaimer_agree', $pkg);	
	}
	
	public function upgrade(){
		parent::upgrade();
		
			
			
	}
	
	public function on_start() {
		$url = Loader::helper('concrete/urls')->getPackageURL(Package::getByHandle($this->pkgHandle));
		Events::extend('on_start', 'SectionDisclaimer', 'check', $this->getPackagePath() . '/models/section_disclaimer.php');
	}
}