<?php
add_action( 'after_setup_theme', 'envo_store_setup' );

if ( !function_exists( 'envo_store_setup' ) ) :

	/**
	 * Global functions
	 */
	function envo_store_setup() {

		// Theme lang.
		load_theme_textdomain( 'envo-store', get_template_directory() . '/languages' );

		// Add Title Tag Support.
		add_theme_support( 'title-tag' );

		// Register Menus.
		register_nav_menus(
		array(
			'main_menu' => __( 'Main Menu', 'envo-store' ),
		)
		);

		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 300, 300, true );
		add_image_size( 'envo-store-single', 1380, 460, true );
		add_image_size( 'envo-store-cats', 460, 460, true );
		
		// Add Custom Background Support.
		$args = array(
			'default-color' => 'ffffff',
		);
		add_theme_support( 'custom-background', $args );

		add_theme_support( 'custom-logo', array(
			'height'		 => 70,
			'width'			 => 200,
			'flex-height'	 => true,
			'flex-width'	 => true,
			'header-text'	 => array( 'site-title', 'site-description' ),
		) );

		// Adds RSS feed links to for posts and comments.
		add_theme_support( 'automatic-feed-links' );
		
		// Set up the WordPress core custom header feature.
		add_theme_support( 'custom-header', apply_filters( 'envo_store_custom_header_args', array(
			'default-image'		 => '',
			'default-text-color' => '404040',
			'width'				 => 2000,
			'height'			 => 200,
			'flex-height'		 => true,
			'flex-width'		 => true,
			'wp-head-callback'	 => 'envo_store_header_style',
		) ) );
		
		// WooCommerce support.
		add_theme_support( 'woocommerce' );
		
		// Recommend plugins.
        add_theme_support( 'recommend-plugins', array(
			'kingcomposer' => array(
                'name' => esc_html__( 'WooCommerce', 'envo-store' ),
                'active_filename' => 'woocommerce/woocommerce.php',
            ),
        ) );
	}

endif;

if ( !function_exists( 'envo_store_header_style' ) ) :

	/**
	 * Styles the header image and text displayed on the blog.
	 *
	 */
	function envo_store_header_style() {
		$header_text_color	 = get_header_textcolor();
		$header_image		 = get_header_image();

		if ( $header_image ) :
			?>
			<style type="text/css">
				.site-header {
					position: relative;
					background-color: transparent;
				}
				.site-header:before {
					background-image: url( <?php echo esc_url( $header_image ); ?>);
					background-position: center;
					background-repeat: no-repeat;
					background-size: cover;
					content: "";
					display: block;
					height: 100%;
					left: 0;
					position: absolute;
					top: 0;
					width: 100%;
					z-index: -1;
				}
			</style>
			<?php
		endif;

		// If no custom options for text are set, let's bail.
		// get_header_textcolor() options: add_theme_support( 'custom-header' ) is default, hide text (returns 'blank') or any hex value.
		if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
			return;
		}

		// If we get this far, we have custom styles. Let's do this.
		?>
		<style type="text/css">
		<?php
		// Has the text been hidden?
		if ( 'blank' === $header_text_color ) :
			?>
				.site-title,
				.site-description {
					position: absolute;
					clip: rect(1px, 1px, 1px, 1px);
				}
			<?php
		// If the user has set a custom color for the text use that.
		else :
			?>
				.site-title a,
				.site-description {
					color: #<?php echo esc_attr( $header_text_color ); ?>;
				}
		<?php endif; ?>
		</style>
		<?php
	}

endif;

/**
 * Set Content Width
 */
function envo_store_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'envo_store_content_width', 1380 );
}

add_action( 'after_setup_theme', 'envo_store_content_width', 0 );

/**
 * Enqueue Styles (normal style.css and bootstrap.css)
 */
function envo_store_theme_stylesheets() {
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.css', array(), '3.3.7' );
	wp_enqueue_style( 'envo-store-stylesheet', get_stylesheet_uri() );
}

add_action( 'wp_enqueue_scripts', 'envo_store_theme_stylesheets' );

/**
 * Register Bootstrap JS with jquery
 */
function envo_store_theme_js() {
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ), '3.3.7', true );
	$deps[] = 'jquery';

    if ( is_page_template( 'homepage.php' ) && class_exists( 'WooCommerce' ) ) {
        $deps[] = 'masonry';
    }
	wp_enqueue_script( 'envo-store-theme-js', get_template_directory_uri() . '/js/customscript.js', $deps, '1.0.1', true );
}

add_action( 'wp_enqueue_scripts', 'envo_store_theme_js' );


/**
 * Register Custom Navigation Walker include custom menu widget to use walkerclass
 */
require_once( trailingslashit( get_template_directory() ) . 'lib/wp_bootstrap_navwalker.php' );


add_action( 'widgets_init', 'envo_store_widgets_init' );

/**
 * Register the Sidebar(s)
 */
