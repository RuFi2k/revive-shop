<?php
/**
 * Title: Категорії товарів
 * Slug: revive-shop/categories
 * Categories: revive-shop
 * Description: Сітка карток категорій із посиланнями на каталог.
 * Viewport Width: 1440
 *
 * @package revive-shop
 */

$revive_categories = array(
	array( 'ochyshchennia', __( 'Очищення', 'revive-shop' ), __( 'Гелі, пінки, тонери', 'revive-shop' ) ),
	array( 'syrovatky', __( 'Сироватки', 'revive-shop' ), __( 'Активні концентрати', 'revive-shop' ) ),
	array( 'kremy', __( 'Креми', 'revive-shop' ), __( 'Зволоження та відновлення', 'revive-shop' ) ),
	array( 'spf', __( 'SPF', 'revive-shop' ), __( 'Щоденний сонцезахист', 'revive-shop' ) ),
	array( 'volossia', __( 'Волосся', 'revive-shop' ), __( 'Програми трихолога', 'revive-shop' ) ),
);

/**
 * Category URL: the real term link when WooCommerce and the term exist, else the pretty-permalink guess.
 *
 * @param string $slug Category slug.
 */
$revive_cat_url = static function ( $slug ) {
	if ( taxonomy_exists( 'product_cat' ) ) {
		$link = get_term_link( $slug, 'product_cat' );
		if ( ! is_wp_error( $link ) ) {
			return $link;
		}
	}
	return home_url( '/product-category/' . $slug . '/' );
};
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|70"},"blockGap":"var:preset|spacing|50"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:heading {"align":"wide"} -->
<h2 class="wp-block-heading alignwide"><?php esc_html_e( 'Категорії', 'revive-shop' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:group {"align":"wide","style":{"spacing":{"blockGap":"16px"}},"layout":{"type":"grid","minimumColumnWidth":"200px"}} -->
<div class="wp-block-group alignwide"><?php foreach ( $revive_categories as $revive_cat ) : ?><!-- wp:group {"className":"revive-card revive-cat-card","style":{"border":{"radius":"20px"},"spacing":{"padding":{"top":"22px","bottom":"22px","left":"22px","right":"22px"},"blockGap":"36px"},"dimensions":{"minHeight":"150px"}},"backgroundColor":"surface","layout":{"type":"flex","orientation":"vertical","justifyContent":"stretch","verticalAlignment":"space-between"}} -->
<div class="wp-block-group revive-card revive-cat-card has-surface-background-color has-background" style="border-radius:20px;min-height:150px;padding-top:22px;padding-right:22px;padding-bottom:22px;padding-left:22px"><!-- wp:heading {"level":3,"style":{"typography":{"fontSize":"20px","letterSpacing":"0.06em"}}} -->
<h3 class="wp-block-heading" style="font-size:20px;letter-spacing:0.06em"><a href="<?php echo esc_url( $revive_cat_url( $revive_cat[0] ) ); ?>"><?php echo esc_html( $revive_cat[1] ); ?></a></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"fontSize":"small","textColor":"muted"} -->
<p class="has-muted-color has-text-color has-small-font-size"><?php echo esc_html( $revive_cat[2] ); ?> →</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --><?php endforeach; ?></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
