<?php
/**
 *
 * Template name: Homepage
 * The template for displaying homepage.
 *
 * @package envo-store
 */
get_header();
?>

<!-- start content container -->
<div class="row">   
	<article class="col-md-<?php envo_store_main_content_width_columns(); ?>">        
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>                          
				<div <?php post_class(); ?>>
					<div class="main-content-page">
                        
						<div class="entry-content">                              
							<?php the_content(); ?>                            
						</div>
					</div>
				</div>        
			<?php endwhile; ?>        
		<?php else : ?>            
			<?php get_template_part( 'content', 'none' ); ?>        
		<?php endif; ?>    
	</article>       
	<?php get_sidebar( 'right' ); ?>
</div>
<!-- end content container -->

<?php get_footer(); ?>