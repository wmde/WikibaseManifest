<?php

use MediaWiki\Extension\WikibaseManifest\ConfigEquivEntitiesFactory;
use MediaWiki\Extension\WikibaseManifest\EquivEntitiesFactory;
use MediaWiki\Extension\WikibaseManifest\ManifestGenerator;
use MediaWiki\MediaWikiServices;

return [
    'WikibaseManifestGenerator' => function ( MediaWikiServices $services ) {
         /**
 * @var EquivEntitiesFactory $equivEntitiesFactory 
*/
        $equivEntitiesFactory = $services->getService('WikibaseManifestConfigEquivEntitiesFactory');

        return new ManifestGenerator(
            $services->getMainConfig(),
            $equivEntitiesFactory->getEquivEntities()
        );
    },
    'WikibaseManifestConfigEquivEntitiesFactory' => function ( MediaWikiServices $services ) {
        return new ConfigEquivEntitiesFactory(
            $services->getMainConfig(),
            'WbManifestWikidataMapping'
        );
    },
];
