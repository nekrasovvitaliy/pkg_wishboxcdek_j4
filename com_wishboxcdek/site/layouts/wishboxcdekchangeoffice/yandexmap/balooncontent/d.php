<?php
/**
 * @copyright  (c) 2013-2025 Nekrasov Vitaliy
 * @license    GNU General Public License version 2 or later;
 */
defined('_JEXEC') or die;

/** @var array $displayData */

$office = $displayData['office'];
$shippingTariff = $displayData['shipping_tariff'];
$adv_user = $displayData['adv_user'];
$sh_pr_method_id = $displayData['sh_pr_method_id'];
?>
<div class="co-pick_up-point_inner">
	<div class="co-pick_up-button_box">
		<a
			class="btn"
			href="index.php?option=com_jshopping&controller=wishboxcdekchangeoffice&task=displayoffice&id=<?php echo $office->id; ?>&sh_pr_method_id=<?php echo $sh_pr_method_id; ?>&tmpl=component"
			onclick="return window.parent.wishboxcdekmodal.open(event, this);"
		>
			Подробнее
		</a>
		<button
			class="btn"
			onclick="window.parent.wishboxcdek_set_pvz_from_map('<?php echo $office->code; ?>');"
			type="button"
		>
			Выбрать
		</button>
	</div>
	<div class="co-pick_up-text_field-compact">
		<?php echo $office->name; ?>
	</div>
	<div class="co-pick_up-address_field">
		<?php echo $office->address; ?>
	</div>
	<div class="co-pick_up-text_field-compact">
		Стоимость доставки: <span class="co-pick_up-price"><?php echo \JSHelper::formatprice($shippingTariff->shipping); ?></span>
	</div>
	<div class="co-pick_up-text_field">
		Срок доставки: Доставка осуществляется от <?php echo $shippingTariff->periodMin; ?> до <?php echo $shippingTariff->periodMax; ?> дней
	</div>
	<div class="co-pick_up-text_field-compact">
		Доставка компанией: СДЭК
	</div>
</div>