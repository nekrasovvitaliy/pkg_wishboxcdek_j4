<?php
/**
 * @copyright   (c) 2013-2024 Nekrasov Vitaliy <nekrasov_vitaliy@list.ru>
 * @license     GNU General Public License version 2 or later;
 */
defined('_JEXEC') or die;

/** @var array $displayData */

$office = $displayData['office'];
$shippingTariff = $displayData['shipping_tariff'];
$adv_user = $displayData['adv_user'];
$shipping_method_id = $displayData['shipping_method_id'];
?>
<div class="co-pick_up-point_inner">
	<div class="co-pick_up-address_field">
		<?php echo $office->address; ?>
	</div>
    <?php /*
	<div class="co-pick_up-text_field-compact">
		Стоимость доставки: <span class="co-pick_up-price"><?php echo $shippingTariff->shipping; ?></span>
	</div>
	<div class="co-pick_up-text_field">
		Срок доставки: Доставка осуществляется от <?php echo $shippingTariff->periodMin; ?> до <?php echo $shippingTariff->periodMax; ?> дней
	</div>
	<div class="co-pick_up-text_field-compact">
		Доставка компанией: СДЭК
	</div>
 */ ?>
</div>