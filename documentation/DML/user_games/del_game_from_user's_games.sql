#delete game ? from user ?’s games
DELETE FROM user_games WHERE user_id=? AND game_id=?;