<?php  defined('C5_EXECUTE') or die("Access Denied."); ?> 
<?php
	$pagesel = Loader::helper('form/page_selector');
?>

<p>
	<?php echo $form->label('cbLabel', t('Checkbox label:')) ?> <?php echo $form->text('cbLabel', $cbLabel) ?>
</p>

<p>
	<?php echo $form->label('btnAccept', t('Accept button text:')) ?> <?php echo $form->text('btnAccept', $btnAccept) ?>
</p>

<p>
	<?php echo $form->label('dcID', t('Disclaimer page:')) ?>
    <br/><small>Leave blank to use the current page's ID</small><br/>
	<?php echo $pagesel->selectPage('dcID', $dcID, 'ccm_selectSitemapNode') ?>
</p>

<p>
	<?php echo $form->label('arcID', t('Default redirect page:')) ?> <?php echo $pagesel->selectPage('arcID', $arcID, 'ccm_selectSitemapNode') ?>
</p>

<p>
	<?php echo $form->label('intuiRedir', t('Intuitive redirect:')) ?> <?php echo $form->checkbox('intuiRedir', '1', $intuiRedir!='0') ?><br/>
    <small>If checked, the block will determine the previous page the user was trying to access and override the Default redirect page.</small>
</p>