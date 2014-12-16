<div class="row"><?php display_message(); ?></div>
<h2><?php echo lang('title.add.pizza'); ?></h2>
<form action="/<?php echo get_site_lang(); ?>/pizza/processadd" method="post" id="addform" name="addform">
    <div class="row">
		<label for="phone"><?php echo lang('form.phone'); ?>:</label>
		<input type="text" name="phone" id="phone" value="<?php echo print_post_text('phone'); ?>" data-validate="required" />
	</div>
    <div class="row">
		<label for="first_name"><?php echo lang('form.firstname'); ?>:</label>
		<input type="text" name="first_name" id="first_name" value="<?php echo print_post_text('first_name'); ?>" data-validate="required"  />
	</div>
	<div class="row">
		<label for="last_name"><?php echo lang('form.lastname'); ?>:</label>
		<input type="text" name="last_name" id="last_name" value="<?php echo print_post_text('last_name'); ?>" data-validate="required" />
	</div>
    <div class="row">
		<label for="address"><?php echo lang('form.address'); ?>:</label>
		<input type="text" name="address" id="address" value="<?php echo print_post_text('address'); ?>" data-validate="required" />
	</div>
    <div class="row">
		<label for="address2"><?php echo lang('form.address2'); ?>:</label>
		<input type="text" name="address2" id="address2" value="<?php echo print_post_text('address2'); ?>" data-validate="required" />
	</div>
    <div class="row">
		<label for="comments"><?php echo lang('form.comments'); ?>:</label>
		<textarea name="comments" id="comments" maxlength="100" data-validate="required"><?php echo print_post_text('comments'); ?></textarea>
	</div>
	<hr>
	<div class="row">
		<label for="ingredient_1"><?php echo lang('form.ingredient1'); ?>:</label>
		<input type="checkbox" name="ingredient_1" id="ingredient_1" value="1" <?php if (intval(print_post_text('ingredient_1')) == 1) echo 'checked'; ?>>
    </div>
	<div class="row">
		<label for="ingredient_2"><?php echo lang('form.ingredient2'); ?>:</label>
		<input type="checkbox" name="ingredient_2" id="ingredient_2" value="1" <?php if (intval(print_post_text('ingredient_2')) == 1) echo 'checked'; ?>>
    </div>
	<div class="row">
		<label for="ingredient_3"><?php echo lang('form.ingredient1'); ?>:</label>
		<input type="checkbox" name="ingredient_3" id="ingredient_3" value="1" <?php if (intval(print_post_text('ingredient_3')) == 1) echo 'checked'; ?>>
    </div>
	<div class="row">
		<label for="delivery"><?php echo lang('form.type'); ?>:</label>
		<select name="delivery" id="delivery">
			<option value="1"><?php echo lang('form.delivery'); ?></option>
			<option value="0"><?php echo lang('form.pickup'); ?></option>
		</select>
    </div>
    <div class="row">
		<label for="price"><?php echo lang('form.price'); ?>:</label>
		<input type="text" name="price" id="price" value="<?php echo print_post_text('price'); ?>" data-validate="required" />
	</div>
    <div>
		<div class="row"><label for="submit"> </label>
			<input id="submitadd" type="button" value="<?php echo lang('title.add.pizza'); ?>" class="submitbutton"/>
		</div>
		<div class="row error_form_msg">
			<span class="error"><?php echo lang('form.check.required.fields'); ?></span>
		</div>
    </div>
</form>
