https://www.mediawiki.org/wiki/Wikibase/Indexing/RDF_Dump_Format

We investigated listing some form of all URIS that were needed in the manifest.
This seemed a bit pointless as most of the URI mid sections are hard coded in RdfVocabulry.php and therefor should be easy to calculate.

**data uri**
We found one unusual prefix, "data:", which doesn't correspond to "wdata:" from the docs but seems about the same.
ALSO should $predicateNamespacePrefix be set to "w" on wikidata to make "data", "wdata"
This is weirdly made from the canonical URL of the title for Special:EntityData.
This can change unexpectidly when mediawiki things are changed:
 - Changing cannonical URLS
 - Changing long to short urls
 - Adding www.
 - Changing from http to https
Should it? This seems evil? This might end up with inconsistent query service data of this set of URIS if it ends up there.

**concept base uri**
We also found some interesting logic around the use of "conceptBaseUri" setting from mediawiki.
In RdfVocabulry "entity/" is removed if it exists in order to create a "top uri" which is then used to create most of the rest of the uris.
Except:
  - "wd"
  - "s"
These use the plain base concept URI and ignore if it has /entity/ or something else.
