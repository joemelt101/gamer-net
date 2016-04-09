# create user
INSERT INTO user(username, salt, hash_pass, gender, age)
	VALUES(?, ?, ?, ?, ?);