<?php

	namespace WotW\Theme\Contracts;

	use WotW\Theme\Traits\HasACFFields;
	use WotW\Theme\Contracts\Interfaces\Hookable;

	class Metabox implements Hookable{

		use HasACFFields;

		protected $title = '';
		protected $post_type = 'post';

		public function register_hooks(): void {

			//register field group:
			add_action( 'acf/include_fields', function() {
				if ( ! function_exists( 'acf_add_local_field_group' ) ) {
					return;
				}

				acf_add_local_field_group([
					'title' 	=> $this->title,
					'fields' 	=> $this->get_sanitized_fields( $this->fields() ),
					'location' => [[[
						'param' => 'post_type',
						'operator' => '==',
						'value' => $this->post_type
					]]],
					'menu_order' => 0,
					'position' => 'normal',
					'style' => 'default',
					'label_placement' => 'top',
					'instruction_placement' => 'label',
					'hide_on_screen' => '',
					'active' => true,
					'description' => '',
					'show_in_rest' => 0,
				]);
			});
		}

		protected function fields(): array {
			return [];
		}
	}
