<?php
/**
 * Created by PhpStorm.
 * User: andy
 * Date: 18/05/2018
 * Time: 17:12
 */

use Elementor\Base_Data_Control;


class TZ_Icons_Control extends Base_Data_Control
{
	public function get_type()
	{
		return 'icontz';
	}

	public function enqueue()
	{
		// Styles
		wp_register_style( 'tz-icons', DICI_FEATURE_PACK_URI . '/public/css/tz-icons.css', [], DICI_FEATURE_PACK_VERSION );
		wp_enqueue_style( 'tz-icons' );

		wp_register_style( 'tz-jewelry-icons', DICI_FEATURE_PACK_URI . 'public/css/tz-jewelry-icons.css', [], DICI_FEATURE_PACK_VERSION );
		wp_enqueue_style( 'tz-jewelry-icons' );

		do_action( 'elementor/controls/iconstz_enqueue' );

		// Scripts
		wp_register_script( 'tz-icons-control', DICI_FEATURE_PACK_URI . '/includes/elementor/assets/js/icontz-control.js', [ 'jquery' ], DICI_FEATURE_PACK_VERSION );
		wp_enqueue_script( 'tz-icons-control' );

	}

	public static function get_icons()
	{
		$icons_list = [
		    'tz-icon-avatar-1' => 'avatar 1',
            'tz-icon-avatar' => 'avatar',
            'tz-icon-back' => 'back',
			'tz-icon-badge' => 'badge',
			'tz-icon-bill' => 'bill',
			'tz-icon-bills' => 'bills',
            'tz-icon-book' => 'book',
			'tz-icon-box-1' => 'box 1',
			'tz-icon-box-2' => 'box 2',
			'tz-icon-box-3' => 'box 3',
			'tz-icon-box-4' => 'box 4',
			'tz-icon-box-5' => 'box 5',
			'tz-icon-box' => 'box',
            'tz-icon-cancel' => 'cancel',
			'tz-icon-cash' => 'cash',
            'tz-icon-chat-1' => 'chat 1',
            'tz-icon-chat-2' => 'chat 2',
            'tz-icon-chat' => 'chat',
			'tz-icon-coin' => 'coin',
			'tz-icon-coins' => 'coins',
            'tz-icon-copy' => 'copy',
            'tz-icon-clock' => 'clock',
			'tz-icon-credit-card' => 'credit card',
			'tz-icon-delivery' => 'delivery',
			'tz-icon-dislike' => 'dislike',
			'tz-icon-dollar-symbol-1' => 'symbol 1',
			'tz-icon-dollar-symbol-2' => 'symbol 2',
			'tz-icon-dollar-symbol-3' => 'symbol 3',
			'tz-icon-dollar-symbol-4' => 'symbol 4',
			'tz-icon-dollar-symbol-5' => 'symbol 5',
			'tz-icon-dollar-symbol' => 'symbol',
            'tz-icon-download-1' => 'download 1',
            'tz-icon-download' => 'download',
            'tz-icon-edit' => 'edit',
            'tz-icon-envelope' =>  'envelope',
            'tz-icon-folder' => 'folder',
            'tz-icon-garbage' => 'garbage',
            'tz-icon-glasses' => 'glasses',
            'tz-icon-hand' => 'hand',
			'tz-icon-headphones' => 'headphones',
            'tz-icon-heart' => 'heart',
            'tz-icon-house' => 'house',
            'tz-icon-id-card' => 'id card',
			'tz-icon-invoice' => 'invoice',
			'tz-icon-like-1' => 'like 1',
			'tz-icon-like-2' => 'like 2',
			'tz-icon-like' => 'like',
            'tz-icon-link' => 'link',
            'tz-icon-logout' => 'logout',
            'tz-icon-magnifying-glass' => 'magnifying glass',
			'tz-icon-mathematics' => 'mathematics',
			'tz-icon-money-bag' => 'money bag',
			'tz-icon-money' => 'money',
			'tz-icon-monitor-1' => 'monitor 1',
			'tz-icon-monitor' => 'monitor',
            'tz-icon-musical-note' => 'musical note',
            'tz-icon-next-1' => 'next 1',
            'tz-icon-next' => 'next',
			'tz-icon-newspaper' => 'newspaper',
			'tz-icon-package-1' => 'package 1',
			'tz-icon-package-2' => 'package 2',
			'tz-icon-package-3' => 'package 3',
			'tz-icon-package-4' => 'package 4',
			'tz-icon-package-5' => 'package 5',
			'tz-icon-package-6' => 'package 6',
			'tz-icon-package-7' => 'package 7',
			'tz-icon-package' => 'package',
			'tz-icon-padlock' => 'padlock',
            'tz-icon-paper-plane' => 'paper-plane',
			'tz-icon-payment-method' => 'payment method',
			'tz-icon-pen' => 'pen',
			'tz-icon-percentage' => 'percentage',
            'tz-icon-phone-call' => 'phone call',
            'tz-icon-photo-camera' => 'photo camera',
			'tz-icon-pie-chart' => 'pie chart',
			'tz-icon-piggy-bank-1' => 'piggy bank 1',
			'tz-icon-piggy-bank-2' => 'piggy bank 2',
			'tz-icon-piggy-bank' => 'piggy bank',
            'tz-icon-placeholder' => 'placeholder',
			'tz-icon-price-tag' => 'price tag',
			'tz-icon-profits' => 'profits',
            'tz-icon-reload' => 'reload',
            'tz-icon-settings-1' => 'settings 1',
			'tz-icon-settings' => 'settings',
            'tz-icon-share' => 'share',
			'tz-icon-shield' => 'shield',
			'tz-icon-shop' => 'shop',
			'tz-icon-shopping-bag-1' => 'bag 1',
			'tz-icon-shopping-bag-2' => 'bag 2',
			'tz-icon-shopping-bag-3' => 'bag 3',
			'tz-icon-shopping-bag-4' => 'bag 4',
			'tz-icon-shopping-bag-5' => 'bag 5',
			'tz-icon-shopping-bag-6' => 'bag 6',
			'tz-icon-shopping-bag-7' => 'bag 7',
			'tz-icon-shopping-bag-8' => 'bag 8',
			'tz-icon-shopping-bag-9' => 'bag 9',
			'tz-icon-shopping-bag-10' => 'bag 10',
			'tz-icon-shopping-bag' => 'bag',
			'tz-icon-shopping-basket' => 'basket',
			'tz-icon-shopping-cart-1' => 'cart 1',
			'tz-icon-shopping-cart-2' => 'cart 2',
			'tz-icon-shopping-cart-3' => 'cart 3',
			'tz-icon-shopping-cart-4' => 'cart 4',
			'tz-icon-shopping-cart-5' => 'cart 5',
			'tz-icon-shopping-cart-6' => 'cart 6',
			'tz-icon-shopping-cart-7' => 'cart 7',
			'tz-icon-shopping-cart-8' => 'cart 8',
			'tz-icon-shopping-cart-9' => 'cart 9',
			'tz-icon-shopping-cart' => 'cart',
            'tz-icon-shuffle' => 'shuffle',
            'tz-icon-speaker' => 'speaker',
            'tz-icon-speech-bubble-1' => 'speech-bubble-1',
			'tz-icon-speech-bubble' => 'speech-bubble',
            'tz-icon-star' => 'star',
			'tz-icon-tag' => 'tag',
			'tz-icon-telephone-1' => 'telephone 1',
			'tz-icon-telephone' => 'telephone',
			'tz-icon-trolley' => 'trolley',
			'tz-icon-truck-1' => 'truck 1',
			'tz-icon-truck' => 'truck',
            'tz-icon-upload-1' => 'upload 1',
			'tz-icon-upload' => 'upload',
            'tz-icon-vector' => 'vector',
			'tz-icon-wallet' => 'wallet',
            'tz-jewelry-earrings-7' => 'earrings-7',
            'tz-jewelry-earrings-6' => 'earrings-6',
            'tz-jewelry-earrings-5' => 'earrings-5',
            'tz-jewelry-diamond-ring' => 'diamond-ring',
            'tz-jewelry-pendant-5' => 'pendant-5',
            'tz-jewelry-pendant-4' => 'pendant-4',
            'tz-jewelry-pendant-3' => 'pendant-3',
            'tz-jewelry-008-pendant-2' => 'pendant-2',
            'tz-jewelry-pendant-1' => 'pendant-1',
            'tz-jewelry-pendant' => 'pendant',
            'tz-jewelry-diamond-4' => 'diamond-4',
            'tz-jewelry-diamond-3' => 'diamond-3',
            'tz-jewelry-diamond-2' => 'diamond-2',
            'tz-jewelry-diamond-1' => 'diamond-1',
            'tz-jewelry-015-diamond' => 'diamond',
            'tz-jewelry-earrings-4' => 'earrings-4',
            'tz-jewelry-earrings-3' => 'earrings-3',
            'tz-jewelry-earrings-2' => 'earrings-2',
            'tz-jewelry-earrings-1' => 'earrings-1',
            'tz-jewelry-earrings' => 'earrings',
            'tz-jewelry-gift' => 'gift',
            'tz-jewelry-ring' => 'ring'
		];

		$icons_list = apply_filters('/elementor/controls/iconstz_list', $icons_list );

	    return $icons_list;
	}

	protected function get_default_settings() {
		return [
			'options' => self::get_icons(),
			'include' => '',
			'exclude' => '',
		];
	}

	public function content_template() {
		$control_uid = $this->get_control_uid();
		?>
		<div class="elementor-control-field">
			<label for="<?php echo $control_uid; ?>" class="elementor-control-title">{{{ data.label }}}</label>
			<div class="elementor-control-input-wrapper">
				<select id="<?php echo $control_uid; ?>" class="elementor-control-icon" data-setting="{{ data.name }}" data-placeholder="<?php echo __( 'Select Icon', 'dici-feature-pack' ); ?>">
					<option value=""><?php echo __( 'Select Icon', 'dici-feature-pack' ); ?></option>
					<# _.each( data.options, function( option_title, option_value ) { #>
					<option value="{{ option_value }}">{{{ option_title }}}</option>
					<# } ); #>
				</select>
			</div>
		</div>
		<# if ( data.description ) { #>
		<div class="elementor-control-field-description">{{ data.description }}</div>
		<# } #>
		<?php
	}

}