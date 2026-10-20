<?php
/**
 * Title: Головний банер магазину
 * Slug: revive-shop/hero
 * Categories: revive-shop, banner
 * Description: Перший екран: заголовок, опис, дві кнопки та фото.
 * Viewport Width: 1440
 *
 * @package revive-shop
 */

$revive_shop_url = function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/shop/' );
$revive_clinic   = revive_shop_clinic();
?>
<!-- wp:group {"align":"full","className":"revive-hero","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|70"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull revive-hero" style="padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:columns {"verticalAlignment":"center","align":"wide","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|70","top":"var:preset|spacing|60"}}}} -->
<div class="wp-block-columns alignwide are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center","width":"52%","style":{"spacing":{"blockGap":"var:preset|spacing|50"}}} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:52%"><!-- wp:paragraph {"style":{"typography":{"fontSize":"12px","letterSpacing":"0.22em","textTransform":"uppercase"}},"textColor":"sage"} -->
<p class="has-sage-color has-text-color" style="font-size:12px;letter-spacing:0.22em;text-transform:uppercase"><?php esc_html_e( 'Обрано лікарями Revive', 'revive-shop' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":1} -->
<h1 class="wp-block-heading"><?php esc_html_e( 'Домашній догляд, що продовжує процедуру', 'revive-shop' ); ?></h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"typography":{"lineHeight":"1.6"}},"fontSize":"large","textColor":"muted"} -->
<p class="has-muted-color has-text-color has-large-font-size" style="line-height:1.6"><?php esc_html_e( 'Професійна косметика з кабінету дерматолога. Ми продаємо лише те, що самі використовуємо та рекомендуємо пацієнтам клініки.', 'revive-shop' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"style":{"spacing":{"blockGap":"12px","margin":{"top":"var:preset|spacing|30"}}}} -->
<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--30)"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( $revive_shop_url ); ?>"><?php esc_html_e( 'Перейти до каталогу', 'revive-shop' ); ?></a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"is-style-outline"} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( $revive_clinic['clinic'] ); ?>"><?php esc_html_e( 'Підбір з лікарем', 'revive-shop' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"48%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:48%"><!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"revive-hero-image revive-parallax"} -->
<figure class="wp-block-image size-full revive-hero-image revive-parallax"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/img/hero-placeholder.svg' ) ); ?>" alt="<?php esc_attr_e( 'Косметика Revive на полиці клініки', 'revive-shop' ); ?>"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->
