<?php
	// 
	defined('_JEXEC') or die;
	
	
	// 
	// 
	$city_code = $displayData['city_code'];
	// 
	// 
	$offices = $displayData['offices'];
	// 
	// 
	$shipping_id = $displayData['shipping_id'];
	// 
	// 
	$params = $displayData['params'];
?>
<?php echo _JSHOP_SM_WISHBOXCDEK_PARAM_OFFICE.': '.JHtml::_(
																'select.genericlist', 
																$offices,
																'params['.$shipping_id.'][office]',
																'id="wishboxsmcdek_pvz_'.$shipping_id.'"', 
																'value',
																'address',
																$params['office'], ''
															);