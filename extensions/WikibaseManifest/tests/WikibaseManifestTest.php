<?php

namespace WikibaseManifest\Test;

use MediaWiki\Extension\WikibaseManifest\ManifestGenerator;
use PHPUnit\Framework\TestCase;

/**
 * @covers \MediaWiki\Extension\WikibaseManifest\ManifestGenerator
 */
class WikibaseManifestTest extends TestCase {

    public function testGenerate() {
        $generator = new ManifestGenerator();
        $result = $generator->generate();

        $this->assertEquals( [ 'duck' ], $result );
    }
}
