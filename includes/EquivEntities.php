<?php

namespace MediaWiki\Extension\WikibaseManifest;

use InvalidArgumentException;

class EquivEntities {

	/**
	 * @var array
	 */
	private $mapping;

	/**
	 * @param string[] $mapping
	 */
	public function __construct( array $mapping ) {
		$this->validateMapping( $mapping );
		$this->mapping = $mapping;
	}

	private function validateMapping( array $mapping ): void {
		foreach ( $mapping as $k => $v ) {
			if ( !is_string( $k ) ) {
				throw new InvalidArgumentException( 'Keys of mapping should be strings' );
			}
			if ( !is_string( $v ) ) {
				throw new InvalidArgumentException( 'Values of mapping should be strings' );
			}
		}
	}

	public function toArray(): array {
		return $this->mapping;
	}

}
