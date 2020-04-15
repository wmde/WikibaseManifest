<?php

namespace MediaWiki\Extension\WikibaseManifest;

use Config;

class ManifestGenerator
{
    private $config;
    private $equivEntities;

    public function __construct(
        Config $config,
        EquivEntities $equivEntities
    ) {
    
        $this->config = $config;
        $this->equivEntities = $equivEntities;
    }

    public function generate(): array
    {
        $config = $this->config;

        return [
            'name' => $config->get('Sitename'),
            'rootScriptUrl' => $config->get('Server') . $config->get('ScriptPath'),
            'equivEntities' => [
                'wikidata' => $this->equivEntities->toArray(),
            ],
        ];
    }
}
