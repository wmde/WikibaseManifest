# External Services

We chose one external service can be build from the Wikibase config (when set), the SPARQL endpoint address.
The rest we left as wikibase manifest specific config options.
There is no real way to automagically discover this, so it must be specified by a user.

**service whitelist**

 - queryservice
 - queryservice-ui
 - quickstatements
 - openrefine-reconcile

We restricted value of service to those in a white list, so that there is no chance of name conflicts for different services (eg. 2 wikibases choosing `qs` to mean something different).
Whitelist can currently be found in `ExternalServices`.
We expect to need to expand this whitelist to include more services almost immediately.

**sparql vs queryservice**

We decided not to call the main query service `sparql` as it could be possible for multiple query services with different feature sets.
The `queryservice` is known to be the WMF Wikbase query service with extra features such as `LABEL SERVICE` etc.
A generic SPARQL endpoint may not have these.
