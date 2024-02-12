<?php
	// 
	defined('_JEXEC') or die;
	
	
	// 
	// 
	$offices = $displayData['offices'];
	// 
	// 
	$sh_pr_method_id = $displayData['sh_pr_method_id'];
	// 
	// 
	$city_code = $displayData['city_code'];
	// 
	// 
	$center = $displayData['center'];
	// 
	// 
	JHtml::script('https://api-maps.yandex.ru/2.1?apikey=afb16ee7-ed0c-4973-a129-3771b436be8b&lang=ru_RU&coordorder=latlong');
?>
<div id="wishboxcdek_map"></div>
<script type="text/javascript">
	// 
	// 
    ymaps.ready(init);
	// 
	// 
	var wishboxcdek_map = null;
	// 
	// 
	var wishboxcdek_objectManager = null;
	// 
	// 
    function init()
	{
		// 
        wishboxcdek_map = new ymaps.Map
		(
			'wishboxcdek_map',
			{
				center: [<?php echo $center[0]; ?>, <?php echo $center[1]; ?>],
				zoom: 7
			}
		);
		// 
		wishboxcdek_objectManager = new ymaps.ObjectManager
		(
			{
				// Включаем кластеризацию.
				clusterize: true,
				// Опции кластеров задаются с префиксом 'cluster'.
				clusterHasBalloon: false,
				// Опции геообъектов задаются с префиксом 'geoObject'.
				geoObjectOpenBalloonOnClick: true
			}
		);
		// Опции можно задавать напрямую в дочерние коллекции.
		wishboxcdek_objectManager.clusters.options.set
		(
			{
				preset: 'islands#grayClusterIcons',
				hintContentLayout: ymaps.templateLayoutFactory.createClass('Группа объектов')
			}
		);
		wishboxcdek_objectManager.objects.options.set('preset', 'islands#blueIcon');
		/*
		// 
		wishboxcdek_objectManager.objects.events.add
		(
			'click',
			function (e)
			{
				// 
				var objectId = e.get('objectId');
				// 
				wishboxcdek_open(objectId);
			}
		);
		*/
		// 
		// 
		wishboxcdek_objectManager.objects.options.set('preset', 'islands#greenDotIcon');
		// 
		// 
		wishboxcdek_objectManager.clusters.options.set('preset', 'islands#greenClusterIcons');
		// 
		// 
		wishboxcdek_map.geoObjects.add(wishboxcdek_objectManager);
		// 
		// 
		jQuery.ajax
		(
			{
				// 
				// 
				url: 'index.php?option=com_jshopping&controller=wishboxcdekcheckout&task=getOffices&city_code=<?php echo $city_code; ?>'
			}
		).done
		(
			function(data)
			{
				console.log(data);
				// 
				// 
				wishboxcdek_objectManager.add(data.data);
				// 
				// 
				wishboxcdek_map.setBounds(wishboxcdek_objectManager.getBounds());
			}
		);
		<?php /* Если уже выбрано отделение */ ?>
		<?php /*
		<?php if ($selected) { ?>
		// 
		wishboxcdek_open(<?php echo $selected; ?>);
		<?php } ?>
		*/ ?>
    }
	
	// 
	jQuery(document).ready
	(
		function()
		{
			// 
			jQuery('#shipping_method_<?php echo $sh_pr_method_id; ?>').one
			(
				'change',
				function()
				{
					// 
					wishboxcdek_map.container.fitToViewport();
					<?php if (count($offices) > 1) { ?>
					// 
					wishboxcdek_map.setBounds(wishboxcdek_objectManager.getBounds());
					<?php } else { ?>
					// 
					wishboxcdek_map.zoomRange.get(wishboxcdek_objectManager.objects.getById(0).geometry.coordinates).then
					(
						function (range)
						{
							// 
							wishboxcdek_map.setCenter(wishboxcdek_objectManager.objects.getById(0).geometry.coordinates, range[1]);
						}
					);
					<?php } ?>
				}
			);
		}
	);
</script>
<style>
	#wishboxcdek_map
	{
		bottom: 0;
		left: 0;
		position: absolute;
		right: 0;
		top: 0;
	}
</style>