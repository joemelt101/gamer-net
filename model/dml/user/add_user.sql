# create user
INSERT INTO user(username, email, alias, salt, hash_pass)
	VALUES(?, ?, ?, ?, ?);