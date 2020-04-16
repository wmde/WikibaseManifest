<?php

namespace WikibaseManifest\Test;

use HashConfig;
use MediaWiki\Extension\WikibaseManifest\ConceptNamespaces;
use MediaWiki\Extension\WikibaseManifest\EquivEntities;
use MediaWiki\Extension\WikibaseManifest\EquivEntitiesFactory;
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
        $equivEntities = [ 'P1' => 'P2' ];
        $mockConfig = new HashConfig(
            [
            'Server' => $serverString,
            'Sitename' => $siteString,
            'ScriptPath' => $scriptString,
            ]
        );

        $mockEquivEntitiesFactory = $this->createMock( EquivEntitiesFactory::class );
        $mockEquivEntitiesFactory->expects( $this->once() )
            ->method( 'getEquivEntities' )
            ->willReturn( new EquivEntities( $equivEntities ) );

        $mockConceptNamespaces = $this->createMock( ConceptNamespaces::class );
        $mockConceptNamespaces->expects( $this->once() )
            ->method( 'getLocal' )
            ->willReturn( [ 'a' => 'bb' ] );

        $generator = new ManifestGenerator(
            $mockConfig,
            $mockEquivEntitiesFactory,
            $mockConceptNamespaces
        );
        $result = $generator->generate();

        $this->assertEquals(
            [
                'name' => $siteString,
                'rootScriptUrl' => $serverString . $scriptString,
                'equivEntities' => [
                    'wikidata' => $equivEntities,
                ],
                'localRdfNamespaces' => [ 'a' => 'bb' ],
                'externalServices' => [ 'a' => 'b' ],
            ],
            $result
        );
    }
}
