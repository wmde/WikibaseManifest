<?php


namespace MediaWiki\Extension\WikibaseManifest;


use Wikibase\DataAccess\EntitySource;

class LocalSourceEntityNamespacesFactory implements EntityNamespacesFactory {

    /**
     * @var EntitySource
     */
    private $localEntitySource;

    public function __construct( EntitySource $localEntitySource ) {
        $this->localEntitySource = $localEntitySource;
    }

    public function getEntityNamespaces(): EntityNamespaces {
        $entityNamespaceMapping = array_map(
            function ( $x ) {
                return [ EntityNamespaces::NAMESPACE_ID => $x ];
            },
            $this->localEntitySource->getEntityNamespaceIds()
        );

        // TODO add namespace string from wgCanonicalNamespaces (does that even exist) or something?

        return new EntityNamespaces( $entityNamespaceMapping );
    }
}
