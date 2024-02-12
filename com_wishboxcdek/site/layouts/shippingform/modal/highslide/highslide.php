<?php
	// 
	defined('_JEXEC') or die;
	// 
	// 
	$add_modal_js = $displayData['add_modal_js'];
	// 
	// 
	if ($add_modal_js)
	{
		// 
		// 
		$path = 'components/com_jshopping/addons/wishboxcdek/layouts/shippingform/modal/highslide/highslide/';
		// 
		// 
		JHtml::script($path.'highslide-with-html.js');
		// 
		// 
		JHtml::stylesheet($path.'highslide.css');
	}
?>
<script type="text/javascript">
	// 
	// 
	window.wishboxcdekmodal =
	{
		// 
		// 
		init: function()
		{
			<?php if ($add_modal_js) { ?>
			// 
			// 
			hs.graphicsDir = '/<?php echo $path; ?>graphics/';
			// 
			// 
			hs.outlineType = 'rounded-white';
			// 
			// 
			hs.wrapperClassName = 'draggable-header';
			<?php } ?>
		},
		
		
		// 
		// 
		close: function()
		{
			// 
			// 
			hs.close();
		},
		
		
		// 
		// 
		open: function(event, a_element)
		{
			// 
			// 
			return hs.htmlExpand(
									a_element,
									{
										objectType: 'iframe',
										width: window.innerWidth - 100,
										height: window.innerHeight - 100
									}
								);
		}
	}
	// 
	// 
	window.wishboxcdekmodal.init();
</script>