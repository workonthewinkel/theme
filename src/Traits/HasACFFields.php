<?php

namespace WotW\Theme\Traits;

trait HasACFFields{

	/**
	 * Sanitize our fields
	 *
	 * @param Array $fields
	 * @return array
	 */
	public function get_sanitized_fields( $fields = [] )
	{

		foreach( $fields as $key => $field ){

			//if there's no field key, it can be the same as the name:
			if( !isset( $field['key'] ) ){
				$fields[$key]['key'] = $field['name'];
			}

			//hidden fields are always 'text' with a hidden class
			//(acf doesnt have hidden fields)
			if( $fields[$key]['type'] == 'hidden' ){
				$fields[$key]['type'] = 'text';
				$fields[$key]['wrapper'] = ['class' => 'hidden'];
			}

			//if a default is set, also set the default_value key
			if( isset( $fields[$key]['default'] ) ){
				$fields[$key]['default_value'] = $fields[$key]['default'];
			}

			//run the sub-fields through, as well:
			if( isset( $field['sub_fields'] ) && !empty( $field['sub_fields'] ) ){
				$fields[$key]['sub_fields'] = $this->get_sanitized_fields( $field['sub_fields'] );
			}
		}
		

		return $fields;
	}
}
