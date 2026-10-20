<?php
/**
 * Title: Запис на консультацію
 * Slug: revive-shop/consultation-cta
 * Categories: revive-shop, call-to-action
 * Description: Зелений банер із запрошенням на консультацію дерматолога.
 * Viewport Width: 1440
 *
 * @package revive-shop
 */

$revive_clinic = revive_shop_clinic();
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"bottom":"var:preset|spacing|70"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:group {"align":"wide","style":{"border":{"radius":"28px"},"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60","left":"var:preset|spacing|60","right":"var:preset|spacing|60"},"blockGap":"var:preset|spacing|50"}},"backgroundColor":"accent","textColor":"white","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between","verticalAlignment":"center"}} -->
<div class="wp-block-group alignwide has-white-color has-accent-background-color has-text-color has-background" style="border-radius:28px;padding-top:var(--wp--preset--spacing--60);padding-right:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60);padding-left:var(--wp--preset--spacing--60)"><!-- wp:group {"style":{"spacing":{"blockGap":"14px"},"layout":{"selfStretch":"fixed","flexSize":"620px"}},"layout":{"type":"flex","orientation":"vertical"}} -->
<div class="wp-block-group"><!-- wp:heading {"textColor":"white"} -->
<h2 class="wp-block-heading has-white-color has-text-color"><?php esc_html_e( 'Не знаєте, що обрати?', 'revive-shop' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"typography":{"lineHeight":"1.6"},"color":{"text":"#eef2ec"}}} -->
<p class="has-text-color" style="color:#eef2ec;line-height:1.6"><?php esc_html_e( 'Дерматолог Revive оцінить стан шкіри та складе домашній протокол догляду, який підсилить результат процедур.', 'revive-shop' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"className":"is-style-light"} -->
<div class="wp-block-button is-style-light"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( $revive_clinic['clinic'] ); ?>"><?php esc_html_e( 'Записатись на консультацію', 'revive-shop' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
