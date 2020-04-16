<?php

namespace MediaWiki\Extension\WikibaseManifest;

use InvalidArgumentException;

class ExternalServices
{

    public const KEY_QUERYSERVICE = 'queryservice';
    public const KEY_QUERYSERVICE_UI = 'queryservice-ui';
    public const KEY_QUICKSTATEMENTS = 'quickstatements';
    public const KEY_OPENREFINE_RECONCILE = 'openrefine-reconcile';

    private const WHITELIST = [
        self::KEY_QUERYSERVICE,
        self::KEY_QUERYSERVICE_UI,
        self::KEY_QUICKSTATEMENTS,
        self::KEY_OPENREFINE_RECONCILE
    ];

    /**
     * @var array
     */
    private $mapping;

    /**
     * @param string[] $mapping
     */
    public function __construct( array $mapping )
    {
        $this->validateMapping($mapping);
        $this->mapping = $mapping;
    }

    private function validateMapping( array $mapping ): void
    {
        foreach( $mapping as $k => $v ) {
            if(!is_string($k) || !in_array( $k, self::WHITELIST )) {
                throw new InvalidArgumentException('Keys of mapping should be strings');
            }
            if ( !is_string( $v ) || !filter_var( $v, FILTER_VALIDATE_URL ) ) {
                throw new InvalidArgumentException( 'Values of mapping should be string URLs' );
            }
        }
    }

    public function toArray(): array
    {
        return $this->mapping;
    }

}
