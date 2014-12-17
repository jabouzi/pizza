<div class="row"><?php display_message(); ?></div>
<h1><?php echo lang('title.accounts'); ?></h1>
<div id="browsecontacts">
<?php
	foreach ($customers as $customer) {
		echo '<a href="/'.get_site_lang().'/customer/select/' . $customer->get_id() . '">';
		echo $customer->get_first_name() . " " . $customer->get_last_name() . ' ' .$customer->get_address() . " " . $customer->get_city() . " " . $customer->get_postal_code();
		echo '</a>';
	}
	echo '</div>';
?>
