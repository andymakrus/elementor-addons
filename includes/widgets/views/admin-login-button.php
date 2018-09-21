<p>
    <label for="<?php echo $this->get_field_id('account_text'); ?>">
        <?php _e('Account Button Text:', 'dici-feature-pack'); ?>
        <input class="widefat" id="<?php echo $this->get_field_id('account_text'); ?>" name="<?php echo $this->get_field_name('account_text'); ?>" type="text" value="<?php echo esc_attr($account_text); ?>" />
    </label>
</p>

<p>
    <label for="<?php echo $this->get_field_id('signin_text'); ?>">
		<?php _e('Sign In Button Text:', 'dici-feature-pack'); ?>
        <input class="widefat" id="<?php echo $this->get_field_id('signin_text'); ?>" name="<?php echo $this->get_field_name('signin_text'); ?>" type="text" value="<?php echo esc_attr($signin_text); ?>" />
    </label>
</p>