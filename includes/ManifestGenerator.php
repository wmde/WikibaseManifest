<?php

namespace MediaWiki\Extension\WikibaseManifest;

use Config;
use Wikibase\Repo\WikibaseRepo;

class ManifestGenerator
{
    private $config;
    private $equivEntities;
    private $conceptNamespaces;

    public function __construct(
        Config $config,
        EquivEntities $equivEntities,
        ConceptNamespaces $conceptNamespaces
    ) {
        $this->config = $config;
        $this->equivEntities = $equivEntities;
        $this->conceptNamespaces = $conceptNamespaces;
    }

    public function generate(): array
    {
        $config = $this->config;

        $localRdfNamespaces = $this->conceptNamespaces->getLocal();
        return [
            'name' => $config->get('Sitename'),
            'rootScriptUrl' => $config->get('Server') . $config->get('ScriptPath'),
            'equivEntities' => [
                'wikidata' => $this->equivEntities->toArray(),
            ],
            'localRdfNamespaces' => $localRdfNamespaces,
        ];
    }

}
