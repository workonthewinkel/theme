<?php

    namespace WotW\Theme\Contracts;

	use WotW\Theme\Traits\HasACFFields;

    abstract class Block{

		use HasACFFields;

        /**
         * Block title
         */
        protected string $title = '';

        /**
         * Properties for this block
         */
        protected array $properties = [];

        /**
         * Constructor;
         */
        public function __construct( array $props = [] ) {
            $this->properties = wp_parse_args( $props, $this->get_defaults() );
        }

        /**
         * Register this block:
         */
        public function register(): void {
            
            add_action( 'acf/init', function(){          
                if( function_exists( 'acf_register_block_type' ) ){
                    acf_register_block_type([
                        'name'              =>      $this->get_slug(),
                        'title'             =>      $this->title,
                        'description'       =>      $this->prop( 'description' ),
                        'render_template'   =>      $this->get_template(),
                        'category'          =>      $this->prop( 'category' ),
                        'icon'              =>      $this->prop( 'icon' ),
                        'keywords'          =>      $this->prop( 'keywords' )
                    ]);
                }
            });

            if( function_exists( 'acf_add_local_field_group' ) ){
                
                acf_add_local_field_group([
                    'key' => 'block_fields_'.$this->get_slug(),
                    'title' => $this->title,
                    'fields' => $this->get_sanitized_fields( $this->get_fields() ),
                    'location' => [[[
                        'param' => 'block',
                        'operator' => '==',
                        'value' => 'acf/'.$this->get_slug()
                    ]]],
                    'menu_order' => 0,
                    'position' => 'normal',
                    'style' => 'default',
                    'label_placement' => 'top',
                    'instruction_placement' => 'label',
                    'hide_on_screen' => '',
                    'active' => true,
                    'description' => '',
                ]);
            }
        }
        
        
        /**
         * Return the fields
         */
        public function get_fields(): array {
            return [];
        }

        

        /**
         * Return a property
         *
         * @return mixed
         */
        public function prop( $key, $default = null ) {
            if( isset( $this->properties[ $key ] ) ){
                return $this->properties[ $key ];
            }

            return $default;
        }
            

        /**
         * Return the slug for this block
         */
        public function get_slug(): string {
            return sanitize_title( $this->title );
        }


        /**
         * Return the template for this block:
         */
        public function get_template(): string {
            return 'blocks/'.$this->get_slug().'.php';
        }


        /**
         * Return default properties
         */
        public function get_defaults(): array {

            $defaults = [
                'description' => '',
                'category' => 'common',
                'icon' => 'admin-comments',
                'keywords' => []
            ];

            return apply_filters( 'wotw_block_defaults', $defaults, $this );
        }


        /**
         * Return the default field values:
         */
        public function get_default_field_values(): array {
            return [];
        }

    }
