<?php

namespace WotW\Theme\Patterns;

use WotW\Theme\Contracts\Interfaces\Hookable;

class Save implements Hookable{

	public function register_hooks(): void {
	
		// Hook into the update_post_mata if we're in local,
		// don't do this on staging or production where the client can 
		// mess with the GIT repo.
		if( env( 'ENVIRONMENT' ) === 'local' ){
			add_action( 'save_post', [ $this, 'save' ]);
		}
	}

	/**
	 * Save a single pattern to a file.
	 */
	public function save( $post_id ): void {
		
		// Check if the saved post type is 'wp_block' (used for patterns)
		if( get_post_type( $post_id ) === 'wp_block' ) {

			// Get the pattern post data
			$pattern_post = get_post( $post_id );

			// Ensure the post has content and a title
			if( $pattern_post && !empty( $pattern_post->post_title ) && !empty( $pattern_post->post_content ) ) {
				// Sanitize the title to create a valid filename
				$sanitized_title = sanitize_title($pattern_post->post_title);

				// Get the current theme's folder path
				$theme_dir = get_stylesheet_directory();
				$patterns_dir = $theme_dir . '/patterns';

				// Ensure the patterns directory exists
				if( !file_exists($patterns_dir) ) {
					mkdir($patterns_dir, 0755, true);
				}

				// Define the file path
				$file_path = $patterns_dir . '/' . $sanitized_title . '.php';
				$contents = $this->get_pattern_front_matter( $pattern_post );
				$contents .= "\n"; //Force a new line.
				$contents .= $pattern_post->post_content; //Add the patterns content.

				// Save the content to the file
				$success = file_put_contents( $file_path, $contents );

			}
		}
	}

	/**
	 * Returns a string of pattern front-matter,
	 * so it can be picked up by WordPress.
	 */
	public function get_pattern_front_matter( $pattern ): string {
		
		$string = "<?php
			/**
			 * Title: $pattern->post_title
			 * Slug: wotw/$pattern->post_name
			 * Inserter: true
			 */
			?>";
		
		//remove our tabs
		return trim( preg_replace( '/\t+/', '', $string ) );
	}
}
