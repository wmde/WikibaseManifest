<?php

namespace MediaWiki\Extension\WikibaseManifest;

use Config;


class ManifestGenerator
{
    private $config;
    private $equivEntitiesFactory;
    private $conceptNamespaces;
    private $externalServicesFactory;
    private $entityNamespacesFactory;

    public function __construct(
        Config $config,
        EquivEntitiesFactory $equivEntitiesFactory,
        ConceptNamespaces $conceptNamespaces,
        ExternalServicesFactory $externalServicesFactory,
        EntityNamespacesFactory $entityNamespacesFactory
    ) {
        $this->config = $config;
        $this->equivEntitiesFactory = $equivEntitiesFactory;
        $this->conceptNamespaces = $conceptNamespaces;
        $this->externalServicesFactory = $externalServicesFactory;
        $this->entityNamespacesFactory = $entityNamespacesFactory;
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
            'entities' => $this->entityNamespacesFactory->getEntityNamespaces()->toArray()
        ];
    }

}
