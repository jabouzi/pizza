<div class="row"><?php display_message(); ?></div>
<h1><?php echo lang('title.pizzas'); ?></h1>
<div id="browsecontacts">
<?php
	foreach ($pizzas as $pizza) {
		echo '<a href="/'.get_site_lang().'/pizza/edit/' . $user->get_pizza_id() . '">';
		echo $user->get_user_first_name() . " " . $user->get_user_last_name();
		echo '</a>';
	}
	echo '</div>';
?>
