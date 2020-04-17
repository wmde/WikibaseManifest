<?php

namespace MediaWiki\Extension\WikibaseManifest;

class ConceptNamespaces {
	private $localEntitySource;
	private $rdfVocabulary;
	private $canonicalDocumentUrls;

	public function __construct( $localEntitySource, $rdfVocabulary, $canonicalDocumentUrls ) {
		$this->localEntitySource = $localEntitySource;
		$this->rdfVocabulary = $rdfVocabulary;
		$this->canonicalDocumentUrls = $canonicalDocumentUrls;
	}

	public function getLocal() {
		$conceptBaseUri = $this->localEntitySource->getConceptBaseUri();
		$dataUri = $this->canonicalDocumentUrls[ $this->localEntitySource->getSourceName() ];
		return $this->rdfVocabulary->getRawConceptNamespaces( $conceptBaseUri, $dataUri );
	}
}
