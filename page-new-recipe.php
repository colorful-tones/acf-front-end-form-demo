<?php

acf_form_head();
get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<?php
			// Start the Loop.
			while ( have_posts() ) :
				the_post();
				?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				</header>

				<div class="entry-content">
					<?php
					the_content();
					// Display our ACF form.
					// @link https://www.advancedcustomfields.com/resources/acf_form/
					acf_form( 'new-recipe' );
					?>
				</div><!-- .entry-content -->

				<?php
			endwhile; // End the loop.
			?>

			</article><!-- #post-<?php the_ID(); ?> -->
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
