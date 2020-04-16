<?php


namespace WikibaseManifest\Test;

use MediaWiki\MediaWikiServices;
use MediaWikiTestCase;

class ManifestGeneratorIntegrationTest extends MediaWikiTestCase
{

    private const NAME = 'name';
    private const ROOT_SCRIPT_URL = 'rootScriptUrl';
    private const EQUIV_ENTITIES = 'equivEntities';
    private const LOCAL_RDF_NAMESPACES = 'localRdfNamespaces';
    private const EXTERNAL_SERVICES = 'externalServices';

    public function testGenerate()
    {
        $siteString = 'manifestsite';
        $serverString = 'http://cat/dog';
        $scriptString = '/wikipath';
        $rootScriptUrlString = $serverString . $scriptString;
        $equivEntities = [ 'P1' => 'P2' ];
        $this->setMwGlobals(
            [
            'wgServer' => $serverString,
            'wgSitename' => $siteString,
            'wgScriptPath' => $scriptString,
            'wgWbManifestWikidataMapping' => $equivEntities,
            ]
        );
        $generator = MediaWikiServices::getInstance()->getService('WikibaseManifestGenerator');
        $result = $generator->generate();

        $this->assertArrayHasKey( self::NAME, $result );
        $this->assertIsString( $result[self::NAME] );
        $this->assertEquals( $result[self::NAME], $siteString );

        $this->assertArrayHasKey( self::ROOT_SCRIPT_URL, $result );
        $this->assertIsString( $result[self::ROOT_SCRIPT_URL] );
        $this->assertEquals( $result[self::ROOT_SCRIPT_URL], $rootScriptUrlString );

        $this->assertArrayHasKey( self::EQUIV_ENTITIES, $result );
        $this->assertIsArray( $result[self::EQUIV_ENTITIES] );
        $this->assertArrayHasKey( 'wikidata', $result[self::EQUIV_ENTITIES] );
        $this->assertIsArray( $result[self::EQUIV_ENTITIES]['wikidata'] );
        $this->assertArrayEquals( $result[self::EQUIV_ENTITIES]['wikidata'], $equivEntities );

        $this->assertArrayHasKey( self::EXTERNAL_SERVICES, $result );
        $this->assertIsArray( $result[self::EXTERNAL_SERVICES] );

        $this->assertArrayHasKey( self::LOCAL_RDF_NAMESPACES, $result );
        $this->assertIsArray( $result[self::LOCAL_RDF_NAMESPACES] );
        $rdfKeys = [
            "",
            "data",
            "s",
            "ref",
            "v",
            "t",
            "tn",
            "p",
            "ps",
            "psv",
            "psn",
            "pq",
            "pqv",
            "pqn",
            "pr",
            "prv",
            "prn",
            "no",
        ];
        foreach ( $rdfKeys as $key ) {
            $this->assertArrayHasKey( $key, $result[self::LOCAL_RDF_NAMESPACES] );
        }
    }
}
