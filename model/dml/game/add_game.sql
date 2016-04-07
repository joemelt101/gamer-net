# create game
INSERT INTO game(developer, year, name, genre, type, platform)
	VALUES(?, ?, ?, ?, ?, ?);


# example for bungie video game
#INSERT INTO game(developer, year, name, genre, type, platform)
#	VALUES('Bungie', 2001, 'Halo: Combat Evolved', 'FPS', 0, 'Xbox');