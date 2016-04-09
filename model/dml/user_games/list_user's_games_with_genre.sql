#list all user ?’s video games
SELECT game.game_id, name, developer, platform, genre FROM game
JOIN user_games ON game.game_id = user_games.game_id
WHERE user_games.user_id=? AND genre=?
ORDER BY name;