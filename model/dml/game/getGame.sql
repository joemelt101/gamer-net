#grab game id after creating it so game id can be stored in user=? game list
SELECT game_id FROM game WHERE name=? AND developer=? AND platform=? AND year=? AND type=?;