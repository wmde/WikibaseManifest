<?php

namespace WikibaseManifest\Test;

use HashConfig;
use MediaWiki\Extension\WikibaseManifest\ConfigExternalServicesFactory;
use MediaWiki\Extension\WikibaseManifest\WbManifest;
use PHPUnit\Framework\TestCase;

class ConfigExternalServicesFactoryTest extends TestCase {

	public function externalServicesDataProvider() {
		return [
			[ [], [
				'WbManifestExternalServiceMapping' => [],
				'WBRepoSettings' => [ 'sparqlEndpoint' => null ],
			]
			],
			[ [ 'queryservice' => 'http://something.com' ], [
				'WbManifestExternalServiceMapping' => [],
				'WBRepoSettings' => [ 'sparqlEndpoint' => 'http://something.com' ],
			]
			],
			[ [ 'queryservice' => 'http://something.com', 'quickstatements' => 'http://quickstatement.net' ], [
				'WbManifestExternalServiceMapping' => [ 'quickstatements' => 'http://quickstatement.net' ],
				'WBRepoSettings' => [ 'sparqlEndpoint' => 'http://something.com' ],
			] ],
			[ [ 'queryservice' => 'http://somethingelse.com' ], [
				'WbManifestExternalServiceMapping' => [ 'queryservice' => 'http://somethingelse.com' ],
				'WBRepoSettings' => [ 'sparqlEndpoint' => 'http://something.com' ],
			] ],
		];
	}

	/**
	 * @dataProvider externalServicesDataProvider
	 * @param $expectedExternalServices
	 * @param $configArray
	 */
	public function test( $expectedExternalServices, $configArray ) {
		$configMappingName = WbManifest::EXTERNAL_SERVICES_CONFIG;
		$mockConfig = new HashConfig( $configArray );

		$factory = new ConfigExternalServicesFactory(
			$mockConfig, $configMappingName
		);
		$this->assertEquals( $expectedExternalServices, $factory->getExternalServices()->toArray() );
	}

}
