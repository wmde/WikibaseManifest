const { assert, REST } = require( 'api-testing' );

describe( 'Manifest', () => {
	const client = new REST( 'rest.php/wikibase/manifest/v0' );

	describe( 'GET /manifest', () => {
		it( 'should return the manifest', async () => {
			const { body } = await client.get( '/manifest' );
			assert.hasAllKeys(
				body,
				[ 'name', 'rootScriptUrl', 'equivEntities', 'localRdfNamespaces', 'externalServices', 'entities' ]
			);
			assert.typeOf( body.name, 'string' );
			assert.typeOf( body.rootScriptUrl, 'string' );
			assert.typeOf( body.equivEntities, 'object' );
			assert.typeOf( body.localRdfNamespaces, 'object' );
			assert.typeOf( body.externalServices, 'object' );
			assert.typeOf( body.entities, 'object' );
		} );
	} );
} );
