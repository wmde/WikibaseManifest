<?php

namespace MediaWiki\Extension\WikibaseManifest;

use Config;


class ManifestGenerator
{
    private $config;
    private $equivEntitiesFactory;
    private $conceptNamespaces;

    public function __construct(
        Config $config,
        EquivEntitiesFactory $equivEntitiesFactory,
        ConceptNamespaces $conceptNamespaces
    ) {
        $this->config = $config;
        $this->equivEntitiesFactory = $equivEntitiesFactory;
        $this->conceptNamespaces = $conceptNamespaces;
    }

    public function generate(): array
    {
        $config = $this->config;

        $localRdfNamespaces = $this->conceptNamespaces->getLocal();
        // TODO perhaps we should only add keys to this result when the values are not empty
        return [
            'name' => $config->get('Sitename'),
            'rootScriptUrl' => $config->get('Server') . $config->get('ScriptPath'),
            'equivEntities' => [
                'wikidata' => $this->equivEntitiesFactory->getEquivEntities()->toArray()
            ],
            'localRdfNamespaces' => $localRdfNamespaces,
            // TODO finish implementing
            'externalServices' => [ 'a' => 'b' ],
        ];
    }

}
