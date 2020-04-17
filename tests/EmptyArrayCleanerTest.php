<?php

namespace MediaWiki\Extension\WikibaseManifest;

use ArrayObject;
use PHPUnit\Framework\TestCase;

class EmptyArrayCleanerTest extends TestCase {

	public function dataProvider() {
		return [
			[ [ 'cat' => 'dog' ], [ 'cat' => 'dog' ] ],
			[ [ 'cat' => [] ], [ 'cat' => new ArrayObject() ] ],
			[ [ 'cat' => [ 'dog' => [] ] ], [ 'cat' => [ 'dog' => new ArrayObject() ] ] ]
		];
	}

	/**
	 * @dataProvider dataProvider
	 */
	public function testClean( $input, $expected ) {
		$cleaner = new EmptyArrayCleaner();
		$actual = $cleaner->clean( $input );
		$this->assertEquals( $expected, $actual );
	}
}
