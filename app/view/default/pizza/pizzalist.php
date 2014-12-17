<div class="row"><?php display_message(); ?></div>
<h1><?php echo lang('title.orders.list'); ?></h1>
<div id="browsecontacts">
<?php
	foreach ($pizzas as $pizza) {
		echo '<a>';
		echo 'Customer # ' .$pizza->get_customer() . ', ';
		if (item($pizza->get_ingredients(), 0)) echo ' Ingredient 1, ';
		if (item($pizza->get_ingredients(), 1)) echo ' Ingredient 2, ';
		if (item($pizza->get_ingredients(), 2)) echo ' Ingredient 3, ';
		echo $pizza->get_price() . ', ';
		if ($pizza->get_type()) echo ' delivery';
		else echo ' pickup';
		echo '</a>';
	}
	echo '</div>';
?>
