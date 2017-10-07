<!DOCTYPE html>
<html>
<head> 
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php wp_title('|','true','right'); ?><?php bloginfo('name'); ?></title>
<meta name="viewport" content="width=device-width" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php do_action( 'playjo_before_header' ); ?>

<header>
	<div class="header-left">

<?php  $custom_logo_id = get_theme_mod( 'custom_logo' );
$logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
if ( has_custom_logo() ) {
        echo '<img src="'. esc_url( $logo[0] ) .'">';
} else {
        echo '<h1>'. get_bloginfo( 'name' ) .'</h1>';
}?>

		</div><!--.site-title-->
	</div><!--.header-left-->

	<div class="header-right">
		
		<?php do_action( 'playjo_in_header' ); ?>
		
		<?php if ( is_active_sidebar( 'header-widget-area' ) ) : ?>
			<?php dynamic_sidebar( 'header-widget-area' ); ?>
		<?php endif; ?>
	</div><!--header-right-->
</header>

<?php do_action( 'playjo_after_header' ); ?>


<nav class="main">
	<?php wp_nav_menu( array(
		'theme_location' => 'header-menu',
		'container_class' => 'menu'
	) ); ?>
</nav>