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
        $this->assertEquals( $expectedExternalServices, $factory->getExternalServices()->toArray());
    }

}
