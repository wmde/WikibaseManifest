# API

We chose to implement the API using the new MediaWiki REST API so that we could learn about it.

All code is implemented in a way that it would be easy to plug into the ActionAPI if desired.

Once specific REST API thing that we had to handle was he returning of empty arrays in our code being sent as empty arrays not objects via the REST API.
This pattern has also been seen and has caused annoyances in previous Wikibase APIs.
To fix this for us, we implemented code to recursively clean these up in the `RestApi`, see `EmptyArrayCleaner`.
