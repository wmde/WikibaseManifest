<?php

namespace MediaWiki\Extension\WikibaseManifest;

use ArrayObject;

class EmptyArrayCleaner {

	public function clean( $array ) {
		return $this->convertEmptyArraysToObjects( $array );
	}

	private function convertEmptyArraysToObjects( $wholeArray ) {
		array_walk( $wholeArray, [ $this, 'addRemoveKeyFromEmptyArray' ] );
		return $wholeArray;
	}

	private function addRemoveKeyFromEmptyArray( &$value ) {
		if ( $value == [] ) {
			$value = new ArrayObject();
		} elseif ( is_array( $value ) ) {
			array_walk( $value, [ $this, 'addRemoveKeyFromEmptyArray' ] );
		}
	}

}
