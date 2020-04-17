<?php

namespace WikibaseManifest\Test;

use InvalidArgumentException;
use MediaWiki\Extension\WikibaseManifest\EquivEntities;
use PHPUnit\Framework\TestCase;

/**
 * @covers \MediaWiki\Extension\WikibaseManifest\EquivEntities
 */
class EquivEntitiesTest extends TestCase {

	public function dataProvider() {
		return [
			[ true,[ 'P12' => 'P34' ] ],
			[ false, [ 'P12' => 12 ] ],
			[ false, [ 45 => 'P34' ] ],
			[ false, [ 45 => null ] ],
		];
	}

	/**
	 * @dataProvider dataProvider
	 */
	public function test( $expectedSuccess, $mapping ) {
		if ( !$expectedSuccess ) {
			$this->expectException( InvalidArgumentException::class );
		}
		$value = new EquivEntities( $mapping );
		$this->assertEquals( $mapping, $value->toArray() );
	}

}
