<?php

	namespace WotW\Theme\Faq;

	use WotW\Theme\Contracts\Metabox as Contract;

	class Metabox extends Contract{

		protected $title = 'Answer';
		protected $post_type = 'faq';

		/**
		 * Return the fields as an array
		 */
		protected function fields(): array {

			return [
				[
					'label' => __( 'Answer', 'burostaal' ),
					'name' => 'faq_answer',
					'type' => 'wysiwyg'
				]
			];
		}

	}
