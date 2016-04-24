#search for user by username or alias
SELECT user_id, username, alias FROM user
	WHERE username LIKE ? OR alias LIKE ?
		ORDER BY alias;