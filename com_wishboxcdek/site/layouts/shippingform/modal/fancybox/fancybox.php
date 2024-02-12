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
		JHtml::script('https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js');
		// 
		// 
		JHtml::stylesheet('https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css');
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
			// 
			// 
			
		},
		
		
		// 
		// 
		close: function()
		{
			// 
			// 
			Fancybox.close();
		},
		
		
		// 
		// 
		open: function(event, a_element)
		{
			// 
			// 
			event = event || window.event;
			// 
			// 
			event.preventDefault();
			// 
			// 
			var href = a_element.getAttribute('href');
			// 
			// 
			var fancybox = Fancybox.show(
											[
												{
													src: href,
													type: 'iframe',
													width: window.innerWidth - 100,
													height: window.innerHeight - 100
												}
											]
										);
			// 
			// 
			return false;
		}
	}
	// 
	// 
	window.wishboxcdekmodal.init();
</script>