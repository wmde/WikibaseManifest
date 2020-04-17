<?php

namespace WikibaseManifest\Test;

use InvalidArgumentException;
use MediaWiki\Extension\WikibaseManifest\ExternalServices;
use PHPUnit\Framework\TestCase;

class ExternalServicesTest extends TestCase {

	public function dataProvider() {
		return [
			[ true, [ ExternalServices::KEY_OPENREFINE_RECONCILE => 'http://addshore.com' ] ],
			[ true, [ ExternalServices::KEY_QUERYSERVICE => 'http://addshore.com' ] ],
			[ true, [ ExternalServices::KEY_QUERYSERVICE_UI => 'http://addshore.com' ] ],
			[ true, [ ExternalServices::KEY_QUICKSTATEMENTS => 'http://addshore.com' ] ],
			[ false, [ 'notvalid' => 'http://addshore.com' ] ],
			[ false, [ ExternalServices::KEY_QUICKSTATEMENTS => 'notaurl' ] ],
		];
	}

	/**
	 * @dataProvider dataProvider
	 */
	public function test( $expectedSuccess, $mapping ) {
		if ( !$expectedSuccess ) {
			$this->expectException( InvalidArgumentException::class );
		}
		$value = new ExternalServices( $mapping );
		$this->assertEquals( $mapping, $value->toArray() );
	}
}
