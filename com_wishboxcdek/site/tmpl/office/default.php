<?php
/**
 * @copyright  (c) 2013-2025 Nekrasov Vitaliy
 * @license    GNU General Public License version 2 or later;
 */

defined('_JEXEC') or die;
?>
<div class="co-pick_up-details-container">
	<div>
		<div class="co-pick_up-details-field-title">
			Адрес
		</div>
		<div class="co-pick_up-details-field">
			<?php echo $this->item->city; ?>, <?php echo $this->item->address; ?>
		</div>
	</div>
    <?php if ($this->shippingTariff) : ?>
	<div>
		<div class="co-pick_up-details-field-title">
			Стоимость доставки
		</div>
		<div class="co-pick_up-details-field-price">
			<?php echo $this->shippingTariff->shipping; ?>
		</div>
	</div>
    <?php endif; ?>
	<div>
		<div class="co-pick_up-details-field-title">
			Как добраться
		</div>
		<div class="co-pick_up-details-field">
			<?php echo $this->item->note; ?>
		</div>
	</div>
	<div>
		<div class="co-pick_up-details-field-title">
			Доставка компанией
		</div>
		<div class="co-pick_up-details-field">
			СДЭК
		</div>
	</div>
	<?php if ($this->shippingTariff) : ?>
	<div>
		<div class="co-pick_up-details-field-title">
			Срок доставки
		</div>
		<div class="co-pick_up-details-field">
			Доставка осуществляется от <?php echo $this->shippingTariff->periodMin; ?> до <?php echo $this->shippingTariff->periodMax; ?> дней
		</div>
	</div>
	<?php endif; ?>
	<div>
		<div class="co-pick_up-details-field-title">
			Контакты
		</div>
		<ul class="co-pick_up-details-field-list">
			<li class="co-pick_up-details-field-phone">
				<?php echo $this->item->phone; ?>
			</li>
		</ul>
	</div>
	<div>
		<div class="co-pick_up-details-field-title">
			Способы оплаты
		</div>
		<ul class="co-pick_up-details-field-list">
			<?php if ($this->item->have_cashless == 1) : ?>
            <li class="co-pick_up-details-field-payment">Оплата картой</li>
			<?php endif; ?>
			<li class="co-pick_up-details-field-payment">Оплата наличными</li>
			<li class="co-pick_up-details-field-payment">Предоплата магазину</li>
		</ul>
	</div>
	<div class="co-pick_up-details-footer">
		<button onclick="window.parent.wishboxcdek_set_pvz_from_map('<?php echo $this->item->code; ?>');" type="button">
			Выбрать
		</button>
	</div>
</div>
