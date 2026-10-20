<?php
/**
 * Title: Підвал магазину
 * Slug: revive-shop/footer
 * Categories: revive-shop, footer
 * Block Types: core/template-part/footer
 * Inserter: no
 *
 * @package revive-shop
 */

$revive_clinic = revive_shop_clinic();
?>
<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|60"}},"border":{"top":{"color":"#eae9e61f","width":"1px"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="border-top-color:#eae9e61f;border-top-width:1px;padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--60)"><!-- wp:group {"align":"wide","style":{"spacing":{"blockGap":"var:preset|spacing|60"}},"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between","verticalAlignment":"top"}} -->
<div class="wp-block-group alignwide"><!-- wp:group {"style":{"spacing":{"blockGap":"8px"}},"layout":{"type":"flex","orientation":"vertical"}} -->
<div class="wp-block-group"><!-- wp:site-title {"level":0,"className":"revive-wordmark"} /-->

<!-- wp:paragraph {"fontSize":"small","textColor":"muted"} -->
<p class="has-muted-color has-text-color has-small-font-size"><?php esc_html_e( 'Магазин центру естетичної медицини', 'revive-shop' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"8px"}},"fontSize":"small","layout":{"type":"flex","orientation":"vertical"}} -->
<div class="wp-block-group has-small-font-size"><!-- wp:paragraph {"style":{"typography":{"fontSize":"11px","letterSpacing":"0.16em","textTransform":"uppercase"}},"textColor":"muted"} -->
<p class="has-muted-color has-text-color" style="font-size:11px;letter-spacing:0.16em;text-transform:uppercase"><?php esc_html_e( 'Покупцям', 'revive-shop' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><a href="<?php echo esc_url( home_url( '/dostavka-ta-oplata/' ) ); ?>"><?php esc_html_e( 'Доставка та оплата', 'revive-shop' ); ?></a></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><a href="<?php echo esc_url( home_url( '/povernennia/' ) ); ?>"><?php esc_html_e( 'Повернення', 'revive-shop' ); ?></a></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><a href="<?php echo esc_url( home_url( '/publichna-oferta/' ) ); ?>"><?php esc_html_e( 'Публічна оферта', 'revive-shop' ); ?></a></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><a href="<?php echo esc_url( get_privacy_policy_url() ? get_privacy_policy_url() : home_url( '/privacy-policy/' ) ); ?>"><?php esc_html_e( 'Політика конфіденційності', 'revive-shop' ); ?></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"8px"}},"fontSize":"small","layout":{"type":"flex","orientation":"vertical"}} -->
<div class="wp-block-group has-small-font-size"><!-- wp:paragraph {"style":{"typography":{"fontSize":"11px","letterSpacing":"0.16em","textTransform":"uppercase"}},"textColor":"muted"} -->
<p class="has-muted-color has-text-color" style="font-size:11px;letter-spacing:0.16em;text-transform:uppercase"><?php esc_html_e( 'Контакти', 'revive-shop' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><a href="<?php echo esc_url( revive_shop_tel( $revive_clinic['phone_1'] ) ); ?>"><?php echo esc_html( $revive_clinic['phone_1'] ); ?></a></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><a href="<?php echo esc_url( revive_shop_tel( $revive_clinic['phone_2'] ) ); ?>"><?php echo esc_html( $revive_clinic['phone_2'] ); ?></a></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><?php echo esc_html( $revive_clinic['address'] ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><a href="<?php echo esc_url( $revive_clinic['instagram'] ); ?>">Instagram</a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"align":"wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|60"}}},"fontSize":"x-small","textColor":"muted"} -->
<p class="alignwide has-muted-color has-text-color has-x-small-font-size" style="margin-top:var(--wp--preset--spacing--60)">© <?php echo esc_html( gmdate( 'Y' ) ); ?> Revive Clinic</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->
