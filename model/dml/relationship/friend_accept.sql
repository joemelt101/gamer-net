#user ? accepts user ?’s friend request
UPDATE relationship
	SET type=‘2’ WHERE user_id=? AND friend_id=?;
UPDATE relationship
	SET type='2' WHERE user_id=? AND friend_id=?;