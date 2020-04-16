<?php

namespace MediaWiki\Extension\WikibaseManifest;

use Config;


class ManifestGenerator
{
    private $config;
    private $equivEntitiesFactory;
    private $conceptNamespaces;
    private $externalServicesFactory;

    public function __construct(
        Config $config,
        EquivEntitiesFactory $equivEntitiesFactory,
        ConceptNamespaces $conceptNamespaces,
        ExternalServicesFactory $externalServicesFactory
    ) {
        $this->config = $config;
        $this->equivEntitiesFactory = $equivEntitiesFactory;
        $this->conceptNamespaces = $conceptNamespaces;
        $this->externalServicesFactory = $externalServicesFactory;
    }

    public function generate(): array
    {
        $config = $this->config;

        $localRdfNamespaces = $this->conceptNamespaces->getLocal();
        $externalServices = $this->externalServicesFactory->getExternalServices();
        // TODO perhaps we should only add keys to this result when the values are not empty
        return [
            'name' => $config->get('Sitename'),
            'rootScriptUrl' => $config->get('Server') . $config->get('ScriptPath'),
            'equivEntities' => [
                'wikidata' => $this->equivEntitiesFactory->getEquivEntities()->toArray()
            ],
            'localRdfNamespaces' => $localRdfNamespaces,
            'externalServices' => $externalServices->toArray(),
            'entities' => [
                'item' => [
                    'namespaceId' => 0,
                    'namespaceString' => ''
                ],
                'property' => [
                    'namespaceId' => 123,
                    'namespaceString' => 'Property'
                ]
            ]
        ];
    }

}
