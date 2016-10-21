// Clear out the DB and start fresh
MATCH (n)
DETACH DELETE n;

// Create some products
//
// Note that we use "product_id" rather than simply "id". While you can have a
// property called "id", Neo4j maintains its own internal identifier for nodes,
// which is also called "id", though it is displayed using the ID() function
// rather than using the dot identifier.
//
// Try creating a node with an "id" property, and look at how "id" and Neo4j's
// internal "id" value differ when viewing the node in the Neo4j browser.
CREATE (:Product {product_id: 12, name: "Dog food", description: "The most delicious dog food ever", price: 20}),
       (:Product {product_id: 34, name: "Dog biscuits", description: "The yummiest dog biscuits ever", price: 5}),
       (:Product {product_id: 56, name: "Squeaky dog toy", description: "A fun squeaky toy", price: 10}),
       (:Product {product_id: 78, name: "Comfy cat bed", description: "Soft and claw-proof", price: 30}),
       (:Product {product_id: 90, name: "Sunglasses", description: "It has nothing to do with pets", price: 15});



// Create some customers
//
// Note that in the previous query, we neither gave the Products an identifier
// nor returned any information. Here, we're giving Alice and Bob an identifier
// and returning their created nodes.
CREATE (alice:Customer {name: "Alice", email: "alice@example.com"}),
       (bob:Customer {name: "Bob", email: "bob@example.com"}),
       (:Customer {name: "Charlie", email: "charlie@example.com"}),
       (:Customer {name: "Dave", email: "dave@example.com"})
RETURN alice, bob;



// Create some orders
//
// We use the MERGE clause here, which is essentially "MATCH or CREATE".
// So, if the pattern being MERGEd exists, Neo4j will use it for the
// rest of the query. If not, it will be created.

    // Alice orders dog food and dog biscuits
    //
    // You can specify what properties to search for using the WHERE clause
    MATCH (customer:Customer), (product:Product)
    WHERE customer.email = "alice@example.com" AND product.product_id IN [12, 34]
    MERGE (customer)-[:PLACED]->(order:Order {date: "2016-02-05"})
    MERGE (order)-[:CONTAINS]->(product);

    // Bob orders dog biscuits and a squeaky dog toy
    //
    // You can also specify the properties and values in JSON format
    MATCH (customer:Customer {email: "bob@example.com"}),
          (product1:Product {product_id: 34}),
          (product2:Product {product_id: 56})
    MERGE (customer)-[:PLACED]->(order:Order {date: "2016-02-05"})
    MERGE (order)-[:CONTAINS]->(product1)
    MERGE (order)-[:CONTAINS]->(product2);

    // Charlie orders dog food, dog biscuits, a squeaky dog toy, and sunglasses
    //
    // You can mix-and-match WHERE and JSON properties, where appropriate.
    MATCH (customer:Customer {email: "charlie@example.com"}), (product:Product)
    WHERE product.product_id IN [12, 34, 56, 90]
    MERGE (customer)-[:PLACED]->(order:Order {date: "2016-02-05"})
    MERGE (order)-[:CONTAINS]->(product);

    // Dave orders sunglasses and a comfy cat bed
    MATCH (customer:Customer {email: "dave@example.com"}),
          (product1:Product {product_id: 78}),
          (product2:Product {product_id: 90})
    MERGE (customer)-[:PLACED]->(order:Order {date: "2016-02-05"})
    MERGE (product1)<-[:CONTAINS]-(order)-[:CONTAINS]->(product2);



// Let's see what we've created.
MATCH (n)
RETURN n
LIMIT 50;



// Someone is browsing the dog biscuit item (product_id: 34) - what should we recommend that they order?
//
// The results of this query must be viewed in ROW mode, where it will show various product names
// and how many other orders contained them.
MATCH (order:Order)-[:CONTAINS]->(product:Product {product_id: 34}),
      (order)-[:CONTAINS]->(recommendation:Product)
WHERE NOT recommendation = product
RETURN recommendation.name, COUNT(recommendation) as recommended
ORDER BY recommended DESC;



// Alice is browsing the dog biscuit page - what should we recommend that she order?
MATCH (customer:Customer)-[:PLACED]->(order:Order)-[:CONTAINS]->(product:Product {product_id: 34}),
      (order)-[:CONTAINS]->(recommendation:Product)
WHERE NOT recommendation = product AND NOT customer.email = "alice@example.com"
RETURN recommendation.name, COUNT(recommendation) as recommended
ORDER BY recommended DESC;
