<?php

namespace MediaWiki\Extension\WikibaseManifest;

use ArrayObject;
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
        $output = $this->generator->generate();
        return $this->convertEmptyArraysToObjects( $output );
    }

    private function convertEmptyArraysToObjects( $wholeArray ) {
        array_walk( $wholeArray, [ $this, 'addRemoveKeyFromEmptyArray' ] );
        return $wholeArray;
    }

    private function addRemoveKeyFromEmptyArray( &$value ){
        if ($value == []) {
            $value = new ArrayObject();
        } else if ( is_array($value) ) {
            array_walk($value, [ $this, 'addRemoveKeyFromEmptyArray' ]);
        }
    }
}
