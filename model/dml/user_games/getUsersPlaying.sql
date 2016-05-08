#Counts the number of user's playing a specific game
SELECT user_games.user_id FROM `user_games` 
JOIN game ON user_games.game_id = game.game_id WHERE user_games.game_id=?;