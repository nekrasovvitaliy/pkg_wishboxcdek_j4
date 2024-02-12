<?php
	// 
	defined('_JEXEC') or die;
	die;
	// 
	// 
	$offices = $displayData['offices'];
	// 
	$shipping_id = $displayData['shipping_id'];
	// 
	$shippinginfo = $displayData['shippinginfo'];
	// 
	$params = $displayData['params'];
	// 
	JHtml::script('https://api-maps.yandex.ru/2.1/?lang=ru_RU');
?>
<div class="wishboxsmcdek_map_<?php echo $shipping_id; ?>_container">
	<div class="info_container">
		<input name="params[<?php echo $shipping_id; ?>][office]" type="hidden" value="<?php echo $params['office']; ?>" />
		<div class="code">
			<span class="label">
				Код
			</span>
			<span class="value">
			</span>
		</div>
		<div class="name">
			<span class="label">
				Название
			</span>
			<span class="value">
			</span>
		</div>
		<div class="worktime">
			<span class="label">
				Часы работы
			</span>
			<span class="value">
			</span>
		</div>
		<div class="address">
			<span class="label">
				Адрес
			</span>
			<span class="value">
			</span>
		</div>
		<div class="phone">
			<span class="label">
				Телефон
			</span>
			<span class="value">
			</span>
		</div>
		<div class="note">
			<span class="label">
				Примечание
			</span>
			<span class="value">
			</span>
		</div>
		<div class="type">
			<span class="label">
				Тип
			</span>
			<span class="value">
			</span>
		</div>
		<div class="isdressingroom">
			<span class="label">
				Примерочная
			</span>
			<span class="value">
			</span>
		</div>
		<div class="havecashless">
			<span class="label">
				Безналичная оплата
			</span>
			<span class="value">
			</span>
		</div>
		<div class="allowedcod">
			<span class="label">
				Наложенный платёж
			</span>
			<span class="value">
			</span>
		</div>
		<div class="neareststation">
			<span class="label">
				Остановки рядом
			</span>
			<span class="value">
			</span>
		</div>
		<div class="metrostation">
			<span class="label">
				Станция метро
			</span>
			<span class="value">
			</span>
		</div>
	</div>
	<div class="map_container">
		<div id="wishboxsmcdek_map_<?php echo $shipping_id; ?>" style="height: 400px"></div>
	</div>
	<div style="clear: both;"></div>
