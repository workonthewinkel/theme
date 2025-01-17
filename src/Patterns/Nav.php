<?php

namespace WotW\Theme\Patterns;

use WotW\Theme\Contracts\Interfaces\Hookable;

class Nav implements Hookable{

	/**
	 * Listen and register each blocks:
	 */
	public function register_hooks(): void { 

		add_action('after_setup_theme', [ $this, 'register_nav' ]);

	}

	/**
	 * Register our custom navigation
	 */
	public function register_nav(): void {

	    register_nav_menu('main-nav', __('Main Navigation', 'staal'));
	
	}
}
