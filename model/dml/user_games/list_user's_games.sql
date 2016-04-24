#list all user ?’s games
SELECT game.game_id, name, developer, platform, genre, year, type, description FROM game
JOIN user_games ON game.game_id = user_games.game_id
WHERE user_games.user_id=?
ORDER BY name;