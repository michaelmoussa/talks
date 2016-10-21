# ZendCon 2016 - Introduction to Graph Databases with Neo4j

Slides, code examples, and reference materials for my Introduction to Graph Databases with Neo4j talk at ZendCon 2016.

## Cypher Instructions

1. Download and install [Neo4j](http://neo4j.com/download/) Community Edition.
1. Start Neo4j and navigate to [http://localhost:7474](http://localhost:7474) and follow the prompts.
1. Open your browser's `localStorage` and replace the contents of `neo4j.documents` with [this](localStorage/neo4j.documents) and `neo4j.folders` with [this](localStorage/neo4j.folders).
    * You can access your browser's localStorage using the Resources or Storage tab of your browser's Developer tools.
1. Refresh the page, and the demo folders and favorites will be available in the Neo4j browser Favorites.

If you can't get that to work, you can also just copy and paste the queries from [ecommerce.cql](ecommerce.cql) and [seven-bridges.cql](seven-bridges.cql).

## PHP Instructions

1. `cd examples/php` and run `composer install`
1. Run `php neo4j-client-example.php` or `php neo4j-ogm-example.php`

## Links
* **Slides:** [ZendCon2016-Graph-Databases-16x9.pdf](ZendCon2016-Graph-Databases-16x9.pdf?raw=true)
* **joind.in:** https://joind.in/talk/d9ead

## Problems?

[Tweet](https://twitter.com/michaelmoussa) at me or open an [issue](https://github.com/michaelmoussa/talks/issues). I really, truly want to help, and it's not a bother at all.
