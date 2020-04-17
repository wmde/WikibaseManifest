<?php

namespace MediaWiki\Extension\WikibaseManifest;

use MediaWiki\Rest\SimpleHandler;

class RestApi extends SimpleHandler {
	private $generator;
	private $emptyArrayCleaner;

	public function __construct( ManifestGenerator $generator, EmptyArrayCleaner $emptyArrayCleaner ) {
		$this->generator = $generator;
		$this->emptyArrayCleaner = $emptyArrayCleaner;
	}

	public function run() {
		$output = $this->generator->generate();
		return $this->emptyArrayCleaner->clean( $output );
	}
}
