<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 */

$author_fn   = get_field( 'about_you_first_name' );
$author_ln   = get_field( 'about_you_last_name' );
$recipe      = get_field( 'recipe_details' );
$image       = $recipe['photo_of_final_dish'] ?? null;
$steps       = $recipe['steps'] ?? null;
$ingredients = $recipe['ingredients'] ?? null;
$prep_time   = $recipe['preparation_time'] ?? null;
$cook_time   = $recipe['cook_time'] ?? null;
$total_time  = $recipe['total_time'] ?? null;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( ! twentynineteen_can_show_post_thumbnail() ) : ?>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<div class="entry-meta">
			<span class="recipe-author">Submitted by: <?php echo esc_html( $author_fn ) . ' ' . esc_html( $author_ln ); ?></span>
	</header>
	<?php endif; ?>

	<div class="entry-content">
		<div class="recipe-details">
			<?php the_content(); ?>

			<ul class="recipe-times unlist">
				<li><strong>Prep time: </strong><?php echo esc_html( $prep_time ); ?></li>
				<li><strong>Cook time: </strong><?php echo esc_html( $cook_time ); ?></li>
				<li><strong>Total time: </strong><?php echo esc_html( $total_time ); ?></li>
			</ul>
			
			<h2 class="recipe-heading">Ingredients</h2>
			<p>
				<?php
				if ( $ingredients ) {
					echo wp_kses_post( $ingredients );
				}
				?>
			</p>

			<h2 class="recipe-heading">Steps</h2>
			<p>
				<?php
				if ( $steps ) {
					echo wp_kses_post( $steps );
				}
				?>
			</p>
		</div>
		
		<figure class="post-thumbnail recipe-photo">
			<?php
			if ( $image ) {
				echo wp_get_attachment_image( $image, 'large' );
			}
			?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php twentynineteen_entry_footer(); ?>
	</footer><!-- .entry-footer -->

</article><!-- #post-<?php the_ID(); ?> -->
