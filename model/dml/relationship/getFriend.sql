#check if user has a friend with friend_id=?
SELECT type FROM relationship
JOIN user ON relationship.friend_id = user.user_id
WHERE relationship.user_id=? AND friend_id=?;