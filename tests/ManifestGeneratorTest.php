<?php

namespace WikibaseManifest\Test;

use HashConfig;
use MediaWiki\Extension\WikibaseManifest\ConceptNamespaces;
use MediaWiki\Extension\WikibaseManifest\EntityNamespaces;
use MediaWiki\Extension\WikibaseManifest\EntityNamespacesFactory;
use MediaWiki\Extension\WikibaseManifest\EquivEntities;
use MediaWiki\Extension\WikibaseManifest\EquivEntitiesFactory;
use MediaWiki\Extension\WikibaseManifest\ExternalServices;
use MediaWiki\Extension\WikibaseManifest\ExternalServicesFactory;
use MediaWiki\Extension\WikibaseManifest\ManifestGenerator;
use PHPUnit\Framework\TestCase;

/**
 * @covers \MediaWiki\Extension\WikibaseManifest\ManifestGenerator
 */
class ManifestGeneratorTest extends TestCase {

	public function testGenerate() {
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

		$mockExternalServicesFactory = $this->createMock( ExternalServicesFactory::class );
		$externalServicesMappings = [ 'queryservice' => 'http://services.something' ];
		$mockExternalServicesFactory->expects( $this->once() )
			->method( 'getExternalServices' )
			->willReturn( new ExternalServices( $externalServicesMappings ) );

		$entityNamespaceMapping = [ 'item' => [ 'namespaceId' => 123, 'namespaceString' => 'Cat' ] ];
		$mockEntityNamespacesFactory = $this->createMock( EntityNamespacesFactory::class );
		$mockEntityNamespacesFactory->expects( $this->atLeastOnce() )
			->method( 'getEntityNamespaces' )
			->willReturn( new EntityNamespaces( $entityNamespaceMapping ) );
		$generator = new ManifestGenerator(
			$mockConfig,
			$mockEquivEntitiesFactory,
			$mockConceptNamespaces,
			$mockExternalServicesFactory,
			$mockEntityNamespacesFactory
		);
		$result = $generator->generate();

		$expectedSubset = [
			'name' => $siteString,
			'rootScriptUrl' => $serverString . $scriptString,
			'equivEntities' => [
				'wikidata' => $equivEntities,
			],
			'localRdfNamespaces' => [ 'a' => 'bb' ],
			'externalServices' => $externalServicesMappings,
			'entities' => $entityNamespaceMapping
		];

		foreach ( $expectedSubset as $key => $value ) {
			$this->assertArrayHasKey( $key, $result );
			$this->assertSame( $value, $result[$key] );
		}
	}
}
