<?php

	namespace WotW\Theme\Faq;

	use WotW\Theme\Contracts\PostType as Contract;

	class PostType extends Contract{


		protected $name = 'FAQs';
		protected $singular_name = 'FAQ';
		protected $post_type = 'faq';
		protected $textdomain = 'burostaal';
		protected $dash_icon = 'dashicons-format-chat';
		protected $supports = ['title'];


	}
