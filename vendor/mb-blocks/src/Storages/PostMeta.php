<?php
namespace MBBlocks\Storages;

/**
 * A wrapper of post storage with decorator pattern.
 * This method allows different storage can be used, such as post meta or custom table.
 */
class PostMeta {
	private $storage;

	public function __construct( $storage ) {
		$this->storage = $storage;
	}

	public function __call( $method, $args ) {
		return call_user_func_array( [ $this->storage, $method ], $args );
	}

	// Fake functions to compatible with the block PHP code.
	public function get_data() {
		// Return an unique ID for each save.
		return [ 'id' => uniqid() ];
	}

	public function set_data( $data ) {}
}
