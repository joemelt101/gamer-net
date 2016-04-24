#search for games by name or developer
SELECT * FROM game WHERE name LIKE ? OR developer LIKE ? ORDER BY name;