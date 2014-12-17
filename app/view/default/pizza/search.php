<div class="row"><?php display_message(); ?></div>
<h2><?php echo lang('title.search.customer'); ?></h2>
<form action="/<?php echo get_site_lang(); ?>/customer/search" method="post" id="addform" name="addform">
    <div class="row">
		<label for="phone"><?php echo lang('form.phone'); ?>:</label>
		<input type="text" name="phone" id="phone" value="<?php echo print_post_text('phone'); ?>" data-validate="required" />
	</div>
    <div>
		<div class="row"><label for="submit"> </label>
			<input id="submitadd" type="button" value="<?php echo lang('title.search.customer'); ?>" class="submitbutton"/>
		</div>
		<div class="row error_form_msg">
			<span class="error"><?php echo lang('form.check.required.fields'); ?></span>
		</div>
    </div>
</form>
