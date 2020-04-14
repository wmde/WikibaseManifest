<?php

namespace MediaWiki\Extension\WikibaseManifest;

use MediaWiki\Rest\SimpleHandler;

class RestApi extends SimpleHandler
{
    private $generator;

    public function __construct( ManifestGenerator $generator ) 
    {
        $this->generator = $generator;
    }

    public function run() 
    {
        return $this->generator->generate();
    }
}
