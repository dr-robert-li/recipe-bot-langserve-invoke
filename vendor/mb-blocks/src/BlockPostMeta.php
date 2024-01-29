<?php
namespace MBBlocks;

class BlockPostMeta extends Block {
	public function get_storage() {
		if ( null === $this->storage ) {
			$storage       = rwmb_get_storage( $this->object_type, $this );
			$this->storage = new Storages\PostMeta( $storage );
		}
		return $this->storage;
	}

	/**
	 * Add fields to the registry properly to make helper functions work.
	 * Set object type = post, type = block.
	 */
	public function register_fields() {
		$field_registry = rwmb_get_registry( 'field' );

		foreach ( $this->fields as $field ) {
			$field_registry->add( $field, 'block', 'post' );
		}
	}

	/**
	 * Filter meta type to make helper functions work.
	 */
	protected function render_block( $attributes = [], $is_preview = false, $post_id = null ) {
		add_filter( 'rwmb_meta_type', [ $this, 'filter_meta_type' ] );
		parent::render_block( $attributes, $is_preview, $post_id );
		remove_filter( 'rwmb_meta_type', [ $this, 'filter_meta_type' ] );
	}

	public function filter_meta_type() {
		return 'block';
	}
}
