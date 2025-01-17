<?php

    namespace WotW\Theme\Blocks;

    use WotW\Theme\Contracts\Block;

    class Faq extends Block{

        protected string $title = 'Veelgestelde Vragen';

        /**
         * Return the fields
         *
         * @return Array
         */
        public function get_fields(): array {
            return [
                [
					'type' => 'text',
					'label' => __( 'Header Text', 'wotw' ),
					'name' => 'faq_header_text'
				],
				[
					'type'            => 'taxonomy',
					'label'           => __( 'Category', 'wotw' ),
					'name'            => 'faq_taxonomy',
                    'instructions'    => '',
                    'required'        => 0,
                    'taxonomy'        => 'faq-category',
                    'field_type'      => 'checkbox',      // UI (checkbox, multi-select, select, radio)
                    'allow_null'      => 0,             // Can select a blank value
                    'load_save_terms' => 1,             // Persist using term relationships table
                    'return_format'   => 'object',      // or 'object'
                    'add_term'        => 0,             // Can the user add new terms?
                ]
            ];
        }

		/**
         * Return the template for this block:
         *
         * @return string
         */
        public function get_template() :string
        {
            return 'blocks/faq.php';
        }


    }
