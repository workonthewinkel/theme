<?php

namespace WotW\Theme\Content\Migrations;

use WotW\Theme\Contracts\Migration;

class Test extends Migration{

    public string $slug = 'test';

    public function run(): void 
    {
        \WP_CLI::success( "succesfully ran the test migration." );
    }
}
