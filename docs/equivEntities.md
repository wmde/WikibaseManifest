# Equivalent entities

We decided to go for a basic mapping between Wikidata entity ID and local Wikibase ID as:
 - Most tools etc that will be using this manifest will already have these Wikidata IDs hardcoded and thus the transition will be easier.
 - Creating some new definition of these entities such as "instance-of" is probably a bad idea because our definition of "instance of" might be different to someoneelse's, but Wikidata gives us a truth to point to.
 - All the Wikidata entity mappings are keyed under "wikidata" to allow possible future extension for other mappings
 - All IDs (Items Properties etc) are in the same list as there is no real reason for them not to be. We made the assumption that this would not be every item in the Wikibase, but circa 100.
