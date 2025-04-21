<?php
/**
 * @copyright  (c) 2013-2025 Nekrasov Vitaliy
 * @license    GNU General Public License version 2 or later;
 */
use Joomla\CMS\HTML\HTMLHelper;

defined('_JEXEC') or die;

$count = $this->count;
$shopName = $this->shopName;
$shippingMethodId = $this->shippingMethodId;
$cityCode = $this->cityCode;
$center = $this->center;
HTMLHelper::script('https://api-maps.yandex.ru/2.1?apikey=afb16ee7-ed0c-4973-a129-3771b436be8b&lang=ru_RU&coordorder=latlong');
?>
<div id="wishboxcdek_map"></div>
<script type="text/javascript">
	ymaps.ready(init);
	var wishboxcdek_map = null;
	var wishboxcdek_objectManager = null;

	function init()
	{
		wishboxcdek_map = new ymaps.Map
		(
			'wishboxcdek_map',
			{
				center: [<?php echo $center[0]; ?>, <?php echo $center[1]; ?>],
				zoom: 7
			}
		);

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
		wishboxcdek_objectManager.objects.options.set('preset', 'islands#greenDotIcon');
		wishboxcdek_objectManager.clusters.options.set('preset', 'islands#greenClusterIcons');
		wishboxcdek_map.geoObjects.add(wishboxcdek_objectManager);
		jQuery.ajax
		(
			{
				url: 'index.php?option=com_wishboxcdek&view=offices&format=json&shop_name=<?php echo $shopName; ?>&city_code=<?php echo $cityCode; ?>&shipping_method_id=<?php echo $this->shippingMethodId; ?>'
			}
		).done
		(
			function(data)
			{
				console.log(data);
				wishboxcdek_objectManager.add(data);
				wishboxcdek_map.setBounds(wishboxcdek_objectManager.getBounds());
			}
		);
	}

	jQuery(document).ready
	(
		function()
		{
			jQuery('#shipping_method_<?php echo $shippingMethodId; ?>').one
			(
				'change',
				function()
				{
					wishboxcdek_map.container.fitToViewport();
					<?php if ($this->count > 1) { ?>
					wishboxcdek_map.setBounds(wishboxcdek_objectManager.getBounds());
					<?php } else { ?>
					wishboxcdek_map.zoomRange.get(wishboxcdek_objectManager.objects.getById(0).geometry.coordinates).then
					(
						function (range)
						{
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
