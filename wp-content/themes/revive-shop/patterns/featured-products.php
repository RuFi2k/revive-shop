<?php
/**
 * Title: Рекомендують наші лікарі
 * Slug: revive-shop/featured-products
 * Categories: revive-shop, woo-commerce
 * Description: Сітка рекомендованих товарів (позначені зірочкою «Рекомендований» у WooCommerce).
 * Viewport Width: 1440
 *
 * @package revive-shop
 */

$revive_shop_url = function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/shop/' );
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|80"},"blockGap":"var:preset|spacing|60"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--80)"><!-- wp:group {"align":"wide","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between","verticalAlignment":"bottom"}} -->
<div class="wp-block-group alignwide"><!-- wp:heading -->
<h2 class="wp-block-heading"><?php esc_html_e( 'Рекомендують наші лікарі', 'revive-shop' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"13px","letterSpacing":"0.1em","textTransform":"uppercase"},"elements":{"link":{"color":{"text":"var:preset|color|sage"}}}}} -->
<p class="has-link-color" style="font-size:13px;letter-spacing:0.1em;text-transform:uppercase"><a href="<?php echo esc_url( $revive_shop_url ); ?>"><?php esc_html_e( 'Весь каталог', 'revive-shop' ); ?></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:woocommerce/product-collection {"queryId":11,"query":{"perPage":8,"pages":1,"offset":0,"postType":"product","order":"desc","orderBy":"date","search":"","exclude":[],"inherit":false,"taxQuery":[],"isProductCollectionBlock":true,"featured":true,"woocommerceOnSale":false,"woocommerceStockStatus":["instock","onbackorder"],"woocommerceAttributes":[],"woocommerceHandPickedProducts":[]},"tagName":"div","displayLayout":{"type":"flex","columns":4,"shrinkColumns":true},"dimensions":{"widthType":"fill"},"collection":"woocommerce/product-collection/featured","hideControls":["inherit"],"queryContextIncludes":["collection"],"align":"wide","className":"revive-products"} -->
<div class="wp-block-woocommerce-product-collection alignwide revive-products"><!-- wp:woocommerce/product-template -->
<!-- wp:woocommerce/product-image {"showSaleBadge":true,"imageSizing":"thumbnail","isDescendentOfQueryLoop":true} /-->

<!-- wp:post-terms {"term":"product_brand","style":{"typography":{"fontSize":"11px","letterSpacing":"0.16em","textTransform":"uppercase"},"spacing":{"margin":{"top":"14px","bottom":"4px"}}}} /-->

<!-- wp:post-title {"level":3,"isLink":true,"style":{"typography":{"fontSize":"15px"},"spacing":{"margin":{"top":"0","bottom":"8px"}}},"__woocommerceNamespace":"woocommerce/product-collection/product-title"} /-->

<!-- wp:woocommerce/product-price {"isDescendentOfQueryLoop":true,"style":{"spacing":{"margin":{"bottom":"12px"}}}} /-->

<!-- wp:woocommerce/product-button {"isDescendentOfQueryLoop":true} /-->
<!-- /wp:woocommerce/product-template -->

<!-- wp:woocommerce/product-collection-no-results -->
<!-- wp:paragraph {"textColor":"muted"} -->
<p class="has-muted-color has-text-color"><?php esc_html_e( 'Тут з’являться товари, позначені як рекомендовані. Позначте їх зірочкою у списку товарів WooCommerce.', 'revive-shop' ); ?></p>
<!-- /wp:paragraph -->
<!-- /wp:woocommerce/product-collection-no-results --></div>
<!-- /wp:woocommerce/product-collection --></div>
<!-- /wp:group -->
