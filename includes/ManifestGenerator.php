<?php

namespace MediaWiki\Extension\WikibaseManifest;

use Config;
use Wikibase\Repo\WikibaseRepo;

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
        $repo = WikibaseRepo::getDefaultInstance();
        $rdfVocabulary = $repo->getRdfVocabulary();
        $localEntitySource = $repo->getLocalEntitySource();
        $conceptBaseUri = $localEntitySource->getConceptBaseUri();
        $dataUri = $repo->getCanonicalDocumentUrls()[ $localEntitySource->getSourceName() ];
        $config = $this->config;

        $localRdfNamespaces = $rdfVocabulary->getRawConceptNamespaces( $conceptBaseUri, $dataUri );
        return [
            'name' => $config->get('Sitename'),
            'rootScriptUrl' => $config->get('Server') . $config->get('ScriptPath'),
            'equivEntities' => [
                'wikidata' => $this->equivEntities->toArray(),
            ],
            //'localRdfNamespaces' => $localRdfNamespaces,
        ];
    }

}
