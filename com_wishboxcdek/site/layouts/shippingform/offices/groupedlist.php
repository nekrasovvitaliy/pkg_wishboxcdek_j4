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
	// 
	// 
	$sh_pr_method_id = $displayData['sh_pr_method_id'];
	// 
	// 
	$user = JFactory::getUser();
	// 
	// 
	$data = [];
	// 
	// 
	foreach ($offices as $k => $office)
	{
		// 
		// 
		if (!isset($data[$offices[$k]->city]))
		{
			// 
			// 
			$data[$offices[$k]->city] = [];
			// 
			// 
			$data[$offices[$k]->city]['id'] = $offices[$k]->city;
			// 
			// 
			$data[$offices[$k]->city]['text'] = $offices[$k]->city;
			// 
			// 
			$data[$offices[$k]->city]['items'] = [];
		}
		// 
		// 
		$data[$offices[$k]->city]['items'][] = JHtml::_('select.option', $offices[$k]->value, $offices[$k]->address);
	}
?>
<fieldset>
	<div class="control-group">
		<label class="control-label" for="wishboxsmcdek_pvz_<?php echo $shipping_id; ?>">
			<?php echo _JSHOP_SM_WISHBOXCDEK_PARAM_OFFICE.': '; ?>
		</label>
		<div class="controls">
			<?php echo JHtml::_(
							'select.groupedlist',
							$data,
							'params['.$shipping_id.'][office]',
							[
								'id' => 'wishboxsmcdek_pvz_'.$shipping_id,
								'list.select' => isset($params['office']) ? $params['office'] : null
							]
						);
			?>
		</div>
	</div>
</fieldset>