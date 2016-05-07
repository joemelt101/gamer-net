# create game
SELECT game_id FROM game WHERE name=? AND developer=? AND platform=? AND genre=? AND year=? AND type=? LIMIT 1;
INSERT INTO game(name, developer, platform, genre, year, type, description, youtube_video_id)
	VALUES(?, ?, ?, ?, ?, ?, ?, ?);