<?php

use MediaWiki\Extension\WikibaseManifest\ConceptNamespaces;
use MediaWiki\Extension\WikibaseManifest\ConfigEquivEntitiesFactory;
use MediaWiki\Extension\WikibaseManifest\EquivEntitiesFactory;
use MediaWiki\Extension\WikibaseManifest\ManifestGenerator;
use MediaWiki\Extension\WikibaseManifest\WbManifest;
use MediaWiki\MediaWikiServices;
use Wikibase\Repo\WikibaseRepo;

return [
    'WikibaseManifestGenerator' => function ( MediaWikiServices $services ) {
        /**
         * @var EquivEntitiesFactory $equivEntitiesFactory
         */
        $equivEntitiesFactory =
            $services->getService( 'WikibaseManifestConfigEquivEntitiesFactory' );

        $conceptNamespaces = $services->getService( 'WikibaseManifestConceptNamespaces' );

        return new ManifestGenerator(
            $services->getMainConfig(),
            $equivEntitiesFactory,
            $conceptNamespaces
        );
    },
    'WikibaseManifestConfigEquivEntitiesFactory' => function ( MediaWikiServices $services ) {
        return new ConfigEquivEntitiesFactory(
            $services->getMainConfig(), WbManifest::ENTITY_MAPPING_CONFIG
        );
    },
    'WikibaseManifestConceptNamespaces' => function ( ) {
        $repo = WikibaseRepo::getDefaultInstance();
        $rdfVocabulary = $repo->getRdfVocabulary();
        $localEntitySource = $repo->getLocalEntitySource();
        // TODO: Get Canonical Document URLS from a service not straight from remote
        return new ConceptNamespaces( $localEntitySource, $rdfVocabulary, $repo->getCanonicalDocumentUrls() );
    }
];
