<?php
namespace MBBlocks\Storages;

class Attributes {
	private $data = [];

	public function get_data() {
		return $this->data;
	}

	public function set_data( $data ) {
		$this->data = $data;
	}

	public function get( $object_id, $meta_key, $args = false ) {
		if ( is_array( $args ) ) {
			$single = ! empty( $args['single'] );
		} else {
			$single = (bool) $args;
		}
		$default = $single ? '' : [];

		return isset( $this->data[ $meta_key ] ) ? $this->data[ $meta_key ] : $default;
	}

	public function add( $object_id, $meta_key, $meta_value, $unique = false ) {
		if ( $unique ) {
			return $this->update( $object_id, $meta_key, $meta_value );
		}

		$meta_value = wp_unslash( $meta_value );
		$values     = isset( $this->data[ $meta_key ] ) ? $this->data[ $meta_key ] : [];
		$values[]   = $meta_value;

		$this->data[ $meta_key ] = $values;

		return true;
	}

	public function update( $object_id, $meta_key, $meta_value, $prev_value = '' ) {
		if ( empty( $meta_key ) ) {
			return false;
		}
		$meta_value = wp_unslash( $meta_value );
		if ( '' === $meta_value || [] === $meta_value ) {
			unset( $this->data[ $meta_key ] );
		} else {
			$this->data[ $meta_key ] = $meta_value;
		}

		return true;
	}

	public function delete( $object_id, $meta_key = '', $meta_value = '', $delete_all = false ) {
		if ( ! $meta_key ) {
			$this->data = [];
			return true;
		}

		if ( ! isset( $this->data[ $meta_key ] ) ) {
			return true;
		}

		if ( $delete_all || ! $meta_value || $this->data[ $meta_key ] === $meta_value ) {
			unset( $this->data[ $meta_key ] );
			return true;
		}

		if ( ! is_array( $this->data[ $meta_key ] ) ) {
			return true;
		}

		// For field with multiple values.
		foreach ( $this->data[ $meta_key ] as $key => $value ) {
			if ( $value === $meta_value ) {
				unset( $this->data[ $meta_key ][ $key ] );
			}
		}

		return true;
	}
}
