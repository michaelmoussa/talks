// Let's create a graph representing the Seven Bridges of Königsberg
CREATE (west:Land {name: "West"}),
       (north:Land {name: "North"}),
       (east:Land {name: "East"}),
       (south:Land {name: "South"}),

       (west)-[b1:BRIDGE {name: "West to North (1)"}]->(north),
       (west)-[b2:BRIDGE {name: "West to North (2)"}]->(north),

       (north)-[b3:BRIDGE {name: "North to East"}]->(east),

       (west)-[b4:BRIDGE {name: "West to South (1)"}]->(south),
       (west)-[b5:BRIDGE {name: "West to South (2)"}]->(south),

       (west)-[b6:BRIDGE {name: "West to East"}]->(east),

       (south)-[b7:BRIDGE {name: "South to East"}]->(east)
RETURN west, north, south, east, b1, b2, b3, b4, b5, b6, b7;



// The problem states that we must walk through the city and cross each and every bridge exactly once.
//
// We don't care about visiting the same Land multiple times, nor do we care in which
// direction we cross the bridge. We only care about crossing each bridge exactly one time.
//
// Since this is not possible, the following query will return no rows.
MATCH (:Land)-[b1:BRIDGE]-(:Land)-[b2:BRIDGE]-(:Land)-[b3:BRIDGE]-(:Land)-[b4:BRIDGE]-(:Land)-[b5:BRIDGE]-(:Land)-[b6:BRIDGE]-(:Land)-[b7:BRIDGE]-(:Land)
RETURN b1, b2, b3, b4, b5, b6, b7;



// Euler's theorem states that, in order for this to be possible, there must be either 0 or 2 landmasses with
// an odd number of bridges connecting them.
//
// So, let's remove a bridge...
MATCH ()-[b:BRIDGE {name: "West to East"}]-()
DELETE b;

// ... and try again!
//
// Note that this time we only go up to b6, because there are only 6 bridges.
MATCH (:Land)-[b1:BRIDGE]-(:Land)-[b2:BRIDGE]-(:Land)-[b3:BRIDGE]-(:Land)-[b4:BRIDGE]-(:Land)-[b5:BRIDGE]-(:Land)-[b6:BRIDGE]-(:Land)
RETURN b1, b2, b3, b4, b5, b6;

// If we change the RETURN to include the bridge name, and we capture the first land mass, the
// ROW output mode in the browser will show us all of the possible paths through the city.
MATCH (land:Land)-[b1:BRIDGE]-(:Land)-[b2:BRIDGE]-(:Land)-[b3:BRIDGE]-(:Land)-[b4:BRIDGE]-(:Land)-[b5:BRIDGE]-(:Land)-[b6:BRIDGE]-(:Land)
RETURN land.name, b1.name, b2.name, b3.name, b4.name, b5.name, b6.name;
