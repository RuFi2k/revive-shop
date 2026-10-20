<?php
/**
 * Title: Доставка та оплата
 * Slug: revive-shop/delivery-payment
 * Categories: revive-shop, featured
 * Description: Три картки: Нова пошта, самовивіз з клініки, способи оплати.
 * Viewport Width: 1440
 *
 * @package revive-shop
 */

$revive_clinic = revive_shop_clinic();
$revive_free   = revive_shop_uah( revive_shop_free_shipping_from() );

$revive_cards = array(
	array(
		'<path d="M3 7h11v9H3z"></path><path d="M14 10h4l3 3v3h-7"></path><circle cx="7" cy="17.5" r="1.6"></circle><circle cx="17" cy="17.5" r="1.6"></circle>',
		__( 'Нова пошта', 'revive-shop' ),
		/* translators: %s: free-shipping threshold, e.g. "2 000 ₴". */
		sprintf( __( 'Відділення та поштомати по всій Україні, 1–3 дні. Безкоштовно від %s.', 'revive-shop' ), $revive_free ),
	),
	array(
		'<path d="M12 21s-6.5-5.6-6.5-11a6.5 6.5 0 0 1 13 0c0 5.4-6.5 11-6.5 11z"></path><circle cx="12" cy="10" r="2.3"></circle>',
		__( 'Самовивіз з клініки', 'revive-shop' ),
		$revive_clinic['address'] . '. ' . $revive_clinic['hours'] . '.',
	),
	array(
		'<rect x="3" y="6" width="18" height="13" rx="2"></rect><path d="M3 10h18"></path>',
		__( 'Зручна оплата', 'revive-shop' ),
		__( 'Карткою онлайн, Apple Pay, Google Pay або при отриманні. Фіскальний чек на email.', 'revive-shop' ),
	),
);
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"bottom":"var:preset|spacing|80"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="padding-bottom:var(--wp--preset--spacing--80)"><!-- wp:group {"align":"wide","style":{"spacing":{"blockGap":"16px"}},"layout":{"type":"grid","minimumColumnWidth":"260px"}} -->
<div class="wp-block-group alignwide"><?php foreach ( $revive_cards as $revive_card ) : ?><!-- wp:group {"className":"revive-outline-card","style":{"border":{"radius":"20px"},"spacing":{"padding":{"top":"28px","bottom":"28px","left":"28px","right":"28px"},"blockGap":"12px"}},"layout":{"type":"flex","orientation":"vertical"}} -->
<div class="wp-block-group revive-outline-card" style="border-radius:20px;padding-top:28px;padding-right:28px;padding-bottom:28px;padding-left:28px"><!-- wp:html -->
<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#9CBB94" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><?php echo $revive_card[0]; // phpcs:ignore WordPress.Security.EscapeOutput -- static SVG markup defined above. ?></svg>
<!-- /wp:html -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading"><?php echo esc_html( $revive_card[1] ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"muted"} -->
<p class="has-muted-color has-text-color"><?php echo esc_html( $revive_card[2] ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --><?php endforeach; ?></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
