<?php

// Load Composer autoloader.
if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
	require_once __DIR__ . '/vendor/autoload.php';

} else {
    wp_die('Run composer install in the active (child)theme.');
}

( new WotW\Theme\Bootstrap() )->load();
