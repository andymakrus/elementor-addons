<p>
	<label for="<?php echo $this->get_field_id('shop_address_title'); ?>">
		<?php _e('Shop Address Title:', 'dici-feature-pack'); ?>
		<input class="widefat" id="<?php echo $this->get_field_id('shop_address_title'); ?>" name="<?php echo $this->get_field_name('shop_address_title'); ?>" type="text" value="<?php echo esc_attr($shop_address_title); ?>" />
	</label>
</p>

<p>
	<label for="<?php echo $this->get_field_id('shop_address_city'); ?>">
		<?php _e('Shop Address City:', 'dici-feature-pack'); ?>
		<input class="widefat" id="<?php echo $this->get_field_id('shop_address_city'); ?>" name="<?php echo $this->get_field_name('shop_address_city'); ?>" type="text" value="<?php echo esc_attr($shop_address_city); ?>" />
	</label>
</p>

<p>
	<label for="<?php echo $this->get_field_id('shop_address_street'); ?>">
		<?php _e('Shop Address Street:', 'dici-feature-pack'); ?>
		<input class="widefat" id="<?php echo $this->get_field_id('shop_address_street'); ?>" name="<?php echo $this->get_field_name('shop_address_street'); ?>" type="text" value="<?php echo esc_attr($shop_address_street); ?>" />
	</label>
</p>