function envo_store_widgets_init() {
	register_sidebar(
	array(
		'name'			 => esc_html__( 'Right Sidebar', 'envo-store' ),
		'id'			 => 'envo-store-right-sidebar',
		'before_widget'	 => '<div id="%1$s" class="widget %2$s">',
		'after_widget'	 => '</div>',
		'before_title'	 => '<h3 class="widget-title">',
		'after_title'	 => '</h3>',
	)
	);
}

function envo_store_main_content_width_columns() {

	$columns = '12';

	if ( is_active_sidebar( 'envo-store-right-sidebar' ) ) {
		$columns = $columns - 3;
	}

	echo absint( $columns );
}

if ( !function_exists( 'envo_store_posted_on' ) ) :

	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function envo_store_posted_on() {

		// Get the author name; wrap it in a link.
		$byline = sprintf(
		/* translators: %s: post author */
		__( 'by %s', 'envo-store' ), '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . get_the_author() . '</a></span>'
		);

		// Finally, let's write all of this to the page.
		echo '<span class="posted-on">' . envo_store_time_link() . '</span><span class="byline"> ' . $byline . '</span>';
	}

endif;


if ( !function_exists( 'envo_store_time_link' ) ) :

	/**
	 * Gets a nicely formatted string for the published date.
	 */
	function envo_store_time_link() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string, get_the_date( DATE_W3C ), get_the_date(), get_the_modified_date( DATE_W3C ), get_the_modified_date()
		);

		// Wrap the time string in a link, and preface it with 'Posted on'.
		return sprintf(
		/* translators: %s: post date */
		__( 'Posted on %s', 'envo-store' ), '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);
	}

endif;

if ( !function_exists( 'envo_store_entry_footer' ) ) :

	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function envo_store_entry_footer() {

		/* translators: used between list items, there is a space after the comma */
		$separate_meta = __( ', ', 'envo-store' );

		// Get Categories for posts.
		$categories_list = get_the_category_list( $separate_meta );

		// Get Tags for posts.
		$tags_list = get_the_tag_list( '', $separate_meta );

		// We don't want to output .entry-footer if it will be empty, so make sure its not.
		if ( $categories_list || $tags_list ) {

			echo '<div class="entry-footer">';

			if ( 'post' === get_post_type() ) {
				if ( $categories_list || $tags_list ) {

					// Make sure there's more than one category before displaying.
					if ( $categories_list ) {
						echo '<div class="cat-links"><span class="space-right">' . __( 'Category:', 'envo-store' ) . '</span>' . $categories_list . '</div>';
					}

					if ( $tags_list ) {
						echo '<div class="tags-links"><span class="space-right">' . __( 'Tagged', 'envo-store' ) . '</span>' . $tags_list . '</div>';
					}
				}
			}
			if ( comments_open() ) :
				echo '<div class="comments-template">';
				comments_popup_link( esc_html__( 'Leave a Comment', 'envo-store' ), esc_html__( 'One Comment', 'envo-store' ), esc_html__( '% Comments', 'envo-store' ), 'comments-link', esc_html__( 'Comments are off for this post', 'envo-store' ) );
				echo '</div>';
			endif;

			edit_post_link();

			echo '</div>';
		}
	}

endif;

if ( class_exists( 'WooCommerce' ) ) {
	if ( !function_exists( 'envo_store_cart_link' ) ) {

		function envo_store_cart_link() {
			?>	
			<a class="cart-contents" href="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" title="<?php esc_html_e( 'View your shopping cart', 'envo-store' ); ?>">
				<i class="cart-icon"><span class="count"><?php echo wp_kses_data( WC()->cart->get_cart_contents_count() ); ?></span></i>
			</a>
			<?php
		}

	}
	if ( !function_exists( 'envo_store_header_cart' ) ) {

		function envo_store_header_cart() {
			?>
			<div class="header-cart">
				<div class="header-cart-block">
					<div class="header-cart-inner">
						<?php envo_store_cart_link(); ?>
						<ul class="site-header-cart menu list-unstyled text-center">
							<li>
								<?php the_widget( 'WC_Widget_Cart', 'title=' ); ?>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<?php
		}

	}
	if ( ! function_exists( 'envo_store_header_add_to_cart_fragment' ) ) {
		add_filter( 'woocommerce_add_to_cart_fragments', 'envo_store_header_add_to_cart_fragment' );

		function envo_store_header_add_to_cart_fragment( $fragments ) {
			ob_start();

			envo_store_cart_link();

			$fragments[ 'a.cart-contents' ] = ob_get_clean();

			return $fragments;
		}
	}
}

/**
 * Add theme info page
 */
require_once( trailingslashit( get_template_directory() ) . 'lib/dashboard.php' );

/**
 * Add pro link
 */
require_once( trailingslashit( get_template_directory() ) . 'lib/customize-pro/class-customize.php' );