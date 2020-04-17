# WikibaseManifest

Decisions, how things work, and why are documented below:

 - [API](/docs/api.md)
   - [entityNamespaces](/docs/entityNamespaces.md)
   - [equivEntitues](/docs/equivEntitues.md)
   - [externalServices](/docs/externalServices.md)
   - [localRdfNamespaces](/docs/localRdfNamespaces.md)

### Installation

In order to use this extension you need to enable the MediaWiki REST API.

```php
$wgEnableRestAPI = true;
```

Then load the extension as you would normally:

```php
wfLoadExtension( 'WikibaseManifest' );
```

And configure as appropriate:

```php
$wgWbManifestExternalServiceMapping = [
	'queryservice-ui' => 'https://query.wikidata.org',
];
$wgWbManifestWikidataMapping = [
	'P31' => 'P1',
];
```

### Development

We recommend using `mediawiki-docker-dev` for development.

You can test the development endpoint at:
http://default.web.mw.localhost:8080/mediawiki/rest.php/wikibase/manifest/v0/manifest

**PHP**

You can run the code linting with:
```sh
composer test
```

And fix with:
```sh
composer fix
```

To run phpunit tests with mediawiki-docker-dev run:
```sh
mw-docker-dev phpunit-file default extensions/WikibaseManifest/tests/
```

**JS**

You can run the api end to end tests using :
```sh
npm run api-testing
```

You can run the api end to end test linting with:
```sh
npm run api-testing-lint
```

And fix with
```sh
npm run api-testing-lint -- --fix
```
