<?php
/**
 * Revive Shop theme bootstrap.
 *
 * @package revive-shop
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'REVIVE_SHOP_VERSION', '0.1.0' );

/**
 * Theme supports.
 */
add_action(
	'after_setup_theme',
	static function () {
		load_theme_textdomain( 'revive-shop', get_template_directory() . '/languages' );

		add_theme_support( 'wp-block-styles' );
		add_theme_support( 'editor-styles' );
		add_editor_style( 'style.css' );

		add_theme_support( 'woocommerce' );
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );
	}
);

/**
 * Front-end stylesheet.
 */
add_action(
	'wp_enqueue_scripts',
	static function () {
		wp_enqueue_style(
			'revive-shop',
			get_stylesheet_uri(),
			array(),
			REVIVE_SHOP_VERSION
		);
	}
);

/**
 * Pattern category for the shop sections, so they are easy to find in the editor.
 */
add_action(
	'init',
	static function () {
		register_block_pattern_category(
			'revive-shop',
			array( 'label' => __( 'Revive — магазин', 'revive-shop' ) )
		);

		register_block_style(
			'core/button',
			array(
				'name'  => 'light',
				'label' => __( 'Світла', 'revive-shop' ),
			)
		);
	}
);

/**
 * Preload the two Cyrillic font files used above the fold.
 */
add_action(
	'wp_head',
	static function () {
		$fonts = array(
			'assets/fonts/montserrat-cyrillic-wght-normal.woff2',
			'assets/fonts/commissioner-cyrillic-wght-normal.woff2',
		);
		foreach ( $fonts as $font ) {
			printf(
				'<link rel="preload" href="%s" as="font" type="font/woff2" crossorigin>' . "\n",
				esc_url( get_theme_file_uri( $font ) )
			);
		}
	},
	1
);

/**
 * Free-shipping threshold shown in the announcement bar and patterns.
 * Keep it in sync with WooCommerce › Settings › Shipping.
 */
function revive_shop_free_shipping_from() {
	return (int) apply_filters( 'revive_shop_free_shipping_from', 2000 );
}

/**
 * Clinic contact details, used by patterns and the footer.
 */
function revive_shop_clinic() {
	return apply_filters(
		'revive_shop_clinic',
		array(
			'address'   => 'Львів, вул. Зелена, 204А',
			'hours'     => 'Пн–Пт 10:00–20:00, Сб 10:00–18:00',
			'phone_1'   => '+38 (097) 088 99 00',
			'phone_2'   => '+38 (073) 088 99 00',
			'clinic'    => 'https://reviveclinic.com.ua/',
			'instagram' => 'https://www.instagram.com/revive.aestheticmedicinecentre/',
		)
	);
}

/**
 * Turn a display phone number into a tel: link.
 *
 * @param string $phone Human-readable phone.
 */
function revive_shop_tel( $phone ) {
	return 'tel:' . preg_replace( '/[^0-9+]/', '', $phone );
}

/**
 * Format a price in UAH the way the shop displays it: "2 000 ₴".
 *
 * @param int $amount Amount in hryvnias.
 */
function revive_shop_uah( $amount ) {
	return number_format_i18n( $amount ) . ' ₴';
}
