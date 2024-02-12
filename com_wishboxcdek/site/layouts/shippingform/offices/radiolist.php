<?php
	// 
	defined('_JEXEC') or die;
	
	// 
	// 
	$offices = $displayData['offices'];
	// 
	// 
	$shipping_id = $displayData['shipping_id'];
	// 
	// 
	$params = $displayData['params'];
?>
<ul class="offices">
	<?php foreach ($offices as $office) { ?>
	<li>
		<label for="params_<?php echo $shipping_id; ?>_office_<?php echo $office->id; ?>">
			<div class="input_container">
				<input
					id="params_<?php echo $shipping_id; ?>_office_<?php echo $office->id; ?>"
					name="params[<?php echo $shipping_id; ?>][office]"
					type="radio"
					value="<?php echo $office->value; ?>"
					<?php if ($params['office'] == $office->value) { ?>
					checked="checked"
					<?php } ?>
				/>
			</div>
			<div class="info_container">
				<div>
					<span class="address">
						<?php echo $office->address; ?>
					</span>
					<?php if (!empty($office->metrostation)) { ?>
					<span class="metrostation">
						<?php echo $office->metrostation; ?>
					</span>
					<?php } ?>
					<?php if (!empty($office->neareststation)) { ?>
					<span class="neareststation">
						Остановки рядом: <?php echo $office->neareststation; ?>
					</span>
					<?php } ?>
				</div>
				<div>
					<span class="worktime">
					<?php echo $office->worktime; ?>
				</span>
				</div>
				<div>
					<?php if ($office->isdressingroom == 'есть') { ?>
					<span class="isdressingroom">
						Примерочная
					</span>
					<?php } ?>
					<?php if ($office->havecashless == 'есть') { ?>
					<span class="havecashless">
						Безналичная оплата
					</span>
					<?php } ?>
					
					<?php if ($office->allowedcod == 'есть') { ?>
					<span class="allowedcod">
						Наложенный платёж
					</span>
					<?php } ?>
				</div>
			</div>
		</label>
	</li>
	<?php } ?>
</ul>
<style>
	ul.offices li
	{
		background-color: #dedede;
		display: block;
		margin-bottom: 3px;
		padding: 5px;
	}
	
	ul.offices li .input_container
	{
		float: left;
	}
	
	ul.offices li .info_container
	{
		margin-left: 25px;
	}
	
	ul.offices li .address
	{
		
	}
	
	ul.offices li .worktime
	{
		
	}
</style>