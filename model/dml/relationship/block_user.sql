#user ? sends user ? a friend request
UPDATE relationship SET type=‘3’ WHERE user_id=? AND friend_id=?;
UPDATE relationship SET type=‘4’ WHERE user_id=? AND friend_id=?;