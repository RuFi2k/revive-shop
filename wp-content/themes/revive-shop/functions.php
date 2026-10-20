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
 * Scroll-reveal: marks sections and product cards, fades them in as they enter the viewport.
 * Inline and tiny on purpose: runs before first paint, no extra request.
 * Skipped entirely for visitors who prefer reduced motion.
 */
add_action(
	'wp_head',
	static function () {
		?>
<script id="revive-motion">
(function () {
	if (!('IntersectionObserver' in window) || window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;
	var root = document.documentElement;
	root.classList.add('revive-motion');
	/* Header intro only when the visitor arrives from outside the shop. */
	try { if (!document.referrer || new URL(document.referrer).host !== location.host) root.classList.add('revive-intro'); } catch (e) {}
	var SELECTOR = 'main > .wp-block-group, main .wp-block-columns, .revive-cat-card, .revive-outline-card, .wc-block-product, footer .wp-block-group.alignwide';
	function init() {
		var io = new IntersectionObserver(function (entries) {
			entries.forEach(function (e) {
				if (e.isIntersecting) { e.target.classList.add('is-visible'); io.unobserve(e.target); }
			});
		}, { rootMargin: '0px 0px -8% 0px', threshold: 0.08 });

		/* Section headings: slow 20px rise, observed on their own. */
		document.querySelectorAll('main h2.wp-block-heading').forEach(function (h) {
			if (h.closest('.revive-hero')) return;
			h.classList.add('revive-title');
			io.observe(h);
		});

		var groups = new Map();
		document.querySelectorAll(SELECTOR).forEach(function (el) {
			if (el.closest('.revive-hero')) return; /* hero has its own load animation */
			if (el.closest('.revive-reveal')) return; /* only the outermost element animates */
			el.classList.add('revive-reveal');
			/* stagger siblings in grids: 60ms apart, max 6 steps */
			var parent = el.parentElement, i = groups.get(parent) || 0;
			groups.set(parent, i + 1);
			el.style.setProperty('--revive-delay', Math.min(i, 6) * 0.06 + 's');
			io.observe(el);
		});

		/* Scroll parallax (like simpleParallax, scale 1.1): image drifts up to ±5% of its height. */
		var layers = [].slice.call(document.querySelectorAll('.revive-parallax img'));
		var header = document.querySelector('.revive-header');
		var lastY = window.scrollY, ticking = false;
		function frame() {
			ticking = false;
			var vh = window.innerHeight, y = window.scrollY;
			layers.forEach(function (img) {
				var r = img.parentElement.getBoundingClientRect();
				if (r.bottom < 0 || r.top > vh) return;
				var progress = (r.top + r.height / 2 - vh / 2) / (vh / 2 + r.height / 2); /* -1 … 1 */
				img.style.translate = '0 ' + (progress * r.height * 0.05).toFixed(1) + 'px';
			});
			/* Header: hide when scrolling down past 120px, show on any scroll up. */
			if (header && !document.body.classList.contains('has-modal-open')) {
				header.classList.toggle('is-hidden', y > 120 && y > lastY);
			}
			lastY = y;
		}
		window.addEventListener('scroll', function () { if (!ticking) { ticking = true; requestAnimationFrame(frame); } }, { passive: true });
		frame();
	}
	if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', init); else init();
	/* Safety net: never leave content hidden. */
	setTimeout(function () { document.querySelectorAll('.revive-reveal, .revive-title').forEach(function (el) { el.classList.add('is-visible'); }); }, 4000);
})();
</script>
		<?php
	},
	2
);

/**
 * Near-instant page navigation (WordPress 6.8+ Speculative Loading).
 * The browser prerenders a page when the visitor hovers or touches a link, so the
 * click shows it immediately. Combined with the CSS view transitions in style.css,
 * navigation feels like an app without breaking WooCommerce scripts.
 */
add_filter(
	'wp_speculation_rules_configuration',
	static function ( $config ) {
		if ( is_user_logged_in() ) {
			return $config; // keep admin sessions on WordPress defaults
		}
		return array(
			'mode'      => 'prerender',
			'eagerness' => 'moderate',
		);
	}
);

/**
 * Never prerender pages that change state or must be fresh.
 * A prerendered "?add-to-cart=" link would silently add a product to the cart.
 */
add_filter(
	'wp_speculation_rules_href_exclude_paths',
	static function ( $paths ) {
		return array_merge(
			$paths,
			array(
				'/cart/*',
				'/checkout/*',
				'/my-account/*',
				'/*\\?*add-to-cart=*',
				'/*\\?*remove_item=*',
				'/*\\?*wc-ajax=*',
			)
		);
	}
);

/**
 * Stop WooCommerce from auto-inserting the account icon into the header.
 * WooCommerce uses the Block Hooks API to add `woocommerce/customer-account` next to the
 * mini-cart when a theme's header doesn't have one. Accounts are optional for now
 * (guest checkout), so the icon stays out until "Мій кабінет" has real content.
 */
add_filter(
	'hooked_block_types',
	static function ( $hooked_blocks ) {
		return array_values( array_diff( $hooked_blocks, array( 'woocommerce/customer-account' ) ) );
	},
	99
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
