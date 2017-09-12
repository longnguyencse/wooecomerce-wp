<div class="container-fluid top-navigation" role="main">
	<div class="site-header text-center" >
		<?php the_custom_logo(); ?>

		<div class="site-branding-text">
			<?php if ( is_front_page() ) : ?>
				<h1 class="site-title h1"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php else : ?>
				<p class="site-title h1"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
			<?php endif; ?>

			<?php
			$description = get_bloginfo( 'description', 'display' );
			if ( $description || is_customize_preview() ) :
				?>
				<p class="site-description lead">
					<?php echo $description; ?>
				</p>
			<?php endif; ?>
		</div><!-- .site-branding-text -->
	</div>
	<div class="main-menu" >
		<nav id="site-navigation" class="navbar">     
			<div class="container">
				<?php if ( has_nav_menu( 'main_menu' ) ) : ?>
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-1-collapse">
							<span class="sr-only"><?php esc_html_e( 'Toggle navigation', 'envo-store' ); ?></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<div class="visible-xs navbar-brand"><?php esc_html_e( 'Menu', 'envo-store' ); ?></div>
					</div>
				<?php endif; ?>
				<?php
				wp_nav_menu( array(
					'theme_location'	 => 'main_menu',
					'depth'				 => 5,
					'container'			 => 'div',
					'container_class'	 => 'collapse navbar-collapse navbar-1-collapse',
					'menu_class'		 => 'nav navbar-nav',
					'fallback_cb'		 => 'wp_bootstrap_navwalker::fallback',
					'walker'			 => new wp_bootstrap_navwalker(),
				) );
				?>
				<?php
				if ( function_exists( 'envo_store_header_cart' ) ) {
					envo_store_header_cart();
				}
				?>
			</div>    
		</nav> 
	</div>
</div>
<div class="container main-container" role="main">
<?php 
if ( is_page_template( 'homepage.php' ) && class_exists( 'WooCommerce' ) ) {
	get_template_part( 'template-parts/template-part', 'homepage' );
}
?>	
