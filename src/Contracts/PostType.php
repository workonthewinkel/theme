<?php

	namespace WotW\Theme\Contracts;

	use WotW\Theme\Contracts\Interfaces\Hookable;

	class PostType implements Hookable{


		protected $name = '';
		protected $singular_name = '';
		protected $post_type = 'posttype';
		protected $textdomain = 'burostaal';
		protected $dash_icon = 'dashicons-format-aside';
		protected $supports = ['title', 'editor', 'custom-fields'];


		public function register_hooks(): void {

			add_action('init', function() {

				// Labelsfor custom posttype
				$labels = array(
					'name'               => __($this->name, $this->textdomain),
					'singular_name'      => __($this->singular_name, $this->textdomain),
					'menu_name'          => __($this->name, $this->textdomain),
					'name_admin_bar'     => __($this->singular_name, $this->textdomain),
					'add_new'            => __('Add New', $this->textdomain),
					'add_new_item'       => __('Add New ' . $this->singular_name, $this->textdomain),
					'edit_item'          => __('Edit ' . $this->singular_name, $this->textdomain),
					'new_item'           => __('New ' . $this->singular_name, $this->textdomain),
					'view_item'          => __('View ' . $this->singular_name, $this->textdomain),
					'search_items'       => __('Search ' . $this->name, $this->textdomain),
					'not_found'          => __('No '. $this->name .' found', $this->textdomain),
					'not_found_in_trash' => __('No ' . $this->name .  ' found in Trash', $this->textdomain),
				);
			
				// Argumenten voor het custom posttype
				$args = array(
					'labels'             => $labels,
					'public'             => true,
					'has_archive'        => true,
					'rewrite'            => array('slug' => $this->name),
					'menu_icon'          => $this->dash_icon,
					'supports'           => $this->supports,
					'show_in_rest'       => true, // Voor Gutenberg-ondersteuning.
				);
			
				// Registreer het custom posttype
				register_post_type($this->post_type, $args);
			});
		}
	}
