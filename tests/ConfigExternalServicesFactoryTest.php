<?php

namespace WikibaseManifest\Test;

use HashConfig;
use MediaWiki\Extension\WikibaseManifest\ConfigExternalServicesFactory;
use MediaWiki\Extension\WikibaseManifest\WbManifest;
use PHPUnit\Framework\TestCase;

class ConfigExternalServicesFactoryTest extends TestCase {

    public function test() {
        // TODO write more tests that test the logic...
        $configMappingName = WbManifest::EXTERNAL_SERVICES_CONFIG;
        $mockConfig = new HashConfig( [
            'WbManifestExternalServiceMapping' => [],
            'WBRepoSettings' => [ 'sparqlEndpoint' => null ],
        ] );

        $factory = new ConfigExternalServicesFactory(
            $mockConfig, $configMappingName
        );
        $this->assertEquals( [], $factory->getExternalServices()->toArray());
    }

}
