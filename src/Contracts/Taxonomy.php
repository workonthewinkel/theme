<?php

	namespace WotW\Theme\Contracts;

	use WotW\Theme\Contracts\Interfaces\Hookable;

	class Taxonomy implements Hookable{


		protected $name = 'categories';
		protected $singular_name = 'category';
		protected $post_type = 'posttype';
		protected $slug = 'category-slug';
		protected $textdomain = 'burostaal';
		protected $supports = ['title', 'editor', 'custom-fields'];


		public function register_hooks(): void {

			add_action('init', function() {

				// Labels voor de taxonomie
				$labels = array(
					'name'              => __($this->name, $this->textdomain),
					'singular_name'     => __($this->singular_name, $this->textdomain),
					'search_items'      => __('Search ' . $this->name, $this->textdomain),
					'all_items'         => __('All ' . $this->name, $this->textdomain),
					'parent_item'       => __('Parent ' . $this->singular_name, $this->textdomain),
					'parent_item_colon' => __('Parent ' . $this->singular_name . ':', $this->textdomain),
					'edit_item'         => __('Edit ' . $this->singular_name, $this->textdomain),
					'update_item'       => __('Update ' . $this->singular_name, $this->textdomain),
					'add_new_item'      => __('Add New ' . $this->singular_name, $this->textdomain),
					'new_item_name'     => __('New ' . $this->singular_name . ' Name', $this->textdomain),
					'menu_name'         => __($this->name, $this->textdomain),
				);
			
				// Argumenten voor de taxonomie
				$args = array(
					'hierarchical'      => true,
					'labels'            => $labels,
					'show_ui'           => true,
					'show_admin_column' => true,
					'query_var'         => true,
					'rewrite'           => array('slug' => 'faq-category'),
					'show_in_rest'      => true, // Voor Gutenberg-ondersteuning.
				);
			
				// Registreer de taxonomie
				register_taxonomy($this->slug, array($this->post_type), $args);
			});
		}
	}
