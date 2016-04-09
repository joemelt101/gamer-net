#search for game by name/developer
SELECT name, developer FROM game
WHERE name=? OR developer=?
ORDER BY name;