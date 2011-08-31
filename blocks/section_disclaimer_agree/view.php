<?php 
	$c = $this->controller;
	
	$disclaimer = $c->getDisclaimerPage();
	
	$arcID = isset($_REQUEST['arcID']) ? $_REQUEST['arcID'] : $arcID;
?>


<form id="section-disclaimer<?php echo $disclaimerID ?>-agree" class="section-disclaimer-agree" action="<?php echo $disclaimer->getCollectionPath() ?>" method="post">
	<input type="hidden" name="arcID" value="<?php echo $arcID ?>" />
    
	<p><label><?php echo $cbLabel ?> <input type="checkbox" name="section_disclaimer<?php echo $disclaimer->getCollectionID() ?>" value="1" /></label></p>
    
	<p><input type="submit" value="<?php echo $btnAccept ?>" /></p>
</form>