</div>
<script type="text/javascript">
	// 
    ymaps.ready(init);
	// 
	var wishboxsmcdek_map_<?php echo $shipping_id; ?> = null;
	// 
	var wishboxsmcdek_objectManager_<?php echo $shipping_id; ?> = null;
	// 
	function wishboxsmcdek_open_<?php echo $shipping_id; ?>(objectId)
	{
		// 
		wishboxsmcdek_objectManager_<?php echo $shipping_id; ?>.objects.balloon.open(objectId);
		// 
		obj = wishboxsmcdek_objectManager_<?php echo $shipping_id; ?>.objects.getById(objectId);
		// 
		jQuery('.wishboxsmcdek_map_<?php echo $shipping_id; ?>_container .info_container input').val(obj.features.code);
		// 
		jQuery('.wishboxsmcdek_map_<?php echo $shipping_id; ?>_container .info_container .code .value').text(obj.features.code);
		// 
		jQuery('.wishboxsmcdek_map_<?php echo $shipping_id; ?>_container .info_container .name .value').text(obj.features.name);
		// 
		jQuery('.wishboxsmcdek_map_<?php echo $shipping_id; ?>_container .info_container .worktime .value').text(obj.features.worktime);
		// 
		jQuery('.wishboxsmcdek_map_<?php echo $shipping_id; ?>_container .info_container .address .value').text(obj.features.address);
		// 
		jQuery('.wishboxsmcdek_map_<?php echo $shipping_id; ?>_container .info_container .phone .value').text(obj.features.phone);
		// 
		jQuery('.wishboxsmcdek_map_<?php echo $shipping_id; ?>_container .info_container .note .value').text(obj.features.note);
		// 
		jQuery('.wishboxsmcdek_map_<?php echo $shipping_id; ?>_container .info_container .type .value').text(obj.features.type);
		// 
		jQuery('.wishboxsmcdek_map_<?php echo $shipping_id; ?>_container .info_container .isdressingroom .value').text(obj.features.isdressingroom);
		// 
		jQuery('.wishboxsmcdek_map_<?php echo $shipping_id; ?>_container .info_container .havecashless .value').text(obj.features.havecashless);
		// 
		jQuery('.wishboxsmcdek_map_<?php echo $shipping_id; ?>_container .info_container .allowedcod .value').text(obj.features.allowedcod);
		// 
		jQuery('.wishboxsmcdek_map_<?php echo $shipping_id; ?>_container .info_container .neareststation .value').text(obj.features.neareststation);
		// 
		jQuery('.wishboxsmcdek_map_<?php echo $shipping_id; ?>_container .info_container .metrostation .value').text(obj.features.metrostation);
	}
	// 
    function init()
	{
		// 
        wishboxsmcdek_map_<?php echo $shipping_id; ?> = new ymaps.Map
		(
			'wishboxsmcdek_map_<?php echo $shipping_id; ?>',
			{
				center: [45.05984880, 38.96527860],
				zoom: 7
			}
		);
		// 
		wishboxsmcdek_objectManager_<?php echo $shipping_id; ?> = new ymaps.ObjectManager
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
		wishboxsmcdek_objectManager_<?php echo $shipping_id; ?>.clusters.options.set
		(
			{
				preset: 'islands#grayClusterIcons',
				hintContentLayout: ymaps.templateLayoutFactory.createClass('Группа объектов')
			}
		);
		wishboxsmcdek_objectManager_<?php echo $shipping_id; ?>.objects.options.set('preset', 'islands#blueIcon');
		// 
		wishboxsmcdek_objectManager_<?php echo $shipping_id; ?>.objects.events.add
		(
			'click',
			function (e)
			{
				// 
				var objectId = e.get('objectId');
				// 
				wishboxsmcdek_open_<?php echo $shipping_id; ?>(objectId);
			}
		);
		// 
		<?php if (is_array($offices) && count($offices)) { ?>
		<?php foreach ($offices as $k => $office) { ?>
		<?php if ($params['office'] == $office->value) { $selected = $k; } ?>
		// 
		wishboxsmcdek_objectManager_<?php echo $shipping_id; ?>.add
		(
			{
				type: 'Feature',
				id: <?php echo $k; ?>,
				geometry:
				{
					type: 'Point',
					coordinates: [<?php echo $office->coordy; ?>, <?php echo $office->coordx; ?>]
				},
				properties:
				{
					hintContent: '<?php echo htmlspecialchars($office->name); ?>',
					balloonContent: '<?php echo htmlspecialchars($office->address); ?>'
				},
				features:
				{
					code: '<?php echo $office->code; ?>',
					name: '<?php echo $office->name; ?>',
					worktime: '<?php echo $office->worktime; ?>',
					address: '<?php echo $office->address; ?>',
					phone: '<?php echo $office->phone; ?>',
					note: '<?php echo $office->note; ?>',
					type: '<?php echo $office->type; ?>',
					isdressingroom: '<?php echo $office->isdressingroom; ?>',
					havecashless: '<?php echo $office->havecashless; ?>',
					allowedcod: '<?php echo $office->allowedcod; ?>',
					neareststation: '<?php echo $office->neareststation; ?>',
					metrostation: '<?php echo $office->metrostation; ?>'
				}
			}
		);
		<?php } ?>
		<?php } ?>
		// 
		wishboxsmcdek_map_<?php echo $shipping_id; ?>.geoObjects.add(wishboxsmcdek_objectManager_<?php echo $shipping_id; ?>);
		// 
		if (jQuery('#shipping_method_<?php echo $shippinginfo->sh_pr_method_id; ?>').prop('checked'))
		{
			// 
			<?php if (count($offices) > 1) { ?>
			// 
			wishboxsmcdek_map_<?php echo $shipping_id; ?>.setBounds(wishboxsmcdek_objectManager_<?php echo $shipping_id; ?>.getBounds());
			<?php } else { ?>
			// 
			wishboxsmcdek_map_<?php echo $shipping_id; ?>.zoomRange.get(wishboxsmcdek_objectManager_<?php echo $shipping_id; ?>.objects.getById(0).geometry.coordinates).then
			(
				function (range)
				{
					// 
					wishboxsmcdek_map_<?php echo $shipping_id; ?>.setCenter(wishboxsmcdek_objectManager_<?php echo $shipping_id; ?>.objects.getById(0).geometry.coordinates, range[1]);
				}
			);
			<?php } ?>
		}
		<?php /* Если уже выбрано отделение */ ?>
		<?php if ($selected) { ?>
		// 
		wishboxsmcdek_open_<?php echo $shipping_id; ?>(<?php echo $selected; ?>);
		<?php } ?>
    }
	
	// 
	jQuery(document).ready
	(
		function()
		{
			<?php if (!$active) { ?>
			// 
			jQuery('#shipping_method_<?php echo $shippinginfo->sh_pr_method_id; ?>').one
			(
				'change',
				function()
				{
					// 
					wishboxsmcdek_map_<?php echo $shipping_id; ?>.container.fitToViewport();
					<?php if (count($offices) > 1) { ?>
					// 
					wishboxsmcdek_map_<?php echo $shipping_id; ?>.setBounds(wishboxsmcdek_objectManager_<?php echo $shipping_id; ?>.getBounds());
					<?php } else { ?>
					// 
					wishboxsmcdek_map_<?php echo $shipping_id; ?>.zoomRange.get(wishboxsmcdek_objectManager_<?php echo $shipping_id; ?>.objects.getById(0).geometry.coordinates).then
					(
						function (range)
						{
							// 
							wishboxsmcdek_map_<?php echo $shipping_id; ?>.setCenter(wishboxsmcdek_objectManager_<?php echo $shipping_id; ?>.objects.getById(0).geometry.coordinates, range[1]);
						}
					);
					<?php } ?>
				}
			);
			<?php } ?>
		}
	);
</script>
<style>
	.wishboxsmcdek_map_<?php echo $shipping_id; ?>_container
	{
		margin-top: 5px;
		overflow: hidden;
	}
	
	.wishboxsmcdek_map_<?php echo $shipping_id; ?>_container .info_container
	{
		float: left;
		width: 30%;
	}
	
	.wishboxsmcdek_map_<?php echo $shipping_id; ?>_container .map_container
	{
		float: right;
		width: 70%;
	}
</style>