<div class="top-grid-products row">
	<?php
	$args		 = array(
		'post_type'		 => 'product',
		'posts_per_page' => 9,
		'order' => 'desc',
		'tax_query'		 => array(
			array(
				'taxonomy'	 => 'product_visibility',
				'field'		 => 'name',
				'terms'		 => 'featured',
				'operator'	 => 'IN'
			),
		),
	);
	$loop		 = new WP_Query( $args );
	$i			 = 1;
	while ( $loop->have_posts() ) : $loop->the_post();
		global $product;
		?>
		<div class="products-line">
			<div class="products-content">
				<div class="top-category-description">    
					<div class="top-cat-heading">
						<h2>
							<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
								<?php the_title(); ?>
							</a>
						</h2>
						<div class="price"><?php echo $product->get_price_html(); ?></div>
					</div>
				</div>
				<div class="products-home-image">
					<a href="<?php echo get_permalink( $loop->post->ID ) ?>" title="<?php the_title_attribute(); ?>">
						<div class="top-cat-img">  
							<?php
							if ( has_post_thumbnail( $loop->post->ID ) )
								echo get_the_post_thumbnail( $loop->post->ID, 'envo-store-cats' );
							else
								echo '<img src="' . woocommerce_placeholder_img_src() . '" alt="Placeholder" width="460px" height="460px" />';
							?>
						</div>                 
					</a>
				</div>
			</div>	
		</div>	
		<?php
		$i++;
	endwhile;
	wp_reset_postdata();
	?>
</div>     