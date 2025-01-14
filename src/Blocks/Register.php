<?php

namespace WotW\Theme\Blocks;

use WotW\Theme\Contracts\Interfaces\Hookable;

class Register implements Hookable{

	/**
	 * Listen and register each blocks:
	 */
	public function register_hooks(): void { 
		          
		( new Faq() )->register(); 
		
	}
}
