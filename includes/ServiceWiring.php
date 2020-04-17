<?php

use MediaWiki\Extension\WikibaseManifest\ConceptNamespaces;
use MediaWiki\Extension\WikibaseManifest\ConfigEquivEntitiesFactory;
use MediaWiki\Extension\WikibaseManifest\ConfigExternalServicesFactory;
use MediaWiki\Extension\WikibaseManifest\EmptyArrayCleaner;
use MediaWiki\Extension\WikibaseManifest\LocalSourceEntityNamespacesFactory;
use MediaWiki\Extension\WikibaseManifest\ManifestGenerator;
use MediaWiki\Extension\WikibaseManifest\WbManifest;
use MediaWiki\MediaWikiServices;
use Wikibase\Repo\WikibaseRepo;

// TODO: add services names to constants of a class
return [
	'WikibaseManifestGenerator' => function ( MediaWikiServices $services ) {
		$equivEntitiesFactory =
			$services->getService( 'WikibaseManifestConfigEquivEntitiesFactory' );

		$conceptNamespaces = $services->getService( 'WikibaseManifestConceptNamespaces' );

		$externalServicesFactory = $services->getService( 'WikibaseManifestConfigExternalServicesFactory' );

		$entityNamespacesFactory = $services->getService( 'WikibaseManifestLocalSourceEntityNamespacesFactory' );

		return new ManifestGenerator(
			$services->getMainConfig(),
			$equivEntitiesFactory,
			$conceptNamespaces,
			$externalServicesFactory,
			$entityNamespacesFactory
		);
	},
	'WikibaseManifestConfigEquivEntitiesFactory' => function ( MediaWikiServices $services ) {
		return new ConfigEquivEntitiesFactory(
			$services->getMainConfig(), WbManifest::ENTITY_MAPPING_CONFIG
		);
	},
	'WikibaseManifestConfigExternalServicesFactory' => function ( MediaWikiServices $services ) {
		return new ConfigExternalServicesFactory(
			$services->getMainConfig(), WbManifest::EXTERNAL_SERVICES_CONFIG
		);
	},
	'WikibaseManifestConceptNamespaces' => function () {
		$repo = WikibaseRepo::getDefaultInstance();
		$rdfVocabulary = $repo->getRdfVocabulary();
		$localEntitySource = $repo->getLocalEntitySource();
		// TODO: Get Canonical Document URLS from a service not straight from remote
		return new ConceptNamespaces( $localEntitySource, $rdfVocabulary, $repo->getCanonicalDocumentUrls() );
	},
	'EmptyArrayCleaner' => function () {
		return new EmptyArrayCleaner();
	},
	'WikibaseManifestLocalSourceEntityNamespacesFactory' => function ( MediaWikiServices $services
	) {
		$repo = WikibaseRepo::getDefaultInstance();
		$localEntitySource = $repo->getLocalEntitySource();

		return new LocalSourceEntityNamespacesFactory(
			$localEntitySource, $services->getNamespaceInfo()
		);
	},
];
