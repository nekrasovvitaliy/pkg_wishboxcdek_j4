<?php
	// 
	defined('_JEXEC') or die;
	
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
	$shippinginfo = $displayData['shippinginfo'];
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


<script type="text/javascript">
	function wishboxcdek_set_pvz_from_map(code)
	{
		// 
		// 
		jQuery('#wishboxcdek_pvz_<?php echo $shipping_id; ?>').val(code);
		// 
		// 
		wishboxcdekmodal.close();
	}
</script>
	<?php
		// 
		// 
		$modal_url_params = [
								'option' => 'com_jshopping',
								'controller' => 'wishboxcdekchangeoffice',
								'tmpl' => 'component',
								'layout' => 'tabslistyandexmap',
								'sh_pr_method_id' => $sh_pr_method_id
							];
		$modal_url = '/index.php?'.http_build_query($modal_url_params);
	?>
<a
	href="<?php echo $modal_url; ?>"
	onclick="return wishboxcdekmodal.open(event, this);"
	id="wishboxcdek_select_pvz_on_map"
>
	Выбрать на карте
</a>
<br />
<label for="wishboxcdek_pvz_<?php echo $shipping_id; ?>">
	<?php echo _JSHOP_SM_WISHBOXCDEK_PARAM_OFFICE.': '; ?>
</label>
<?php echo JHtml::_(
						'select.groupedlist',
						$data,
						'params['.$shipping_id.'][office]',
						[
							'id' => 'wishboxcdek_pvz_'.$shipping_id,
							'list.select' => isset($params['office']) ? $params['office'] : null
						]
					);
?>