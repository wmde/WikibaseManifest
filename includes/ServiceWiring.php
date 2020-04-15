<?php

use MediaWiki\Extension\WikibaseManifest\ManifestGenerator;
use MediaWiki\MediaWikiServices;

return [
    'WikibaseManifestGenerator' => function ( MediaWikiServices $services ) {
        $config = $services->getMainConfig();
        return new ManifestGenerator($config);
    },
];
