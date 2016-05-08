#Finds the 3 most popular games (the games that are in the most user's game lists)
SELECT *, COUNT(user_games.game_id) FROM `user_games` 
JOIN game ON user_games.game_id = game.game_id
GROUP BY user_games.game_id
ORDER BY COUNT(user_games.game_id) DESC;