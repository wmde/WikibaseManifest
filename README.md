# WikibaseManifest

**__This is a prototype and is not currently supported or deployed by WMDE.__**

WikibaseManifest is an extension that combines metadata about a Wikibase installation exposing it as a simple API.
The goal is to help tool makers write tools that can target any wikibase.

Example output can be found in the [examples directory](/docs/examples), e.g [wikidata](/docs/examples/wikidata.json), raw json can be [retrieved too](https://raw.githubusercontent.com/wmde/WikibaseManifest/master/docs/examples/wikidata.json).

This would be exposed at an endpoint such as https://www.wikidata.org/w/rest.php/wikibase/manifest/v0/manifest

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

This extension was developed as part of the 2020 April prototyping week at WMDE.

#### Decisions & reasoning

Decisions, how things work, and why are documented below:

 - [API](/docs/api.md)
   - [entityNamespaces](/docs/entityNamespaces.md)
   - [equivEntities](/docs/equivEntities.md)
   - [externalServices](/docs/externalServices.md)
   - [localRdfNamespaces](/docs/localRdfNamespaces.md)

#### Doing stuff

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
