const { assert, REST } = require( 'api-testing' );

describe( 'Manifest', () => {
	const client = new REST( 'rest.php/wikibase/manifest/v0' );

	describe( 'GET /search/page?q={term}', () => {
		it( 'should return the manifest', async () => {
			const { body } = await client.get( '/manifest' );
			assert.hasAllKeys(
				body,
				[ 'name', 'rootScriptUrl', 'equivEntities' ]
			);
		} );
	} );
} );
