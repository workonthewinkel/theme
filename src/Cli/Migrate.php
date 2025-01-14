<?php

namespace WotW\Theme\Cli;  

class Migrate extends \WP_CLI_Command{

	/**
	 * Run all content migrations, or if a slug is defined only that migration.
	 * Optionally force the migration to run by adding the --force flag.
	 * 
	 * wp wotw migrate content {{slug}} --force 
	 */
	public function content( array $args, array $assoc_args ): void {
		
		$migrations = $this->get_migrations();

		foreach( $migrations as $migration ){
			$instance = $this->get_instance( $migration );
			
			// Check if we need to run a specific migration if a slug is set.
			if( !empty( $args ) ){
				if( $instance->get_slug() !== $args[ 0 ] ){
					continue;
				} 
			}

			// Check if we need to force the migration to run.
			if( isset( $assoc_args['force'] ) ){
				$instance->force()->trigger( $assoc_args );
			}else{
				$instance->trigger( $assoc_args );
			}
		}

		die();
	}


	/**
	 * Creates a migration class instance
	 */
	protected function get_instance( string $migration ) : Migration {
		$instance_name = "\\WotW\\Theme\\Migrations\\".$migration;
		return new $instance_name();
	}


	/**
	 * Return all migration files in an array
	 *
	 * @return array
	 */
	protected function get_migrations(): array {
	
		$response = [];
		$parent = dirname(__DIR__, 1);

		$dir = $parent .'/Migrations/';
		$files = scandir( $dir );

		$not_allowed = ['.', '..', '.DS_Store' ];
		
		foreach( $files as $file ){
			if( !in_array( $file, $not_allowed ) ){
				$response[] = str_replace( '.php', '', $file );
			} 
		}

		return $response;
	}
}
