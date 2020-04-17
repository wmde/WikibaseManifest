# Entity namespaces

The key is called just `entities` as we might want to add more information than just namespaces (perhaps slot etc?)
We named the keys `namespaceId` and `namespaceString` so as to be self explanatory but also not too deep.

Currently the expectation would be that the `namespaceString` is added to `:Q123` for example in order to get the title.

THe entity list if built from all LOCAL entity types that are enabled via the Local `EntitySources`.
This means that this list also serves as the list of enables entity types.
