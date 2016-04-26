#user ? declines user ?’s friend request or user ? deletes user ? as a friend
DELETE FROM relationship WHERE user_id=? AND friend_id=?;
DELETE FROM relationship WHERE user_id=? AND friend_id=?;