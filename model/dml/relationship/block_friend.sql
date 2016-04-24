#user ? blocks friend ?
UPDATE relationship SET type=3 WHERE user_id=? AND friend_id=?;
UPDATE relationship SET type=4 WHERE user_id=? AND friend_id=?;