<p>
	<label for="<?php echo $this->get_field_id('call_back_title'); ?>">
		<?php _e('Call Back Title:', 'dici-feature-pack'); ?>
		<input class="widefat" id="<?php echo $this->get_field_id('call_back_title'); ?>" name="<?php echo $this->get_field_name('call_back_title'); ?>" type="text" value="<?php echo esc_attr($call_back_title); ?>" />
	</label>
</p>

<p>
	<label for="<?php echo $this->get_field_id('call_back_text'); ?>">
		<?php _e('Call Back Text:', 'dici-feature-pack'); ?>
		<input class="widefat" id="<?php echo $this->get_field_id('call_back_text'); ?>" name="<?php echo $this->get_field_name('call_back_text'); ?>" type="text" value="<?php echo esc_attr($call_back_text); ?>" />
	</label>
</p>

<p>
    <label for="<?php echo $this->get_field_id('call_back_button_text'); ?>">
		<?php _e('Call Back Button Text:', 'dici-feature-pack'); ?>
        <input class="widefat" id="<?php echo $this->get_field_id('call_back_button_text'); ?>" name="<?php echo $this->get_field_name('call_back_button_text'); ?>" type="text" value="<?php echo esc_attr($call_back_button_text); ?>" />
    </label>
</p>