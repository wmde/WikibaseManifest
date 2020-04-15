<?php

namespace WikibaseManifest\Test;

use HashConfig;
use MediaWiki\Extension\WikibaseManifest\EquivEntities;
use MediaWiki\Extension\WikibaseManifest\ManifestGenerator;
use PHPUnit\Framework\TestCase;

/**
 * @covers \MediaWiki\Extension\WikibaseManifest\ManifestGenerator
 */
class ManifestGeneratorTest extends TestCase
{

    public function testGenerate()
    {
        $siteString = 'manifestsite';
        $serverString = 'http://cat/dog';
        $scriptString = '/wikipath';
        $mockConfig = new HashConfig(
            [
            'Server' => $serverString,
            'Sitename' => $siteString,
            'ScriptPath' => $scriptString,
            ]
        );
        $equivEntities = new EquivEntities([ 'P1' => 'P2' ]);

        $generator = new ManifestGenerator(
            $mockConfig,
            $equivEntities
        );
        $result = $generator->generate();

        $this->assertEquals(
            [
                'name' => $siteString,
                'rootScriptUrl' => $serverString . $scriptString,
                'equivEntities' => [
                    'wikidata' => [
                        'P1' => 'P2'
                    ],
                ]
            ],
            $result
        );
    }
}
