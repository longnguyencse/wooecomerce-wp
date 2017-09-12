<?php get_header(); ?> 

<!-- start content container -->
<div class="row">

	<div class="col-md-<?php envo_store_main_content_width_columns(); ?>">
		<?php
		if ( have_posts() ) :
			?>
			<header class="archive-page-header text-center">
				<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<p class="taxonomy-description">', '</p>' );
				?>
			</header><!-- .page-header -->
			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'content', get_post_format() );

			endwhile;

			the_posts_pagination();

		else :

			get_template_part( 'content', 'none' );

		endif;
		?>

	</div>

	<?php get_sidebar( 'right' ); ?>

</div>
<!-- end content container -->

<?php get_footer(); ?>
