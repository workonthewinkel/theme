<?php

namespace WotW\Theme\Contracts;

abstract class Format{

	/**
	 * All of the attributes set on the container.
	 */
	protected array $attributes = [];


	/**
	 * Constructor
	 */
	public function __construct( array $data = [] ) {

		// Default set every attribute in the array
		foreach( $data as $key => $value ) {
			$this->attributes[ $key ] = $value;
		}

		// optionally, format them in a set function.
		$this->set( $data );
	}

	/**
	 * Get an attribute from the container.
	 *
	 * @param  string  $key
	 * @param  mixed   $default
	 * @return mixed
	 */
	public function get( string $key, $default = null ) {
		if( array_key_exists( $key, $this->attributes ) ) {
			return $this->attributes[$key];
		}

		//return value( $default );
		return $default;
	}

	/**
	 * Get the attributes from the container.
	 */
	public function get_attributes() : array
	{
		return $this->attributes;
	}

	/**
	 * Convert the Fluent instance to an array.
	 */
	public function to_array() : array
	{
		return $this->attributes;
	}

	/**
	 * Convert the Fluent instance to JSON.
	 */
	public function to_json( int $options = 0 ): string {
		return json_encode( $this->to_array(), $options );
	}


	/**
	 * Handle dynamic calls to the container to set attributes.
	 *
	 * @return $this
	 */
	public function __call( string $method, array $parameters ) {

		$this->attributes[$method] = count( $parameters ) > 0 ? $parameters[0] : true;

		return $this;
	}

	/**
	 * Dynamically retrieve the value of an attribute.
	 * @return mixed
	 */
	public function __get( string $key ) {
		return $this->get( $key );
	}

	/**
	 * Dynamically set the value of an attribute.
	 *
	 * @param  string  $key
	 * @param  mixed   $value
	 */
	public function __set( string $key, $value ): void {
		$this->attributes[ $key ] = $value;
	}

	/**
	 * Dynamically check if an attribute is set.
	 */
	public function __isset( string $key ): bool {
		return isset( $this->attributes[$key] );
	}

	/**
	 * Dynamically unset an attribute.
	 */
	public function __unset( string $key ): void {
		unset( $this->attributes[$key] );
	}
}
