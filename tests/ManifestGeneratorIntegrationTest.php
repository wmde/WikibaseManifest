<?php


namespace WikibaseManifest\Test;

use HashConfig;
use MediaWiki\Extension\WikibaseManifest\ManifestGenerator;
use MediaWiki\MediaWikiServices;
use MediaWikiTestCase;
use PHPUnit\Framework\TestCase;

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
            ]
        );
        $generator = MediaWikiServices::getInstance()->getService('WikibaseManifestGenerator');
        $result = $generator->generate();

        $this->assertEquals(
            [
            'name' => $siteString,
            'rootScriptUrl' => $rootScriptUrlString,
            ],
            $result
        );
    }
}
