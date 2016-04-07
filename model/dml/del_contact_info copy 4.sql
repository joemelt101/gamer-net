/*
type
0 = requester
1 = requestee
2 = currently friends
3 = blocker
4 = blockee
*/

#user ? blocks user ?
UPDATE relationship
	SET type='3' WHERE user_id=? AND friend_id=?;
UPDATE relationship
	SET type='4' WHERE user_id=? AND friend_id=?;