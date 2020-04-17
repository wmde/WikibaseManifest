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

return [
	WbManifest::WIKIBASE_MANIFEST_GENERATOR => function ( MediaWikiServices $services ) {
		$equivEntitiesFactory =
			$services->getService( WbManifest::WIKIBASE_MANIFEST_CONFIG_EQUIV_ENTITIES_FACTORY );

		$conceptNamespaces = $services->getService( WbManifest::WIKIBASE_MANIFEST_CONCEPT_NAMESPACES );

		$externalServicesFactory = $services->getService( WbManifest::WIKIBASE_MANIFEST_CONFIG_EXTERNAL_SERVICES_FACTORY );

		$entityNamespacesFactory = $services->getService( WbManifest::WIKIBASE_MANIFEST_LOCAL_SOURCE_ENTITY_NAMESPACES_FACTORY );

		return new ManifestGenerator(
			$services->getMainConfig(),
			$equivEntitiesFactory,
			$conceptNamespaces,
			$externalServicesFactory,
			$entityNamespacesFactory
		);
	},
	WbManifest::WIKIBASE_MANIFEST_CONFIG_EQUIV_ENTITIES_FACTORY => function ( MediaWikiServices $services ) {
		return new ConfigEquivEntitiesFactory(
			$services->getMainConfig(), WbManifest::ENTITY_MAPPING_CONFIG
		);
	},
	WbManifest::WIKIBASE_MANIFEST_CONFIG_EXTERNAL_SERVICES_FACTORY => function ( MediaWikiServices $services ) {
		return new ConfigExternalServicesFactory(
			$services->getMainConfig(), WbManifest::EXTERNAL_SERVICES_CONFIG
		);
	},
	WbManifest::WIKIBASE_MANIFEST_CONCEPT_NAMESPACES => function () {
		$repo = WikibaseRepo::getDefaultInstance();
		$rdfVocabulary = $repo->getRdfVocabulary();
		$localEntitySource = $repo->getLocalEntitySource();
		// TODO: Get Canonical Document URLS from a service not straight from remote
		return new ConceptNamespaces( $localEntitySource, $rdfVocabulary, $repo->getCanonicalDocumentUrls() );
	},
	WbManifest::EMPTY_ARRAY_CLEANER => function () {
		return new EmptyArrayCleaner();
	},
	WbManifest::WIKIBASE_MANIFEST_LOCAL_SOURCE_ENTITY_NAMESPACES_FACTORY => function ( MediaWikiServices $services
	) {
		$repo = WikibaseRepo::getDefaultInstance();
		$localEntitySource = $repo->getLocalEntitySource();

		return new LocalSourceEntityNamespacesFactory(
			$localEntitySource, $services->getNamespaceInfo()
		);
	},
];
