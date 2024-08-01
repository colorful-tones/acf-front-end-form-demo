<?php
/**
 * Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 */

/**
 * ACF post type and field group.
 */
require get_stylesheet_directory() . '/acf/recipe-field-group.php';
require get_stylesheet_directory() . '/acf/recipe-post-type.php';

/**
 * Enqueue parent theme's stylesheet.
 *
 * @link https://developer.wordpress.org/reference/functions/wp_enqueue_style/
 *
 * @return void
 */
function ttnineteen_child_enqueue_styles() {
	wp_enqueue_style(
		'ttnineteen_child-parent-style',
		/**
		 * Get the parent theme's stylesheet URI.
		 * @link https://developer.wordpress.org/reference/functions/get_parent_theme_file_uri/
		 */
		get_parent_theme_file_uri( 'style.css' ),
		array(),
		wp_get_theme()->get( 'Version' ),
	);
}
add_action( 'wp_enqueue_scripts', 'ttnineteen_child_enqueue_styles' );

/**
 * Registers a custom ACF form.
 *
 * This function checks if the `acf_register_form` function exists and then registers a form with the specified parameters.
 *
 * @link https://www.advancedcustomfields.com/resources/acf_register_form/
 *
 * @return void
 */
function ttnineteen_acf_register_form() {
	// Check function exists.
	if ( function_exists( 'acf_register_form' ) ) {
		// Register form.
		acf_register_form(
			array(
				'field_groups'          => array( 'group_66a95c48d8f47' ),
				'id'                    => 'new-recipe',
				'instruction_placement' => 'field',
				'new_post'              => array(
					'post_type'   => 'recipe',
					'post_status' => 'draft',
				),
				'post_id'               => 'new_post',
				'return'                => esc_url( home_url( 'thank-you' ) ), // Redirect to 'Thank you' page.
				'submit_value'          => __( 'Submit', 'theme-slug' ),
			)
		);
	}
}
add_action( 'acf/init', 'ttnineteen_acf_register_form' );

/**
 * Saves the recipe details and updates the post title with the recipe name.
 *
 * @link https://www.advancedcustomfields.com/resources/acf-save_post/
 *
 * @param int $post_id The ID of the post being saved.
 * @return void
 */
function ttnineteen_save_recipe( $post_id ) {
	// Bail early.
	if ( is_admin() || 'recipe' !== get_post_type( $post_id ) ) {
		return;
	}

	// Get the recipe details.
	$recipe_details = get_field( 'recipe_details', $post_id );

	// Prepare the new recipe data.
	// We want to update the post title with the recipe name.
	$updated_recipe = array(
		'ID'         => $post_id,
		'post_title' => $recipe_details['name'],
	);

	// Update the post into the database.
	wp_update_post( $updated_recipe );
}
// Note: priority 20 is used to ensure this function runs after ACF has saved the custom fields.
add_action( 'acf/save_post', 'ttnineteen_save_recipe', 20 );

/**
 * Sends an email notification when a recipe is saved as a draft.
 *
 * @link https://developer.wordpress.org/reference/hooks/new_status_post-post_type/
 *
 * @param int $post_id The ID of the post being saved.
 * @return void
 */
function ttnineteen_recipe_draft_email( $post_id ) {
	// Avoid duplicate emails.
	// Make sure the wp_update_post() above doesn't trigger this function.
	if ( ! get_the_title( $post_id ) ) {
		return;
	}

	// Get variables.
	$to         = get_option( 'admin_email' );
	$post_title = get_the_title( $post_id );
	$post_url   = get_permalink( $post_id );
	// Begin concatenating the email variables.
	$subject  = 'New Recipe Submitted: ' . $post_title;
	$message  = 'A new recipe has been submitted:<br>';
	$message .= '<strong>' . $post_title . '</strong><br><br>';
	$message .= 'Click here to review and publish: <br>';
	$message .= '<a href="' . $post_url . '">' . $post_url . '</a>';
	$headers  = array( 'Content-Type: text/html; charset=UTF-8' );

	// Trigger email.
	// @link https://developer.wordpress.org/reference/functions/wp_mail/
	wp_mail( $to, $subject, $message, $headers );
}
add_action( 'draft_recipe', 'ttnineteen_recipe_draft_email' );
