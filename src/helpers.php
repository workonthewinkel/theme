<?php

// Helper functions go here...
//fetch stuff from the .env
if( !function_exists('env') ){
    function env( $key ){
        return $_ENV[ strtoupper( $key ) ] ?? null;
    }
}
