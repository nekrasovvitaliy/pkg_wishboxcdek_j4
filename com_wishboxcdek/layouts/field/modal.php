<?php
/**
 * @copyright   (c) 2013-2025 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later;
 */
defined('_JEXEC') or die;

/** @var array $displayData */
extract($displayData);

/** @var integer $cityCode */
/** @var integer $shippingMethodId */
/** @var string  $shopName */

$modalUrlParams = [
	'option'                => 'com_wishboxcdek',
	'view'                  => 'changeoffice',
	'tmpl'                  => 'component',
	'layout'                => 'tabslistyandexmap',
	'city_code'             => $cityCode,
	'shipping_method_id'    => $shippingMethodId,
    'shop_name'             => $shopName
];
$modalUrl = '/index.php?' . http_build_query($modalUrlParams);
?>
<a
	href="<?php echo $modalUrl; ?>"
	onclick="return wishboxcdekmodal.open(event, this);"
	id="wishboxcdek_select_pvz_on_map"
>
	Выбрать на карте
</a>
