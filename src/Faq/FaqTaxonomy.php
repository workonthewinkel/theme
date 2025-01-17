<?php

	namespace WotW\Theme\Faq;

	use WotW\Theme\Contracts\Taxonomy as Contract;

	class FaqTaxonomy extends Contract{

		protected $name = 'FAQ Categories';
		protected $singular_name = 'FAQ Category';
		protected $post_type = 'faq';
		protected $textdomain = 'burostaal';
		protected $slug = 'faq-category';

	}
