<?php 

    namespace WotW\Theme;

    class Bootstrap{

        /**
         * Load the initial static files:
         */
        public function load(): void
        {
            //load assets:
            add_action( 'wp_enqueue_scripts', [ $this, 'assets' ] );
            add_action( 'admin_enqueue_scripts', [ $this, 'blocks' ]);

			//set language domain:
            add_action( 'after_setup_theme', [ $this, 'theme_setup'] );

			//theme support post-thumbnails + svg
			add_theme_support( 'post-thumbnails' );
			add_theme_support( 'menus' );
			
			add_filter('upload_mimes', function ($mimes) {
				$mimes['svg'] = 'image/svg+xml';
				return $mimes;
			});

			//trigger our event listeners:
			( new Blocks\Register )->register_hooks();
			( new Patterns\Nav )->register_hooks();
			( new Patterns\Save )->register_hooks();

			( new Products\Archive )->register_hooks();
			( new Products\Taxonomies )->register_hooks();
			( new Products\Detail )->register_hooks();

			//set API endpoints:
			( new Rest\ImageUpload )->register_hooks();
			//( new Rest\AddToCart )->register_hooks();
			//( new Rest\GetCart )->register_hooks();

	        if ( defined('WP_CLI') && WP_CLI ){
    	        \WP_CLI::add_command( 'wotw migrate', Cli\Migrate::class );
				\WP_CLI::add_command( 'wotw clear', Cli\Clear::class );
			}
        }

		/**
		 * Return the Mollie key we have in .env.
		 * Why? because using get_option for this is dumb.	
		 *
		 * @return string
		 */
		public function set_mollie_key()
		{
			return env( 'MOLLIE_API_KEY' );	
		}


		/**
		 * Load the text-domain
		 */
		public function theme_setup(): void
		{
		   \load_child_theme_textdomain( 'wotw' );
    	}


        /**
         * Load our assets:
         */
        public function assets(): void 
        {
            //wp_enqueue_style( 'generatepress-style', get_template_directory_uri() . '/assets/css/main.css' );
            wp_enqueue_style( 'wotw-style',
                get_stylesheet_directory_uri() . '/assets/dist/css/main.css',
                ['ollie'],
				env('ASSETS_VERSION')
            );
            

            wp_enqueue_script( 'wotw-script', 
                get_stylesheet_directory_uri() . '/assets/dist/js/main.js',
				[],
				env('ASSETS_VERSION')
            );
        }

        /**
         * Adds block styling
         */
        public function blocks(): void 
        {
            wp_enqueue_style( 'wotw-style',
                get_stylesheet_directory_uri() . '/assets/dist/css/blocks.css'
            );
        }
    }
