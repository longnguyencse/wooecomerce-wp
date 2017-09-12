<article>
	<div <?php post_class(); ?>>                    
		<?php if ( has_post_thumbnail() ) : ?>                               
			<a class="featured-thumbnail" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"> 
				<img class="lazy" src="<?php echo get_template_directory_uri() . '/img/placeholder.png' ?>" data-src="<?php the_post_thumbnail_url( 'envo-store-single' ); ?>" alt="<?php the_title_attribute(); ?>" />
				<noscript>
					<?php the_post_thumbnail( 'envo-store-single' ); ?>
				</noscript>
			</a>								               
		<?php endif; ?>	
		<div class="main-content row"> 
			<header>
				<h2 class="page-header col-md-12 h1">                                
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark">
						<?php the_title(); ?>
					</a>                            
				</h2>
			</header>
			<div class="content-inner">
				<div class="post-meta col-md-4">
					<?php envo_store_time_link(); ?>
					<?php envo_store_posted_on(); ?>
					<?php envo_store_entry_footer(); ?>
				</div><!-- .post-meta -->
				<div class="entry-summary col-md-8">
					<?php the_excerpt(); ?> 
				</div><!-- .entry-summary -->
			</div>                                                             
		</div>                   
	</div>
</article>
