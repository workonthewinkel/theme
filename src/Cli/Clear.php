<?php

    namespace WotW\Theme\Cli;  


    class Clear extends \WP_CLI_Command{

        /**
         * Clear ar FSE items in the database
		 * 
		 * wp wotw clear fse
         */
        public function fse( array $args = [], array $assoc_args = [] ): void {
            $this->patterns();
            $this->templates();
            $this->parts();
        }


        /**
         * Delete all patterns in database
		 * 
		 * wp wotw clear patterns
         */
        public function patterns(  array $args = [], array $assoc_args = [] ): void {
			global $wpdb;

			$deleted = $wpdb->delete( $wpdb->posts, [ 'post_type' => 'wp_pattern' ]);

			if ( $deleted === false ) {
				\WP_CLI::error( 'Failed to delete FSE patterns.' );
			}

			\WP_CLI::success( "$deleted FSE patterns deleted." );
		}


		/**
         * Delete all FSE templates in database
		 * 
		 * wp wotw clear templates
         */
        public function templates(  array $args = [], array $assoc_args = [] ): void {
			global $wpdb;

			$deleted = $wpdb->delete( $wpdb->posts, [ 'post_type' => 'wp_template' ]);

			if ( $deleted === false ) {
				\WP_CLI::error( 'Failed to delete FSE templates.' );
			}

			\WP_CLI::success( "$deleted FSE templates deleted." );
		}

		/**
         * Delete all FSE template-parts in database
		 * 
		 * wp wotw clear parts
         */
        public function parts( array $args = [], array $assoc_args = [] ): void {
			global $wpdb;

			$deleted = $wpdb->delete( $wpdb->posts, [ 'post_type' => 'wp_template_part' ]);

			if ( $deleted === false ) {
				\WP_CLI::error( 'Failed to delete FSE template-parts.' );
			}

			\WP_CLI::success( "$deleted FSE template-parts deleted." );
		}
    }
