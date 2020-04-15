<?php

namespace MediaWiki\Extension\WikibaseManifest;

use Config;

class ManifestGenerator
{
    private $config;

    public function __construct( Config $config ) 
    {
        $this->config = $config;
    }

    public function generate() 
    {
        $config = $this->config;

        return [
         'name' => $config->get('Sitename'),
         'rootScriptUrl' => $config->get('Server') . $config->get('ScriptPath'),

        ];
    }
}
