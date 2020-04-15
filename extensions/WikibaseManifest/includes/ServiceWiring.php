<?php

use MediaWiki\Extension\WikibaseManifest\ManifestGenerator;
use MediaWiki\MediaWikiServices;

return [
    'WikibaseManifestGenerator' => function ( MediaWikiServices $services ) {
        return new ManifestGenerator();
    }
];
