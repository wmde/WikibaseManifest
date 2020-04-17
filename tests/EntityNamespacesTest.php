<?php

namespace WikibaseManifest\Test;

use InvalidArgumentException;
use MediaWiki\Extension\WikibaseManifest\EntityNamespaces;
use PHPUnit\Framework\TestCase;

class EntityNamespacesTest extends TestCase {

	public function dataProvider() {
		return [
			[ true, [ 'foo' => [ 'namespaceId' => 1, 'namespaceString' => '' ] ] ],
			[ true, [ 'foo' => [ 'namespaceId' => 120, 'namespaceString' => 'Foo' ] ] ],
			[ false, [ 'foo' => [] ] ],
			[ false, [ 'foo' => 123 ] ],
			[ false, [ 'foo' => [ 'namespaceId' => 1 ] ] ],
			[ false, [ 'foo' => [ 'namespaceId' => 'foo', 'namespaceString' => '' ] ] ],
			[ false, [ 'foo' => [ 'namespaceId' => 1, 'namespaceString' => 123 ] ] ],
		];
	}

	/**
	 * @dataProvider dataProvider
	 */
	public function test( $expectedSuccess, $mapping ) {
		if ( !$expectedSuccess ) {
			$this->expectException( InvalidArgumentException::class );
		}
		$value = new EntityNamespaces( $mapping );
		$this->assertEquals( $mapping, $value->toArray() );
	}
}
