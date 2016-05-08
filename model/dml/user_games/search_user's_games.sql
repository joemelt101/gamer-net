#find out if a game exists in user's game list
SELECT game_id FROM user_games WHERE user_id=? AND game_id=?;