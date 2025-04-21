<?php
/**
 * @copyright   (c) 2013-2025 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later;
 */

/** @var array $displayData */

use Joomla\CMS\Uri\Uri;

extract($displayData);

if (!$shipping_tariff)
{
    return null;
}

$url = Uri::getInstance();
$url->setPath('index.php');
$url->setVar('option', 'com_wishboxcdek');
$url->setVar('view', 'offices');
$url->setVar('format', 'json');
$url->setVar('shop_name', 'radicalmart');
$url->setVar('shipping_method_id', '5');
$url->setVar('city_code', $city_code); // phpcs:ignore
$url->setVar('shipping_tariff', json_encode($shipping_tariff->toArray())); // phpcs:ignore
$url->setVar('packages_data', json_encode($packages));


?>
<script src="https://api-maps.yandex.ru/2.1/?apikey=393748f9-9076-4b96-b584-13cd6b61b54d&lang=ru_RU"></script>
<script>
	function setOfficeCode(officeCode)
	{
		const fancySelectElement = document.getElementById('jform_shipping_officeCode').closest('joomla-field-fancy-select');
		const fancySelectInstance = fancySelectElement.choicesInstance;
		fancySelectInstance.setChoiceByValue(officeCode);
	}

	ymaps.ready
	(
		function()
		{

			const map<?php echo $field->id; ?> = new ymaps.Map(
				document.getElementById('map<?php echo $field->id; ?>'),
				{
					center: [<?php echo $center['latitude']; ?>, <?php echo $center['longitude']; ?>],
					zoom: 10
				}
			);

			wishboxcdek_objectManager = new ymaps.ObjectManager
			(
				{
					clusterize: true,
					clusterHasBalloon: false,
					geoObjectOpenBalloonOnClick: true
				}
			);
			wishboxcdek_objectManager.clusters.options.set
			(
				{
					preset: 'islands#grayClusterIcons',
					hintContentLayout: ymaps.templateLayoutFactory.createClass('Группа объектов')
				}
			);
			wishboxcdek_objectManager.objects.options.set('preset', 'islands#blueIcon');
			wishboxcdek_objectManager.objects.events.add
			(
				'click',
				function (e)
				{
					const objectId = e.get('objectId');
					setOfficeCode(objectId);
				}
			);
			wishboxcdek_objectManager.objects.options.set('preset', 'islands#redDotIcon');
			wishboxcdek_objectManager.clusters.options.set('preset', 'islands#greenClusterIcons');
			map<?php echo $field->id; ?>.geoObjects.add(wishboxcdek_objectManager);

			Joomla.request
			(
				{
					url: '<?php echo URI::root(); ?><?php echo $url->getPath() . '?' . $url->getQuery(); ?>',
					method: 'GET',
					onSuccess: function (response, xhr)
					{
						if (response !== "")
						{
							let data = JSON.parse(response);
							wishboxcdek_objectManager.add(data);
							map<?php echo $field->id; ?>.setBounds(wishboxcdek_objectManager.getBounds());
						}
					}
				}
			);

			const fancySelectElement = document.getElementById('jform_shipping_officeCode').closest('joomla-field-fancy-select');
			const fancySelectInstance = fancySelectElement.choicesInstance;

			fancySelectElement.addEventListener(
				'change',
				function(event)
				{
					console.log(event.detail.value);
					wishboxcdek_objectManager.objects.balloon.open(event.detail.value);
				},
				false,
			);
		}
	);
</script>

<div id="map<?php echo $field->id; ?>" style="height: 400px; width: 100%;"></div>
