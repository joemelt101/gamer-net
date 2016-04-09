#search for user by username or alias
SELECT username, alias FROM user
	WHERE username=? OR alias=?
		ORDER BY alias;