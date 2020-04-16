<?php


namespace WikibaseManifest\Test;

use MediaWiki\MediaWikiServices;
use MediaWikiTestCase;

class ManifestGeneratorIntegrationTest extends MediaWikiTestCase
{

    public function testGenerate()
    {
        $siteString = 'manifestsite';
        $serverString = 'http://cat/dog';
        $scriptString = '/wikipath';
        $rootScriptUrlString = $serverString . $scriptString;
        $this->setMwGlobals(
            [
            'wgServer' => $serverString,
            'wgSitename' => $siteString,
            'wgScriptPath' => $scriptString,
            'wgWbManifestWikidataMapping' => [
                'P1' => 'P2'
            ],
            ]
        );
        $generator = MediaWikiServices::getInstance()->getService('WikibaseManifestGenerator');
        $result = $generator->generate();

        $this->assertArrayHasKey( 'name', $result );
        $this->assertIsString( $result['name'] );
        $this->assertEquals( $result['name'], $siteString );

        $this->assertArrayHasKey( 'rootScriptUrl', $result );
        $this->assertIsString( $result['rootScriptUrl'] );
        $this->assertEquals( $result['rootScriptUrl'], $rootScriptUrlString );

        $this->assertArrayHasKey( 'equivEntities', $result );
        $this->assertArrayHasKey( 'wikidata', $result['equivEntities'] );
        $this->assertIsArray( $result['equivEntities']['wikidata'] );
        $this->assertArrayEquals( $result['equivEntities']['wikidata'], [ 'P1' => 'P2' ] );


        $this->assertArrayHasKey( 'localRdfNamespaces', $result );
        $this->assertIsArray( $result['localRdfNamespaces'] );
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
            $this->assertArrayHasKey( $key, $result['localRdfNamespaces'] );
        }
    }
}
