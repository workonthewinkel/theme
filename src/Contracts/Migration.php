<?php

namespace WotW\Theme\Contracts;

abstract class Migration{

	/**
	 * The slug of this migration.
	 */
	public string $slug;

	/**
	 * Is this migration being run forcibly?
	 */
	protected bool $forced = false;

	/**
	 * Arguments passed to this migration
	 */
	protected array $args = [];


	/**
	 * Trigger this migration
	 * 
	 * @return mixed
	 */
	public function trigger( array $assoc_args ): void {
		$this->args = $assoc_args;
		
		if( $this->check() ){
			
			//run this migration
			try{
				$this->run();
				$this->save();

			}catch( Throwable $t ){
				
				\WP_CLI::error( $t->getMessage() );
				die();

			}
		}
	}

	/**
	 * Function to run a content migration
	 */
	public function run() : void { 
	
		return;
	}

	/**
	 * Are we allowed to run this migration?
	 */
	public function check(): bool {

		$slugs = get_option( 'wotw_content_migrations', [] );

		//we've ran this migration before and we're not forcing it:
		if( in_array( $this->slug, $slugs ) && $this->forced === false ){
			return false;
		}

		return true;
	}

	/**
	 * Save the state of this migration:
	 */
	public function save(): void {

		$slugs = get_option( 'wotw_content_migrations', [] );

		//we've ran this migration before and we're not forcing it:
		if( in_array( $this->slug, $slugs ) == false ){
			$slugs[] = $this->slug;
			update_option( 'wotw_content_migrations', $slugs );
		}
	}

	/**
	 * Return the slug of a content migration
	 */
	public function get_slug(): string {

		return $this->slug ?? '';
	}

	/**
	 * Force this migration
	 */
	public function force(): Migration {
		
		$this->forced = true;
		return $this; //make it chainable
	}
}
